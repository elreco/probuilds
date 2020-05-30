<template>
    <!-- Two columns -->
    <div class="loading">
        <vs-row vs-type="flex" vs-justify="space-between">
            <vs-col vs-w="6" vs-type="flex" vs-justify="center" vs-align="center">
                <vs-card class="m-2">
                    <div slot="header">
                        <h3>Hello world !</h3>
                    </div>
                    <match :data="winners"></match>
                </vs-card>
            </vs-col>
            <vs-col vs-w="6" vs-type="flex" vs-justify="center" vs-align="center">
                <vs-card class="m-2">
                    <match :data="losers"></match>
                </vs-card>
            </vs-col>
        </vs-row>
    </div>
</template>

<script>
import Match from "./Match";

export default {
    name: "match-details",
    components: {
        Match
    },
    props: ["region", "summonerId", "matchId"],
    data() {
        return {
            winners: [],
            losers: []
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
