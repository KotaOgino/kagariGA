<template>
<div>
  <h2>チャネル</h2>
  <div v-for="(medium,index) in data.inflow[0]">
    <p>{{ medium[0] }}:{{ medium[1] }}</p>
  </div>
  <h2>ソーシャル</h2>
  <div v-for="(social,index) in data.inflow[0]">
    <p>{{ social[0] }}:{{ social[1] }}</p>
  </div>
  <h2>他サイトのリンク</h2>
  <div v-for="(referral,index) in data.inflow[0]">
    <p>{{ referral[0] }}:{{ referral[1] }}</p>
  </div>
</div>
</template>
<script>
export default {
  data() {
    return {
      data: {}
    }
  },
  mounted() {
    axios.get('/api/inflow')
      .then((res) => {
        this.data = res.data
      })
      .catch(error => {
        console.log(error);
      })
  }
}
</script>
