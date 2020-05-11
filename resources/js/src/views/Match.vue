<template>
    <section id="dashboard-analytics">
        <match-details :region="region" :summonerId="summonerId" :matchId="matchId" />
        <build-details />
    </section>
</template>

<script>
import SearchBanner from "./partials/SearchBanner";
import MatchDetails from "./partials/MatchDetails";
import BuildDetails from "./partials/BuildDetails";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.show"),
            region: this.$route.params.region,
            summonerId: this.$route.params.summonerId,
            matchId: this.$route.params.matchId
        };
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
            titleTemplate: "Probuilds.eu – %s"
        };
    }
};
</script>

<style>
</style>
