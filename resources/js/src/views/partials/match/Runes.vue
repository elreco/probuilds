<template>
    <vx-card class="vs-con-loading__container" id="spellsLoading">
        <div class="text-center mb-custom">
            <h4>{{ $t('Rune.runes') }}</h4>
        </div>
        <div class="vx-row w-2/3 mx-auto flex items-stretch text-white">
            <div class="vx-col w-1/2">
                <div class="vx-row mb-base">
                    <div class="vx-col w-full">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                src="https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/demo-2/img/avatar-s-3.7ed1da4a.jpg"
                                class="mr-8 rounded h-24 w-24"
                            />
                            <div>
                                <p class="text-lg font-medium mb-2 mt-4 sm:mt-0">Angelo Sashington</p>
                                <p class="text-sm font-light mb-2 mt-4 sm:mt-0">sdgsdgsdg</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col w-full">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                src="https://pixinvent.com/demo/vuexy-vuejs-admin-dashboard-template/demo-2/img/avatar-s-3.7ed1da4a.jpg"
                                class="mr-8 rounded h-24 w-24"
                            />
                            <div>
                                <p class="text-lg font-medium mb-2 mt-4 sm:mt-0">Angelo Sashington</p>
                                <p class="text-sm font-light mb-2 mt-4 sm:mt-0">sdgsdgsdg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vx-col w-1/2"></div>
        </div>
    </vx-card>
</template>

<script>
import PopoverAvatar from "@/components/popovers/PopoverAvatar";

export default {
    name: "runes",
    components: {
        PopoverAvatar
    },
    props: ["matchId", "summonerId", "region", "participantId", "champion"],
    data() {
        return {
            spells: [],
            timeline: []
        };
    },
    mounted() {
        this.getRunes();
    },
    methods: {
        getRunes() {
            // loading
            this.loadingData(true);
            this.$http
                .get(`matches/${this.matchId}/runes/${this.summonerId}`, {
                    params: {
                        locale: this.$route.params.locale,
                        region: this.region,
                        participantId: this.participantId,
                        champion: this.champion
                    }
                })
                .then(response => {
                    this.spells = response.data.spells;
                    this.timeline = response.data.timeline;
                })
                .then(() => {
                    this.loadingData(false);
                });
        },
        loadingData(boolean) {
            if (boolean) {
                this.$vs.loading({
                    type: "default",
                    container: "#runesLoading"
                });
            } else {
                this.$vs.loading.close("#runesLoading > .con-vs-loading");
            }
        }
    }
};
</script>
