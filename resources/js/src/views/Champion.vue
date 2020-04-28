<template id="loaderContainer">
<section id="dashboard-analytics" v-if="!isFetching">
    <search-banner v-model="champion" :champion="champion" />
    <live-feed :champion="champion" />
</section>
</template>

<script>
import LiveFeed from './partials/LiveFeed'
import SearchBanner from './partials/SearchBanner'

export default {

    data() {
        return {
            title: this.$i18n.t('meta.title.home'),
            champion: '',
            isFetching: true
        }
    },
    created() {
        this.checkChampion()
    },
    components: {
        LiveFeed,
        SearchBanner
    },
    methods: {
        checkChampion() {
            // check if champion exists
            // if exists
            this.loadingData(true)
            return this.$http.get('champions/check?name=' + this.$route.params.champion).then(response => {
                return this.setChampion(response.data)
            }).catch((error) => {
                this.loadingData(false)
                return this.$router.push({
                    name: 'page-error-404',
                })
            });

            // else if not exist
            // 404
        },
        setChampion(champion) {
            this.champion = champion
            this.loadingData(false)
        },
        loadingData(boolean) {
            this.isFetching = boolean
            if (this.isFetching) {
                this.$vs.loading({
                    type: 'material',
                    container: 'body',
                })
            } else {
                this.$vs.loading.close('body > .con-vs-loading')
            }
        }
    },
    metaInfo() {
        // if no subcomponents specify a metaInfo.title, this title will be used
        return {
            title: `${this.title}`,
            // all titles will be injected into this template
            titleTemplate: 'Probuilds.eu – %s'
        }

    }
}
</script>
