<template>
    <vx-card class="vs-con-loading__container" id="timelineLoading">
        <div class="text-center">
            <h4>{{ $t('Item.timeline') }}</h4>
            <p class="text-grey">{{ $t('Item.buildOrder') }}</p>
        </div>
    </vx-card>
</template>

<script>
import PopoverAvatar from "@/components/popovers/PopoverAvatar";

export default {
    name: "spells",
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
        this.getSpells();
    },
    methods: {
        getSpells() {
            // loading
            this.loadingData(true);
            this.$http
                .get(`matches/${this.matchId}/spells/${this.summonerId}`, {
                    params: {
                        locale: this.$route.params.locale,
                        region: this.region,
                        participantId: this.participantId,
                        champion: this.champion
                    }
                })
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
                    container: "#spellsLoading"
                });
            } else {
                this.$vs.loading.close("#spellsLoading > .con-vs-loading");
            }
        }
    }
};
</script>