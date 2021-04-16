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