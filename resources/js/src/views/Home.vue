<template>
<section id="dashboard-analytics">
    <search-banner v-model="championName" @selected="onSelectChampion" />
    <live-feed ref="championRef" />
</section>
</template>

<script>
import LiveFeed from './partials/LiveFeed'
import SearchBanner from './partials/SearchBanner'

export default {

    data() {
        return {
            title: this.$i18n.t('meta.title.home'),
            championName: '',
        }
    },
    components: {
        LiveFeed,
        SearchBanner
    },
    methods: {
        onSelectChampion(value) {
            this.championName = value.name
            this.$refs.championRef.setChampionName(this.championName)
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
