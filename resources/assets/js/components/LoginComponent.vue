<template>
    <div>
        <div class="login-component-page" v-bind:style="{ backgroundImage: 'url(https://localhost/ui/bg_ru.jpg)' }">
            <div class="row login_screen">
                <div class="col-md-4 offset-md-2" style="margin-top: 5%;">
                    <div class="card" style="border-radius: 15px;">
                        <a style="text-align: center;" href="/"><img height="70" class="m-4" src="https://localhost/ui/logo.svg" alt=""></a>
                        <div v-if="!err_status_q" class="panel-body">
                            <div class="form-horizontal" id="loginf">
                                <div class="form-group">
                                
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Имя</label>
                                                <input autocomplete="off" spellcheck="false" v-model="name" @input="inputEv" placeholder="Сергей" type="text" class="form-control" required autofocus>   
                                            </div>

                                            <div class="col-md-6 pl-0">
                                                <label>Фамилия</label>
                                                <input autocomplete="off" spellcheck="false" v-model="surname" @input="inputEv"  placeholder="Плутогаренко" type="text" class="form-control" required autofocus>   
                                            </div>
                                            <div class="col mt-2" v-if="surname.length != 0 && name.length != 0 && !track_name_surname && err_status">
                                                <p class="text-danger mb-0" style="font-size: small;line-height: 1.3em;">
                                                    Поля \"имя\" и \"фамилия\" должны содержать от 2 до 20 символов русского или английского алфавитов
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <div class="custom-control custom-checkbox">
                                            <input autocomplete=off v-model="agreement" type="checkbox" class="custom-control-input" id="terms">
                                            <label class="custom-control-label" for="terms">Я согласен с условиями лицензионного соглашения</a></label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-4">                                        
                                        <center>
                                            <a v-if="!loginAccess" style="text-align: center;"                            class="unactive-ui-el"><img height="47" class="mt-2 mb-1" :src="'https://localhost/ui/login_ru.svg'" alt=""></a>
                                            <a v-if="loginAccess"  style="text-align: center;" v-on:click="coonect2game"  class="active-ui-el">  <img height="47" class="mt-2 mb-1" :src="'https://localhost/ui/login_ru.svg'" alt=""></a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="err_status_q" class="panel-body">
                            <div class="col-md-12"> 
                                <p>Приносим свои извинения, произошла неопознанная ошибка, поробуйте воспользоватсья сервисмо позже.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 5%;">
                    <div class="card" style="border-radius: 15px; height: 468px;">
                        <center><img height="70" class="m-4" src="https://localhost/ui/rating.svg" alt=""></center>
                        <div v-if="!err_status_q" class="panel-body" style="overflow: auto;">
                            <div class="form-horizontal p-3"  id="loginf">
                                <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center">Место</th>
                                        <th class="text-center">Имя</th>
                                        <th class="text-center">Очки</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">
                                            1
                                        </td>
                                        <td class="text-center">
                                            <i class="fas fa-crown" style="color: rgb(255 119 4);"></i> Сергей
                                        </td>
                                        <td class="text-center">
                                           {{ rating[0]["score"] + 150 }}
                                        </td>
                                    </tr>
                                    <tr v-for="(item, index) in rating">
                                        <td class="text-center">
                                            {{ index+2 }}
                                        </td>
                                        <td class="text-center">
                                            {{ item.name }}
                                        </td>
                                        <td class="text-center">
                                            {{ item.score }}
                                        </td>

                                        
                                    </tr>
                                    
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            <footer class="footer">
                <div class="px-3">
                    <div class="row">
                        <div class="col-md-12 text-white"  style="line-height: 2.1vh">
                            <small>© 2021 Команда PLEXeT. Цифровой прорыв.</small>
                        </div>
                    </div>
                </div>
            </footer>    
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dataRoomNumber'],
        mounted(){
            axios.post('https://localhost/check', {
                key: this.roomId,
            })
            .then((response) => {
                
                if(response.data == 0){
                    this.key_block = false; 
                }else{
                    this.key_block = true;
                    this.key = this.roomId;
                }
               
            });

            axios.post('https://localhost/rating_list')
            .then((response) => {
               this.rating = response.data;
            });


            axios.post('https://localhost/key')
            .then((response) => {
                this.key = response.data;
            });


        },
        data(){
            return {
                roomId: this.dataRoomNumber,
                name: "",
                surname: "",
                key: "",
                rating: null,
                key_block: false,
                bad_key: false,
                lang: undefined,
                err_status: false,   // ошибка клиент
                err_status_q: false, // ошибка сервер (любая)
                err_timer: undefined,
                track_status: false,
                agreement: false,
            }
        },
        computed:{
            track_name_surname: function(){
                return (/^[a-zA-Z\ \-]{2,20}$|^[а-яА-Я\ \-]{2,20}$/mu.test(this.name)) && (/^[a-zA-Z\ \-]{2,20}$|^[а-яА-Я\ \-]{2,20}$/mu.test(this.surname));  
            },
            loginAccess: function () {
                //  имя больше двух и меньше 20 символов
                //  фамилия также больше двух и меньше 20
                return this.track_name_surname &&  this.agreement;
            }
        },
        methods: {
            inputEv(){
               
                if(this.track_status != this.track_name_surname){
                    this.err_status = false;
                }
                clearTimeout(this.err_timer);
                this.err_timer = setTimeout(() => {
                    this.err_status = true;
                    this.track_status = this.track_name_surname;
                }, 1000);
            
            },
            
            coonect2game(){
                axios.post('https://localhost/teams/connect', {
                    roomId: this.roomId,
                    name: this.name,
                    surname: this.surname,
                    key: this.key,
                })
                .then((response) => {
                    
                    if(response.data == 1){
                        window.location.href="https://localhost/rules/" + this.lang + "/" + this.key;
                    }else{
                        this.bad_key = true;
                    }
                });
            }
        } 
    }
</script>


<style>

.login-component-page{
    height: 100vh;
    overflow: hidden;

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
.unactive-ui-el{
    -webkit-filter: grayscale(100%);
    -moz-filter: grayscale(100%);
    -ms-filter: grayscale(100%);
    -o-filter: grayscale(100%);
    filter: grayscale(100%);
    filter: gray; /* IE 6-9 */
}
.active-ui-el:hover {
    cursor: pointer;
}
.login_screen{
    height: 94vh;
}
.footer{
    height: 6vh;
}
</style>