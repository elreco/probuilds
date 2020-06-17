<template>
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
                        <td class="font-semibold">{{$t('Summoner.player')}}</td>
                        <td class="font-light">{{data.name}}</td>
                    </tr>

                    <tr>
                        <td class="font-semibold">{{$t('Summoner.league')}}</td>
                        <td class="font-light">{{data.league}}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold">{{$t('Summoner.leaguePoints')}}</td>
                        <td class="font-light">{{data.leaguePoints}}</td>
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
</template>

<script>
export default {
    name: "summoner-details",
    props: ["summonerId", "region"],
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png"),
            data: {
                name: " "
            }
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
                .get(`summoners/${this.summonerId}`, {
                    params: {
                        region: this.region,
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
