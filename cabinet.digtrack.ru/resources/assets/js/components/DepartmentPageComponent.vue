<template>       
    <section class="section-gap pt-5">
        <div class="container"> 
            
           
            <div class="row">
                <div class="col">
                    <a :disabled="selected.length > 0" href="https://cabinet.digtrack.ru/department/new" class="ml-2 btn btn-pill btn-primary float-right">Новый департамент</a>
                    <button v-if="selected.length > 0" type="submit" class="btn btn-pill btn-primary float-right">Удалить</button>

                </div>
            </div>
            
            

            <div class="table-responsive mt-2">
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
                        <th>Департамент</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="department in departments">
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="gridCheck" v-model="selected" :value="department.id">
                                <label class="form-check-label" for="gridCheck">
                                </label>
                            </div>
                        </td>
                        <td> 
                            <span>{{ department.department_name }}</span>
                        </td>
                    
                    </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        mounted() {
            this.getdepartmentsList();
        },
        data() {
            return {
                selected: [],
                selectedAll: false,
                departments: null
            }
        },
        watch: {
            selectedAll(){
                if(this.selectedAll == true){
                    this.departments.forEach(department => {
                        this.selected.push(department.id);
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
            getdepartmentsList(){
                axios
                    .post('https://cabinet.digtrack.ru/all-departments')
                    .then(
                        (response) => {
                            this.departments = response.data;
                        }
                    )
            }
        }
    }
</script>





