<template>
    <vx-card class="vs-con-loading__container" id="championLoading">
        <!-- Avatar -->
        <div class="vx-row mb-8">
            <div class="vx-col"></div>
        </div>
        <div class="vx-row mb-2">
            <!-- Avatar Col -->
            <div class="vx-col mr-4" id="avatar-col">
                <div class="img-container relative"></div>
            </div>

            <!-- Information - Col 1 -->
            <div class="vx-col flex-1 text-sm" id="account-info-col-1">
                <table>
                    <tr></tr>

                    <tr></tr>
                </table>
            </div>
            <!-- /Information - Col 2 -->
            <div class="vx-col w-full flex" id="account-manage-buttons"></div>
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
                .get(`matches/${this.matchId}/items-timeline`, {
                    params: {
                        locale: this.$route.params.locale,
                        summonerId: this.summonerId,
                        region: this.region,
                        participantId: this.participantId
                    }
                })
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
                    container: "#championLoading"
                });
            } else {
                this.$vs.loading.close("#championLoading > .con-vs-loading");
            }
        }
    }
};
</script>