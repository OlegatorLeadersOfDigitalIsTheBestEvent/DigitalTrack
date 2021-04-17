<template>   
    <section class="section-gap pt-5">
        <div class="container"> 
            
            <div class="row" v-if="selected.length > 0">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <a :href="'https://cabinet.digtrack.ru/teach/start/' + selectedList" class="btn btn-block btn-theme">Обучить</a>
                </div>
                <div class="col-md-3">
                    <a :href="'https://cabinet.digtrack.ru/test/start/' + selectedList" class="btn btn-block btn-theme">Протестировать</a>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-block btn-theme">Уволить</button>
                </div>
            </div>
            <div class="row" v-else>
                
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6 mb-3" v-for="customer in customers">
                            <div class="card">
                                <div class="row">

                                    <div class="col-md-3 p-2"><center><div style="height: 60px;width: 60px;background: #ccc;border-radius: 50%;"></div></center></div>
                                    <div class="col-md-8">
                                        <span class="d-block">{{ customer.first_name }} {{ customer.second_name }} {{ customer.last_name}}</span>
                                        <span class="d-block">{{ customer.position_name }}</span>
                                    </div>

                                </div>
                                <!-- <a :href="'https://cabinet.digtrack.ru/customer/' + customer.id" class="btn btn-block btn-theme">Подробнее</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    
                    <a href="https://cabinet.digtrack.ru/customer/new" class="btn btn-pill btn-block btn-theme">Новый сотрудник</a>
                </div>
            </div>
            
            <div class="row" v-else>
                <div class="col-md-6">
                    fdsa
                </div>
                <div class="col-md-6">
                    adf
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





