<template>
    <div class="vx-row">
        <div class="vx-col w-full">
            <vs-navbar
                active-text-color="rgba(255,255,255,1)"
                text-color
                v-model="selectedLane"
                class="nabarx mb-base lane-selection p-2"
                type="flat"
                id="loadingRegions"
            >
                <div slot="title">
                    <vs-navbar-title>{{ $t("LiveFeed.title") }}</vs-navbar-title>
                </div>
                <vs-navbar-item index="all">
                    <a href="#" class="all">{{ $t("LiveFeed.all") }}</a>
                    <!-- <router-link
                        :to="{name: 'probuilds',params:{lane: 'all', region: selectedRegion}}"
                        class="all"
                    >{{ $t("LiveFeed.all") }}</router-link>-->
                </vs-navbar-item>
                <vs-navbar-item index="top">
                    <a href="#" class="top">Top</a>
                    <!-- <router-link
                        :to="{name: 'probuilds',params:{lane: 'top', region: selectedRegion}}"
                        class="top"
                    >Top</router-link>-->
                </vs-navbar-item>
                <vs-navbar-item index="jungle">
                    <a href="#" class="jungle">Jungle</a>
                    <!-- <router-link
                        :to="{name: 'probuilds',params:{lane: 'jungle', region: selectedRegion}}"
                        class="jungle"
                    >Jungle</router-link>-->
                </vs-navbar-item>
                <vs-navbar-item index="mid">
                    <a href="#" class="mid">Mid</a>
                    <!-- <router-link
                        :to="{name: 'probuilds',params:{lane: 'mid', region: selectedRegion}}"
                        class="Mid"
                    >Jungle</router-link>-->
                </vs-navbar-item>
                <vs-navbar-item index="adc">
                    <a href="#" class="bot">Bot</a>
                    <!-- <router-link
                        :to="{name: 'probuilds',params:{lane: 'adc', region: selectedRegion}}"
                        class="bot"
                    >Bot</router-link>-->
                </vs-navbar-item>
                <vs-navbar-item index="support">
                    <a href="#" class="support">Support</a>
                    <!-- <router-link
                        :to="{name: 'probuilds',params:{lane: 'support', region: selectedRegion}}"
                        class="support"
                    >Support</router-link>-->
                </vs-navbar-item>
                <v-select
                    :clearable="true"
                    :options="regions"
                    :placeholder="$t('LiveFeed.allRegion')"
                    class="w-48"
                    v-model="selectedRegion"
                />
            </vs-navbar>

            <vs-table
                v-if="Object.keys(matches.data).length != 0 || isFetching==true"
                noDataText
                :currentPage="page"
                :sst="true"
                @change-page="handleChangePage"
                :max-items="matches.maxItems"
                :total="matches.totalItems"
                pagination
                :data="matches.data"
                @selected="handleSelected"
                class="vs-con-loading__container"
                id="loadingFeed"
            >
                <template slot="thead">
                    <vs-th></vs-th>
                    <vs-th></vs-th>
                    <vs-th>{{ $t("LiveFeed.player") }}</vs-th>
                    <vs-th class="text-center">{{ $t("LiveFeed.vs") }}</vs-th>
                    <vs-th class="text-center">{{ $t("LiveFeed.kda") }}</vs-th>
                    <vs-th class="text-center">{{ $t("LiveFeed.gold") }}</vs-th>
                    <vs-th class="text-center">{{ $t("LiveFeed.keystone") }}</vs-th>
                    <vs-th class="text-center">{{ $t("LiveFeed.build") }}</vs-th>
                    <vs-th class="text-center">{{ $t("LiveFeed.summoners") }}</vs-th>
                    <vs-th class="text-center">{{ $t("LiveFeed.region") }}</vs-th>
                </template>

                <template slot-scope="{data}">
                    <vs-tr
                        class="whitespace-no-wrap text-base"
                        :data="tr"
                        :key="indextr"
                        v-for="(tr, indextr) in data"
                    >
                        <vs-td class="text-center" :data="tr.date">{{ tr.ago }}</vs-td>
                        <vs-td class="text-center" :data="tr.champion">
                            <popover-avatar
                                :win="tr.win"
                                :default="false"
                                type="champions"
                                :id="tr.champion.id"
                                :src="tr.champion.src"
                            />
                        </vs-td>
                        <vs-td :data="tr.player">
                            <vs-chip color="primary">
                                <vs-avatar :src="tr.player.icon" />
                                {{ tr.player.name }}
                            </vs-chip>
                        </vs-td>
                        <vs-td class="text-center" :data="tr.vs">
                            <popover-avatar :src="tr.vs.src" type="champions" :id="tr.vs.id" />
                        </vs-td>
                        <vs-td class="text-center" :data="tr.kda">{{ tr.kda }}</vs-td>
                        <vs-td class="text-center" :data="tr.gold">{{ tr.gold }}</vs-td>
                        <vs-td class="text-center" :data="tr.keystone">
                            <div class="relative inline">
                                <vs-avatar :src="tr.keystone" />
                                <img class="supperposed-avatar rounded" :src="tr.subkeystone" />
                            </div>
                        </vs-td>
                        <vs-td class="text-center" :data="tr.items">
                            <popover-avatar
                                v-for="(item, index) in tr.items"
                                :key="index"
                                :src="item.src"
                                :id="item.id"
                                type="items"
                            />

                            <div
                                v-for="n in 6-Object.keys(tr.items).length"
                                :key="n + 100"
                                class="inline-block w-10 h-10 rounded bg-theme-dark mr-1"
                            ></div>
                        </vs-td>
                        <vs-td class="text-center" :data="tr.summonerSpells">
                            <popover-avatar
                                v-for="(spell, index) in tr.summonerSpells"
                                :key="index"
                                :src="spell.src"
                                :id="spell.id"
                                type="spells"
                            />
                        </vs-td>
                        <vs-td class="text-center" :data="tr.region">{{tr.region.toUpperCase()}}</vs-td>
                    </vs-tr>
                </template>
            </vs-table>
            <div v-else class="bg-primary text-teal-900 px-4 py-3 shadow-md" role="alert">
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
                        <p class="text-sm">{{$t('Message.noLivefeedData')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import PopoverAvatar from "../../../components/popovers/PopoverAvatar";
import moment from "moment";

export default {
    name: "live-feed",
    props: ["champion"],
    data() {
        return {
            selectedLane: "all",
            selectedRegion: null,
            isFetching: true,
            page: 1,
            regions: [],
            totalItems: 0,
            get_feed_is_running: false,
            matches: {
                data: [],
                totalItems: 1,
                maxItems: 1
            },
            requests: [],
            request: null
        };
    },
    mounted() {
        this.getFeed();
        this.getRegions();
        this.pollLiveMatches();
    },
    methods: {
        handleSelected(tr) {
            this.$router.push({
                name: "probuilds.matches",
                params: {
                    region: tr.region,
                    summonerId: tr.summonerId,
                    matchId: tr.matchId,
                    champion: tr.champion.id,
                    participantId: tr.participantId
                }
            });
        },
        handleChangePage(page) {
            this.page = page;
            this.getFeed();
        },
        getFeed() {
            // loading
            this.loadingData(true, "#loadingFeed");
            this.livefeed().then(() => {
                this.loadingData(false, "#loadingFeed");
            });
            // UPDATE this.matches après avoir fait la requête axios
        },
        livefeed() {
            return this.$http
                .get("livefeed", {
                    params: {
                        page: this.page,
                        lane: this.selectedLane,
                        region: this.selectedRegion,
                        champion: this.champion,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    this.isFetching = false;
                    this.matches = response.data;
                    this.formatDate();
                })
                .then(() => {
                    setInterval(() => {
                        this.formatDate();
                    }, 1000);
                });
        },
        formatDate() {
            if (this.matches.data.length) {
                this.matches.data = this.matches.data.map(m => {
                    m.ago = moment(m.date).fromNow();
                    return m;
                });
            }
        },
        getRegions() {
            this.loadingData(true, "#loadingRegions");
            this.$http
                .get("regions")
                .then(response => {
                    this.regions = response.data;
                })
                .then(() => {
                    this.loadingData(false, "#loadingRegions");
                });
        },
        pollLiveMatches() {
            var channelName = ".livefeed." + this.selectedLane;
            if (this.champion) {
                channelName += "." + this.champion;
            }
            window.Echo.channel("probuilds").listen(channelName, e => {
                if (this.matches.data.length) {
                    this.livefeed();
                }
            });
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
    computed: {
        filterTable: function() {
            const selectedLane = this.selectedLane;
            const selectedRegion = this.selectedRegion;

            return {
                selectedLane,
                selectedRegion
            };
        }
    },
    watch: {
        filterTable: function() {
            this.handleChangePage(1);
        }
    },
    components: {
        PopoverAvatar
    }
};
</script>
<style lang="css">
.selectExample {
    margin: 10px;
}
.con-select-example {
    display: flex;
    align-items: center;
    justify-content: center;
}
.con-select .vs-select {
    width: 100%;
}
@media (max-width: 550px) {
    .con-select {
        flex-direction: column;
    }
    .con-select .vs-select {
        width: 100%;
    }
}
.vs__dropdown-menu {
    z-index: 9999 !important;
}
</style>
