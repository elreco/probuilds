<template>
    <section>
        <!-- GRID VIEW -->
        <div class="vx-row">
            <div class="vx-col w-1/2 mx-auto mb-base">
                <region-navbar
                    :regions="regions"
                    :activeRegion="activeRegion"
                    class="vs-con-loading__container"
                    id="loadingRegions"
                />
            </div>
        </div>
        <div class="items-grid-view vx-row match-height" id="loadingSpectate">
            <div
                class="vx-col xl:w-1/6 md:w-1/3 w-full"
                :data="match"
                :key="index"
                v-for="(match, index) in matches"
            >
                <vx-card
                    class="grid-view-item mb-base overflow-hidden"
                    style="background-size: cover;"
                    :card-background="'linear-gradient(120deg ,rgba(16,22,58,0.85), rgba(16,22,58,0.85)),no-repeat 100% 25%/100% url(' + match.champion.splash + ')'"
                >
                    <template slot="no-body">
                        <!-- ITEM IMAGE -->
                        <div
                            class="item-img-container mx-auto flex items-center justify-center my-4 cursor-pointer"
                        >
                            <img
                                :src="match.champion.src"
                                class="grid-view-img w-16 h-16 rounded border-solid border-2 border-primary shadow-primary"
                                style="border-radius:50%;object-fit: cover;"
                            />
                        </div>
                        <div class="item-details px-4">
                            <!-- RATING & PRICE -->
                            <div class="flex justify-between items-center">
                                <div
                                    class="text-warning border border-solid border-warning flex py-1 px-2 rounded"
                                >
                                    <feather-icon icon="VideoIcon" svgClasses="h-4 w-4" />
                                    <span class="text-sm ml-1">{{ago[index]}}</span>
                                </div>
                                <h6 class="font-bold">
                                    <router-link
                                        class="hover:text-primary text-white"
                                        :to="{name: 'probuilds.champions', params: {champion: match.champion.name}}"
                                    >{{match.champion.name}}</router-link>
                                </h6>
                            </div>

                            <!-- TITLE & DESCRIPTION -->
                            <div class="my-4 text-center">
                                <!-- @click="navigate_to_detail_view" -->
                                <h6
                                    class="truncate font-semibold mb-1 hover:text-primary cursor-pointer"
                                >
                                    <a
                                        class="hover:text-primary text-white"
                                        target="_blank"
                                        :href="'https://'+activeRegion+'.op.gg/summoner/userName=' + match.summonerName"
                                    >
                                        {{match.summonerName}}
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </h6>
                                <p class="item-description truncate text-sm">{{match.gameMode}}</p>
                            </div>
                        </div>
                        <!-- SLOT: ACTION BUTTONS -->
                        <div class="flex flex-wrap">
                            <div
                                class="item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer"
                            >
                                <feather-icon icon="EyeIcon" svgClasses="h-4 w-4" />

                                <span
                                    class="text-sm font-semibold ml-2 uppercase"
                                >{{$t('Spectate.watch')}}</span>
                            </div>
                        </div>
                    </template>
                </vx-card>
            </div>
        </div>
        <div
            v-if="matches && matches.length==0 && isFetching==false"
            class="bg-primary text-white px-4 py-3 shadow-md"
            role="alert"
        >
            <div class="flex">
                <div class="py-1">
                    <svg
                        class="fill-current h-6 w-6 text-teal-500 mr-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                        />
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{$t('Message.noData')}}</p>
                    <p class="text-sm">{{$t('Message.noMatchesData')}}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import SearchBanner from "@/views/main/partials/SearchBanner";
import RegionNavbar from "./partials/RegionNavbar";
import moment from "moment";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.home"),
            regions: [],
            isFetching: true,
            activeRegion: null,
            matches: [],
            polling: null,
            ago: [],
            agoInterval: null
        };
    },
    components: {
        SearchBanner,
        RegionNavbar
    },
    mounted() {
        this.getRegions();
        this.setActiveRegion();
        this.getLiveMatches();
        this.pollLiveMatches();
    },
    methods: {
        getLiveMatches() {
            // loading
            this.loadingData(true, "#loadingSpectate");
            this.liveMatches()
                .then(() => {
                    this.loadingData(false, "#loadingSpectate");
                })
                .then(response => {
                    this.isFetching = false;
                });
        },
        pollLiveMatches() {
            this.polling = setInterval(() => this.liveMatches(), 10000);
        },
        liveMatches() {
            return this.$http
                .get(`spectate`, {
                    params: {
                        region: this.activeRegion,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    this.matches = response.data;
                })
                .then(response => {
                    clearInterval(this.agoInterval);
                    this.updateDate();
                    this.agoInterval = setInterval(() => {
                        this.updateDate();
                    }, 1000);
                });
        },
        updateDate() {
            this.matches = this.matches.map((m, index) => {
                var a = moment();
                var b = moment(m.date);
                this.ago[index] = moment({})
                    .seconds(a.diff(b, "seconds"))
                    .add(1, "seconds")
                    .format("mm:ss");
                return m;
            });
        },
        getRegions() {
            this.$http
                .get("regions", { cache: true })
                .then(response => (this.regions = response.data));
        },
        setActiveRegion() {
            this.activeRegion = this.$route.params.region
                ? this.$route.params.region
                : "EUW";
        },
        loadingData(boolean, id) {
            if (boolean) {
                this.$vs.loading({
                    type: "default",
                    container: id
                });
            } else {
                this.$vs.loading.close(id + " > .con-vs-loading");
            }
        }
    },
    beforeDestroy() {
        clearInterval(this.polling);
        clearInterval(this.agoInterval);
    },
    metaInfo() {
        // if no subcomponents specify a metaInfo.title, this title will be used
        return {
            title: `${this.title}`,
            // all titles will be injected into this template
            titleTemplate: "EvilSpartan.com – %s"
        };
    }
};
</script>
