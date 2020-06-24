<template>
    <vx-card class="vs-con-loading__container" id="spellsLoading">
        <div class="text-center mb-base">
            <h4>{{ $t('Spell.abilities') }}</h4>
            <p class="text-grey">{{ $t('Spell.abilitiesOrder') }}</p>
        </div>
        <vs-table
            class="w-full text-white"
            noDataText
            :sst="true"
            :data="data"
            :hoverFlat="true"
            :notSpacer="true"
            id="spellsTable"
        >
            <vs-tr
                class="whitespace-no-wrap text-base leading-10 bg-theme-dark"
                :data="spell"
                :key="indexSpell"
                v-for="(spell, indexSpell) in data.spells"
            >
                <vs-td class="border-solid border border-white bg-primary-gradient">
                    <div class="flex items-center justify-start">
                        <img
                            :src="spell.src"
                            class="inline w-10 h-10 rounded border-solid border-2 border-white"
                            :alt="spell.name"
                        />
                        <span class="pl-2">{{spell.name}}</span>
                        <span class="ml-auto">{{$t('Spell.' + indexSpell)}}</span>
                    </div>
                </vs-td>
                <vs-td :data="tl" :key="indexTl" v-for="(tl, indexTl) in data.timeline" class="p-0">
                    <div
                        class="border-solid border border-white flex items-center justify-center w-10 h-10 bg-primary-gradient text-center mx-auto"
                        v-if="tl.skillSlot == indexSpell"
                    >{{indexTl}}</div>

                    <div
                        class="border-solid border border-white flex items-center justify-center w-10 h-10 text-center mx-auto"
                        v-else
                    ></div>
                </vs-td>
            </vs-tr>
        </vs-table>
    </vx-card>
</template>

<script>
import PopoverAvatar from "@/components/popovers/PopoverAvatar";

export default {
    name: "spells",
    components: {
        PopoverAvatar
    },
    props: ["matchId", "summonerId", "region", "participantId", "champion"],
    data() {
        return {
            data: {
                spells: [],
                timeline: []
            }
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
<style lang="scss">
$dark-color: #10163a;
#spellsTable {
    tr {
        background-color: $dark-color;
    }
    .vs-con-tbody {
        border-color: $dark-color !important;
        background: $dark-color;
    }
    .vs-table {
        border: 0;
    }
    .vs-table--tbody-table .tr-values:last-child {
        border: 0;
    }
    .vs-table--tbody-table .tr-values {
        cursor: auto;
    }
    .vs-table--tbody-table
        .tr-values.hoverFlat:not(.activeEdit):not(.is-expand):hover {
        opacity: 1;
    }
}
</style>