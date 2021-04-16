<template>
    <div>
        <div class="login-component-page">
            <div class="row login_screen">
                <div class="col-md-4 offset-md-2" style="margin-top: 5%;">
                    <div class="card" style="border-radius: 15px;">
                        <a style="text-align: center;" href="/"><img height="70" class="m-4" src="/ui/logo.svg" alt=""></a>
                        <div class="panel-body">
                            <div class="form-horizontal" id="loginf">
                                <div class="form-group">
                                
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Имя</label>
                                                <input autocomplete="off" spellcheck="false" type="text" class="form-control" required autofocus>   
                                            </div>

                                            <div class="col-md-6 pl-0">
                                                <label>Фамилия</label>
                                                <input autocomplete="off" spellcheck="false" type="text" class="form-control" required autofocus>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-md-offset-4">                                        
                                        <center>
                                            <a style="text-align: center;"  class="active-ui-el">  <img height="47" class="mt-2 mb-1" :src="'/ui/login.svg'" alt=""></a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="margin-top: 5%;">
                    <div class="card" style="border-radius: 15px; height: 468px;">
                        <center><img height="70" class="m-4" src="/ui/rating.svg" alt=""></center>
                        
                    </div>
                </div>
            </div>    
            
        </div>
    </div>
</template>

<script>
    export default {
        props: ['dataRoomNumber'],
        mounted(){
            axios.post('/check', {
                key: this.roomId,
            })
            .then((response) => {
                try{
                    if(response.data == 0){
                        this.key_block = false; 
                    }else{
                        this.key_block = true;
                        this.key = this.roomId;
                    }
                }catch(e){
                    this.err_status_q = true;
                }
            })
            .catch((error) => {
                this.err_status_q = true;
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
                lang_list: [
                    'en',
                    'ru'
                ],
                browser_lang: ((window.navigator ? (window.navigator.language || window.navigator.systemLanguage || window.navigator.userLanguage) : "ru").substr(0, 2).toLowerCase()),
                ui_international:{
                    en: {
                        name_placeholder: "Your name",
                        surname_placeholder: "Your surname",
                        name_placeholder_val: "Sergei",
                        surname_placeholder_val: "Plutogarenko"
                    },
                    ru: {
                        name_placeholder: "Ваше имя",
                        surname_placeholder: "Ваша фамилия",
                        name_placeholder_val: "Сергей",
                        surname_placeholder_val: "Плутогаренко"
                    }

                }
            }
        },
        methods: {
            inputEv(){
                try{
                    if(this.track_status != this.track_name_surname){
                        this.err_status = false;
                    }
                    clearTimeout(this.err_timer);
                    this.err_timer = setTimeout(() => {
                        this.err_status = true;
                        this.track_status = this.track_name_surname;
                    }, 1000);
                }catch(e){
                    this.err_status_q = true;
                }
            },
            getUI(word){
                try{
                    if(this.lang != undefined){
                        return this.ui_international[this.lang][word];
                    }else{
                        // если пользователь еще не выбрал язык, и язык его барузера не поддерживается сценарием
                        // мы используем английский язык
                        if(this.lang_list.indexOf(this.browser_lang) != -1){
                            return this.ui_international[this.browser_lang][word];
                        }else{
                            return this.ui_international["en"][word];
                        }
                    }
                }catch(e){
                    this.err_status_q = true;
                }
            },
            
            coonect2game(){
                axios.post('/teams/connect', {
                    roomId: this.roomId,
                    name: this.name,
                    surname: this.surname,
                    key: this.key,
                    lang: this.lang,
                })
                .then((response) => {
                    try{
                        if(response.data == 1){
                            window.location.href="https://localhost/rules/" + this.lang + "/" + this.key;
                        }else{
                            this.bad_key = true;
                        }
                    }catch(e){
                        this.err_status_q = true;
                    }
                })
                .catch((error) => {
                    this.err_status_q = true;
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
</style>