<template>    
    <div>
        <section class="section-gap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="mb-4">Информация об обучении</h5>
                        <p>Выбранным сотрудникам на рабочую электронную почту (в случае отсутствия рабочей, на домашнюю) будет отправлен ключ для прохождения игры-симуляции.</p> 
                        <div class="table-responsive mt-2">
                            <table class="table table-bordered table-striped">
                               <tr v-for="customer in customers">
                                   <td>
                                        <span style="display: block;">{{ customer.first_name }} {{ customer.second_name }} {{ customer.last_name}}</span>
                                        <small>{{ customer.position_name }}</small>
                                    </td>
                                    
                                    <td>
                                        {{ customer.email_work }}
                                    </td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                    <div class="col-md-4">
                        <h5 class="mb-4">Сценарий</h5>
                        <div class="form-group">
                            <select v-model="scriptId" class="custom-select">
                                <option v-for="script in scripts" :value="script.id">{{ script.name }}</option>
                            </select>
                        </div>
                        <h5 class="mb-4">Счет</h5>
                        <div class="border rounded p-3">
                            <div><span>Игра ({{ scripts[scriptId-1].name }}):</span> <span class="float-right font-weight-bold">₽ {{ list.length*scripts[scriptId-1].price*0.73 }}</span></div> 
                            <div><span>НФДЛ (13%):</span> <span class="float-right font-weight-bold">₽ {{ list.length*scripts[scriptId-1].price*0.13 }}</span></div>

                            <div class="border-top mt-3 pt-2"><span>Всего:</span> <span class="float-right  font-weight-bold">₽ {{ list.length*scripts[scriptId-1].price }}</span></div>
                        </div>
                        <div v-if="list.length*scripts[scriptId-1].price <= score">
                            <button @click="startTeach" class="btn btn-block btn-theme mt-3">Обучить</button>
                        </div>
                        <div v-else>
                            <button disabled class="btn btn-block btn-theme mt-3">Обучить</button>
                            <small>У вас не достаточно средств на обучение</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        props: ['ids', 'score'],
        mounted() {
            this.getCustomerData();
            this.allScripts();
        },
        data() {
            return {
                list: this.ids.split(','),
                scripts: null,
                scriptId: 1,
                customers: null,
            }
        },
        methods:{
          

            startTeach(){
                axios
                    .post('https://cabinet.digtrack.ru/start-teach', {
                        ids: this.list,
                        scriptId: this.scriptId
                    })
                    .then(response => {
                        this.customers = response.data;
                        if(response.status == 200){
                            window.location.href = "https://cabinet.digtrack.ru/statistic";
                        }     
                    })
            },
            getCustomerData(){
                axios
                    .post('https://cabinet.digtrack.ru/selected-list', {
                        ids: this.list
                    })
                    .then(response => (this.customers = response.data))
            },
            allScripts(){
                axios
                    .post('https://cabinet.digtrack.ru/scripts-list')
                    .then(response => (this.scripts = response.data))
            }
        }
    }
</script>





