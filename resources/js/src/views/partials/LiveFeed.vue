<template>
    <vx-card class="z-0 vs-con-loading__container" id="loadingFeed">
        <div class="vx-col w-full">
            <vs-navbar
                active-text-color="rgba(255,255,255,1)"
                text-color
                v-model="selectedLane"
                class="nabarx mb-base lane-selection p-2"
                type="flat"
            >
                <div slot="title">
                    <vs-navbar-title>{{ $t("LiveFeed.title") }}</vs-navbar-title>
                </div>
                <vs-navbar-item index="all">
                    <a href="#" class="all">{{ $t("LiveFeed.all") }}</a>
                </vs-navbar-item>
                <vs-navbar-item index="top">
                    <a href="#" class="top">Top</a>
                </vs-navbar-item>
                <vs-navbar-item index="jungle">
                    <a href="#" class="jungle">Jungle</a>
                </vs-navbar-item>
                <vs-navbar-item index="mid">
                    <a href="#" class="mid">Mid</a>
                </vs-navbar-item>
                <vs-navbar-item index="adc">
                    <a href="#" class="bot">Bot</a>
                </vs-navbar-item>
                <vs-navbar-item index="support">
                    <a href="#" class="support">Support</a>
                </vs-navbar-item>
                <v-select
                    id="loadingSelect"
                    :clearable="true"
                    :options="regions"
                    :placeholder="$t('LiveFeed.allRegion')"
                    class="w-48"
                    v-model="selectedRegion"
                />
            </vs-navbar>
            <vs-table
                noDataText
                :currentPage="page"
                :sst="true"
                @change-page="handleChangePage"
                :max-items="users.maxItems"
                :total="users.totalItems"
                pagination
                :data="users.data"
                @selected="handleSelected"
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
                                :src="tr.champion.src"
                                :title="tr.champion.title"
                                :description="tr.champion.description"
                            />
                        </vs-td>
                        <vs-td :data="tr.player">
                            <vs-chip color="primary">
                                <vs-avatar :src="tr.player.icon" />
                                {{ tr.player.name }}
                            </vs-chip>
                        </vs-td>
                        <vs-td class="text-center" :data="tr.vs">
                            <popover-avatar
                                :src="tr.vs.src"
                                :title="tr.vs.title"
                                :description="tr.vs.description"
                            />
                        </vs-td>
                        <vs-td class="text-center" :data="tr.kda">{{ tr.kda }}</vs-td>
                        <vs-td class="text-center" :data="tr.gold">{{ tr.gold }}</vs-td>
                        <vs-td class="text-center" :data="tr.keystone">
                            <div class="relative inline">
                                <vs-avatar :src="tr.keystone" />
                                <img class="supperposed-avatar rounded" :src="tr.subkeystone" />
                            </div>
                        </vs-td>
                        <vs-td class="text-center" :data="tr.slots">
                            <popover-avatar
                                v-for="(slot, index) in tr.slots"
                                :key="index"
                                :data="slot"
                                :src="slot.src"
                                :title="slot.title"
                                :description="slot.description"
                            />

                            <div
                                v-for="n in 6-Object.keys(tr.slots).length"
                                :key="n + 100"
                                class="inline-block w-10 h-10 rounded bg-theme-dark mr-1"
                            ></div>
                        </vs-td>
                        <vs-td class="text-center" :data="tr.spells">
                            <popover-avatar
                                v-for="(spell, index) in tr.spells"
                                :key="index"
                                :data="spell"
                                :src="spell.src"
                                :title="spell.title"
                                :description="spell.description"
                            />
                        </vs-td>
                    </vs-tr>
                </template>
            </vs-table>
        </div>
    </vx-card>
</template>
<script>
import PopoverAvatar from "../../components/popovers/PopoverAvatar";
import moment from "moment";

export default {
    name: "live-feed",
    props: ["champion"],
    data() {
        return {
            selectedLane: "all",
            selectedRegion: null,
            page: 1,
            regions: [],
            activeLoading: false,
            totalItems: 0,
            get_feed_is_running: false,
            users: {
                data: [],
                totalItems: 1,
                maxItems: 1
            },
            requests: [],
            request: null
        };
    },

    mounted() {
        this.getRegions();
        this.getFeed();
    },
    methods: {
        handleSelected(tr) {
            this.$router.push({
                name: "matchs",
                params: {
                    region: tr.region,
                    summonerId: tr.summonerId,
                    matchId: tr.matchId,
                    champion: tr.champion.title
                }
            });
        },
        handleChangePage(page) {
            this.page = page;
            this.getFeed();
        },
        getFeed() {
            // loading

            this.loadingData(true);
            this.$http
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
                    this.users = response.data;
                    this.formatDate();
                })
                .then(() => {
                    setInterval(() => {
                        this.formatDate();
                    }, 1000);
                })
                .then(() => {
                    this.loadingData(false);
                });

            // UPDATE this.users après avoir fait la requête axios
        },
        formatDate() {
            this.users.data = this.users.data.map(m => {
                m.ago = moment(m.date).fromNow();
                return m;
            });
        },
        getRegions() {
            this.$http
                .get("regions")
                .then(response => (this.regions = response.data));
        },
        loadingData(boolean) {
            if (boolean) {
                this.$vs.loading({
                    type: "default",
                    container: "#loadingFeed"
                });
            } else {
                this.$vs.loading.close("#loadingFeed > .con-vs-loading");
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
</style>
