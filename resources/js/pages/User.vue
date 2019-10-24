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
        <div v-for="(gender,index) in data.user[2]">
            <p>{{ gender[0] }}:{{ gender[1] }}</p>
        </div>
        <div class="barGender">
          <span class="barGenderMale" v-bind:style="{width:stylesMale}"></span>
          <span class="barGenderFemale"  v-bind:style="{width:stylesFemale}"></span>
        </div>
    </div>
    <div class="device graphBox">
        <h2>Deivce</h2>
        <div v-for="(device,index) in data.user[0]">
            <p>{{ device[0] }}:{{ device[1] }}</p>
            <span v-if="index===0" v-bind:style="{width:styleMax}" class="barDevice"></span>
            <span v-else v-bind:style="{width:stylesDevice[index]}" class="barDevice"></span>
        </div>
    </div>
</div>

</template>
<script>
export default {
    data() {
        return {
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
                    this.widthDevice(),
                    this.widthMale(),
                    this.widthFemale()
            })
            .catch(error => {
                console.log(error);
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
        widthDevice: function() {
            var maxNumber = this.data.user[0][0][1];
            var w_arry = {};
            for (var i = 1; i < 3; i++) {
                var number = this.data.user[0][i][1];
                var width = this.calRate(number,maxNumber);
                w_arry[i] = width;
            }
            this.stylesDevice = w_arry;
        },
        widthMale: function() {
            var maleNumber = this.data.user[2][0][1];
            var femaleNumber = this.data.user[2][1][1];
            var totalNumber = Number(maleNumber) + Number(femaleNumber);
            var width = this.calRate(maleNumber,totalNumber);
            this.stylesMale = width;
        },
      widthFemale: function() {
        var maleNumber = this.data.user[2][0][1];
        var femaleNumber = this.data.user[2][1][1];
        var totalNumber = Number(maleNumber) + Number(femaleNumber);
        var width = this.calRate(femaleNumber,totalNumber);
        this.stylesFemale = width;
      }
    }
}
</script>
