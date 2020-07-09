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
            <div class="vx-col w-1/6" :data="match" :key="index" v-for="(match, index) in matches">
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
                                    <span class="text-sm ml-1">28:18</span>
                                </div>
                                <h6 class="font-bold">Nidalee</h6>
                            </div>

                            <!-- TITLE & DESCRIPTION -->
                            <div class="my-4 text-center">
                                <!-- @click="navigate_to_detail_view" -->
                                <h6
                                    class="truncate font-semibold mb-1 hover:text-primary cursor-pointer"
                                >GOSU</h6>
                                <p class="item-description truncate text-sm">Match classé</p>
                            </div>
                        </div>
                        <!-- SLOT: ACTION BUTTONS -->
                        <div class="flex flex-wrap">
                            <div
                                class="item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer"
                            >
                                <feather-icon icon="EyeIcon" svgClasses="h-4 w-4" />

                                <span class="text-sm font-semibold ml-2">REGARDER</span>
                            </div>
                        </div>
                    </template>
                </vx-card>
            </div>
        </div>
    </section>
</template>

<script>
import SearchBanner from "@/views/main/partials/SearchBanner";
import RegionNavbar from "./partials/RegionNavbar";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.home"),
            regions: [],
            activeRegion: null,
            matches: []
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
        setInterval(() => this.liveMatches(), 1000);
    },
    methods: {
        getLiveMatches() {
            // loading
            this.loadingData(true, "#loadingSpectate");
            this.liveMatches().then(() => {
                this.loadingData(false, "#loadingSpectate");
            });
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
                });
        },
        getRegions() {
            this.loadingData(true, "#loadingRegions");
            this.$http
                .get("regions")
                .then(response => (this.regions = response.data))
                .then(() => {
                    this.loadingData(false, "#loadingRegions");
                });
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
