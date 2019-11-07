<template>
<div class="user container">
  <section>
    <div class="row">
      <div class="col-md-4">
        <div class="card bottom1Rem">
          <div class="card-body">
            <div class="iconAveSs iconTop">
              <i class="fas fa-user-plus"></i>
            </div>
            <p class="card-title textCenter fourteen">新規ユーザー</p>
            <div class="card-text doughnutChart">
              <DoughnutChartUser :chart-data="datacollectionUser" :options="optionsUser" :width="150" :height="150"></DoughnutChartUser>
            </div>
            <div class="flex justifyCenter">
              <div class="newUser textCenter mr-3">
                <i class="fas fa-user-plus newUserColor"></i>
                <p class="fourteen dark-gray mb-1">新規ユーザー</p>
                <p class="dark-gray bold mb-1">XX%</p>
                <p class="textCenter comRate"><span class="mr-1">▲</span>10%</p>
              </div>
              <div class="returnUser textCenter ml-3">
                <i class="fas fa-user returnUserColor"></i>
                <p class="fourteen dark-gray mb-1">既存ユーザー</p>
                <p class="dark-gray bold mb-1">XX%</p>
                <p class="textCenter comRate"><span class="mr-1">▲</span>10%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bottom1Rem">
          <div class="card-body">
            <div class="iconSession iconTop">
              <i class="fas fa-venus-mars"></i>
            </div>
            <p class="card-title textCenter">性別</p>
            <div class="card-text doughnutChart">
              <DoughnutChartSex :chart-data="datacollectionSex" :options="optionsSex" :width="150" :height="150"></DoughnutChartSex>
            </div>
            <div class="flex justifyCenter">
              <div class="newUser textCenter mr-3">
                <i class="fas fa-male blue"></i>
                <p class="fourteen dark-gray mb-1">男性</p>
                <p class="dark-gray bold mb-1">XX%</p>
                <p class="textCenter comRate"><span class="mr-1">▲</span>10%</p>
              </div>
              <div class="returnUser textCenter ml-3">
                <i class="fas fa-female red"></i>
                <p class="fourteen dark-gray mb-1">女性</p>
                <p class="dark-gray bold mb-1">XX%</p>
                <p class="textCenter comRate"><span class="mr-1">▲</span>10%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bottom1Rem">
          <div class="card-body">
            <div class="iconUser iconTop">
              <i class="fas fa-mobile-alt"></i>
            </div>
            <p class="card-title textCenter">デバイス</p>
            <div class="card-text doughnutChart">
              <DoughnutChartDevice :chart-data="datacollectionDevice" :options="optionsDevice" :width="150" :height="150"></DoughnutChartDevice>
            </div>
            <div class="flex justifyCenter">
              <div class="newUser textCenter mr-3">
                <i class="fas fa-mobile-alt blue"></i>
                <p class="fourteen dark-gray mb-1">モバイル</p>
                <p class="dark-gray bold mb-1">XX%</p>
                <p class="textCenter comRate"><span class="mr-1">▲</span>10%</p>
              </div>
              <div class="returnUser textCenter ml-3 mr-3">
                <i class="fas fa-desktop pcColor"></i>
                <p class="fourteen dark-gray mb-1">PC</p>
                <p class="dark-gray bold mb-1">XX%</p>
                <p class="textCenter comRate"><span class="mr-1">▲</span>10%</p>
              </div>
              <div class="returnUser textCenter ml-3">
                <i class="fas fa-tablet-alt mobileColor"></i>
                <p class="fourteen dark-gray mb-1">タブレット</p>
                <p class="dark-gray bold mb-1">XX%</p>
                <p class="textCenter comRate"><span class="mr-1">▲</span>10%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bottom1Rem">
          <div class="card-body">
            <div class="iconUser iconTop">
              <i class="fas fa-user"></i>
            </div>
            <p class="card-title textCenter">年齢</p>
            <div v-for="(age,index) in data.user[1]">
              <div class="flex justifyBetween mb-1">
                <p class="fourteen black">{{ age[0] }}</p>
                <p class="eighteen black bold">{{ age[1] }}</p>
              </div>
              <span v-if="index===0" v-bind:style="{width:styleMax}" class="barAgeMax mb-1"></span>
              <span v-else v-bind:style="{width:stylesAge[index]}" class="barAge mb-1"></span>
              <div class="flex justifyEnd mb-2">
                <p class="textCenter comRate fourteen"><span class="mr-1">▲</span>10%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bottom1Rem">
          <div class="card-body">
            <div class="iconBr iconTop">
              <i class="fas fa-globe-asia"></i>
            </div>
            <p class="card-title textCenter">国</p>
            <div v-for="(country,index) in data.user[3]">
              <div class="flex justifyBetween mb-1">
                <p class="fourteen black">{{ country[0] }}</p>
                <p class="eighteen black bold">{{ country[1] }}</p>
              </div>
              <span v-if="index===0" v-bind:style="{width:styleMax}" class="barCountryMax mb-1"></span>
              <span v-else v-bind:style="{width:stylesCountry[index]}" class="barCountry mb-1"></span>
              <div class="flex justifyEnd mb-2">
                <p class="textCenter comRate fourteen"><span class="mr-1">▲</span>10%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card bottom1Rem">
          <div class="card-body">
            <div class="iconBye iconTop">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <p class="card-title textCenter dark-gray">地域</p>
            <div v-for="(city,index) in data.user[4]">
              <div class="flex justifyBetween mb-1">
                <p class="fourteen black">{{ city[0] }}</p>
                <p class="eighteen black bold">{{ city[1] }}</p>
              </div>
              <span v-if="index===0" v-bind:style="{width:styleMax}" class="barCityMax mb-1"></span>
              <span v-else v-bind:style="{width:stylesCity[index]}" class="barCity mb-1"></span>
              <div class="flex justifyEnd mb-2">
                <p class="textCenter comRate fourteen"><span class="mr-1">▲</span>10%</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section>
    <div class="commentArea kagariBorder bottom1Rem flex">
      <div class="iconComment iconTop">
        <i class="fas fa-comment-dots"></i>
      </div>
      <div class="commentTextArea">
        <h6 class="dark-gray sixteen bold">コメント</h6>
      <textarea placeholder="コメントを入力" style="border:none;"></textarea>
      </div>
    </div>
  </section>
  <!-- <div class="country graphBox">
        <h2>Country</h2>
        <div v-for="(country,index) in data.user[3]">
            <p>{{ country[0] }}:{{ country[1] }}</p>
            <span v-if="index===0" v-bind:style="{width:styleMax}" class="barCountry"></span>
            <span v-else v-bind:style="{width:stylesCountry[index]}" class="barCountry"></span>
            <p>前期間：{{country[2]}}</p>
        </div>
    </div>
    <div class="city graphBox">
        <h2>City</h2>
        <div v-for="(city,index) in data.user[4]">
            <p>{{ city[0] }}:{{ city[1] }}</p>
            <span v-if="index===0" v-bind:style="{width:styleMax}" class="barCity"></span>
            <span v-else v-bind:style="{width:stylesCity[index]}" class="barCity"></span>
        </div>
    </div>
    <div class="age graphBox">
        <h2>Age</h2>
        <div v-for="(age,index) in data.user[1]">
            <p>{{ age[0] }}:{{ age[1] }}</p>
            <span v-if="index===0" v-bind:style="{width:styleMax}" class="barAge"></span>
            <span v-else v-bind:style="{width:stylesAge[index]}" class="barAge"></span>
        </div>
