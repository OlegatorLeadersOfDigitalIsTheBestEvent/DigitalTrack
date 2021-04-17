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
                            <h2 style="line-height: 70px;">Правила игры</h2>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col">
                            <p>Пожалуйста перед началом игры ознакомьтесь с ее правилами!</p>
                            <p>Цель игры: спасти друзей и республику! Злые хакеры хотят переписать историю, ты должен противостоять им, заработать как можно больше денег. Симуляция эмулирует ваш жизненный процесс - каждый ход вы получаете заработную плату 800$!</p>
                            <p>Во время игры вам нужно читать новости, анализировать их, и принимать решения для собственной защиты. Решения принимаются с помощью карт.</p>
                        </div>
                        <div class="col">
                            <p>Для переключения между вкладками используйте - левое боковое меню.</p>
                            <p>Выбирая карту, используется выделенное на ход время и бюджет. На каждый ход будет отводиться от 10 до 2 минут.</p>
                            <p>Колличество времени с каждым ходом будет сокращаться. Всего в игре 5 ходов.</p>

                            <div v-if="!subscribe_success"> 
                                <a style="text-align: center;" @click="next_step"><img height="47" class="mt-2 mb-1 active-ui-el" :src="'https://digtrack.ru/ui/login.svg'" alt=""></a>
                            </div> 
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
        data(){
            return {
                roomId: this.dataRoomNumber,
                name: "",
                surname: "",
                email: "",
                lang: this.docLang,
                agreement: false,
                subscribe_success: false,
            }
        },
        
        methods: {
            next_step(){
                window.location.href="https://digtrack.ru/game/" + this.dataRoomNumber;
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