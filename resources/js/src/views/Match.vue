<template>
<section id="dashboard-analytics">
    <search-banner />
    <match-details />
    <build-details />
</section>
</template>

<script>
import SearchBanner from './partials/SearchBanner'
import MatchDetails from './partials/MatchDetails'
import BuildDetails from './partials/BuildDetails'

export default {
    data() {
        return {
            title: this.$i18n.t('meta.title.show'),
        }
    },
    components: {
        SearchBanner,
        MatchDetails,
        BuildDetails
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
