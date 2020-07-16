<template>
    <vs-navbar
        v-model="activeRegion"
        color="#0091EA"
        text-color="rgba(255,255,255,.6)"
        active-text-color="rgba(255,255,255,1)"
        class="vx-navbar px-5 myNavbar text-white vs-con-loading__container mb-4"
        id="regionLoading"
    >
        <div slot="title">
            <vs-navbar-title class="font-semibold uppercase text-white">{{$t('Global.Regions')}}</vs-navbar-title>
        </div>

        <vs-navbar-item :index="data" :data="data" :key="index" v-for="(data, index) in regions">
            <router-link
                :to="{name: 'spectate', params: {
                    region: data,
                }}"
            >{{data}}</router-link>
        </vs-navbar-item>
    </vs-navbar>
</template>

<script>
export default {
    data: () => ({
        colorx: "#0091EA"
    }),
    props: ["regions", "activeRegion"]
};
</script>
<style>
.myNavbar .is-active-item a {
    color: white !important;
}
.myNavbar .vs-navbar--item:hover a {
    color: white !important;
}
</style>