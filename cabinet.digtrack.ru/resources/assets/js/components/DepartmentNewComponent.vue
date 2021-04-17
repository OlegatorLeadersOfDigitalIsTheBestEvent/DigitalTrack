<template>   
    <div>
        <section class="section-gap">
            <div class="container">
                <div class="row justify-content-between mb-4">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-5">
                        <form>
                            
                            <div class="form-group">
                                <div class="row">
                                    
                                    <div class="col">
                                        <label>Название департамента</label>
                                            <input type="text" name="employers" v-model="department_name" class="form-control" placeholder="Иванович" >
                                        </div>
                                </div>
                            </div>

                            <button type="submit" @click="save()" class="btn btn-pill btn-block btn-theme">Сохарнить</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>    

<script>
    export default {
        data() {
            return {
                department_name: null,
            }
        },
        methods:{
           
            save(){
                axios
                    .post('https://cabinet.digtrack.ru/new-department', {
                        department_name: this.department_name
                    })
                    .then(response => {
                        window.location = "https://cabinet.digtrack.ru/home";
                    })
            }
        }
    }
</script>





