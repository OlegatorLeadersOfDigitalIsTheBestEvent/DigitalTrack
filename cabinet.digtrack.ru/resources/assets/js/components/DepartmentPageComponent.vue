<template>       
    <section class="section-gap pt-5">
        <div class="container"> 
            
            <div class="row" v-if="selected.length > 0">
                <div class="col-md-3">
                    <button type="submit" class="btn btn-block btn-theme">Удалить</button>
                </div>
            </div>
            <div class="row" v-else>
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <a href="https://cabinet.digtrack.ru/department/new" class="btn btn-block btn-pill btn-theme">Новый департамент</a>
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
                            <h6>{{ department.department_name }}</h6>
                            <span class="text-muted">{{ department.position_name }}</span>
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





