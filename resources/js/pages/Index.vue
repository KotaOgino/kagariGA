<template>
<div class="container">
    <div class="row">
        <div class="col-4-lg">
          <p>ユーザー</p>
        </div>
        <div class="col-8-lg">
          <line-chart :chart-data="datacollection"></line-chart>
          <button @click="fillData()">Randomize</button>
        </div>
    </div>
    <h1 v-bind:style="styles">Summary</h1>
    <p>セッション数：{{ data.session }}</p>
    <p>セッション数：{{ data.comSession }}</p>
    <p>ページ/セッション：{{ data.pSession }}</p>
    <p>ページ/セッション：{{ data.comPSession }}</p>
    <p>ユーザー数：{{ data.user }}</p>
    <p>ユーザー数：{{ data.comUser }}</p>
    <p>滞在時間：{{ data.time }}</p>
    <p>滞在時間：{{ data.comTime }}</p>
    <p>直帰率：{{ data.bRate }}</p>
    <p>直帰率：{{ data.comBRate }}</p>
    <p>ページの価値：{{ data.value }}</p>
    <p>ページの価値：{{ data.comValue }}</p>
    <p>CV：{{ data.cv }}</p>
    <p>CV：{{ data.comCv }}</p>
    <p>ページの早さ：{{ data.speed }}</p>
    <p>ページの早さ：{{ data.comSpeed }}</p>
</div>
</template>
<script>
import LineChart from '../chart/LineChart.js'
export default {
    components: {
        // ここで読んだコンポーネントをケバブケースにしたら普通に使えるっぽい
        LineChart,
        /* <line-chart></line-chart> */
    },
    data() {
        return {
            datacollection: {},
            data: {},
            styles: {
                backgroundColor: 'green',
                fontSize: '30px',
                color: 'red',
            },
        }
    },
    mounted() {
        axios.get('/api/analytics')
            .then((res) => {
                this.data = res.data,
                    this.fillData()
                // console.log(this.data);
            })
            .catch(error => {
                console.log(error);
            })
    },
    methods: {
        /**
         * 入力されたデータの数に応じてランダムなチャートデータを作成する
         */
        fillData: function() {
            this.datacollection = {
                animation : true,
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Data One',
                    borderColor: 'red',
                    backgroundColor:'rgba(0, 0, 0, 0)',
                    data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
                }, {
                    label: 'Data Two',
                    borderColor: 'blue',
                    backgroundColor:'rgba(0, 0, 0, 0)',
                    data: [this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt(), this.getRandomInt()]
                }]
            }
        },
        getRandomInt: function() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        }
    }
}
</script>
