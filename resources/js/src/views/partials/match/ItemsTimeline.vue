<template>
    <vx-card class="vs-con-loading__container" id="timelineLoading">
        <div class="text-center">
            <h4>{{ $t('Item.timeline') }}</h4>
            <p class="text-grey">{{ $t('Item.buildOrder') }}</p>
        </div>
        <div class="vx-row flex items-center">
            <template v-for="(group, index) in data">
                <div class="vx-col mt-base" :key="index" v-if="index != 0">
                    <feather-icon
                        icon="ChevronsRightIcon"
                        svgClasses="stroke-current text-primary"
                    />
                </div>
                <template v-for="(item, index2) in group.items">
                    <div class="vx-col text-center mt-base" :key="index2 + '-' + index">
                        <div class="w-full mx-auto">
                            <popover-avatar
                                :sold="item.type == 'ITEM_SOLD' ? true : false"
                                :border="true"
                                :src="item.src"
                                :title="item.title"
                                :description="item.description"
                            />
                        </div>
                        <div class="w-full mini-chip flex">
                            <vs-chip color="primary" class="w-full ml-0 mr-0 text-xs">{{item.time}}</vs-chip>
                        </div>
                    </div>
                </template>
            </template>
        </div>
    </vx-card>
</template>

<script>
import PopoverAvatar from "@/components/popovers/PopoverAvatar";

export default {
    name: "items-timeline",
    components: {
        PopoverAvatar
    },
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