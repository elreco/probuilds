<template>
    <section id="dashboard-analytics">
        <summoner-details :data="data" />
        <match-details :data="data" />
        <build-details />
    </section>
</template>

<script>
import MatchDetails from "./partials/MatchDetails";
import BuildDetails from "./partials/BuildDetails";
import SummonerDetails from "./partials/SummonerDetails";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.show"),
            data: {
                champion: {},
                losers: {
                    bans: [],
                    participants: []
                },
                winners: {
                    bans: [],
                    participants: []
                }
            }
        };
    },
    components: {
        MatchDetails,
        BuildDetails,
        SummonerDetails
    },
    mounted() {
        this.getMatch();
    },
    methods: {
        getMatch() {
            // loading
            this.loadingData(true);
            this.$http
                .get("match/show-details", {
                    params: {
                        summonerId: this.summonerId,
                        region: this.region,
                        matchId: this.matchId,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    this.data = response.data;
                })
                .then(() => {
                    this.loadingData(false);
                });

            // UPDATE this.users après avoir fait la requête axios
        },
        loadingData(boolean) {
            if (boolean) {
                this.$vs.loading({
                    type: "default"
                });
            } else {
                this.$vs.loading.close();
            }
        }
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
