<template>
    <section id="dashboard-analytics">
        <div class="vx-row mb-0 xl:mb-base" id="page-user-view">
            <div class="vx-col w-full xl:w-1/3 mb-base xl:mb-0 flex items-stretch">
                <profile :summonerId="summonerId" :region="region" />
            </div>
            <div class="vx-col w-full xl:w-2/3 mb-base xl:mb-0 flex items-stretch">
                <champion-details :champion="champion" />
            </div>
        </div>
        <div class="vx-row xl:mb-base">
            <div class="vx-col w-full mb-base xl:mb-0 xl:w-3/5 flex items-stretch">
                <items :data="items" id="itemsLoading" class="vs-con-loading__container" />
            </div>
            <div class="vx-col w-full mb-base xl:mb-0 xl:w-1/5 flex items-stretch">
                <summoner-spells
                    :data="summonerSpells"
                    id="summonerSpellsLoading"
                    class="vs-con-loading__container"
                />
            </div>
            <div class="vx-col w-full mb-base xl:mb-0 xl:w-1/5 flex items-stretch">
                <vx-card id="durationLoading" class="vs-con-loading__container">
                    <div class="text-center xl:mb-20 mb-base">
                        <h4 class="text-white">{{ $t('Match.duration') }}</h4>
                    </div>
                    <div class="vx-row text-center h-full mb-4">
                        <div class="vx-col w-full h-full">{{duration}}</div>
                    </div>
                </vx-card>
            </div>
        </div>
        <div class="vx-row xl:mb-base">
            <div class="vx-col w-full mb-base xl:mb-0">
                <items-timeline
                    :matchId="matchId"
                    :summonerId="summonerId"
                    :region="region"
                    :participantId="participantId"
                />
            </div>
        </div>
        <div class="vx-row mb-base">
            <div class="vx-col w-full mb-base xl:mb-0">
                <spells
                    :matchId="matchId"
                    :summonerId="summonerId"
                    :region="region"
                    :participantId="participantId"
                    :champion="champion"
                />
            </div>
        </div>
        <div class="vx-row mb-base">
            <div class="vx-col w-full mb-base xl:mb-0">
                <runes :data="runes" id="runesLoading" class="vs-con-loading__container" />
            </div>
        </div>
        <!-- Two columns -->
        <div class="vx-row">
            <div class="vx-col w-full mb-base">
                <match-details
                    :data="winners"
                    :win="true"
                    :summonerId="summonerId"
                    :region="region"
                    :matchId="matchId"
                    id="winnersLoading"
                    class="vs-con-loading__container"
                />
            </div>
            <div class="vx-col w-full">
                <match-details
                    :data="losers"
                    :win="false"
                    :summonerId="summonerId"
                    :region="region"
                    :matchId="matchId"
                    id="losersLoading"
                    class="vs-con-loading__container"
                />
            </div>
        </div>
    </section>
</template>

