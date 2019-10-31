<template>
<div>
  <h2>広告</h2>
  <ul>
    <li>今期間</li>
    <li>広告費用：{{data[0][0]}}</li>
    <li>広告クリック：{{data[0][1]}}</li>
    <li>コンバージョン：{{data[0][2]}}</li>
  </ul>
  <ul>
    <li>前期間</li>
    <li>広告費用：{{data[1][0]}}</li>
    <li>広告クリック：{{data[1][1]}}</li>
    <li>コンバージョン：{{data[1][2]}}</li>
  </ul>
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
    axios.get('/api/ad')
      .then((res) => {
        this.data = res.data
      })
      .catch(error => {
        console.log(error);
      })
  }
}
</script>
