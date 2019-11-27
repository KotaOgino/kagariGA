<template>
<div class="navcomp">
  <section class="mt-2">
  <div class="container">
  <div class="bd-highlight bg-white kagariBorder">
  <div class="d-flex">
  <div class="mr-auto p-2 bd-highlight top-line">
  <p class="mt-4 ml-3 sixteen bold">{{data.site_info[1]}}</p>
  <br>
  <p class="ml-3 mb-4 gray fourteen">{{data.site_info[0]}}</p>
  </div>
  <div class="p-2 bd-highlight top-line">
  <!-- <p class="mt-4 mr-3 blue fourteen" v-on:click="dataAjax">期間<span class="ml-3 gray borderBottom pointer">{{start}} 〜 {{end}}</span></p> -->
  <p class="mt-4 mr-3 blue fourteen" data-toggle="modal" data-target="#exampleModal">期間<span class="ml-3 gray borderBottom pointer">{{start}} 〜 {{end}}</span></p>
  <br>
  <p class="mr-3 mb-4 red fourteen" data-toggle="modal" data-target="#exampleModal">比較<span class="ml-3 gray borderBottom pointer">{{comStart}} 〜 {{comEnd}}</span></p>
  </div>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">分析期間を変更する</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-6">
          <p>分析 <span>{{start}} 〜 {{end}}</span></p>
          開始：<input type="date" v-model="start">
          <br>
          終了：<input type="date" v-model="end">
        </div>
        <div class="col-md-6">
          <p>比較 <span>{{comStart}} 〜 {{comEnd}}</span></p>
          開始：<input type="date" v-model="comStart">
          <br>
          終了：<input type="date" v-model="comEnd">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="siteInfo">期間を変更</button>
      </div>
    </div>
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
  </section>
</div>
</template>
<script>
import EventBus from '../EventBus.js'

export default {
    data() {
        return {
          data: {},
          isActive: 1,
          start: '',
          end: '',
          comStart: '',
          comEnd: ''
        }
    },
    mounted() {
      this.axiosGet()
    },
    methods: {
      siteInfo: function() {
        var calender = {
            start: this.start,
            end: this.end,
            comStart: this.comStart,
            comEnd: this.comEnd
        };
        console.log(calender,'post');
        EventBus.$emit('site-info', calender);
      },
      axiosGet: function(){
          axios.get('/api/nav')
              .then((res) => {
                  this.data = res.data,
                  this.dateSet(),
                  this.siteInfo()
              })
              .catch(error => {
                  console.log(error);
              })
      },
      dateSet: function(){
        this.start = this.data.site_info[2];
        this.end = this.data.site_info[3];
        this.comStart = this.data.site_info[4];
        this.comEnd = this.data.site_info[5];
      }
    }
}
</script>
