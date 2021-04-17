<template>    
    <div>
        <div class="card gradient-primary p-0 border-0 rounded-0 p-4">
            <div class="container">
                <div class="row justify-content-between align-items-center text-center text-md-left">
                    <div class="col-md-8">
                        <h5 class="mb-1 text-white d-inline-block border-right border-sm-right-0 pr-md-4 mr-md-4">Должности</h5>
                        <p class="mb-0 text-white d-inline-block">Создавайте должности и управляйте ими в несколько кликов</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="table-responsive mt-5">
                        <div class="form-group col-md-5">
                            <div class="row">
                                <div class="col">
                                    <input type="text" v-model="name" placeholder="Добавить департамент" class="form-control">
                                </div>
                                <div class="col">
                                    <button type="submit" @click="newDepartment" class="btn btn-pill btn-block btn-theme">Добавить</button>
                                </div>
                            </div>
                        </div>

                        <table class="table vl-custom-table">
                            <thead>
                            <tr>
                                <th>Название</th>
                                <th>Число сотрудников</th>
                                <th>Удалить</th> 
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="position in positions">
                                <td>
                                    {{ position.position_name }}
                                </td>
                                <td>
                                    -
                                </td>
                                <td>
                                    <a class="btn btn-pill btn-outline">Удалить</a>
                                </td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getPositionsList();
        },
        data() {
            return {
                name: "",
                positions: null
            }
        },
        methods:{
            newDepartment(){
                axios
                    .post('https://cabinet.digtrack.ru/new-position', {
                        position_name: this.name
                    })
                    .then(response => (this.positions = response.data, this.getPositionsList(), this.name = ""))
            },

            getPositionsList(){
                axios
                    .post('https://cabinet.digtrack.ru/all-positions')
                    .then(response => (this.positions = response.data))
            }
        }
    }
</script>





