<template>
    <vue-simple-suggest
        :controls="{
      selectionUp: [38, 33],
      selectionDown: [40, 34],
      select: [13, 36],
      hideList: [27, 35]
    }"
        :list="simpleSuggestionList"
        :filter-by-query="true"
        value-attribute="id"
        display-attribute="name"
        @select="onSuggestSelect"
    >
        <!-- Filter by input text to only show the matching results -->
        <!--  <input  :placeholder="$t('SearchBanner.searchInput')" class="is-label-placeholder   text-white" /> -->
        <vx-input-group>
            <template slot="prepend">
                <div class="prepend-text bg-primary">
                    <feather-icon icon="SearchIcon" :svgClasses="['stroke-current h-5 w-5']"></feather-icon>
                </div>
            </template>

            <vs-input
                v-model="championInput"
                class="w-full rounded-l-none"
                :placeholder="$t('SearchBanner.searchInput')"
            />
        </vx-input-group>
        <div slot="suggestion-item" slot-scope="scope" :title="championInput" class="suggest-item">
            <div class="flex items-center px-1 pt-1 pb-1">
                <div class="contact__avatar mr-3">
                    <vs-avatar
                        class="border-2 border-solid border-white"
                        :src="scope.suggestion.src"
                        size="42px"
                    />
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
</template>

<script>
// Vue Simple Suggest
import VueSimpleSuggest from "vue-simple-suggest";

export default {
    name: "search-input",
    props: ["champion"],
    components: {
        VueSimpleSuggest
    },
    data: () => ({
        mode: null,
        loading: false,
        championInput: null
    }),
    mounted() {
        this.setChampion();
    },
    methods: {
        simpleSuggestionList(q) {
            return this.$http.get("champions?name=" + q).then(response => {
                return response.data;
            });
        },
        onSuggestSelect(suggest) {
            if (suggest.name != this.championInput)
                return this.$router.push({
                    name: "champions",
                    params: {
                        champion: suggest.name
                    }
                });
        },
        setChampion() {
            if (this.$route.params.champion) {
                this.championInput = this.$route.params.champion;
            } else {
                this.championInput = "";
            }
        }
    },
    watch: {
        $route(to, from) {
            this.setChampion();
        }
    }
};
</script>

<style lang="scss">
@import "@sass/vuexy/extraComponents/autocomplete.scss";
</style>