</div>
    <div class="gender graphBox">
        <h2>Gender</h2>
        <DoughnutChartSex :chart-data="datacollectionSex" :options="optionsSex" :width="150" :height="150"></DoughnutChartSex>
    </div>
    <div class="device graphBox">
        <h2>Deivce</h2>
        <DoughnutChartDevice :chart-data="datacollectionDevice" :options="optionsDevice" :width="150" :height="150"></DoughnutChartDevice>
    </div>
    <div class="userType graphBox">
      <h2>UserType</h2>
      <DoughnutChartUser :chart-data="datacollectionUser" :options="optionsUser" :width="150" :height="150"></DoughnutChartUser>
    </div> -->
</div>
</template>
<script>
import DoughnutChartSex from '../chart/DoughnutChart.js'
import DoughnutChartUser from '../chart/DoughnutChart.js'
import DoughnutChartDevice from '../chart/DoughnutChart.js'

export default {

  components: {
    // ここで読んだコンポーネントをケバブケースにしたら普通に使えるっぽい
    DoughnutChartSex,
    DoughnutChartUser,
    DoughnutChartDevice,
  },
  data() {
    return {
      datacollectionSex: {},
      datacollectionUser: {},
      datacollectionDevice: {},
      optionsSex: {},
      optionsDevice: {},
      optionsUser: {},
      data: {},
      styleMax: '100%',
      stylesCountry: {},
      stylesCity: {},
      stylesAge: {}
    }
  },
  created() {
    axios.get('/api/user')
      .then((res) => {
          this.data = res.data,
          // console.log(this.data);
          this.widthCountry(),
          this.widthCity(),
          this.widthAge(),
          this.DoughnutChartDataSex(),
          this.DoughnutChartDataUser(),
          this.DoughnutChartDataDevice()
      })
      .catch(error => {
        console.error(error);
      })
  },
  methods: {
    calRate: function(number, maxNumber) {
      var resultNumber = (number / maxNumber) * 100;
      var _pow = Math.pow(10, 1);
      var result = Math.round(resultNumber * _pow) / _pow;
      var width = result + '%';
      return width;
    },
    widthCountry: function() {
      var maxNumber = this.data.user[3][0][1];
      var w_arry = {};
      for (var i = 1; i < 5; i++) {
        var number = this.data.user[3][i][1];
        var width = this.calRate(number, maxNumber);
        w_arry[i] = width;
      }
      this.stylesCountry = w_arry;
    },
    widthCity: function() {
      var maxNumber = this.data.user[4][0][1];
      var w_arry = {};
      for (var i = 1; i < 5; i++) {
        var number = this.data.user[4][i][1];
        var width = this.calRate(number, maxNumber);
        w_arry[i] = width;
      }
      this.stylesCity = w_arry;
    },
    widthAge: function() {
      var maxNumber = this.data.user[1][0][1];
      var w_arry = {};
      for (var i = 1; i < 4; i++) {
        var number = this.data.user[1][i][1];
        var width = this.calRate(number, maxNumber);
        w_arry[i] = width;
      }
      this.stylesAge = w_arry;
    },
    DoughnutChartDataSex: function() {
      var maleNumber = this.data.user[2][0][1];
      var femaleNumber = this.data.user[2][1][1];
      var sexData = [];
      sexData.push(maleNumber, femaleNumber);
      this.datacollectionSex = {
          // ラベル
          labels: ["男性", "女性"],
          // データ詳細
          datasets: [{
            data: sexData,
            backgroundColor: [
              '#007AFF',
              '#FF2D55'
            ]
          }]
        },
        this.optionsSex = {
          responsive: false,
          cutoutPercentage: 85,
          legend: {
            display: false
          }
        }
    },
    DoughnutChartDataUser: function() {
      var NewNumber = this.data.userTypes[0][0][1];
      var ReturnNumber = this.data.userTypes[1][0][1];
      var userData = [];
      userData.push(NewNumber, ReturnNumber);
      this.datacollectionUser = {
          // ラベル
          labels: ["新規ユーザー", "既存ユーザー"],
          // データ詳細
          datasets: [{
            data: userData,
            backgroundColor: [
              'rgba(255, 59, 48, 1)',
              'rgba(255, 59, 48, 0.6)'
            ]
          }]
        },
        this.optionsUser = {
          legend: {
            display: false
          },
          responsive: false,
          cutoutPercentage: 85,
        }
    },
    DoughnutChartDataDevice: function() {
      var mobileNumber = this.data.user[0][1][1];
      var pcNumber = this.data.user[0][0][1];
      var tabletNumber = this.data.user[0][2][1];
      var deviceData = [];
      deviceData.push(mobileNumber, pcNumber, tabletNumber);
      this.datacollectionDevice = {
          // ラベル
          labels: ["モバイル", "PC", "タブレット"],
          // データ詳細
          datasets: [{
            data: deviceData,
            backgroundColor: [
              '#007AFF',
              '#007AFF99',
              '#007AFF66'
            ]
          }]
        },
        this.optionsDevice = {
          responsive: false,
          cutoutPercentage: 85,
          legend: {
            display: false
          }
        }
    }
  }
}
</script>
