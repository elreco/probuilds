<template>
<section id="dashboard-analytics">
    <search-banner />
    <live-feed :champion="champion" />
</section>
</template>

<script>
import SearchBanner from './partials/SearchBanner'
import LiveFeed from './partials/LiveFeed'
export default {
    data() {
        return {
            title: this.$i18n.t('meta.title.show'),
            champion: this.$route.params.champion
        }
    },
    components: {
        LiveFeed,
        SearchBanner
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

<style>
</style>
