<template>
    <vx-card
        class="vs-con-loading__container"
        id="summonerLoading"
        :card-background="'linear-gradient(120deg ,rgba(16,22,58,0.85), rgba(16,22,58,0.85)), no-repeat url(/images/dragon/emblems/Emblem_' + data.leagueName + '.png) 125% 50%/50%'"
    >
        <div class="vx-row">
            <div class="vx-col mb-5">
                <h4>{{ data.name }}</h4>
                <p>{{ region.toUpperCase() }}</p>
            </div>
            <div class="vx-col" id="account-manage-buttons">
                <vs-button
                    icon-pack="feather"
                    icon="icon-external-link"
                    class="ml-2 text-xs"
                    target="_blank"
                    :href="'https://'+region+'.op.gg/summoner/userName=' + data.name"
                >OP.GG</vs-button>
            </div>
        </div>
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
        </div>
    </vx-card>
</template>

<script>
export default {
    name: "profile",
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
