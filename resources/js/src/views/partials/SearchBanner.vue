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
                <vue-simple-suggest :controls="{
      selectionUp: [38, 33],
      selectionDown: [40, 34],
      select: [13, 36],
      hideList: [27, 35]
    }" :list="simpleSuggestionList" :filter-by-query="true" value-attribute="id" display-attribute="name" @select="onSuggestSelect">
                    <!-- Filter by input text to only show the matching results -->
                    <input v-model="inputVal" :placeholder="$t('SearchBanner.searchInput')" class="is-label-placeholder   text-white" />
                    <div slot="suggestion-item" slot-scope="scope" :title="inputVal" class="suggest-item">
                        <div class="flex items-center px-1 pt-1 pb-1">
                            <div class="contact__avatar mr-3">
                                <vs-avatar class="border-2 border-solid border-white" :src="scope.suggestion.src" size="42px" />
                            </div>
                            <div class="contact__container w-full flex justify-between overflow-hidden">
                                <div class="contact__info flex flex-col truncate w-4/6 text-left">
                                    <h5 class="font-semibold text-white">{{scope.suggestion.name}}</h5>
                                    <span class="truncate">{{scope.suggestion.title}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
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
        simpleSuggestionList(q) {
            return this.$http.get('champions?name=' + q).then(response => {
                return response.data
            });
        }
    }

}
</script>

<style lang="scss">
@import "@sass/vuexy/extraComponents/autocomplete.scss";
@import "@sass/vuexy/pages/home.scss";
</style>
