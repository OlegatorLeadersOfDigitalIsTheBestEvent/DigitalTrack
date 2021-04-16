<template>
    <div>
        Игра сама
    </div>
</template>


<script>
export default {
    data() {
        return {
           

            user: {
                team_id: this.dataRoomNumber,
                team_name: null,
                old_score: 0,
                score: 800,
                day_time: 0,
                day_money: 0,
                day: 0,
                // флаг для кнопки сигнализирубщий что идет игровой день и можно отправить ход
                step_activity: false,
            },
            lang: ru,
          
            new_cards_for_step: [],
            news: [],
            cards: [],
            choose: [],
            history: [],
            
        }
    },
    methods: {
    
       

        // получение публичных новостей
        getDynamic(){
            axios.post('https://localhost/dynamic', {
                key: this.user.team_id,
                lang: this.lang,
            })
            .then((response) => {
               
                this.dynamic['1'].save_result = response.data.step1_user_result;
                this.dynamic['1'].best_result = response.data.step1_max_result;
                
                this.dynamic['2'].save_result = response.data.step2_user_result;
                this.dynamic['2'].best_result = response.data.step2_max_result;
                
                this.dynamic['3'].save_result = response.data.step3_user_result;
                this.dynamic['3'].best_result = response.data.step3_max_result;
            
                this.dynamic['4'].save_result = response.data.step4_user_result;
                this.dynamic['4'].best_result = response.data.step4_max_result;
                
                this.dynamic['5'].save_result = response.data.step5_user_result;
                this.dynamic['5'].best_result = response.data.step5_max_result;
                    
            });
        },

        // получение публичных новостей
        getPublicNews(){
            axios.post('https://localhost/public_news_publication', {
                team_id: this.user.team_id,
                day: this.user.day,
                lang: this.lang,
            })
            .then((response) => {
                    response.data.forEach(item => {
                        this.news.push(item); 
                    });
                
            });
        },
        
        //  получение приватных новостей
        getPrivateNews(){
            axios.post('https://localhost/private_news_publication', {
                team_id: this.user.team_id,
                day: this.user.day,
                 lang: this.lang,
            })
            .then((response) => {
               
                response.data.forEach(item => {
                    this.news.push(item); 
                });
           
            });
        },
        
        
                
        }
    }
}
</script>