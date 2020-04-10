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
            <p class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white" v-html="$t('home.welcomeText')"></p>
            <vue-simple-suggest pattern="\w+" v-model="inputVal" :list="getList" :max-suggestions="10" :min-length="3" :debounce="200" :filter-by-query="false" :prevent-submit="true" :controls="{
                selectionUp: [38, 33],
                selectionDown: [40, 34],
                select: [13, 36],
                hideList: [27, 35]
              }" :mode="mode" :nullable-select="true" ref="suggestComponent" placeholder="Search information..." value-attribute="id" display-attribute="text" @select="onSuggestSelect">

                <vs-input icon-pack="feather" icon="icon-search" placeholder="Search" class="is-label-placeholder xl:w-2/5 lg:w-2/5 md:w-2/3 w-3/5 mx-auto text-white" />

                <template slot="misc-item-above" slot-scope="{ suggestions, query }">
                    <div class="misc-item">
                        <span>You're searching for '{{ query }}'.</span>
                    </div>

                    <template v-if="suggestions.length > 0">
                        <div class="misc-item">
                            <span>{{ suggestions.length }} suggestions are shown...</span>
                        </div>
                        <hr>
                    </template>

                    <div class="misc-item" v-else-if="!loading">
                        <span>No results</span>
                    </div>
                </template>

                <div slot="suggestion-item" slot-scope="scope" :title="scope.suggestion.description">
                    <div class="text">
                        <span v-html="boldenSuggestion(scope)"></span>
                    </div>
                </div>

                <div class="misc-item" slot="misc-item-below" slot-scope="{ suggestions }" v-if="loading">
                    <span>{{ $t("SearchBanner.loading") }}...</span>
                </div>
            </vue-simple-suggest>

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
        getList(inputValue) {
            return new Promise((resolve, reject) => {
                let url = `https://en.wikipedia.org/w/api.php?origin=*&action=opensearch&namespace=*&search=${inputValue}&limit=10&namespace=0&format=json`
                fetch(url).then(response => {
                    if (!response.ok) {
                        reject()
                    }
                    response.json().then(json => {
                        json.shift();
                        let result = []
                        const fields = ['text', 'description', 'link']
                        json.forEach((part, i) => {
                            part.forEach((el, j) => {
                                if (!result[j]) {
                                    result.push({
                                        id: j + 1
                                    })
                                }
                                result[j][fields[i]] = el
                            })
                        })
                        resolve(result)
                        // resolve([...(json.items || [])])
                    }).catch(e => {
                        reject(e)
                    })
                }).catch(error => {
                    this.loading = false
                    reject(error)
                })
            })
        },
        onSuggestSelect(suggest) {
            this.selected = suggest
        },
        boldenSuggestion(scope) {
            if (!scope) return scope;
            const {
                suggestion,
                query
            } = scope;
            let result = this.$refs.suggestComponent.displayProperty(suggestion);
            if (!query) return result;
            const texts = query.split(/[\s-_/\\|.]/gm).filter(t => !!t) || [''];
            return result.replace(new RegExp('(.*?)(' + texts.join('|') + ')(.*?)', 'gi'), '$1<b>$2</b>$3');
        },
    }

}
</script>

<style lang="scss">
@import "@sass/vuexy/pages/home.scss";
</style>
