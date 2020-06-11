<template>
    <!-- Two columns -->
    <div id="page-user-view">
        <div class="vx-row mb-base" id="user-data">
            <div class="vx-col w-full">
                <vx-card title="Aatrox">
                    <!-- Avatar -->
                    <div class="vx-row">
                        <!-- Avatar Col -->
                        <div class="vx-col" id="avatar-col">
                            <div class="img-container mb-4">
                                <img
                                    src="http://ddragon.leagueoflegends.com/cdn/10.11.1/img/champion/Aatrox.png"
                                    class="rounded w-full"
                                />
                            </div>
                        </div>

                        <!-- Information - Col 1 -->
                        <div class="vx-col flex-1" id="account-info-col-1">
                            <table>
                                <tr>
                                    <td class="font-semibold">Player</td>
                                    <td>dfhdfh</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Name</td>
                                    <td>sdgdsgsdg</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Email</td>
                                    <td>sdgsdgdsg</td>
                                </tr>
                            </table>
                        </div>
                        <!-- /Information - Col 1 -->

                        <!-- Information - Col 2 -->
                        <div class="vx-col flex-1" id="account-info-col-2">
                            <table>
                                <tr>
                                    <td class="font-semibold">Status</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Role</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Company</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                        <!-- /Information - Col 2 -->
                        <div class="vx-col w-full flex" id="account-manage-buttons">
                            <vs-button
                                icon-pack="feather"
                                icon="icon-edit"
                                class="mr-4"
                                :to="{name: 'app-user-edit', params: { userId: $route.params.userId }}"
                            >Edit</vs-button>
                            <vs-button
                                type="border"
                                color="danger"
                                icon-pack="feather"
                                icon="icon-trash"
                                @click="confirmDeleteRecord"
                            >Delete</vs-button>
                        </div>
                    </div>
                </vx-card>
            </div>
        </div>
        <div class="vx-row mb-base">
            <div class="vx-col w-full xl:w-1/2 mb-base">
                <vx-card
                    class="vs-con-loading__container"
                    id="loadingMatch1"
                    :title="$t('Match.winningTeam')"
                    title-color="#7ed321"
                    content-color="#fff"
                >
                    <template slot="actions">
                        <bans :data="winners.bans"></bans>
                    </template>
                    <team :data="winners.participants" :summonerId="summonerId"></team>
                </vx-card>
            </div>
            <div class="vx-col xl:w-1/2 w-full">
                <vx-card
                    class="vs-con-loading__container"
                    id="loadingMatch2"
                    :title="$t('Match.losingTeam')"
                    title-color="#a12b17"
                    content-color="#fff"
                >
                    <template slot="actions">
                        <bans :data="losers.bans"></bans>
                    </template>
                    <team :data="losers.participants" :summonerId="summonerId"></team>
                </vx-card>
            </div>
        </div>
    </div>
</template>

<script>
import Team from "./match/Team";
import Bans from "./match/Bans";

export default {
    name: "match-details",
    components: {
        Team,
        Bans
    },
    props: ["region", "summonerId", "matchId"],
    data() {
        return {
            winners: [],
            losers: [],
            images: {
                background1: require("@assets/images/match/background1.jpg"),
                background2: require("@assets/images/match/background2.jpg")
            }
        };
    },
    mounted() {
        this.getMatch();
    },
    methods: {
        getMatch() {
            // loading

            this.loadingData(true);
            this.$http
                .get("match/show-details", {
                    params: {
                        summonerId: this.summonerId,
                        region: this.region,
                        matchId: this.matchId,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    /* this.losers = response.data.participants.filter(function(
                        value
                    ) {
                        return value.win == false;
                    });

                    this.winners = response.data.participants.filter(function(
                        value
                    ) {
                        return value.win == true;
                    }); */
                    console.log(response.data.winners.participants);
                    this.winners = response.data.winners;
                    this.losers = response.data.losers;
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
                    container: "#loadingMatch1"
                });
                this.$vs.loading({
                    type: "default",
                    container: "#loadingMatch2"
                });
            } else {
                this.$vs.loading.close("#loadingMatch1 > .con-vs-loading");
                this.$vs.loading.close("#loadingMatch2 > .con-vs-loading");
            }
        }
    }
};
</script>

<style lang="scss">
#avatar-col {
    width: 10rem;
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
