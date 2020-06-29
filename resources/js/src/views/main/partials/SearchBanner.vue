<template>
    <vx-card slot="no-body" class="text-center bg-primary-gradient greet-user h-full">
        <div class="vx-row h-full flex items-center pt-5 pb-5">
            <div class="vx-col w-full">
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
                <img
                    v-if="displayDecore"
                    :src="images.raka"
                    class="decore-left"
                    alt="card-img-left"
                />
                <img
                    v-if="displayDecore"
                    :src="images.leona"
                    class="decore-right"
                    alt="card-img-right"
                />

                <logo-white class="w-16 fill-current text-primary z-50" />

                <slot></slot>
            </div>
        </div>
    </vx-card>
</template>

<script>
import LogoWhite from "@/layouts/components/LogoWhite.vue";

export default {
    name: "search-banner",
    props: ["champion", "displayDecore"],
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
.vx-card__body {
    height: 100%;
}
</style>
