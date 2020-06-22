<template>
    <vx-card class="vs-con-loading__container" id="timelineLoading">
        <div class="text-center mb-custom">
            <h4>{{ $t('Item.timeline') }}</h4>
            <p class="text-grey">{{ $t('Item.buildOrder') }}</p>
        </div>
        <div class="vx-row flex items-center">
            <div class="vx-col text-center">
                <div class="w-full mx-auto">
                    <popover-avatar-lg
                        src="https://ddragon.leagueoflegends.com/cdn/10.12.1/img/item/2420.png"
                        title="title"
                        description="Description"
                    />
                </div>
                <div class="mx-auto">
                    <vs-chip color="primary">00:00</vs-chip>
                </div>
            </div>
            <div class="vx-col">
                <feather-icon icon="ChevronsRightIcon" svgClasses="stroke-current text-primary" />
            </div>
            <div class="vx-col">
                <popover-avatar-lg
                    src="https://ddragon.leagueoflegends.com/cdn/10.12.1/img/item/2420.png"
                    title="title"
                    description="Description"
                />
            </div>
            <div class="vx-col">
                <popover-avatar-lg
                    src="https://ddragon.leagueoflegends.com/cdn/10.12.1/img/item/2420.png"
                    title="title"
                    description="Description"
                />
            </div>
            <div class="vx-col">
                <popover-avatar-lg
                    src="https://ddragon.leagueoflegends.com/cdn/10.12.1/img/item/2420.png"
                    title="title"
                    description="Description"
                />
            </div>
            <div class="vx-col">
                <popover-avatar-lg
                    src="https://ddragon.leagueoflegends.com/cdn/10.12.1/img/item/2420.png"
                    title="title"
                    description="Description"
                />
            </div>
        </div>
    </vx-card>
</template>

<script>
import PopoverAvatarLg from "@/components/popovers/PopoverAvatarLg";

export default {
    name: "items-timeline",
    components: {
        PopoverAvatarLg
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