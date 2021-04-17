<template>
    <div>
        <div class="mt-3">
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-8 map" 
                    :style="{
                        'background': 'url(https://localhost/schemes/' + lang + '/scheme.png) no-repeat',
                    }"
                ></div>
                <div class="col-md-3">
                    <div class="row">
                        <div v-for="(obj, index) in history_render_images_list" v-bind:class="{ 'offset-md-2' : (index % 2 == 0),  'offset-md' : (index % 2 != 0), 'class-parent-card' : (index != 0 && index != 1)}" class="col-md-4 mt-2">
                            <img 
                                style="width: 100%;" 
                                :src="obj.src" 
                                v-on:click="
                                    clicked().then((res) => { 
                                        if(res == 'click'){
                                            if(obj.id != undefined){
                                                openCardWindow(obj.id, getTimeById(obj.id), getMoneyById(obj.id), true, false)
                                            }                                    
                                        } 
                                    })                                
                                "
                                v-bind:class="{ 'card-map-c' : (obj.id != undefined)}"
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="navbar-fixed-bottom row-fluid" style="height: 12vh;">
            <div class="row">
                <div class="col-md-2">
                    <div class="money-card">
                        <div class="text-muted money-card-score" id="ui-money">$ 200 000</div>
                    </div>
                </div>
                <div class="col-md-8">   
                    <img :style= "[choose.length <= 6 ? {'width': '16%'} : {'width': '13.7%'}]"  :src="smallCardById(id)">
                </div>
                <div class="col-md-2">
                    <div class="submit-card">
                        <div class="text-muted money-card-score">Отправить</div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>


