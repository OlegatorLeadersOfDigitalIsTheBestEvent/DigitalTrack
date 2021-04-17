<template>
    <div>
        <div class="mt-3">
            <div class="row">
                <div class="col-md"></div>
                <div class="col-md-8 map" 
                    :style="{
                        'background': 'url(https://localhost/schemes/scheme.png) no-repeat',
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
        
        <div v-if="user.day >= 1 && user.day <= 5">
            <!-- Widget Switcher -->
            <div class="swith-toogler rounded text-center">
                <div class="p-2 active-ui-el"  v-bind:class="{ 'active-screen-class rounded' : (screen == 1) }" v-on:click="screen = 1"><i class="fas fa-industry" aria-hidden="true"></i></div>
                <div class="p-2 active-ui-el"  v-bind:class="{ 'active-screen-class rounded' : (screen == 2) }" v-on:click="screen = 2"><i class="fas fa-layer-group" aria-hidden="true"></i></div>
                <div class="p-2 active-ui-el"  v-bind:class="{ 'active-screen-class rounded' : (screen == 3) }" v-on:click="screen = 3"><i class="far fa-newspaper" aria-hidden="true"></i></div>
            </div>

            <div class="battle-map" style="height: 88vh;">
                <!-- Widget header -->
                <header>
                    <nav class="navbar navbar-expand-md navbar-dark fixed-top m-0 p-0" style="height: 57px; background: #fff; position: initial;">
                        <div class="day-card">
                            <div class="text-muted day-card-score font-weight-bold" id="ui-stage">День {{ user.day }}</div>
                        </div>
                        <span class="timer ml-4" id="ui-timer">{{ Math.floor(timer.time / 60).toString().padStart(2, '0') }}:{{ Math.floor(timer.time % 60).toString().padStart(2, '0') }}</span>
                        
                        <div class="ml-4 header-score-big-money" id="ui-timer-resource">{{ money_formatter_big(user.day_money) }}</div>
                        <div class="ml-4 header-score-time"  id="ui-timer-resource">{{ user.day_time }}</div>
                        
                        <img class="navbar-nav ml-auto mr-4" style="height: 80%; " src="https://localhost/ui/logo.svg" alt="">
                    </nav>
                </header>
            
            
                <!-- Begin page content -->
                <div class="mt-3">
                    <div v-show="screen == 1" class="row">
                        <div class="col-md"></div>
                        <div class="col-md-8 map" style="background: url(https://localhost/schemes/scheme.png) no-repeat"></div>
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
            
            
                <div class="mt-3">
                    <div class="container">
                        <div v-show="screen == 2" class="row" style="max-height: calc(90vh - 140px);overflow-y: auto;">
                            <div v-if="!cards.length" class="screen-size-with-vertical-align col-md-12">У вас еще нет доступных карт!</div>
                            <div class="col-md-2" style="position: relative;padding-top: 20px;display: inline-block;" v-for="card in cards">
                                <span class="badge badge-danger" v-if="new_cards_for_step.indexOf(card.id) != -1">NEW</span>
                                <img class="active-ui-el" 
                                    v-on:dblclick="
                                        clicked().then((res) => { 
                                            if(res == 'dbclick'){
                                                if(card.active == true){ 
                                                    chooseCard(card.id, card.day_time, card.money)
                                                }else{
                                                    openCardWindow(card.id, card.day_time, card.money, card.active, false)
                                                }
                                            } 
                                        })
                                    "    
                                    v-on:click="
                                        clicked().then((res) => { 
                                            if(res == 'click'){
                                                if(card.active == true){ 
                                                    openCardWindow(card.id, card.day_time, card.money, card.active, true)
                                                }else{
                                                    openCardWindow(card.id, card.day_time, card.money, card.active, false)
                                                }
                                            } 
                                        })
                                    " 
                                    style="width: 100%;" 
                                    v-bind:class="{ 'uncative-ui' : card.active == false }" 
                                    :src="smallCardById(card.id)" 
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            
                <div v-show="screen == 3" class="container" style="min-height: 480px;">
                    <div class="row">
                        <div class="col-md-7 news-list">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="4">Сообщения в телеграмме</th>
                                    </tr>
                                </thead>
                                <tbody>
            
                                    <tr v-if="!news.length">
                                        <td colspan="4" class="text-center">Пока что нет публичных новостей</td>
                                    </tr>
                                    <!-- 

                                        type

                                        1 - публичные новости
                                        2 - приватные новости
                                        3 - информация о новых картах
                                        4 - начало дня
                                    -->
                                    <tr v-for="item in news.slice().reverse()" v-bind:class="{ 'table-danger text-center' : (item.type == 4) }" >
                                        <td v-bind:class="{ 'cell-color-public-news' : (item.type == 1) }" v-if="item['description_ru'] == null">
                                            <span v-if="item.type == 1" class="text-primary">
                                                <i class="fas fa-book-reader"></i>
                                                <small>Новость из популярного телеграм канала</small><br>
                                            </span>
                                            <p class="mb-0" v-html="item['news_ru']"></p>
                                        </td>
                                        <td v-bind:class="{ 'cell-color-public-news' : (item.type == 1) }" v-if="item['description_ru'] != null">
                                            <span v-if="item.type == 1">
                                                <i class="fas fa-book-reader"></i>
                                                <small class="text-primary">Новость из популярного телеграм канала</small><br>
                                            </span>
                                            <b>{{ item['news_ru'] }}</b>
                                            <p class="mt-3 mb-0" v-html="item['description_ru']"></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-5">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th colspan="3">Потери денег</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="text-center">
                                            Сохранено
                                        </td>
                                        <td class="text-center">
                                            Максимально
                                        </td>
                                        <td class="text-center">
                                            Сохранил Сергей <img src="/ui/32.png" style="margin-top: -4px;">
                                        </td>
                                    </tr>
                                    <tr v-for="(item, index) in dynamic">
                                        <td v-if="index < user.day" class="text-center">
                                            $ {{ money_formatter(item.save_result) }}
                                        </td>
                                        <td v-if="index >= user.day">
                                            <div class="text-placeholder animated-background">{{ money_formatter(index) }}</div>
                                        </td>

                                        <td v-if="index < user.day"  class="text-center">
                                            $ {{ money_formatter(item.best_result) }}
                                        </td>
                                        <td v-if="index >= user.day">
                                            <div class="text-placeholder animated-background">{{ money_formatter(index) }}</div>
                                        </td>

                                        <td v-if="index < user.day"  class="text-center">
                                            $ {{ money_formatter(item.best_result) }}
                                        </td>
                                        <td v-if="index >= user.day">
                                            <div class="text-placeholder animated-background">{{ money_formatter(index) }}</div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <footer class="navbar-fixed-bottom row-fluid" style="height: 12vh;">
            <div class="row">
                <div class="col-md-2">
                    <div class="money-card">
                        <div class="text-muted money-card-score" id="ui-money">$ {{ money_formatter(user.score) }}</div>
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
                    ['news_ru']: "Новые карты: " + new_cards.join(', '),
                    ['description_ru']: null,
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
            })
            .then((response) => {
               
                response.data.forEach(item => {
                    this.news.push(item); 
                });
           
            });
        },
        
         cardById(id) {
            return 'https://localhost/cards/full/' + id + '.svg'
        },
        smallCardById(id) {
            return 'https://localhost/cards/small/' + id + '.svg'
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