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
            <img :src="images.raka" class="decore-left" alt="card-img-left">
            <img :src="images.leona" class="decore-right" alt="card-img-right">
            <h1 class="mb-4 text-white">{{ $t("home.welcome") }}</h1>
            <p class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white mb-5" v-html="$t('home.welcomeText')"></p>
            <div class="xl:w-2/5 lg:w-2/5 md:w-2/3 w-3/5 mx-auto">
                <vue-simple-suggest :list="simpleSuggestionList" :filter-by-query="true">
                    <!-- Filter by input text to only show the matching results -->
                    <input v-model="inputVal" :placeholder="$t('SearchBanner.searchInput')" class="is-label-placeholder   text-white" />
                </vue-simple-suggest>
            </div>

        </vx-card>
    </div>
</div>
</template>

<script>
// Vue Simple Suggest
import VueSimpleSuggest from 'vue-simple-suggest'

export default {
    name: 'search-banner',
    props: ['value'],
    components: {
        VueSimpleSuggest
    },
    computed: {
        inputVal: {
            get() {
                return this.value;
            },
            set(val) {
                this.$emit('input', val);
            }
        }
    },
    data: () => ({
        images: {
            raka: require("@assets/images/home/home_raka.png"),
            leona: require("@assets/images/home/home_leona.png"),
        },
        mode: null,
        loading: false
    }),
    methods: {
        simpleSuggestionList() {
            return [
                'Vayne',
                'React.js',
                'Angular.js'
            ]
        },

    }

}
</script>

<style lang="scss">
@import "@sass/vuexy/extraComponents/autocomplete.scss";
@import "@sass/vuexy/pages/home.scss";
</style>
