<template  slot="no-body">
    <vs-table class="w-full" noDataText :sst="true" :data="data" @selected="handleSelected">
        <template slot="thead">
            <vs-th></vs-th>
            <vs-th>{{ $t("LiveFeed.player") }}</vs-th>
            <vs-th class="text-center">{{ $t("LiveFeed.level") }}</vs-th>
            <vs-th class="text-center">{{ $t("LiveFeed.kda") }}</vs-th>
            <vs-th class="text-center">{{ $t("LiveFeed.gold") }}</vs-th>
            <vs-th class="text-center">{{ $t("LiveFeed.keystone") }}</vs-th>
            <vs-th class="text-center">{{ $t("LiveFeed.build") }}</vs-th>
            <vs-th class="text-center">{{ $t("LiveFeed.summoners") }}</vs-th>
        </template>

        <template slot-scope="{data}">
            <vs-tr
                class="whitespace-no-wrap text-base text-center"
                :data="tr"
                :key="indextr"
                v-for="(tr, indextr) in data"
                :state="tr.summonerId == summonerId?'primary':null"
            >
                <vs-td class="text-center" :data="tr.champion">
                    <popover-avatar
                        :win="tr.win"
                        :default="false"
                        :src="tr.champion.src"
                        :id="tr.champion.id"
                        type="champions"
                    />
                </vs-td>
                <vs-td class="text-center" :data="tr.player">
                    <vs-chip color="primary">
                        <vs-avatar :src="tr.player.icon" />
                        {{ tr.player.name }}
                    </vs-chip>
                </vs-td>
                <vs-td class="text-center" :data="tr.level">{{ tr.level }}</vs-td>
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
            </vs-tr>
        </template>
    </vs-table>
</template>


<script>
// Search Input
import PopoverAvatar from "@/components/popovers/PopoverAvatar";
export default {
    name: "team",
    components: {
        PopoverAvatar
    },
    props: ["data", "summonerId", "region", "matchId"],
    methods: {
        handleSelected(tr) {
            this.$router.push({
                name: "probuilds.matches",
                params: {
                    region: this.region,
                    summonerId: tr.summonerId,
                    matchId: this.matchId,
                    champion: tr.champion.id,
                    participantId: tr.participantId
                }
            });
        }
    }
};
</script>