<script>
import MatchDetails from "./partials/MatchDetails";
import ChampionDetails from "./partials/ChampionDetails";
import Profile from "./partials/summoner/Profile";
import Items from "./partials/match/Items";
import SummonerSpells from "./partials/match/SummonerSpells";
import ItemsTimeline from "./partials/match/ItemsTimeline";
import Spells from "./partials/match/Spells";
import Runes from "./partials/match/Runes";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.match"),
            description: this.$route.params.champion,
            summonerId: this.$route.params.summonerId,
            region: this.$route.params.region,
            matchId: this.$route.params.matchId,
            champion: this.$route.params.champion,
            participantId: this.$route.params.participantId,
            duration: null,
            runes: {
                first: {
                    principal: {
                        src: null,
                        name: null
                    },
                    rune: {
                        "0": {
                            src: null,
                            name: null,
                            description: null
                        },
                        "1": {
                            src: null,
                            name: null,
                            description: null
                        },
                        "2": {
                            src: null,
                            name: null,
                            description: null
                        },
                        "3": {
                            src: null,
                            name: null,
                            description: null
                        }
                    }
                },
                second: {
                    principal: {
                        src: null,
                        name: null
                    },
                    rune: {
                        "4": {
                            src: null,
                            name: null,
                            description: null
                        },
                        "5": {
                            src: null,
                            name: null,
                            description: null
                        }
                    }
                },
                third: {
                    "0": {
                        src: null,
                        name: null,
                        description: null
                    },
                    "1": {
                        src: null,
                        name: null,
                        description: null
                    },
                    "2": {
                        src: null,
                        name: null,
                        description: null
                    }
                }
            },
            items: {},
            summonerSpells: {},
            losers: {
                bans: [],
                participants: []
            },
            winners: {
                bans: [],
                participants: []
            }
        };
    },
    components: {
        ChampionDetails,
        Profile,
        Items,
        MatchDetails,
        SummonerSpells,
        ItemsTimeline,
        Spells,
        Runes
    },
    mounted() {
        this.getMatch();
    },
    methods: {
        getMatch() {
            // loading
            this.loadingData(true);
            this.$http
                .get(`matches/${this.matchId}`, {
                    params: {
                        summonerId: this.summonerId,
                        region: this.region,
                        locale: this.$route.params.locale,
                        champion: this.champion,
                        participantId: this.participantId
                    }
                })
                .then(response => {
                    this.losers = response.data.losers;
                    this.winners = response.data.winners;
                    this.duration = response.data.duration;
                    this.runes = response.data.runes;
                })
                .then(() => {
                    this.getRunes(this.runes);
                })
                .then(() => {
                    this.losers.participants.forEach((value, index) => {
                        if (this.summonerId == value.summonerId) {
                            this.items = value.items;
                            this.summonerSpells = value.summonerSpells;
                        }
                    });
                    this.winners.participants.forEach((value, index) => {
                        if (this.summonerId == value.summonerId) {
                            this.items = value.items;
                            this.summonerSpells = value.summonerSpells;
                        }
                    });
                })
                .then(() => {
                    this.loadingData(false);
                });
        },
        getRunes(runes) {
            this.$http
                .get(`runes`, {
                    params: {
                        region: this.region,
                        locale: this.$route.params.locale,
                        runes: runes
                    }
                })
                .then(response => {
                    this.runes = response.data;
                })
                .then(() => {
                    this.$vs.loading.close("#runesLoading > .con-vs-loading");
                });
        },
        loadingData(boolean) {
            if (boolean) {
                this.$vs.loading({
                    type: "default",
                    container: "#losersLoading"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#winnersLoading"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#itemsLoading"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#summonerSpellsLoading"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#durationLoading"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#runesLoading"
                });
            } else {
                this.$vs.loading.close("#losersLoading > .con-vs-loading");
                this.$vs.loading.close("#winnersLoading > .con-vs-loading");
                this.$vs.loading.close("#itemsLoading > .con-vs-loading");
                this.$vs.loading.close(
                    "#summonerSpellsLoading > .con-vs-loading"
                );
                this.$vs.loading.close("#durationLoading > .con-vs-loading");
            }
        }
    },
    metaInfo() {
        // if no subcomponents specify a metaInfo.title, this title will be used
        return {
            title: `${this.title}`,
            // all titles will be injected into this template
            titleTemplate: "EvilSpartan.com – %s",
            meta: [
                { name: "description", content: `${this.description}` },
                {
                    property: "og:title",
                    content: `${this.title}`
                },
                { property: "og:site_name", content: "EvilSpartan.com" },
                { property: "og:type", content: "website" },
                { name: "robots", content: "index,follow" }
            ]
        };
    }
};
</script>

<style lang="scss">
.mb-custom-2 {
    margin-bottom: 4.5rem;
}
#avatar-col {
    width: 8rem;
}

#page-user-view {
    table {
        td {
            vertical-align: top;
            min-width: 140px;
            padding-bottom: 0.8rem;
            word-break: break-all;
        }

        &:not(.permissions-table) {
            td {
                @media screen and (max-width: 370px) {
                    display: block;
                }
            }
        }
    }
}

// #account-info-col-1 {
//   // flex-grow: 1;
//   width: 30rem !important;
//   @media screen and (min-width:1200px) {
//     & {
//       flex-grow: unset !important;
//     }
//   }
// }

@media screen and (min-width: 1201px) and (max-width: 1211px),
    only screen and (min-width: 636px) and (max-width: 991px) {
    #account-info-col-1 {
        width: calc(100% - 12rem) !important;
    }

    // #account-manage-buttons {
    //   width: 12rem !important;
    //   flex-direction: column;

    //   > button {
    //     margin-right: 0 !important;
    //     margin-bottom: 1rem;
    //   }
    // }
}
</style>