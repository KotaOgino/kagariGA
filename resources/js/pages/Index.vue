<template>
<div class="container">
    <!-- <section class="mt-5 bottom1Rem">
    <div class="container">
    <div class="bd-highlight mb-1 bg-white kagariBorder">
    <div class="d-flex">
    <div class="mr-auto p-2 bd-highlight top-line">
    <p class="mt-4 ml-3 sixteen bold">{{data.site_info[1]}}</p>
    <br>
    <p class="ml-3 mb-4 gray fourteen">{{data.site_info[0]}}</p>
    </div>
    <div class="p-2 bd-highlight top-line">
    <p class="mt-4 mr-3 blue fourteen" v-on:click="dataAjax">期間<span class="ml-3 gray borderBottom pointer">{{start}} 〜 {{end}}</span></p>
    <br>
    <p class="mr-3 mb-4 red fourteen">比較<span class="ml-3 gray borderBottom pointer">{{comStart}} 〜 {{comEnd}}</span></p>
    </div>
    </div>
    <nav class="nav top-nav">
    <p v-on:click='isActive=1' v-bind:class="[ isActive === 1 ? 'active' : '' ]" class="nav-item nav-link">
        <router-link to="/" class="router-link">
            <i class="far fa-calendar-alt mr-1"></i>サマリー
        </router-link>
    </p>
    <p v-on:click='isActive=2' v-bind:class="[ isActive === 2 ? 'active' : '' ]" class="nav-item nav-link">
        <router-link to='/user' class="router-link">
            <i class="fas fa-users mr-1"></i>ユーザー属性
        </router-link>
    </p>
    <p v-on:click='isActive=3' v-bind:class="[ isActive === 3 ? 'active' : '' ]" class="nav-item nav-link">
        <router-link to='/inflow' class="router-link">
            <i class="fas fa-project-diagram mr-1"></i>流入元分析
        </router-link>
    </p>
    <p v-on:click='isActive=4' v-bind:class="[ isActive === 4 ? 'active' : '' ]" class="nav-item nav-link">
        <router-link to='/action' class="router-link">
            <i class="fas fa-pager mr-1"></i>ユーザー行動分析
        </router-link>
    </p>
    <p v-on:click='isActive=5' v-bind:class="[ isActive === 5 ? 'active' : '' ]" class="nav-item nav-link">
        <router-link to='/conversion' class="router-link">
            <i class="fas fa-flag mr-1"></i>コンバージョン分析
        </router-link>
    </p>
    <p v-on:click='isActive=6' v-bind:class="[ isActive === 6 ? 'active' : '' ]" class="nav-item nav-link">
        <router-link to='/ad' class="router-link">
            <i class="fas fa-ad mr-1"></i>広告分析
        </router-link>
    </p>
    </nav>
    </div>
    </div>
    </section> -->
  <div class="userLineGraph kagariBorder bottom1Rem">
    <div class="LineInfo">
      <div class="iconUser iconTop">
        <i class="fas fa-user"></i>
      </div>
      <div class="user-span">
        <p class="dark-gray fourteen bold">ユーザー</p>
        <p class="tewlve dark-gray"><i class="far fa-calendar-alt blue mr-1"></i>{{calender.start}} - {{calender.end}}</p>
        <p class="tewlve dark-gray"><i class="fas fa-arrows-alt-h red mr-1"></i>{{calender.comStart}} - {{calender.comEnd}}</p>
      </div>
    </div>
    <div class="userLine ml-3">
      <line-chart :chart-data="datacollection" :options="options" :height="161" :width="900"></line-chart>
      <!-- <line-chart :chart-data="datacollection" :options="options"></line-chart> -->
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
          <p v-if="data.user >= data.comUser" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.user, data.comUser)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.user, data.comUser)}}%</p>
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
          <p v-if="Number(data.session) >= Number(data.comSession)" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.session, data.comSession)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.session, data.comSession)}}%</p>
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
          <p class="card-text textCenter nowNumber bold">{{ data.pv }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ data.comPv }}</p>
          <p v-if="data.pv >= data.comPv" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.pv, data.comPv)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.pv, data.comPv)}}%</p>
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
          <p v-if="data.pSession >= data.comPSession" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.pSession, data.comPSession)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.pSession, data.comPSession)}}%</p>
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
          <p class="card-text textCenter nowNumber bold">{{ mathRound(data.aveSs, 1) }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ mathRound(data.comAveSs, 1) }}</p>
          <p v-if="Number(data.aveSs) >= Number(data.comAveSs)" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.aveSs, data.comAveSs)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.aveSs, data.comAveSs)}}%</p>
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
          <p v-if="Number(data.time) >= Number(data.comTime)" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.time, data.comTime)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.time, data.comTime)}}%</p>
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
          <p v-if="data.bRate >= data.comBRate" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.bRate, data.comBRate)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.bRate, data.comBRate)}}%</p>
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
          <p class="card-text textCenter nowNumber bold">{{ mathRound(data.exit, 1) }}</p>
          <p class="card-text textCenter preNumber mb-1"><i class="fas fa-arrows-alt-h mr-1"></i>{{ mathRound(data.comExit, 1) }}</p>
          <p v-if="data.exit >= data.comExit" class="card-text textCenter comRateUp"><span class="mr-1">▲</span>{{comparRate(data.exit, data.comExit)}}%</p>
          <p v-else class="card-text textCenter comRateDown"><span class="mr-1">▼</span>{{comparRate(data.exit, data.comExit)}}%</p>
          <p class="card-text borderTop my-3"></p>
          <p class="card-text cardExp">期間中に１回以上のセッションを開始したユーザー数。</p>
        </div>
      </div>
    </div>
  </div>
  <section>
    <div class="commentArea kagariBorder bottom1Rem flex">
      <div class="iconComment iconTop">
        <i class="fas fa-comment-dots"></i>
      </div>
      <div class="commentTextArea">
        <h6 class="dark-gray sixteen bold">コメントの見出し</h6>
        <textarea placeholder="コメントを入力" style="border:none;"></textarea>
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
import EventBus from '../EventBus.js'

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
      isActive: 1,
      start: '',
      end: '',
      comStart: '',
      comEnd: '',
      calender: {}
    }
  },
  mounted() {
    EventBus.$on('site-info',this.getSiteInfo)
  },
  methods: {
    getSiteInfo: function(calender){
      this.calender = calender;
      axios.post('/api/ajax',this.calender).then(res => {
        this.data = res.data,
        this.dateSet(),
        this.fillData()
      })
      .catch(error => {
          console.warn(error);
      });
    },
    /**
     * 入力されたデータの数に応じてランダムなチャートデータを作成する
     */
    mathRound: function(number, n) {
      var _pow = Math.pow(10, n);
      return Math.round(number * _pow) / _pow;
    },
    comparRate: function(numberNow, numberPast) {
      if(numberPast == 0 || numberNow == 0){
        var result = '-';
      }else{
        var result = this.mathRound(
          (Number(numberNow) / Number(numberPast) - 1) * 100,
          1);
      }
      return result;
    },
    dateSet: function(){
      this.start = this.data.site_info[2];;
      this.end = this.data.site_info[3];;
      this.comStart = this.data.site_info[4];;
      this.comEnd = this.data.site_info[5];;
    },
    // getAxios: function(){
    //   axios.get('/api/analytics')
    //     .then((res) => {
    //       this.data = res.data,
    //       this.dateSet(),
    //       this.fillData()
    //     })
    //     .catch(error => {
    //       console.log(error);
    //     })
    // },
    pageReload:function() {
        this.$router.go({path: this.$router.currentRoute.path, force: true});
    },
    // dataAjax: function(){
    //   var calender = this.calender;
    //   axios.post('/api/ajax',calender).then(res => {
    //     console.log(calender);
    //     this.$router.go({path: this.$router.currentRoute.path, force: true})
    //   })
    //   .catch(error => {
    //       console.warn(error);
    //   });
    // },
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
            backgroundColor: '#5AC8FA1A',
            pointBackgroundColor: 'blue',
            data: arrayDataOne
          }, {
            label: '前期間',
            borderColor: '#FF2D55',
            pointBackgroundColor: 'red',
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
                display: false
              },
              ticks: {
                display: false
              }
            }],
            yAxes: [{
              scaleLabel: {
                fontColor: '#EDEDED'
              },
              gridLines: {

              },
              ticks: {
                suggestedMin: 0,
                autoSkip: true
              },
            }]
          }
        }
    }
  }
}
</script>
