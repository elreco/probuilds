<template>
    <section id="dashboard-analytics">
        <div class="vx-row mb-base items-stretch" id="page-user-view">
            <champion-details :champion="champion" />
            <summoner-details :summonerId="summonerId" :region="region" />
        </div>

        <!-- Two columns -->
        <div class="vx-row mb-base">
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
import SummonerDetails from "./partials/SummonerDetails";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.show"),
            summonerId: this.$route.params.summonerId,
            region: this.$route.params.region,
            matchId: this.$route.params.matchId,
            champion: this.$route.params.champion,
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
        SummonerDetails,
        MatchDetails
    },
    mounted() {
        this.getMatch();
    },
    methods: {
        getMatch() {
            // loading
            this.loadingData(true);
            this.$http
                .get(`matchs/${this.matchId}`, {
                    params: {
                        summonerId: this.summonerId,
                        region: this.region,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    this.losers = response.data.losers;
                    this.winners = response.data.winners;
                    this.champion = response.data.champion;
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
                    container: "#losersLoading"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#winnersLoading"
                });
            } else {
                this.$vs.loading.close("#losersLoading > .con-vs-loading");
                this.$vs.loading.close("#winnersLoading > .con-vs-loading");
            }
        }
    },
    metaInfo() {
        // if no subcomponents specify a metaInfo.title, this title will be used
        return {
            title: `${this.title}`,
            // all titles will be injected into this template
            titleTemplate: "Probuilds.eu – %s"
        };
    }
};
</script>

<style lang="scss">
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