<template>
    <!-- Two columns -->

    <div class="vx-row mb-base">
        <div class="vx-col w-full md:w-1/2">
            <vx-card
                class="vs-con-loading__container"
                id="loadingMatch1"
                :title="$t('Match.winningTeam')"
                title-color="#7ed321"
                content-color="#fff"
            >
                <template slot="actions">
                    <bans :data="winners.bans"></bans>
                </template>
                <team :data="winners.participants" :summonerId="summonerId"></team>
            </vx-card>
        </div>
        <div class="vx-col w-full md:w-1/2">
            <vx-card
                class="vs-con-loading__container"
                id="loadingMatch2"
                :title="$t('Match.losingTeam')"
                title-color="#a12b17"
                content-color="#fff"
            >
                <template slot="actions">
                    <bans :data="losers.bans"></bans>
                </template>
                <team :data="losers.participants" :summonerId="summonerId"></team>
                <!-- DATA -->
                <div class="flex justify-between text-center" slot="no-body-bottom">
                    <div
                        class="w-1/3 border border-solid d-theme-border-grey-light border-r-0 border-b-0 border-l-0"
                    >
                        <p class="mt-4">Completed</p>
                        <p class="mb-4 text-3xl font-semibold">786,617</p>
                    </div>
                    <div
                        class="w-1/3 border border-solid d-theme-border-grey-light border-r-0 border-b-0"
                    >
                        <p class="mt-4">In Progress</p>
                        <p class="mb-4 text-3xl font-semibold">13,561</p>
                    </div>
                    <div
                        class="w-1/3 border border-solid d-theme-border-grey-light border-r-0 border-b-0"
                    >
                        <p class="mt-4">In Progress</p>
                        <p class="mb-4 text-3xl font-semibold">13,561</p>
                    </div>
                </div>
            </vx-card>
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
                    /* this.losers = response.data.participants.filter(function(
                        value
                    ) {
                        return value.win == false;
                    });

                    this.winners = response.data.participants.filter(function(
                        value
                    ) {
                        return value.win == true;
                    }); */
                    console.log(response.data.winners.participants);
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
                    type: "default",
                    container: "#loadingMatch1"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#loadingMatch2"
                });
            } else {
                this.$vs.loading.close("#loadingMatch1 > .con-vs-loading");
                this.$vs.loading.close("#loadingMatch2 > .con-vs-loading");
            }
        }
    }
};
</script>

<style lang="css" scoped>
</style>
