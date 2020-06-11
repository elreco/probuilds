<template>
    <section id="dashboard-analytics">
        <summoner-details :champion="champion" :summonerName="summonerName" />
        <match-details
            :winners="winners"
            :losers="losers"
            :region="region"
            :summonerId="summonerId"
            :matchId="matchId"
        />
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
            region: this.$route.params.region,
            summonerId: this.$route.params.summonerId,
            matchId: this.$route.params.matchId,
            champion: [],
            summonerName: null,
            winners: {
                bans: [],
                participants: []
            },
            losers: {
                bans: [],
                participants: []
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
                    this.champion = response.data.champion;
                    this.summonerName = response.data.summonerName;
                    this.winners = response.data.winners;
                    this.losers = response.data.losers;
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
