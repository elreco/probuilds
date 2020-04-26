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
    mounted() {
        checkChampion(this.$router.params.baseaccount);
    },
    components: {
        LiveFeed,
        SearchBanner
    },
    methods: {
        onSelectChampion(value) {
            this.$router.push({
                name: 'champion',
                params: {
                    'champion': value.name,
                }
            })
        },
        setChampionRef() {
            this.championName = this.$router.params.champion
            this.$refs.championRef.setChampionName(this.championName)
        },
        checkChampion() {
            // check if champion exists
            // if exists
            setChampionRef();
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
