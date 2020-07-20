<template>
    <vx-card class="vs-con-loading__container" id="spellsLoading">
        <div class="text-center mb-base">
            <h4 class="text-white">{{ $t('Spell.abilities') }}</h4>
            <p class="text-grey">{{ $t('Spell.abilitiesOrder') }}</p>
        </div>
        <div class="overflow-auto">
            <table class="border-collapse w-full text-white" id="spellsTable" cellspacing="0">
                <tr
                    class="whitespace-no-wrap text-base leading-10 bg-theme-dark"
                    :key="indexSpell"
                    v-for="(spell, indexSpell) in spells"
                >
                    <td class="border-solid border border-white bg-primary-gradient p-1 w-20">
                        <div class="flex items-center justify-start">
                            <!-- <img
                                :src="spell.src"
                                class="inline w-10 h-10 rounded border-solid border-2 border-white"
                                :alt="spell.name"
                            />-->
                            <popover-avatar
                                :border="'white'"
                                :src="spell.src"
                                :forceTitle="spell.name"
                                :forceDescription="spell.description"
                            />
                            <span class="pl-2">{{spell.name}}</span>
                            <span class="pl-2 pr-2 ml-auto">{{$t('Spell.' + indexSpell)}}</span>
                        </div>
                    </td>
                    <td :key="indexTl" v-for="(tl, indexTl) in timeline" class="px-2">
                        <div
                            class="border-solid border border-white flex items-center justify-center w-10 h-10 bg-primary-gradient text-center mx-auto"
                            v-if="tl.skillSlot == indexSpell"
                        >{{indexTl}}</div>

                        <div
                            class="border-solid border border-white flex items-center justify-center w-10 h-10 text-center mx-auto"
                            v-else
                        ></div>
                    </td>
                </tr>
            </table>
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
    props: ["matchId", "summonerId", "region", "participantId", "champion"],
    data() {
        return {
            spells: [],
            timeline: [],
            spellName: {
                0: {},
                0: {},
                0: {},
                0: {}
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
    table {
        border: 0;
    }
    @media (min-width: 640px) {
        table {
            display: inline-table !important;
        }

        thead tr:not(:first-child) {
            display: none;
        }
    }
}
</style>