<script>
export default {
    props: ['dataRoomNumber'],
    data() {
        return {
           

            user: {
                team_id: this.dataRoomNumber,
                team_name: null,
                old_score: 0,
                score: 800,
                day_time: 0,
                day_money: 0,
                day: 0,
                // флаг для кнопки сигнализирубщий что идет игровой день и можно отправить ход
                step_activity: false,
            },
            lang: ru,
            dynamic:{
                1:{
                    save_result: 0,
                    best_result: 0,
                },
                2:{
                    save_result: 0,
                    best_result: 0,
                },
                3:{
                    save_result: 0,
                    best_result: 0,
                },
                4:{
                    save_result: 0,
                    best_result: 0,
                },
                5:{
                    save_result: 0,
                    best_result: 0,
                },
            },
            new_cards_for_step: [],
            news: [],
            cards: [],
            choose: [],
            history: [],
            
        }
    },
    computed: {
        status_window: function(){
            return this.video.second > this.notify_stamps[this.user.day].start && this.video.second < this.notify_stamps[this.user.day].end;  
        },
        team_room: function() {
            return "team" + this.user.team_id;
        },
        history_render_images_list: function() {
            
            let render_list = [];
            let max_count_of_cards = 20;
            
            if ((max_count_of_cards - this.history.length) >= 0) {
                // добавляем знаящие карты
                for (let i = 0; i < this.history.length; i++) {
                    let data_push = {
                        id: this.history[i],
                         src: this.smallCardById(this.history[i]),
                    }
                    render_list.push(data_push);
                }
                
                // добавлям заглушки
                for (let i = 0; i < (max_count_of_cards - this.history.length); i++) {
                    let data_push = {
                        id: undefined,
                        src: 'https://localhost/ui/green-place.svg',
                    }

                    render_list.push(data_push);
                }
            } else {
                for (let i = 0; i < max_count_of_cards; i++) {
                    let data_push = {
                        id: this.history[i],
                        src: this.smallCardById(this.history[i]),

                    }

                    render_list.push(data_push);
                }
            }

            return render_list;
        }
    },
    methods: {
        // обновление карт
        cardsUpdate(){
            axios.post('https://localhost/newcards', {
                team_id: this.user.team_id,
                day: this.user.day,
                lang: this.lang,
            })
            .then((response) => {
                // только новые карты
                let new_cards = [];

                // список старых карт
                let old_cards_list = this.cards;
                let new_cards_list = response.data;
                
                
                // обновление списка активных карт
                this.cards = response.data;
                
                // идем по новым картам 
                new_cards_list.forEach((new_card, new_index) => {
                    // если новой карты нет в списке старых мы ее добавляем в новые карты
                    let status_availability = false;
                    old_cards_list.forEach((old_card, old_index) => {
                        if(old_card.id == new_card.id){
                            status_availability = true;
                        }
                    });
                    if(status_availability == false){ new_cards.push(new_card.id) }
                });

                this.new_cards_for_step = new_cards;

                // добавляем новость о новых картах
                this.news.push({
                    type: 3,
                    ['news_' + this.lang]: this.ui_lang[this.lang].newCardsNotyfy + ": " + new_cards.join(', '),
                    ['description_' + this.lang]: null,
                });
               
            });
        },
        newDay(){
            // инкреминируем день
            this.user.day++;
            
            //bpvtyztv экран
            this.screen = 1;

            // обновляем интерфейс
            this.user.day_time = 100;
            this.user.day_money = 100;
            
            if(this.user.day >= 1 && this.user.day <= 5){

                // тем временем в фоне получаем новости публичные и приватные и карты
                // публичные новости
                this.getPublicNews();

                // получаем приватные новости
                this.getPrivateNews();

                // получаем новые карты
                this.cardsUpdate();
                
                // динамика cash loss   
                this.getDynamic();
            }
        },
        makeAllCardsActive() {
            this.cards.forEach((card, index) => {
                this.cards[index].active = true;
            });
        },
        makeAllCardsNonActive() {
            this.cards.forEach((card, index) => {
                this.cards[index].active = false;
            });
        },
        recalculateCardsStatuses() {
            this.cards.forEach((card, index) => {
                if ((this.user.day_money - card.money) < 0 || (this.user.day_time - card.day_time) < 0) {
                    this.cards[index].active = false;
                    return;
                }

                // bug 
                this.choose.forEach((id) => {
                    if (card.id == id) {
                        this.cards[index].active = false;
                        return;
                    }
                });
            });
        },
        getTimeById(id) {
            let time = null;
            this.cards.forEach((card, index) => {
                if (this.cards[index].id == id) {
                    time = this.cards[index].day_time;
                }
            });
            return time;
        },
        getMoneyById(id) {
            let money = null;
            this.cards.forEach((card, index) => {
                if (this.cards[index].id == id) {

                    money = this.cards[index].money;
                }
            });
            return money;
        },
        removeCardFromChooseCards(cardId) {
          
            this.choose.splice(this.choose.indexOf(cardId), 1);

            // меняем значени
            this.user.day_time += this.getTimeById(cardId);
            this.user.day_money += this.getMoneyById(cardId);

            // делаем все карты вновь активными 
            // пересчитываем все карты и оставляем только активные
            this.makeAllCardsActive();
            this.recalculateCardsStatuses();
            
        },
        chooseCard(cardId, time, money) {
            // добавляем карту 
            this.choose.push(cardId);


            // меняем значени
            this.user.day_time -= time;
            this.user.day_money -= money;


            //  пересчитываем все карты и оставляем только активные
            this.recalculateCardsStatuses();
        },

        // получение публичных новостей
        getDynamic(){
            axios.post('https://localhost/dynamic', {
                key: this.user.team_id,
                lang: this.lang,
            })
            .then((response) => {
               
                this.dynamic['1'].save_result = response.data.step1_user_result;
                this.dynamic['1'].best_result = response.data.step1_max_result;
                
                this.dynamic['2'].save_result = response.data.step2_user_result;
                this.dynamic['2'].best_result = response.data.step2_max_result;
                
                this.dynamic['3'].save_result = response.data.step3_user_result;
                this.dynamic['3'].best_result = response.data.step3_max_result;
            
                this.dynamic['4'].save_result = response.data.step4_user_result;
                this.dynamic['4'].best_result = response.data.step4_max_result;
                
                this.dynamic['5'].save_result = response.data.step5_user_result;
                this.dynamic['5'].best_result = response.data.step5_max_result;
                    
            });
        },

        // получение публичных новостей
        getPublicNews(){
            axios.post('https://localhost/public_news_publication', {
                team_id: this.user.team_id,
                day: this.user.day,
                lang: this.lang,
            })
            .then((response) => {
                    response.data.forEach(item => {
                        this.news.push(item); 
                    });
                
            });
        },
        
        //  получение приватных новостей
        getPrivateNews(){
            axios.post('https://localhost/private_news_publication', {
                team_id: this.user.team_id,
                day: this.user.day,
                 lang: this.lang,
            })
            .then((response) => {
               
                response.data.forEach(item => {
                    this.news.push(item); 
                });
           
            });
        },
        
     makeRecalculating(){
        axios.post('https://localhost/day_result', {
            team_id: this.user.team_id,
            day: this.user.day,
        })
        .then((response) => {
            this.user.old_score = this.user.score;
            this.user.score = response.data;
        });
    },
            
        }
    }
}
</script>