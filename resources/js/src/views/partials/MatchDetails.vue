<template>
    <!-- Two columns -->
    <vx-card>
        <div class="flex flex-wrap">
            <div class="w-1/3 ml-auto bg-grid-color h-12">dfh</div>
            <div class="w-1/3 mr-auto bg-grid-color-secondary h-12">dgsg</div>
        </div>
    </vx-card>
</template>

<script>
export default {
    name: "match-details",
    props: ["region", "summonerId", "matchId"],
    mounted() {
        this.getMatch();
    },
    methods: {
        getMatch() {
            // loading

            this.loadingData(true);
            this.$http
                .get("match", {
                    params: {
                        summonerId: this.summonerId,
                        region: this.region,
                        matchId: this.matchId,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    console.log(response.data);
                })
                .then(() => {
                    this.loadingData(false);
                });

            // UPDATE this.users après avoir fait la requête axios
        },
        getRegions() {
            this.$http
                .get("regions")
                .then(response => (this.regions = response.data));
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
