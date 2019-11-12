<template>
<div class="ad container">
  <!-- <h2>広告</h2>
  <ul>
    <li>今期間</li>
    <li>広告費用：{{data.cv[0][0]}}</li>
    <li>広告クリック：{{data.cv[0][1]}}</li>
    <li>コンバージョン：{{data.cv[0][2]}}</li>
  </ul>
  <ul>
    <li>前期間</li>
    <li>広告費用：{{data.cv[1][0]}}</li>
    <li>広告クリック：{{data.cv[1][1]}}</li>
    <li>コンバージョン：{{data.cv[1][2]}}</li>
  </ul> -->
  <table class="table table-striped" style="table-layout:fixed;">
  <thead>
    <tr class="textCenter fourteen">
      <th style="width:16%"></th>
      <th style="width:14%" class="normal">
      <div class="iconUser">
        <i class="fas fa-mouse-pointer marginIcon"></i>
      </div>
      クリック数
      </th>
      <th style="width:14%" class="normal">
        <div class="iconBr">
          <i class="fas fa-yen-sign marginIcon"></i>
        </div>
      費用
      </th>
      <th style="width:14%" class="normal">
      <div class="iconPs">
        <i class="fas fa-yen-sign marginIcon"></i>
      </div>
      クリック単価
      </th>
      <th style="width:14%" class="normal">
      <div class="iconAveSs">
        <i class="fas fa-bolt marginIcon"></i>
      </div>
      セッション数
      </th>
      <th style="width:14%" class="normal">
      <div class="iconSession">
        <i class="fas fa-flag marginIcon"></i>
      </div>
      コンバージョン<br>数
      </th>
      <th style="width:14%" class="normal">
        <div class="iconBye">
          <i class="far fa-flag marginIcon"></i>
        </div>
      コンバージョン率
      </th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(report,index) in data.cvReport" class="fourteen">
      <td class="textLeft wordBreak">{{ report[0][0][0][0] }}</td>
      <td class="textRight">
        {{ report[0][0][1] }}
          <span v-if="index===0" v-bind:style="{width:styleMax}" class="barAgeMax mb-1"></span>
          <span v-else v-bind:style="{width:stylesClick[index]}" class="barAge mb-1"></span>
          <div class="flex justifyEnd mb-2">
            <p class="textCenter comRate tewlve"><span class="mr-1">▲</span>10%</p>
          </div>
      </td>
      <td class="textRight">
        {{ mathRound(report[0][0][2], 1) }}
        <span v-bind:style="{width:stylesCost[index]}" class="barCountry mb-1"></span>
        <div class="flex justifyEnd mb-2">
          <p class="textCenter comRate tewlve"><span class="mr-1">▲</span>10%</p>
        </div>
      </td>
      <td class="textRight">
        {{mathRound(report[0][0][2] / report[0][0][1] ,1)}}
          <span v-bind:style="{width:stylesCc[index]}" class="barAge mb-1"></span>
          <div class="flex justifyEnd mb-2">
            <p class="textCenter comRate tewlve"><span class="mr-1">▲</span>10%</p>
          </div>
      </td>
      <td class="textRight">
        {{ mathRound(report[0][0][3], 1) }}
        <span v-bind:style="{width:stylesSs[index]}" class="barTime mb-1"></span>
        <div class="flex justifyEnd mb-2">
          <p class="textCenter comRate tewlve"><span class="mr-1">▲</span>10%</p>
        </div>
      </td>
      <td class="textRight">
        {{ mathRound(report[0][0][4], 1) }}
        <span v-bind:style="{width:stylesCv[index]}" class="barSs mb-1"></span>
        <div class="flex justifyEnd mb-2">
          <p class="textCenter comRate tewlve"><span class="mr-1">▲</span>10%</p>
        </div>
      </td>
      <td class="textRight">
        {{ mathRound(report[0][0][5], 1) }}
        <span v-bind:style="{width:stylesCvr[index]}" class="barCity mb-1"></span>
        <div class="flex justifyEnd mb-2">
          <p class="textCenter comRate tewlve"><span class="mr-1">▲</span>10%</p>
        </div>
      </td>
    </tr>
  </tbody>
