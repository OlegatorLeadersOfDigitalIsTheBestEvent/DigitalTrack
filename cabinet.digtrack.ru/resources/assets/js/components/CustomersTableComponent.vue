<template>   
    <section class="section-gap pt-5">
        <div class="container"> 
            <div class="row">
                
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12 mb-3" v-for="customer in customers">
                            <div class="card">
                                <div class="row">

                                    <div class="col-md-3 p-2">
                                        <center class="p-4">
                                            <img class="rounded-circle" :src="'https://cabinet.digtrack.ru/avatars/' + customer.id + '.png'">
                                        </center>
                                    </div>
                                    <div class="col-md-8 p-4">
                                        <span class="badge badge-pill badge-primary float-right">Высокий уровень киберграмотности</span>
                                        <h6 class="d-block">{{ customer.first_name }} {{ customer.second_name }} {{ customer.last_name}}</h6>
                                        <b class="d-block">{{ customer.position_name }}</b>
                                        <div class="mt-3">
                                            <div class="col p-0 mb-2">
                                                <label>Поиск информации</label>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                        v-bind:style="{ width : (customer.id+customer.id)*9 + '%' }"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col p-0 mb-2">
                                                <label>Разработка</label>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                        v-bind:style="{ width : (customer.id+customer.id*customer.id)*15 + '%' }"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    </div>         
                                                </div>
                                            </div>

                                            <div class="col p-0 mb-2">
                                                <label>Информационная безопасность</label>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar" role="progressbar" 
                                                        v-bind:style="{ width : (customer.id+customer.id)*3 + '%' }"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                    </div>                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="gridCheck" v-model="selected" :value="customer.id">
                                                        <!-- <input type="checkbox" class="form-check-input" id="exampleCheck1"> -->
                                                        <label class="form-check-label" for="exampleCheck1">Выбрать сотрудника</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="row">
                                                <div class="col">
                                                    <a :href="'https://cabinet.digtrack.ru/customer/' + customer.id" class="btn btn-pill btn-block btn-primary">Результаты ассесмента</a>
                                                </div>
                                                <div class="col">
                                                    <a :href="'https://cabinet.digtrack.ru/customer/' + customer.id" class="btn btn-pill btn-block btn-primary">Подробнее</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <a :disabled="selected.length > 0" href="https://cabinet.digtrack.ru/customer/new" class="btn btn-pill btn-block btn-primary">Новый сотрудник</a>
                    <a v-if="selected.length > 0" :href="'https://cabinet.digtrack.ru/teach/start/' + selectedList" class="btn btn-pill btn-block btn-primary">Обучить</a>
                    <a v-if="selected.length > 0" :href="'https://cabinet.digtrack.ru/test/start/' + selectedList" class="btn btn-pill btn-block btn-primary">Протестировать</a>
                    <button v-if="selected.length > 0" type="submit" class="btn btn-pill btn-block btn-primary">Уволить</button>

                </div>
                
               
            </div>
            
            

            <!-- <div class="table-responsive mt-2">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="gridCheck" v-model="selectedAll">
                                <label class="form-check-label" for="gridCheck">
                                </label>
                            </div>    
                        </th>
                        <th>Сотрудник</th>
                        <th>Должность</th>
                        <th></th> 
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="customer in customers">
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="gridCheck" v-model="selected" :value="customer.id">
                                <label class="form-check-label" for="gridCheck">
                                </label>
                            </div>
                        </td>
                        <td>
                            {{ customer.first_name }} {{ customer.second_name }} {{ customer.last_name}}
                        </td>
                        <td>
                            <h6>{{ customer.department_name }}</h6>
                            <span class="text-muted">{{ customer.position_name }}</span>
                        </td>
                        <td>
                            <a :href="'https://cabinet.digtrack.ru/customer/' + customer.id" class="btn btn-block btn-theme">Подробнее</a>

                        </td>
                    </tr>
                    
                    </tbody>
                </table>
            </div> -->
        </div>
    </section>
</template>

<script>
    export default {
        mounted() {
            this.getCustomersList();
        },
        data() {
            return {
                selected: [],
                selectedAll: false,
                customers: null
            }
        },
        watch: {
            selectedAll(){
                if(this.selectedAll == true){
                    this.customers.forEach(customer => {
                        this.selected.push(customer.id);
                    });
                }else{
                    this.selected = [];
                }
            }
        },
        computed : {
            selectedList(){
                return this.selected.join(',');
            }
        },
        methods:{
            getCustomersList(){
                axios
                    .post('https://cabinet.digtrack.ru/all-customers')
                    .then(
                        (response) => {
                            this.customers = response.data;
                        }
                    )
            }
        }
    }
</script>





