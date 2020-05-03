<template>
    <div class="vx-row">
        <!-- CARD 1: CONGRATS -->
        <div class="vx-col w-full mb-base">
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

                <logo class="w-10 fill-current text-primary" />

                <h1 class="mb-4 text-white">{{ $t("home.welcome") }}</h1>
                <p
                    class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white mb-5"
                    v-html="$t('home.welcomeText')"
                ></p>
                <div class="xl:w-2/5 lg:w-2/5 md:w-2/3 w-3/5 mx-auto"></div>
            </vx-card>
        </div>
    </div>
</template>

<script>
// Search Input
import SearchInput from "./SearchInput";
import Logo from "@/layouts/components/Logo.vue";

export default {
    name: "search-banner",
    props: ["champion"],
    components: {
        SearchInput,
        Logo
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
