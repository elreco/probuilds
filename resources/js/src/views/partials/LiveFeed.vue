<template>
<vx-card>
    <div class="vx-col w-full">
        <vs-navbar active-text-color="rgba(255,255,255,1)" text-color v-model="selectedLane" class="nabarx mb-base lane-selection p-2" type="flat">
            <div slot="title">
                <vs-navbar-title>
                    {{ $t("LiveFeed.title") }}
                </vs-navbar-title>
            </div>
            <vs-navbar-item index="0">
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
            <v-select id="loadingSelect" :clearable="false" :value="selectedRegion" :options="regions" :placeholder="selectedRegion" class="w-48" v-model="selectedRegion" />
        </vs-navbar>
        <vs-table noDataText="" :sst="true" @change-page="handleChangePage" :max-items="users.maxItems" :total="users.totalItems" pagination :data="users.data" @selected="handleSelected" id="loadingFeed">

            <template slot="thead">
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th>{{ $t("LiveFeed.player") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.vs") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.kda") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.gold") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.keystone") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.build") }}</vs-th>
                <vs-th></vs-th>
            </template>

            <template slot-scope="{data}">

                <vs-tr class="whitespace-no-wrap" :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="data[indextr].date">
                        {{ data[indextr].date | moment("from", "now") }}
                    </vs-td>
                    <vs-td :data="data[indextr].champion">
                        <popover-avatar :win="data[indextr].win" :default="false" :src="data[indextr].champion.src" :title="data[indextr].champion.title" :description="data[indextr].champion.description" />
                    </vs-td>
                    <vs-td :data="data[indextr].player">
                        <vs-chip color="primary">
                            <vs-avatar :src="data[indextr].player.icon" />
                            {{ data[indextr].player.name }}
                        </vs-chip>
                    </vs-td>
                    <vs-td :data="data[indextr].vs">
                        <popover-avatar :src="data[indextr].vs.src" :title="data[indextr].vs.title" :description="data[indextr].vs.description" />
                    </vs-td>
                    <vs-td :data="data[indextr].kda">
                        {{ data[indextr].kda }}
                    </vs-td>
                    <vs-td :data="data[indextr].gold">
                        {{ data[indextr].gold }}
                    </vs-td>
                    <vs-td :data="data[indextr].keystone">
                        <div class="relative inline">
                            <vs-avatar :src="data[indextr].keystone" />
                            <img class="supperposed-avatar rounded" :src="data[indextr].subkeystone" />
                        </div>
                    </vs-td>
                    <vs-td :data="data[indextr].slots">
                        <popover-avatar v-for="(slot, index) in data[indextr].slots" :key="index" :data="slot" :src="slot.src" :title="slot.title" :description="slot.description" />

                        <div v-for="n in 6-Object.keys(data[indextr].slots).length" class="inline-block w-10 h-10 rounded bg-theme-dark mr-1">
                        </div>

                    </vs-td>
                    <vs-td :data="data[indextr].spells">
                        <popover-avatar v-for="(spell, index) in data[indextr].spells" :key="index" :data="spell" :src="spell.src" :title="spell.title" :description="spell.description" />
                    </vs-td>
                </vs-tr>
            </template>
        </vs-table>
    </div>
</vx-card>
</template>
<script>
import PopoverAvatar from '../../components/popovers/PopoverAvatar'
export default {
    data() {
        return {
            selectedLane: 0,
            selectedRegion: "EUW",
            page: 1,
            regions: [],
            activeLoading: false,
            totalItems: 0,
            users: {
                'data': [],
                'totalItems': 1,
                'maxItems': 1
            },
        }
    },
    mounted() {
        this.getFeed()
        this.getRegions()
    },
    methods: {
        handleSelected(tr) {
            this.$vs.notify({
                title: `Selected ${tr.username}`,
                text: `Email: ${tr.email}`
            })
            this.$router.push({
                name: 'show-match',
                params: {
                    'region': tr.date,
                    'match_id': tr.date
                }
            })
        },
        handleChangePage(page) {
            this.page = page
            this.getFeed()
        },
        getFeed() {
            // loading
            this.$vs.loading({
                type: 'material',
                container: '#loadingFeed',
            })
            this.$http.get('/api/livefeed', {
                    params: {
                        page: this.page,
                        lane: this.selectedLane,
                        region: this.selectedRegion,
                    }
                })
                .then(response => (this.users = response.data))
                .then(() => {
                    this.$vs.loading.close('#loadingFeed > .con-vs-loading')
                })
            // UPDATE this.users après avoir fait la requête axios
        },
        getRegions() {
            this.$http.get('/api/regions')
                .then(response => (this.regions = response.data))
        }

    },
    computed: {
        filterTable: function() {
            const selectedLane = this.selectedLane
            const selectedRegion = this.selectedRegion

            return {
                selectedLane,
                selectedRegion
            }
        }
    },
    watch: {
        filterTable: function() {
            this.getFeed()
        },
    },
    components: {
        PopoverAvatar
    }
}
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
  width: 100%
}
@media (max-width: 550px) {
  .con-select {
    flex-direction: column;
  }
  .con-select .vs-select {
    width: 100%
  }
}
</style>
