<template>
<div>
    <h2>Action</h2>
    <div v-for="action in this.data">
        <p>{{ action[0] }}:{{ action[1] }},{{ action[2] }},{{ action[3] }},{{ action[4] }},{{ action[5] }},{{ action[6] }}</p>
    </div>
</div>
</template>
<script>
export default {
    data() {
        return {
            data: {},
        }
    },
    mounted() {
        axios.get('/api/action')
            .then((res) => {
                this.data = res.data
                console.log(this.data);
            })
            .catch(error => {
                console.log(error);
            })
    }
}
</script>
