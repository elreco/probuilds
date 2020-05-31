<template>
    <!-- Two columns -->
    <div class="loading">
        <div class="vx-row mb-base">
            <div class="vx-col w-full md:w-1/2">
                <vx-card
                    class="mb-base"
                    :title="$t('Match.winningTeam')"
                    title-color="#7ed321"
                    content-color="#fff"
                >
                    <team :data="winners"></team>
                </vx-card>
                <vx-card>
                    <template slot="actions">
                        <bans></bans>
                    </template>
                    <bans></bans>
                </vx-card>
            </div>
            <div class="vx-col w-full md:w-1/2">
                <vx-card
                    class="mb-base"
                    :title="$t('Match.losingTeam')"
                    title-color="#a12b17"
                    content-color="#fff"
                >
                    <template slot="actions">
                        <bans></bans>
                    </template>
                    <team :data="losers"></team>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import Team from "./match/Team";
import Bans from "./match/Bans";

export default {
    name: "match-details",
    components: {
        Team,
        Bans
    },
    props: ["region", "summonerId", "matchId"],
    data() {
        return {
            winners: [],
            losers: [],
            images: {
                background1: require("@assets/images/match/background1.jpg"),
                background2: require("@assets/images/match/background2.jpg")
            }
        };
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
                    this.losers = response.data.participants.filter(function(
                        value
                    ) {
                        return value.win == false;
                    });

                    this.winners = response.data.participants.filter(function(
                        value
                    ) {
                        return value.win == true;
                    });
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
                    container: ".loading"
                });
            } else {
                this.$vs.loading.close(".loading > .con-vs-loading");
            }
        }
    }
};
</script>

<style lang="css" scoped>
</style>
