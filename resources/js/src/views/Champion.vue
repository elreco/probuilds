<template>
<section id="dashboard-analytics">
    <search-banner v-model="championName" />
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
    mounted() {
        this.checkChampion(this.$route.params.champion);
    },
    components: {
        LiveFeed,
        SearchBanner
    },
    methods: {
        setChampionRef() {
            this.championName = this.$route.params.champion
            this.$refs.championRef.setChampionName(this.championName)
        },
        checkChampion() {
            // check if champion exists
            // if exists

            this.setChampionRef();
            // else if not exist
            // 404
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
