<template>
<section id="dashboard-analytics">
    <search-banner v-model="champion" />
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

            this.setChampion();
            // else if not exist
            // 404
        },
        setChampion() {
            this.champion = this.$route.params.champion
            console.log("champion.vue:" + this.champion)
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
