<template>
<section id="dashboard-analytics">
    <search-banner v-model="championInput" />
    <!-- <search-banner /> -->
    <live-feed />
</section>
</template>

<script>
import LiveFeed from './partials/LiveFeed'
import SearchBanner from './partials/SearchBanner'

export default {

    data() {
        return {
            title: this.$i18n.t('meta.title.home'),
            championInput: 'Bite',
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
