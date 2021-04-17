<template>
    <div style="background: #F2F3F6;">
       
        <!-- Widget Video Window -->
        <div>
            <div class="modal-card modal-card-dark" v-bind:class="{ 'modal-block' : video.status, 'modal-none' : !video.status }"></div>
            <!-- Отображаем картинку только когда открыто модальное окно -->
            
                <div 
                    class="modal-card modal-card-dark" 
                    v-bind:class="{ 'modal-block' : video.status, 'modal-none' : !video.status }"
                    style="background: #fff;"
                >            
                    <div v-if="user.day == 1" class="row" style="background-image: url('/maestro/1.png'); height: 100%; background-size: cover;">
                        <div class="col-2">
                            
                        </div>
                        <div class="col-4 p-5 m-5">
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обею,</p>
                            <p style="font-size: 18px;">Давно цах, которое не потой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электроннойстве текста по умолчанию,</p>
                            <img height="47" class="mt-2 mb-1 active-ui-el" :src="'https://digtrack.ru/ui/next.svg'" @click="videoEnd()">
                        </div>
                        <div class="col-6">
                            
                        </div>
                    </div>
                    <div v-else-if="user.day == 2" class="row" style="background-image: url('/maestro/2.png'); height: 100%; background-size: cover;">
                        <div class="col">
                        
                        </div>
                        <div class="col  p-5 m-5 text-white">
                            <p style="font-size: 18px;">Давно в потому, что тот обеспечивает более или менее стандартное Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию,</p>
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредо.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию,</p>
                            <img height="47" class="mt-2 mb-1 active-ui-el" :src="'https://digtrack.ru/ui/next.svg'" @click="videoEnd()">
                        </div>
                    </div>
                    <div v-else-if="user.day == 3" class="row" style="background-image: url('/maestro/3.png'); height: 100%; background-size: cover;">
                        <div class="col">
                            
                        </div>
                        <div class="col p-5 m-5 text-white">
                            <p style="font-size: 18px;">Давно выяснено,более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Зстве текста по умолчанию,</p>
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции чое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." Многие программы электронной вёрстки и редакторы HTML использолчанию,</p>
                            <img height="47" class="mt-2 mb-1 active-ui-el" :src="'https://digtrack.ru/ui/next.svg'" @click="videoEnd()">
                        </div>
                    </div>
                    <div v-else-if="user.day == 4" class="row" style="background-image: url('/maestro/4.png'); height: 100%; background-size: cover;">
                        <div class="col">
                            
                        </div>
                        <div class="col p-5 m-5">
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное Lorem Ipsum в качестве текста по умолчанию,</p>
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное Lorem Ipsum в качестве текста по умолчанию,</p>
                            <img height="47" class="mt-2 mb-1 active-ui-el" :src="'https://digtrack.ru/ui/next.svg'" @click="videoEnd()">
                        </div>
                    </div>
                    <div v-else-if="user.day == 5" class="row" style="background-image: url('/maestro/5.png'); height: 100%; background-size: cover;">
                       <div class="col-2">
                            
                        </div>
                        <div class="col-5 p-5 m-5">
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное Lorem Ipsum в качестве текста по умолчанию.</p>
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное Lorem Ipsum в качестве текста по умолчанию.</p>
                            <img height="47" class="mt-2 mb-1 active-ui-el" :src="'https://digtrack.ru/ui/next.svg'" @click="videoEnd()">
                        </div>
                        <div class="col-5">
                            
                        </div>
                    </div>
                    <div v-else-if="user.day == 6" class="row" style="background-image: url('/maestro/6.png'); height: 100%; background-size: cover;">
                        <div class="col-4">
                            
                        </div>
                        <div class="col-6 p-5 m-5">
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное Lorem Ipsum в качестве текста по умолчанию,</p>
                            <p style="font-size: 18px;">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное Lorem Ipsum в качестве текста по умолчанию,</p>
                            <img height="47" class="mt-2 mb-1 active-ui-el" :src="'https://digtrack.ru/ui/next.svg'" @click="videoEnd()">
                        </div>
                    </div>
                </div>
            <div class="notify_money_score py-3 px-5" v-if="status_window">
                <h3 class="text-center mb-0"> + $ {{ money_formatter(user.score - user.old_score) }}</h3>
            </div>
        </div>
        <!-- Widget Video Window -->



        <!-- Widget Card Modal Window -->
        <div>
            <div class="modal-card" v-on:click="closeCardWindow" v-bind:class="{ 'modal-block' : modal.status, 'modal-none' : !modal.status }"></div>
            <!-- Отображаем картинку только когда открыто модальное окно -->
            <img v-if="modal.status"  style="width: 30%;" class="modal-image" 
                
                v-bind:class="{ 'active-ui-el' : modal.card_active, 'uncative-ui' : !modal.card_active, }"
                v-on:click="
                
        
                        clicked().then((res) => { 
                            if(res == 'click'){
                            
                                if(modal.card_chose == true){ chooseCard(modal.card_id, modal.card_time, modal.card_money); }
                                closeCardWindow();
                            
                            } 
                        })
                        
                " 
                :src="cardById(modal.card_id)">

                <div class="col-md-12 my-3 substare-card-desc" v-bind:class="{ 'modal-block' : modal.status, 'modal-none' : !modal.status }">
                    <footer class="footer substare-footer">
                        <div class="px-3">
                            <div class="row">
                                <div class="col-md-12" style="line-height: 2.3vh;">
                                    <small>Для выбора карты нажмите на нее.</small>
                                </div>
                                <div class="col-md-12" style="line-height: 2.1vh;">
                                    <small>Для отмены выбора нажмите на серую область.</small>
                                </div>
                            </div>
                        </div>
                    </footer>
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
                        
                        <img class="navbar-nav ml-auto mr-4" style="height: 80%; " src="https://digtrack.ru/ui/logo.svg" alt="">
                    </nav>
                </header>
            
            
                <!-- Begin page content -->
                <div class="mt-3">
                    <div v-show="screen == 1" class="row">
                        <div class="col-md"></div>
                        <div class="col-md-8 map" style="background: url(https://digtrack.ru/schemes/scheme.png) no-repeat"></div>
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
                                            Сохранил Сергей <img src="https://digtrack.ru/avatars/5.png" style="height: 18px; margin-top: -4px;">
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
                        <img :style= "[choose.length <= 6 ? {'width': '16%'} : {'width': '13.7%'}]"  alt="Для отмены выбора карты нажмите на нее." v-for="id in choose" class="choosed_card" v-on:dblclick="removeCardFromChooseCards(id)" :src="smallCardById(id)">
                    </div>
                    <div class="col-md-2">
                        <div class="submit-card" v-on:click="(user.step_activity == true && choose.length > 0) ? sendstep() : null" v-bind:class="{ 'uncative-ui'  : (user.step_activity == false || choose.length == 0), 'active-ui-el' : !(user.step_activity == false || choose.length == 0)}">
                            <div class="text-muted money-card-score" id="ui-money">Отправить</div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script>
