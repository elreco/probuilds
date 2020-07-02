<template>
    <vx-card
        class="vs-con-loading__container"
        id="summonerLoading"
        :card-background="'linear-gradient(120deg ,rgba(16,22,58,0.85), rgba(16,22,58,0.85)), no-repeat url(/images/dragon/emblems/Emblem_' + data.leagueName + '.png) 125% 50%/50%'"
    >
        <div class="vx-row mb-8">
            <div class="vx-col">
                <h4 class="text-white">{{ data.name }}</h4>
                <p>{{ regionName }}</p>
            </div>
            <div class="vx-col xl:ml-2 ml-auto" id="account-manage-buttons">
                <vs-button
                    icon-pack="feather"
                    icon="icon-external-link"
                    class="text-xs"
                    target="_blank"
                    :href="'https://'+region+'.op.gg/summoner/userName=' + data.name"
                >OP.GG</vs-button>
            </div>
        </div>
        <!-- Avatar -->
        <div class="vx-row mb-2">
            <!-- Avatar Col -->
            <div class="vx-col xl:mr-4 xl:mb-0 mb-base mx-auto" id="avatar-col">
                <div class="img-container relative">
                    <div
                        class="borderImage"
                        :style="'background-image: url(' + images.borderImage + ');'"
                    ></div>
                    <img :src="data.icon ? data.icon : srcIfNull" class="w-full" />
                    <span
                        class="level"
                        :style="'background-image:url(' + images.levelBox + ')'"
                    >{{data.level}}</span>
                </div>
            </div>

            <!-- Information - Col 1 -->
            <div class="vx-col flex-1 text-sm" id="account-info-col-1">
                <table>
                    <tr>
                        <td class="font-semibold text-white">{{$t('Summoner.player')}}</td>
                        <td class="font-light">{{data.name}}</td>
                    </tr>

                    <tr>
                        <td class="font-semibold text-white">{{$t('Summoner.league')}}</td>
                        <td class="font-light">{{data.league}}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-white">{{$t('Summoner.leaguePoints')}}</td>
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
            regionName: null,
            images: {
                levelBox: require("@assets/images/dragon/bg-levelbox.png"),
                borderImage: ""
            },
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
                    this.regionName = this.region.toUpperCase();
                    if (this.data.leagueName)
                        this.images.borderImage = require("@assets/images/dragon/borders/" +
                            this.data.leagueName +
                            ".png");
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

<style>
.borderImage {
    position: absolute;
    left: -10px;
    top: -10px;
    width: 120px;
    height: 120px;
    background-position: center bottom;
    background-repeat: no-repeat;
}

.img-container {
    width: 100px;
    height: 100px;
}
.level {
    position: absolute;
    top: 100%;
    left: 50%;
    margin-top: -14px;
    margin-left: -22px;
    width: 44px;
    height: 24px;
    padding-top: 3.8px;
    box-sizing: border-box;
    background-size: 100%;
    line-height: 17px;
    /* font-family: Helvetica, AppleSDGothic, "Apple SD Gothic Neo", AppleGothic,
        Arial, Tahoma; */
    font-size: 14px;
    text-align: center;
    color: #eabd56;
}
</style>