</table>
</div>
</template>

<script>
export default {
  data() {
    return {
      data: {},
      stylesClick :{},
      stylesCost :{},
      stylesClickCost :{},
      stylesSs :{},
      stylesCv :{},
      stylesCvr :{},
      stylesCc :{},
      styleMax :"100%"
    }
  },
  mounted() {
    axios.get('/api/ad')
      .then((res) => {
        this.data = res.data,
        // console.log(this.data.cv,this.data.cvReport);
        this.makeArraySs(),
        this.makeArrayCv(),
        this.makeArrayCvr(),
        this.makeArrayCost(),
        this.widthClick(),
        this.makeArrayClickCost()
      })
      .catch(error => {
        console.log(error);
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
    mathRound: function(number, n){
        var _pow = Math.pow( 10 , n );
        return Math.round( number * _pow ) / _pow;
    },
    widthClick: function() {
      var maxNumber = this.data.cvReport[0][0][0][1];
      var w_arry = {};
      for (var i = 1; i < 10; i++) {
        var number = this.data.cvReport[i][0][0][1];
        var width = this.calRate(number, maxNumber);
        w_arry[i] = width;
      }
      this.stylesClick = w_arry;
    },
    makeArrayCv: function(){
      var cvArray = [];
      var cvArrays ={};
       for(var i=0; i<10; i++){
         var a = this.data.cvReport[i][0][0][4];
         cvArrays[i] = a;
         cvArray.push(a);
       }
      var maxCv = Math.max.apply(null,cvArray);
      var w_arry = {};
      for(var i=0; i<10; i++){
        var number = cvArrays[i];
        var width = this.calRate(number, maxCv);
        w_arry[i] = width;
      }
      this.stylesCv = w_arry;
    },
    makeArrayCvr: function(){
      var cvrArray = [];
      var cvrArrays ={};
       for(var i=0; i<10; i++){
         var a = this.mathRound(this.data.cvReport[i][0][0][5], 1);
         cvrArrays[i] = a;
         cvrArray.push(a);
       }
      var maxCvr= Math.max.apply(null,cvrArray);
      var w_arry = {};
      for(var i=0; i<10; i++){
        var number = cvrArrays[i];
        var width = this.calRate(number, maxCvr);
        w_arry[i] = width;
      }
      this.stylesCvr = w_arry;
    },
    makeArrayClickCost: function(){
      var ccArray = [];
      var ccArrays ={};
       for(var i=0; i<10; i++){
         var cost = this.mathRound(this.data.cvReport[i][0][0][2], 1);
         var click = this.data.cvReport[i][0][0][1];
         var cc = this.mathRound(cost / click, 1);
         ccArrays[i] = cc;
         ccArray.push(cc);
       }
      var maxCc= Math.max.apply(null,ccArray);
      var w_arry = {};
      for(var i=0; i<10; i++){
        var number = ccArrays[i];
        var width = this.calRate(number, maxCc);
        w_arry[i] = width;
      }
      this.stylesCc = w_arry;
    },
    makeArrayCost: function(){
      var brArray = [];
      var brArrays ={};
       for(var i=0; i<10; i++){
         var a = this.data.cvReport[i][0][0][2];
         brArrays[i] = a;
         brArray.push(a);
       }
      var maxBr = Math.max.apply(null,brArray);
      var w_arry = {};
      for(var i=0; i<10; i++){
        var number = brArrays[i];
        var width = this.calRate(number, maxBr);
        w_arry[i] = width;
      }
      this.stylesCost = w_arry;
    },
    makeArraySs: function(){
      var psArray = [];
      var psArrays = {};
       for(var i=0; i<10; i++){
         var a = this.data.cvReport[i][0][0][3];
         psArrays[i] = a;
         psArray.push(a);
       }
       var maxPs = Math.max.apply(null,psArray);
       var w_arry = {};
       for(var i=0; i<10; i++){
         var number = psArrays[i];
         var width = this.calRate(number, maxPs);
         w_arry[i] = width;
       }
       this.stylesSs = w_arry;
    }
  }
}
</script>
