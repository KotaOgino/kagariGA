<template>
<div class="user">
    <div class="country graphBox">
        <h2>Country</h2>
        <div v-for="(country,index) in data.user[3]">
            <p>{{ country[0] }}:{{ country[1] }}</p>
            <span v-if="index===0" v-bind:style="{width:styleMax}" class="barCountry"></span>
            <span v-else v-bind:style="{width:stylesCountry[index]}" class="barCountry"></span>
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
        <div v-for="age in data.user[1]">
            <p>{{ age[0] }}:{{ age[1] }}</p>
        </div>
</div>
    <div class="gender graphBox">
        <h2>Gender</h2>
        <DoughnutChartSex :chart-data="datacollectionSex" :options="optionsSex" :width="150" :height="150"></DoughnutChartSex>
    </div>
    <div class="device graphBox">
        <h2>Deivce</h2>
        <!-- <div v-for="(device,index) in data.user[0]">
            <p>{{ device[0] }}:{{ device[1] }}</p>
            <span v-if="index===0" v-bind:style="{width:styleMax}" class="barDevice"></span>
            <span v-else v-bind:style="{width:stylesDevice[index]}" class="barDevice"></span>
        </div> -->
        <DoughnutChartDevice :chart-data="datacollectionDevice" :options="optionsDevice" :width="150" :height="150"></DoughnutChartDevice>
    </div>
    <div class="userType graphBox">
      <h2>UserType</h2>
      <!-- <div v-for="(userType,index) in data.userTypes">
        <p>{{userType[0][0]}}:{{userType[0][1]}}</p>
      </div> -->
      <DoughnutChartUser :chart-data="datacollectionUser" :options="optionsUser" :width="150" :height="150"></DoughnutChartUser>
    </div>
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
            data: {},
            styleMax: '100%',
            stylesCountry: {},
            stylesCity: {},
            stylesDevice: {},
            stylesMale: '',
            stylesFemale: ''
        }
    },
    created() {
        axios.get('/api/user')
            .then((res) => {
                    this.data = res.data,
                    this.widthCountry(),
                    this.widthCity(),
                    this.DoughnutChartDataSex(),
                    this.DoughnutChartDataUser(),
                    this.DoughnutChartDataDevice()
            })
            .catch(error => {
                console.error(error);
            })
    },
    methods: {
        calRate: function(number,maxNumber){
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
                var width = this.calRate(number,maxNumber);
                w_arry[i] = width;
            }
            this.stylesCountry = w_arry;
        },
        widthCity: function() {
            var maxNumber = this.data.user[4][0][1];
            var w_arry = {};
            for (var i = 1; i < 5; i++) {
                var number = this.data.user[4][i][1];
                var width = this.calRate(number,maxNumber);
                w_arry[i] = width;
            }
            this.stylesCity = w_arry;
        },
    DoughnutChartDataSex:function(){
      var maleNumber = this.data.user[2][0][1];
      var femaleNumber = this.data.user[2][1][1];
      var sexData = [];
      sexData.push(maleNumber,femaleNumber);
      this.datacollectionSex = {
        // ラベル
          labels: ["男性", "女性"],
          // データ詳細
          datasets: [{
              data: sexData,
              backgroundColor: [
                 'blue',
                 'red'
              ]
          }]
      },
      this.optionsSex = {
        responsive:false,
        cutoutPercentage: 80,
        legend: {
          position: 'bottom',
          labels : {
            fontSize: 12,
          }
        }
      }
    },
    DoughnutChartDataUser: function(){
      var NewNumber = this.data.userTypes[0][0][1];
      var ReturnNumber = this.data.userTypes[1][0][1];
      var userData = [];
      userData.push(NewNumber,ReturnNumber);
      this.datacollectionUser = {
        // ラベル
          labels: ["新規ユーザー", "既存ユーザー"],
          // データ詳細
          datasets: [{
              data: userData,
              backgroundColor: [
                 'blue',
                 'skyblue'
              ]
          }]
      },
      this.optionsUser = {
        responsive:false,
        cutoutPercentage: 80,
        legend: {
          position: 'bottom',
          // ★ [labels]を追加
          labels : {
            fontSize: 12,
          }
        }
      }
    },
    DoughnutChartDataDevice: function(){
      var mobileNumber = this.data.user[0][1][1];
      var pcNumber = this.data.user[0][0][1];
      var tabletNumber = this.data.user[0][2][1];
      var deviceData = [];
      deviceData.push(mobileNumber,pcNumber,tabletNumber);
      this.datacollectionDevice = {
        // ラベル
          labels: ["モバイル", "PC", "タブレット"],
          // データ詳細
          datasets: [{
              data: deviceData,
              backgroundColor: [
                 'red',
                 'orange',
                 'pink'
              ]
          }]
      },
      this.optionsDevice = {
        responsive:false,
        cutoutPercentage: 80,
        legend: {
          position: 'bottom',
          // ★ [labels]を追加
          labels : {
            fontSize: 12,
          }
        }
      }
    }
    }
}
</script>
