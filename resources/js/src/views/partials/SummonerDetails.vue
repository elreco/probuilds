<template>
    <div class="vx-row mb-base" id="page-user-view">
        <div class="vx-col w-1/2">
            <vx-card :title="data.champion.title">
                <!-- Avatar -->
                <div class="vx-row">
                    <!-- Avatar Col -->
                    <div class="vx-col" id="avatar-col">
                        <div class="img-container mb-4">
                            <img
                                :src="data.champion.src ? data.champion.src : srcIfNull"
                                class="rounded w-full"
                            />
                        </div>
                    </div>

                    <!-- Information - Col 1 -->
                    <div class="vx-col flex-1" id="account-info-col-1">
                        <table>
                            <tr>
                                <td class="font-semibold">{{$t('Match.player')}}</td>
                                <td>{{data.summonerName}}</td>
                            </tr>

                            <tr>
                                <td class="font-semibold">{{$t('Match.league')}}</td>
                                <td>{{data.summonerLeague}}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">{{$t('Match.leaguePoints')}}</td>
                                <td>{{data.summonerLeaguePoints}}</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /Information - Col 1 -->

                    <!-- Information - Col 2 -->
                    <!-- <div class="vx-col flex-1" id="account-info-col-2">
                        <table>
                            <tr>
                                <td class="font-semibold">Level</td>
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
                    </div>-->
                    <!-- /Information - Col 2 -->
                    <div class="vx-col w-full flex" id="account-manage-buttons">
                        <!--  <vs-button
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
                        >Delete</vs-button>-->
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
export default {
    name: "summoner-details",
    props: ["data"],
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png")
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