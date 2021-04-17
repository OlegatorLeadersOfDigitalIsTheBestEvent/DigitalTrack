<template>    
    <div>
        <section class="component-section section-top p-4 pt-5 bg-gray">
            <!--<div class="hero-img bg-overlay" data-overlay="1" style="background-image: url(assets/img/price-banner.jpg);"></div>-->
            <div class="container">
                <div class="row justify-content-between align-items-center text-lg-left text-center">
                    <div class="col-md-6">
                        <!-- heading -->
                        <h3 class="">
                            {{ data.first_name }} {{ data.second_name }} {{ data.last_name }}
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <!--breadcrumb-->
                        <nav aria-label="breadcrumb" class="float-lg-right">
                            <ol class="breadcrumb bg-white btn-pill px-5 mb-0">
                                <li class="breadcrumb-item"><a href="#" class="text-dark">{{ data.department_name }}</a></li>
                                <li class="breadcrumb-item"><a href="#" class="text-dark">{{ data.position_name }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-gap">
            <div class="container">
                <div class="row justify-content-between mb-4">
                    <div class="col-md-5">
                        <div>
                            
                            <div class="form-group">
                                <label>Фамилия сотрудника</label>
                                <input type="text" name="name" v-model="data.second_name" class="form-control" placeholder="Раскольников">
                            </div>
                           
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Имя</label>
                                        <input type="text" name="company" v-model="data.first_name" class="form-control" placeholder="Олег"> 
                                                            
                                    </div>
                                    <div class="col">
                                        <label>Отчество</label>
                                            <input type="text" name="employers" v-model="data.last_name" class="form-control" placeholder="Иванович">
                                        </div>
                                </div>

                            </div>
                            <div class="form-group" v-if="departments.length > 0">
                                <label>Департамент (отдел)</label>
                                <select class="custom-select my-1 mr-sm-2" v-model="department_id">
                                   <option v-for="department in departments" :value="department.id">{{ department.department_name }}</option>
                                </select>
                            </div>
                            <div class="form-group" v-else>
                                <label>Департамент (отдел)</label>
                                <select disabled class="custom-select my-1 mr-sm-2">
                                   <option>Нет созданных департаментов</option>
                                </select>
                                <small><a href="https://cabinet.digtrack.ru/departments">Добавить департамент</a></small>
                            </div>

                            <div class="form-group" v-if="positions.length > 0">
                                <label>Должность</label>
                                <select v-model="data.position_id" class="custom-select my-1 mr-sm-2">
                                    <option v-for="position in positions" :value="position.id">{{ position.position_name }}</option>
                                </select>
                            </div>
                            <div class="form-group" v-else>
                                <label>Должность</label>
                                <select disabled class="custom-select my-1 mr-sm-2">
                                   <option>Нет созданных должностей</option>
                                </select>
                                <small><a href="https://cabinet.digtrack.ru/positions">Добавить должность</a></small>
                            </div>
                            <div class="mt-3 mb-3">
                                <small>Для проверки сотрудников на уязвимость перед фишинговыми сообщениями заполните информацию о них. Также на них будут высылаться ключи сотрудников для обучения в рамках игры.</small>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>E-mail адрес (рабочий)</label>
                                        <input type="text" name="company" v-model="data.email_work" class="form-control"> 
                                                            
                                    </div>
                                    <div class="col">
                                        <label>E-mail адрес (домашний)</label>
                                            <input type="text" name="employers" v-model="data.email_home" class="form-control">
                                        </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label>Корпоративный телефон</label>
                                <input type="text" name="name" v-model="data.personal_phone_number" class="form-control" placeholder="Раскольников">
                            </div>

                            <div class="form-group">
                                <label>Домашний телефон</label>
                                <input type="text" name="name" v-model="data.work_phone_number" class="form-control" placeholder="Раскольников">
                            </div>
                            
                            <div class="form-group">
                                <label>Страница ВКонтакте</label>
                                <input type="text" name="name" v-model="data.vk_id" class="form-control" placeholder="Раскольников">
                            </div>

                            <div class="form-group">
                                <label>Номер WhatsApp</label>
                                <input type="text" name="name" v-model="data.whatsapp_number" class="form-control" placeholder="Раскольников">
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Номер телеграм</label>
                                        <input type="text" name="company" v-model="data.telegram_number" class="form-control"> 
                                                            
                                    </div>
                                    <div class="col">
                                        <label>Никнейм телеграм</label>
                                            <input type="text" name="employers" v-model="data.telegram_username" class="form-control">
                                        </div>
                                </div>

                            </div>


                           

                            <button type="submit" @click="save" class="btn btn-pill btn-block btn-theme">Сохрнить</button>
                                
                            
                        <!-- </form> -->
                        </div>
                        <!-- <lable class="text-muted">Личная информация</lable>
                        <div class="form-inline">                       
                            <input type="text" v-model="data.second_name" class="form-control">
                        </div>

                        <div class="form-inline">                       
                            <input type="text" v-model="data.first_name"  class="form-control">
                        </div>

                            

                        <div class="form-inline my-lg-5 mb-4">                        
                            <input type="text" v-model="data.last_name"   class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Сохарнить</button> -->

                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        mounted() {
            if(this.id != "new"){
                this.getCustomerData();
                this.getTeachStat();
            }
            this.getPositions();
            this.getDepartments();
        },
        
        data() {
            return {
                data: {
                    first_name: "",
                    second_name: "",
                    last_name: "",
                    department_id: "",
                    email_home: "",
                    email_work: "",
                    personal_phone_number: "",
                    work_phone_number: "",
                    whatsapp_number: "",
                    telegram_number: "",
                    telegram_username: "",
                    vk_id: "",
                    position_id: ""
                },
                positions: null,
                departments: null,
                teachStat: null,
            }
        },
        methods:{
            dateFormat(date){
                let date_local = new Date(date);
                // "0" + d.getDate()).slice(-2)
                return ("0" + date_local.getDate()).slice(-2) + '.' + ("0" + (date_local.getMonth() + 1)).slice(-2) + '.'  + ("0" + date_local.getYear()).slice(-2) + ' ' + date_local.getHours() + ':' + date_local.getMinutes();
            },
            getTeachStat(){
                axios
                    .post('https://cabinet.digtrack.ru/get-customer-teach-stat', {
                        id: this.id
                    })
                    .then(response => (this.teachStat = response.data))
            },
            getCustomerData(){
                axios
                    .post('https://cabinet.digtrack.ru/get-customer', {
                        id: this.id
                    })
                    .then(response => (this.data = response.data))
            },
            getDepartments(){
                axios
                    .post('https://cabinet.digtrack.ru/all-departments', {
                        id: this.id
                    })
                    .then(response => (this.departments = response.data))
            },
            getPositions(){
                axios
                    .post('https://cabinet.digtrack.ru/all-positions', {
                        id: this.id
                    })
                    .then(response => (this.positions = response.data))
            },
            save(){
                axios
                    .post('https://cabinet.digtrack.ru/new-customer', this.data)
                    .then(response => {
                            window.location.href = "https://cabinet.digtrack.ru/home";
                    })
            },
        }
    }
</script>





