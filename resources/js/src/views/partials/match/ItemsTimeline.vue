<template>
    <vx-card class="vs-con-loading__container" id="timelineLoading">
        <div class="text-center mb-custom">
            <h4>{{ $t('Item.timeline') }}</h4>
            <p class="text-grey">{{ $t('Item.buildOrder') }}</p>
        </div>
    </vx-card>
</template>

<script>
export default {
    name: "items-timeline",
    props: ["matchId", "summonerId", "region", "participantId"],
    data() {
        return {
            data: {}
        };
    },
    mounted() {
        this.getItemsTimeline();
    },
    methods: {
        getItemsTimeline() {
            // loading
            this.loadingData(true);
            this.$http
                .get(
                    `matches/${this.matchId}/items-timeline/${this.summonerId}`,
                    {
                        params: {
                            locale: this.$route.params.locale,
                            region: this.region,
                            participantId: this.participantId
                        }
                    }
                )
                .then(response => {
                    this.data = response.data;
                    console.log(this.data);
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
                    container: "#timelineLoading"
                });
            } else {
                this.$vs.loading.close("#timelineLoading > .con-vs-loading");
            }
        }
    }
};
</script>