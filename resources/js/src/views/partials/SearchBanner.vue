<template>
    <vx-card slot="no-body" class="text-center bg-primary-gradient greet-user">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <img :src="images.raka" class="decore-left" alt="card-img-left" />
        <img :src="images.leona" class="decore-right" alt="card-img-right" />

        <logo-white class="w-16 fill-current text-primary z-50" />

        <slot></slot>
        <div class="xl:w-2/5 lg:w-2/5 md:w-2/3 w-3/5 mx-auto"></div>
    </vx-card>
</template>

<script>
import LogoWhite from "@/layouts/components/LogoWhite.vue";

export default {
    name: "search-banner",
    props: ["champion"],
    components: {
        LogoWhite
    },
    data: () => ({
        images: {
            raka: require("@assets/images/home/home_raka.png"),
            leona: require("@assets/images/home/home_leona.png")
        }
    })
};
</script>

<style lang="scss">
@import "@sass/vuexy/pages/home.scss";
</style>
