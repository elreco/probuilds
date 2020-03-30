<template>
<section id="dashboard-analytics">
    <search-banner />
</section>
</template>

<script>
import SearchBanner from './partials/SearchBanner'
export default {
    data() {
        return {
            title: this.$i18n.t('meta.title.show'),
        }
    },
    components: {
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
