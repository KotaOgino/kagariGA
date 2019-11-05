<template>
<div class="container">
  <div class="userLineGraph kagariBorder bottom1Rem">
    <div class="LineInfo">
      <div class="iconUser iconTop">
        <i class="fas fa-user"></i>
      </div>
      <div class="user-span">
        <p class="dark-gray fourteen bold">ユーザー</p>
        <p class="tewlve dark-gray"><i class="far fa-calendar-alt blue mr-1"></i>20xx-x-xx - 20xx-x-xx</p>
        <p class="tewlve dark-gray"><i class="fas fa-arrows-alt-h red mr-1"></i>20xx-x-xx - 20xx-x-xx</p>
      </div>
    </div>
    <div class="userLine">
      <line-chart :chart-data="datacollection" :options="options" :height="161" :width="720"></line-chart>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconUser iconTop">
            <i class="fas fa-user"></i>
          </div>
          <p class="card-title textCenter">ユーザー</p>
          <p class="card-text textCenter nowNumber bold">{{ data.user }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ data.comUser }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconSession iconTop">
            <i class="fas fa-bolt"></i>
          </div>
          <p class="card-title textCenter">セッション</p>
          <p class="card-text textCenter nowNumber bold">{{ data.session }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ data.comSession }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconPv iconTop">
            <i class="fas fa-eye"></i>
          </div>
          <p class="card-title textCenter">ページビュー数</p>
          <p class="card-text textCenter nowNumber bold">{{ data.user }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ data.comUser }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconPs iconTop">
            <i class="fas fa-pager"></i>
          </div>
          <p class="card-title textCenter">ページ/セッション</p>
          <p class="card-text textCenter nowNumber bold">{{ mathRound(data.pSession, 1) }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ mathRound(data.comPSession, 1) }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconAveSs iconTop">
            <i class="fas fa-clock"></i>
          </div>
          <p class="card-title textCenter">平均セッション時間</p>
          <p class="card-text textCenter nowNumber bold">{{ data.session }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ data.comSession }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconAveTime iconTop">
            <i class="far fa-clock"></i>
          </div>
          <p class="card-title textCenter">平均ページ滞在時間</p>
          <p class="card-text textCenter nowNumber bold">{{ mathRound(data.time, 1) }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ mathRound(data.comTime, 1) }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconBr iconTop">
            <i class="fas fa-arrow-alt-circle-left"></i>
          </div>
          <p class="card-title textCenter">直帰率</p>
          <p class="card-text textCenter nowNumber bold">{{ mathRound(data.bRate, 1) }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ mathRound(data.comBRate, 1) }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bottom1Rem">
        <div class="card-body">
          <div class="iconBye iconTop">
            <i class="fas fa-times-circle"></i>
          </div>
          <p class="card-title textCenter">離脱率</p>
          <p class="card-text textCenter nowNumber bold">{{ data.user }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ data.comUser }}</p>
          <p class="card-text textCenter comRate"><span class="mr-1">▲</span>10%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
  </div>
  <section>
    <div class="commentArea kagariBorder bottom1Rem">
      <div class="iconComment iconTop">
        <i class="fas fa-comment-dots"></i>
      </div>
    </div>
  </section>
  <!-- <p>セッション数：{{ data.session }}</p>
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
  <p>前ページの早さ：{{ data.comSpeed }}</p> -->
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
      options: {},
      data: {},
      styles: {

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
    mathRound: function(number, n){
        var _pow = Math.pow( 10 , n );
        return Math.round( number * _pow ) / _pow;
    },
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
          animation: true,
          labels: arrayLabel,
          datasets: [{
            label: '今期間',
            borderColor: '#007AFF',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            data: arrayDataOne
          }, {
            label: '前期間',
            borderColor: '#FF2D55',
            backgroundColor: 'rgba(0, 0, 0, 0)',
            data: arrayDataTwo
          }]
        },
        this.options = {
          responsive: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              scaleLabel: {
                fontColor: '#EDEDED'
              },
              // display: true,
              // stacked: false,
              gridLines: {
                drawBorder: false,
                color: '#EDEDED'
              },
            }],
            yAxes: [{
              scaleLabel: {
                fontColor: '#EDEDED'
              },
              gridLines: {
                drawBorder: false,
                color: '#EDEDED'
              },
              ticks: {
                suggestedMin: 0
              },
            }]
          }
        }
    }
  }
}
</script>
