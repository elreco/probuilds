<template>
    <div class="vx-row mb-base" id="page-user-view">
        <div class="vx-col w-1/2">
            <vx-card :title="data.name" class="vs-con-loading__container" id="summonerLoading">
                <!-- Avatar -->
                <div class="vx-row">
                    <!-- Avatar Col -->
                    <div class="vx-col" id="avatar-col">
                        <div class="img-container mb-4">
                            <img
                                :src="data.icon ? data.icon : srcIfNull"
                                class="rounded w-full border-solid border-2 border-white"
                            />
                        </div>
                    </div>

                    <!-- Information - Col 1 -->
                    <div class="vx-col flex-1" id="account-info-col-1">
                        <table>
                            <tr>
                                <td class="font-semibold">{{$t('Match.player')}}</td>
                                <td>{{data.name}}</td>
                            </tr>

                            <tr>
                                <td class="font-semibold">{{$t('Match.league')}}</td>
                                <td>{{data.league}}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">{{$t('Match.leaguePoints')}}</td>
                                <td>{{data.leaguePoints}}</td>
                            </tr>
                        </table>
                    </div>
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
    name: "champion-details",
    props: ["champion"],
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png"),
            data: {}
        };
    },
    mounted() {
        this.getSummoner();
    },
    methods: {
        getSummoner() {
            // loading
            this.loadingData(true);
            this.$http
                .get("champions", {
                    params: {
                        champion: this.champion,
                        locale: this.$route.params.locale
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
                    container: "#summonerLoading"
                });
            } else {
                this.$vs.loading.close("#summonerLoading > .con-vs-loading");
            }
        }
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