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
                class="vx-col xl:w-1/5 md:w-1/3 w-full"
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
                                    class="text-gold border border-solid border-gold flex py-1 px-2 rounded"
                                >
                                    <feather-icon icon="VideoIcon" svgClasses="h-4 w-4" />
                                    <span class="text-sm ml-1">{{ago[index]}}</span>
                                </div>

                                <h6 class="font-bold">
                                    <router-link
                                        class="hover:text-primary text-white"
                                        :to="{name: 'probuilds.champions', params: {champion: match.champion.id}}"
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
                                        :href="'https://'+match.region+'.op.gg/summoner/userName=' + match.summonerName"
                                    >
                                        {{match.summonerName}}
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </h6>
                                <p
                                    class="item-description truncate text-sm text-gold font-light"
                                    v-html="setQueue(match.queueID)"
                                ></p>

                                <div
                                    class="con-vs-chip vs-chip-primary con-color w-12 mx-auto mt-2 mb-5 rounded-sm float-none"
                                >
                                    <span
                                        class="text-chip vs-chip--text"
                                    >{{match.region.toUpperCase()}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- SLOT: ACTION BUTTONS -->
                        <div class="flex flex-wrap">
                            <div
                                @click="download(match.url, match.matchId);openPopup(match)"
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
        <vs-popup
            class="holamundo"
            :title="popupMatch.summonerName + ' - ' + popupMatch.champion.name"
            :active.sync="popupActive"
        >
            <vs-navbar
                v-model="activeItem"
                color="#0091EA"
                text-color="rgba(255,255,255,.6)"
                active-text-color="rgba(255,255,255,1)"
                class="vx-navbar rounded-sm px-5 myNavbar text-white mb-4"
            >
                <div slot="title">
                    <vs-navbar-title class="font-semibold text-sm text-white">{{$t('Spectate.OS')}}</vs-navbar-title>
                </div>
                <vs-navbar-item index="0">
                    <a href="#" class="text-base" @click="changeOS('windows')">
                        <i class="fab fa-windows pr-1"></i> Windows
                    </a>
                </vs-navbar-item>
                <vs-navbar-item index="1">
                    <a href="#" class="text-base" @click="changeOS('mac')">
                        <i class="fab fa-apple pr-1"></i> Mac
                    </a>
                </vs-navbar-item>
            </vs-navbar>

            <vx-card>
                <div class="w-full" :class="os == 'windows' ? 'block' : 'hidden'">
                    <p class="text-white text-sm mb-4">
                        {{$t('Spectate.restartDownload1')}}
                        {{$t('Spectate.restartDownload2')}}
                        <a
                            href="#"
                            class="text-gold hover:text-primary"
                            @click="download(popupMatch.url, popupMatch.matchId)"
                        >{{$t('Spectate.restartDownload3')}}</a>
                    </p>
                    <hr />
                    <img
                        src="@assets/images/match/tuto.gif"
                        class="border-2 border-primary border-solid w-full mt-4"
                        icon="windows"
                    />
                </div>
                <div class="w-full" :class="os == 'mac' ? 'block' : 'hidden'">
                    <p class="text-white text-sm mb-4" v-html="$t('Spectate.macMessage')"></p>
                    <hr />
                    <div
                        class="vs-component vs-con-textarea mt-4 vs-textarea-primary"
                        style="border: 1px solid rgba(0, 0, 0, 0.08); height: 295px;"
                    >
                        <textarea
                            @focus="$event.target.select()"
                            class="vs-textarea"
                            readonly
                            v-model="popupMatch.mac"
                        ></textarea>
                    </div>
                </div>
            </vx-card>
        </vs-popup>
    </section>
</template>

<script>
import SearchBanner from "@/views/main/partials/SearchBanner";
import RegionNavbar from "./partials/RegionNavbar";
import moment from "moment";
import axios from "axios";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.home"),
            regions: [],
            queueIDs: [],
            queueLoading: true,
            queueType: [],
            isFetching: true,
            activeRegion: this.$route.params.region,
            matches: [],
            polling: null,
            ago: [],
            agoInterval: null,
            popupActive: false,
            popupMatch: {
                champion: []
            },
            activeItem: 0,
            os: "windows"
        };
    },
    components: {
        SearchBanner,
        RegionNavbar
    },
    mounted() {
        this.getRegions();
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
        forceFileDownload(response, fileName) {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement("a");
            link.href = url;
            link.setAttribute("download", fileName); //or any other extension
            document.body.appendChild(link);
            link.click();
        },
        download(url, matchId) {
            axios({
                method: "get",
                url: process.env.MIX_APP_URL + url,
                responseType: "blob"
            }).then(response => {
                /* this.forceFileDownload(
                    response,
                    "EvilSpartan_lol_spectate_" +
                        this.activeRegion +
                        "_" +
                        matchId +
                        ".bat"
                ); */
            });
        },
        pollLiveMatches() {
            this.polling = setInterval(
                function() {
                    if (this.matches.length) {
                        this.liveMatches();
                    }
                }.bind(this),
                10000
            );
        },
        openPopup(match) {
            this.popupActive = true;
            this.popupMatch = match;
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
                    this.matches = response.data.matches;
                    this.queueIDs = response.data.queueIDs;
                })
                .then(response => {
                    this.getQueuesTypes();
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
                this.ago[index] = moment
                    .utc(a.diff(b, "seconds") * 1000)
                    .add(1, "seconds")
                    .format("mm:ss");
                return m;
            });
        },
        getRegions() {
            this.$http.get("regions", { cache: true }).then(response => {
                this.regions = response.data;
            });
        },
        setQueue(queueID) {
            return !this.queueLoading
                ? this.queueType[queueID].name
                : '<i class="fas fa-spinner fa-spin"></i>';
        },
        getQueuesTypes() {
            if (this.matches.length)
                this.$http
                    .get(`queues-types`, {
                        params: {
                            queues: this.queueIDs,
                            locale: this.$route.params.locale
                        }
                    })
                    .then(response => {
                        this.queueType = response.data;
                        this.queueLoading = false;
                    });
        },
        changeOS(os) {
            this.os = os;
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
<style>
.vs-textarea {
    height: 100%;
}
</style>
