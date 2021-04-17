

import { Doughnut, mixins } from 'vue-chartjs'
const { reactiveProp } = mixins

export default {
  extends: Doughnut,
  mixins: [reactiveProp],
  props: ['options'],
  mounted () {
    // this.chartData создаётся внутри миксина.
    // Если вы хотите передать опции, создайте локальный объект options
    this.renderChart(this.chartData, {
        responsive: true,
        legend: {
            display: false,
           
        },
        plugins: {
            legend: {
                display: false,
               
            },
            title: {
                display: false,
                
            },
        },
        animation: {
            animateScale: true,
            animateRotate: true
        }
    })
  }
}