export default {


    /*

        Необходимо реализовать увеличение наше карты предприятияю Это очень важно? так как сейчас карта крайне маленькая.
        Для карты предприятия будет отдельный css все будет построено на:

            background-position-x: 0;
            background-position-y: 0;
            background-size: 100%;
        
        В зависимости от перетаскивания будет меняться position карты. Пы выключению, изменяется флаг, и мы включаем режим.

    */
    props: ['dataRoomNumber', 'lang'],
    mounted() {},
    created() {
        // по загрузке вызываем новый день
        this.newDay();
    },
    data() {
        return {
            // таймер последнего клика, для того чтобы отличать событий click and double click
            // при открытии модального окна с выбором карты 
            click: undefined,

            // статус активного экрана (карта предприятия, игровые карты, новости и рейтинг)
            screen: 1,

            video:{
                id: undefined,
                status: false,
                second: undefined,
            },  
            
            // время на ход
            timing_intervals:{
                1: 60*10,
                2: 60*8,
                3: 60*6,
                4: 60*4,
                5: 60*2, 
            },

            // минуты показа прибыли
            notify_stamps:{
                1: {
                    start: 0,
                    end: 0,
                },
                2: {
                    start: 5,
                    end: 10,
                },
                3: {
                    start: 2,
                    end: 7,
                },
                4: {
                    start: 3,
                    end: 7,
                },
                5: {
                    start: 2,
                    end: 9,
                },
                6: {
                    start: 2,
                    end: 10,
                }, 
            },

            // данные интерфейса модльного окна с картой 
            modal: {
                status:     false,
                card_id:    null,
                card_time:  null,
                card_money: null,
                card_active: false,
                card_chose: false,
            },

            // данные пользовательского интерфейса
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

            // timer
            timer: {
                time: 0,
                activity: false,
                timer_controller: null
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
            video_quality_val: 720,
            // lang: this.lang,
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
                        src: 'https://digtrack.ru/ui/placholder-place.svg',
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
        // Обновить качество видео
        video_quality(){
            let status_connection_speed = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
 
            if(status_connection_speed > 5){
                this.video_quality_val = 1080;
            }else{
                this.video_quality_val = 720;
            }
        },

        // обновление карт
        cardsUpdate(){
            axios.post('https://digtrack.ru/newcards', {
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
                    'news_ru': "Номера новых карт: " + new_cards.join(', '),
                    'description_ru': null,
                });
            
            });
        },


        // получение публичных новостей
        getDynamic(){
            axios.post('https://digtrack.ru/dynamic', {
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
            axios.post('https://digtrack.ru/public_news_publication', {
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
            axios.post('https://digtrack.ru/private_news_publication', {
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
            axios.post('https://digtrack.ru/day_result', {
                team_id: this.user.team_id,
                day: this.user.day,
            })
            .then((response) => {
                // console.log(response);
                this.user.old_score = this.user.score;
                this.user.score = response.data;
                
            });
        },

        // первая часть дня
        newDay(){
            // Обновляем качество следующего видео
            this.video_quality();

            // инкреминируем день
            this.user.day++;
            
            //bpvtyztv экран
            this.screen = 1;

            // обновляем интерфейс
            this.user.day_time = 100;
            this.user.day_money = 100;
            
            // запускаем видео
            this.video.id = this.user.day;
            this.video.status = !this.video.status;
            
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

        // игровой процесс дня
        videoEnd(){

            //  если видос с id 6, т.е разбор мы переадресуем после него на результаты и прочее
            if(this.video.id == 6){  
                window.location.href = "https://digtrack.ru/results/" + this.user.team_id;
            }

            // добавляем для вкладки новостей инфу о новом дне 
            this.news.push({
                type: 4,
                "news_ru": "День " + this.user.day,
                "description_ru": null,
            });


            this.video.second = undefined;
            this.video.status = false;
            this.video.id = undefined;
            

            // запускаем таймер
            this.newTimer(this.timing_intervals[this.user.day], true);
            
        },

        
        // метод на промисе для реагирования на события слик и даблклик когда они весят на одном элементе 
        // в нашем случаеэто выбор карты 
        clicked(){
            return new Promise ((resolve, reject) => {
                if (this.click) {
                    clearTimeout(this.click);
                    resolve('dbclick');
                }

                this.click = setTimeout(() => {
                    this.click = undefined;
                    resolve('click');
                }, 200)
            });
        },

        // открывает модальное окно с картой
        openCardWindow(card_id, card_time, card_money, card_active, card_chose){
            this.modal.status      = true; 
            this.modal.card_id     = card_id; 
            this.modal.card_time   = card_time; 
            this.modal.card_money  = card_money;
            this.modal.card_active = card_active;
            this.modal.card_chose  = card_chose;
        },

        //  закрывает модальное окно
        closeCardWindow(){
            this.modal.status      = false; 
            this.modal.card_id     = null; 
            this.modal.card_time   = null; 
            this.modal.card_money  = null;
            this.modal.card_active = false;
            this.modal.card_chose  = false;
        },

        // timer
        newTimer(seconds, card_activation) {
            
            clearInterval(this.timer.timer_controller);
            this.timer.timer_controller = null;
            this.timer.time = seconds;
            this.timer.activity = true;
            if (card_activation) {
                this.makeAllCardsActive();
                this.user.step_activity = true;
            }

            this.timer.timer_controller = setInterval(() => {
                if (this.timer.time > 0) {
                    this.timer.time = this.timer.time - 1;
                } else {
                    clearInterval(this.timer.timer_controller);
                    this.timer.activity = false;
                    if (card_activation) {
                        this.makeAllCardsNonActive();
                        this.user.step_activity = false;

                        // отправляем выбранные карты на сервер
                        this.sendstep();
                        // НЕ БАГ ЛИ ЭТО ВЕДЬ send step и так содержит newDay()
                        // this.newDay();
                    }

                }
            }, 1000);
            
        },

        cardById(id) {
            return 'https://digtrack.ru/cards/full/' + id + '.svg'
        },
        smallCardById(id) {
            return 'https://digtrack.ru/cards/small/' + id + '.svg'
        },
        /* 
            
        Функция делающая все карты активными, по запуску таймера.

        */
        makeAllCardsActive() {
            this.cards.forEach((card, index) => {
                this.cards[index].active = true;
            });
        },
        /* 
            
        Функция делающая все карты не активными, по отсановке таймера.

        */
        makeAllCardsNonActive() {
            this.cards.forEach((card, index) => {
                this.cards[index].active = false;
            });
        },

        /* 
            
        Метод делаюший проверку, если при выборе карты один из элементов время на ход или деньги меньше нуля, то мы просто делаемкарту не активной,
        после выбора кажлой карты мы в обязательно порядке пересчитываем данное значение.

        */
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
        // преобразуем тысячи в ЧПУ вид
        money_formatter_big: function(price) {    
            return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        },
       // преобразуем тысячи в ЧПУ вид
        money_formatter: function(price) {
            if(price <= 1000){
                return price;
            }
            
            if(price / 1000 >= 1000){
                return price / 1000000 + ' млн.';
            }else{
                return price / 1000 + ' тыс.';
            }
        },
        // getCardInfoById(id){
        //     this.cards.forEach((card) => {
        //         if(card.id == id){
        //             return card;
        //         }
        //     });
        // },
        sendstep(){
                axios.post('https://digtrack.ru/step/choose', {
                    team_id: this.user.team_id,
                    day: this.user.day,
                    cards: this.choose,
                })
                .then((response) => {
                    /* 

                        Добавляем карты в историю клиентскую 
                        А также удаляем карты из доступных для выбора, если необходимо
                        это сделать в соответствии с типом карты
                
                    */
                    
                    this.choose.forEach(id => {
                        this.cards.forEach((card, index) => {
                            if (this.cards[index].id == id) {
                                
                                /* Карта многоразовая */
                                if (this.cards[index].type == 1) {
                                    /* В рамках MVP при выборе многоразовой карты мы не делаем ничего*/
                                    /* Карта одноразовая */
                                } else {
                                    //  добавляем карту в историю
                                    this.history.push(id);
                                    // удаляем карту из списка доступных
                                    this.cards.splice(index, 1);

                                }
                            }
                        });
                    });
                    
                    // стопим таймер
                    clearInterval(this.timer.timer_controller);
                    
                    // делаем перерасчет сразу после отправки карт
                    // функция должна стоять здесь так как мы 
                    // должны быть уверены что она запуститься сразу
                    // после отправки хода, а не параллельно
                    // так как сервер может не успеть принять карты
                    // в функцию recululating включено обновление
                    this.makeRecalculating();

                    // запускаем скрипт нового дня
                    this.newDay();
                    
                    // Очищаем выбранные карты
                    this.choose = [];
                    // делаем все карты не активными
                    this.makeAllCardsNonActive();
                    
                });

                
        }
    }
}
</script>

<style>

/* video::-webkit-media-controls-panel{display:none;} */

video::-webkit-media-controls-play-button{}

video::-webkit-media-controls-volume-slider-container{display:none;}

video::-webkit-media-controls-volume-slider{display:none;}

video::-webkit-media-controls-mute-button{display:none;}

video::-webkit-media-controls-timeline{display:none;}

video::-webkit-media-controls-current-time-display{display:none;}

video::-webkit-full-page-media::-webkit-media-controls-panel{display:none;}

video::-webkit-media-controls-timeline-container{display:none;}

video::-webkit-media-controls-time-remaining-display{display:none;}

video::-webkit-media-controls-seek-back-button{display:none;}

video::-webkit-media-controls-seek-forward-button{display:none;}

video::-webkit-media-controls-fullscreen-button{display:none;}

video::-webkit-media-controls-rewind-button{display:none;}

video::-webkit-media-controls-return-to-realtime-button{display:none;}

video::-webkit-media-controls-toggle-closed-captions-button {display:none;}


::-webkit-scrollbar { width: 8px; }

::-webkit-scrollbar-track {
  background: #f7efef;
  border-radius: 5px;
}

::-webkit-scrollbar-thumb {
  background: #a5a2a2;
  border-radius: 5px;
}

/* =================== */
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
        font-size: 3.5rem;
    }
}

/* Custom page CSS
        -------------------------------------------------- */

/* Not required for template or sticky footer method. */

main>.container {
    padding: 57px 15px 0;
}

.footer {
    /* background-color: #f5f5f5; */
}

.footer>.container {
    padding-right: 0px;
    padding-left: 0px;
}

code {
    font-size: 80%;
}

.money-card {
    background-size: contain;
    height: 7.5vh;
    border-top-right-radius: 0.5em;
    width: 100%;
    margin-top: 4.5vh;
    background: #9bbe6c;
    border-right: 5px #67884c solid;
}
.submit-card{
    background-size: contain;
    height: 7.5vh;
    border-top-left-radius: 0.5em;
    width: 100%;
    margin-top: 4.5vh;
    background: #9bbe6c;
    border-left: 5px #67884c solid;
}
.money-card-score {
    line-height: 8vh;
    color: #fff;
    text-align: center;
    color: #fff !important;
    font-size: 25px;
}

.day-card {
    /* background: url(/ui/blue-bg-day.svg);
    height: 57px;
    width: 130px; */
    height: 57px;
    width: 130px;
    background: #3e51b5;
    border-top-right-radius: 0.85em;
    border-bottom-right-radius: 0.85em;
    border-right: 5px solid #414d98;
}

.day-card-score {
    line-height: 57px;
    color: #fff;
    text-align: center;
    color: #fff !important;
    font-size: 19px;
}

.timer {
    line-height: 57px;
    font-size: 19px;
    font-weight: bold;
}

.card-map-c:hover {
    cursor: pointer;
}

#hp-ctn-howItWorks:hover {
    cursor: pointer;
}

#hp-ctn-howItWorks
/* 62, 219 */

    {
    position: fixed;
    top: 240px;
    right: 0px;
    padding: 0px;
    margin: 0px;
    width: 40px;
    height: 160px;
    background: url(/ui/news.svg);
    z-index: 15;
    border-radius: 3px 0px 0px 3px;
}

#hp-ctn-howItWorks img {
    margin: 15px 0px 0px 13px;
}

#hp-ctn-howItWorks p {
    color: #fff;
    font-weight: bold;
    padding: 23px;
    line-height: 182px;
    -moz-transform: rotate(-90deg);
    -ms-transform: rotate(-90deg);
    -o-transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg);
}

.uncative-ui {
    -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    -o-filter: grayscale(100%);
    filter: grayscale(100%);
    filter: gray;
    /* IE 6-9 */
}

.active-ui-el:hover {
    cursor: pointer;
}

footer {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    /* height: 50px; */
    height: 140px;
    /* background: #e6e6e6; */
    background: #f2f3f6;
}

.choosed_card {
    height: 220px;
    transition-delay: 0.4s;
    transition: .4s;
    margin-right: 5px;
}

.choosed_card:hover {
    cursor: pointer;
    margin-top: -24px;
}
.swith-toogler{
    background: rgb(230, 230, 230);
    color: #4e4d4d;

    position: absolute;
    
    margin: auto;
    left: 9px;
    bottom: 50%;
    top: auto;
    font-size: 20px;
    z-index: 1;
}


.active-screen-class{
    color: rgb(230, 230, 230);
    background: #4e4d4d;
}


.class-parent-card{
    margin-top: -4.4rem !important;
}
.news-list{
    max-height: calc(90vh - 140px); 
    overflow-y: auto;
}

.modal-card {
	position: fixed;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
	background: rgba(0,0,0,0.8);
	z-index: 100000;
	-webkit-transition: opacity 400ms ease-in;
	-moz-transition: opacity 400ms ease-in;
	transition: opacity 400ms ease-in;
	display: none;

}

.modal-card-dark{
    background: rgba(0,0,0,1);
}

.modal-block{ display: block; }
.modal-none{ display: none;}

.header-score-time{
    /* height: 37px;
    width: 108px;
    background: url(https://digtrack.ru/ui/card_time.svg);
    line-height: 37px;
    font-weight: bold;
    font-size: 19px;
    padding-left: 30px;
    text-align: center;
    background-size: cover; */
    height: 48px;
    width: 120px;
    background: url(https://digtrack.ru/ui/card_time.svg);
    line-height: 48px;
    font-weight: bold;
    font-size: 19px;
    background-size: cover;
    padding-left: 15px;
    text-align: center;

}

.header-score-big-money{
    /* height: 48px;   
    width: 112px;
    background: url(https://digtrack.ru/ui/card_money_big.svg);
    line-height: 48px;
    font-weight: bold;
    font-size: 19px;
    padding-left: 21px;
    text-align: center; */
    height: 48px;
    width: 120px;
    background: url(https://digtrack.ru/ui/card_money_big.svg);
    line-height: 48px;
    font-weight: bold;
    font-size: 19px;
    background-size: cover;
    padding-left: 15px;
    text-align: center;
}

.header-score-small-money{
    /* height: 48px;
    width: 106px;
    background: url(https://digtrack.ru/ui/card_money.svg);
    line-height: 48px;
    font-weight: bold;
    font-size: 19px;
    padding-left: 21px;
    text-align: center; */
    height: 48px;
    width: 120px;
    background: url(https://digtrack.ru/ui/card_money.svg);
    line-height: 48px;
    font-weight: bold;
    font-size: 19px;
    background-size: cover;
    padding-left: 15px;
    text-align: center;
}

.modal-image{
    margin: auto;
    position: absolute;
    top: 0; left: 0; bottom: 0; right: 0;
    z-index: 100001;
}
.badge{
    color: #fff;
    background-color: #dc3545;
    position: absolute;
    right: 4px;
    top: 14px;
    text-align: center;
    font-size: 15px;
    z-index: 1;
}
.screen-size-with-vertical-align{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(90vh - 140px);
    max-height: calc(90vh - 140px);
}

.substare-card-desc{
    z-index: 100001; 
    position: absolute; 
    left: 0; 
    bottom: 0; 
    color: #fff; 
    line-height: 2.1vh; 
}
.substare-footer{
    background: none; 
    height: auto;
}
.map{
    background-position: center !important; 
    background-size: contain !important;
}

.notify_money_score{
        /* background: red; */
    background-size: contain;
    min-height: 7.5vh;
    border-top-left-radius: 0.5em;
    border-bottom-left-radius: 0.5em;
    /* width: 100%; */
    margin-top: 4.5vh;
    background: #9bbe6c;
    border-left: 5px #67884c solid;
    /* border-top: 5px #67884c solid; */
    color: white;
    z-index: 100001;
    display: block;
    position: absolute;
    /* top: 0; */
    bottom: 15%;
    right: 0;

}

.error-component-page{
    height: 100vh;
    overflow: hidden;

    /* Местоположение фоновой картинки */   
    background-image: url("https://digtrack.ru/ui/bg.jpg");      
    /* Фоновое изображение выровнено по центру в горизонтальной и вертикальной плоскостях */   
    background-position: center center;      
    /* Фон не повторяется */   
    background-repeat: no-repeat;      
    /* Фон зафиксирован в области просмотра и потому не двигается, когда высота контента превышает высоту изображения */   
    background-attachment: fixed;      
    /* Это свойство заставляет фон менять масштаб при изменении размеров содержащего его контейнера*/   
    background-size: cover;      
    /* Цвет фона, который будет отображаться при загрузке фоновой картинки*/   
    background-color: #464646; 
}
.error_screen{
    height: 94vh;
}

.cell-color-public-news{
    background: #c4e9ff63;
}
.text-placeholder{
    background: #e9ecef;
    /* height: 100px; */
    color: #e9ecef;
    display: block;
    /* line-height: 16px; */
    position: relative;
    border-radius: 4em;
    /* font-size: 12px; */
}
</style>