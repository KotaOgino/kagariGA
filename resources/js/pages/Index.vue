<template>
<div class="container">
    <div class="userLineGraph">
        <line-chart :chart-data="datacollection" height="150"></line-chart>
    </div>
    <h2>User</h2>
    <h3>今期間</h3>
      <div v-for="(user,date,index) in data.originUser">
        <p>{{date}}:{{user}}</p>
      </div>
    <h3>前期間</h3>
      <div v-for="(user,date,index) in data.compareUser">
        <p>{{date}}:{{user}}</p>
      </div>
    <h2 v-bind:style="styles">Summary</h2>
    <p>セッション数：{{ data.session }}</p>
    <p>前セッション数：{{ data.comSession }}</p>
    <p>ページ/セッション：{{ data.pSession }}</p>
    <p>前ページ/セッション：{{ data.comPSession }}</p>
    <p>ユーザー数：{{ data.user }}</p>
    <p>前ユーザー数：{{ data.comUser }}</p>
    <p>滞在時間：{{ data.time }}</p>
    <p>前滞在時間：{{ data.comTime }}</p>
    <p>直帰率：{{ data.bRate }}</p>
    <p>前直帰率：{{ data.comBRate }}</p>
    <p>ページの価値：{{ data.value }}</p>
    <p>前ページの価値：{{ data.comValue }}</p>
    <p>CV：{{ data.cv }}</p>
    <p>前CV：{{ data.comCv }}</p>
    <p>ページの早さ：{{ data.speed }}</p>
    <p>前ページの早さ：{{ data.comSpeed }}</p>
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
            var originUser = this.data['originUser'];
            var compareUser = this.data['compareUser'];
            var arrayLabel = [];
            var arrayDataOne = [];
            var arrayDataTwo = [];
            for (var key in originUser) {
              // console.log(key+':'+originUser[key]);
              arrayLabel.push(key);
              arrayDataOne.push(originUser[key]);
            }
            for (var key in compareUser) {
              // console.log(key+':'+originUser[key]);
              arrayDataTwo.push(compareUser[key]);
            }

            this.datacollection = {
                animation : true,
                labels: arrayLabel,
                datasets: [{
                    label: 'Data One',
                    borderColor: 'red',
                    backgroundColor:'rgba(0, 0, 0, 0)',
                    data: arrayDataOne
                }, {
                    label: 'Data Two',
                    borderColor: 'blue',
                    backgroundColor:'rgba(0, 0, 0, 0)',
                    data: arrayDataTwo
                }],

            }
        }
    }
}
</script>
