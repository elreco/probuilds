<template>
    <section id="dashboard-analytics">
        <summoner-details :summonerId="summonerId" :region="region" />
        <champion-details :champion="champion" />

        <!-- Two columns -->
        <div class="vx-row mb-base">
            <div class="vx-col w-full xl:w-1/2 mb-base">
                <match-details
                    :data="winners"
                    :winners="true"
                    :summonerId="summonerId"
                    :region="region"
                    :matchId="matchId"
                    id="winnersLoading"
                    class="vs-con-loading__container"
                />
            </div>
            <div class="vx-col xl:w-1/2 w-full">
                <match-details
                    :data="losers"
                    :winners="false"
                    :summonerId="summonerId"
                    :region="region"
                    :matchId="matchId"
                    id="losersLoading"
                    class="vs-con-loading__container"
                />
            </div>
        </div>
    </section>
</template>

<script>
import MatchDetails from "./partials/MatchDetails";
import ChampionDetails from "./partials/ChampionDetails";
import SummonerDetails from "./partials/SummonerDetails";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.show"),
            summonerId: this.$route.params.summonerId,
            region: this.$route.params.region,
            matchId: this.$route.params.matchId,
            champion: null,
            losers: {
                bans: [],
                participants: []
            },
            winners: {
                bans: [],
                participants: []
            }
        };
    },
    components: {
        /* ChampionDetails, */
        SummonerDetails,
        MatchDetails
    },
    mounted() {
        this.getMatch();
    },
    methods: {
        getMatch() {
            // loading
            this.loadingData(true);
            this.$http
                .get("matchs", {
                    params: {
                        summonerId: this.summonerId,
                        region: this.region,
                        matchId: this.matchId,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    this.losers = response.data.losers;
                    this.winners = response.data.winners;
                })
                .then(() => {
                    this.loadingData(false);
                });

            // UPDATE this.users après avoir fait la requête axios
        },
        loadingData(boolean) {
            if (boolean) {
                this.$vs.loading({
                    type: "default",
                    container: "#losersLoading"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#winnersLoading"
                });
            } else {
                this.$vs.loading.close("#losersLoading > .con-vs-loading");
                this.$vs.loading.close("#winnersLoading > .con-vs-loading");
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
