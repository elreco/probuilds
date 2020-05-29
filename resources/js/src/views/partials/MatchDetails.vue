<template>
    <!-- Two columns -->
    <div id="loadingFeed">
        <vx-card>
            <div class="vx-col w-full">
                <match :data="winners"></match>
            </div>
        </vx-card>
        <hr />
        <vx-card>
            <div class="vx-col w-full">
                <match :data="losers"></match>
            </div>
        </vx-card>
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
                    type: "material",
                    container: "#loadingFeed"
                });
            } else {
                this.$vs.loading.close("#loadingFeed > .con-vs-loading");
            }
        }
    }
};
</script>

<style lang="css" scoped>
</style>
