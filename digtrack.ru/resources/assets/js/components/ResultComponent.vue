<template>
    <div style="background: #F2F3F6;">
        <div style="height: 94vh;">
            <!-- Widget header -->
            <header>
                <nav class="navbar navbar-expand-md navbar-dark fixed-top m-0 p-0" style="height: 57px; background: #fff;     position: initial;"> 
                    <img style="height: 80%"  class="navbar-nav ml-auto mr-4" src="https://digtrack.ru/ui/logo.svg" alt="">
                </nav>
            </header>
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-10 mx-auto mt-5">
                        <div class="row">
                        <div class="col">
                            <h2 style="line-height: 70px;">Поздравляем с упешным прохождением тренинга!</h2>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <p>Спасибо за то что выбрали наше решение для обучения киберграмотности. Вы показали очень хорошие результаты!</p>
                            <p>Пожалуйста оставьте отзыв об игре, это поможет нам становится лучше и разрабатывать более интересные и качественные сценарии.</p>
                        </div>
                        <div class="col">
                            <p>Вам был выдан сертификат о прохождении тренинга, вы его можете <a target="_blank" :href="'https://digtrack.ru/certificate/' + roomId">скачать</a>.</p>    
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <footer class="footer">
            <div class="px-3">
                <div class="row">
                    <div class="col-md-12"  style="line-height: 2.1vh">
                        <small>© 2021 Команда PLEXeT. Цифровой прорыв.</small>
                    </div>
                </div>
            </div>
        </footer>   
    </div>
</template>





<script>
    export default {
        props: ['dataRoomNumber'],
        // mounted(){
        //     axios.post('https://digtrack.ru/check', {
        //         key: this.roomId,
        //         _token: $('meta[name="csrf-token"]').attr('content')
        //     })
        //     .then((response) => {
        //         if(response.data == 0){
        //             this.key_block = false; 
        //         }else{
        //             this.key_block = true;
        //             this.key = this.roomId;
        //         }
        //     })
        //     .catch((error) => {
        //         console.log(error);
        //     });
        // },
        data(){
            return {
                roomId: this.dataRoomNumber,
                name: "",
                surname: "",
                email: "",
                agreement: false,
                subscribe_success: false,
                
            }
        },
        
        methods: {
            
            send_cert(){
                this.subscribe_success = true;
                axios.post('https://digtrack.ru/send_cert_email', {
                    key: this.roomId,
                    email: this.email,
                    agreement: this.agreement,
                })
                .then((response) => {
                    // if(response.data == 0){
                        
                    //     this.subscribe_success = true;
                    // }
                    
                    
                })
                .catch((error) => {
                    console.log(error);
                });
            }
           
        } 
    }
</script>


<style>

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