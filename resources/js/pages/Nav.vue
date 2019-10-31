<template>
<div>
    <nav class="navbar navbar-dark nav-justified top-nav mb-4">
        <p v-on:click='isActive=1' v-bind:class="[ isActive === 1 ? 'active' : '' ]" class="nav-item nav-link">
            <router-link to="/" class="dark-gray router-link">
                サマリー
            </router-link>
        </p>
        <p v-on:click='isActive=2' v-bind:class="[ isActive === 2 ? 'active' : '' ]" class="nav-item nav-link">
            <router-link to='/user' class="dark-gray router-link">
                ユーザー属性
            </router-link>
        </p>
        <p v-on:click='isActive=3' v-bind:class="[ isActive === 3 ? 'active' : '' ]" class="nav-item nav-link">
            <router-link to='/inflow' class="dark-gray router-link">
                流入元分析
            </router-link>
        </p>
        <p v-on:click='isActive=4' v-bind:class="[ isActive === 4 ? 'active' : '' ]" class="nav-item nav-link">
            <router-link to='/action' class="dark-gray router-link">
                ユーザー行動分析
            </router-link>
        </p>
        <p v-on:click='isActive=5' v-bind:class="[ isActive === 5 ? 'active' : '' ]" class="nav-item nav-link">
            <router-link to='/ad' class="dark-gray router-link">
                広告分析
            </router-link>
        </p>
    </nav>
</div>
</template>
<script>
export default {
    data() {
        return {
            isActive: 1
        }
    }
}
</script>
