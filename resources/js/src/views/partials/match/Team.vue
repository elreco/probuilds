<template  slot="no-body">
    <vs-table class="w-full" noDataText :sst="true" :data="data" @selected="handleSelected">
        <template slot="thead">
            <vs-th></vs-th>
            <vs-th>{{ $t("LiveFeed.player") }}</vs-th>
            <vs-th>{{ $t("LiveFeed.level") }}</vs-th>
            <vs-th>{{ $t("LiveFeed.kda") }}</vs-th>
            <vs-th>{{ $t("LiveFeed.gold") }}</vs-th>
            <vs-th>{{ $t("LiveFeed.keystone") }}</vs-th>
            <vs-th>{{ $t("LiveFeed.build") }}</vs-th>
            <vs-th></vs-th>
        </template>

        <template slot-scope="{data}">
            <vs-tr
                class="whitespace-no-wrap"
                :data="tr"
                :key="indextr"
                v-for="(tr, indextr) in data"
                :state="tr.summonerId == summonerId?'primary':null"
            >
                <vs-td :data="tr.champion">
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
                <vs-td :data="tr.level">{{ tr.level }}</vs-td>
                <vs-td :data="tr.kda">{{ tr.kda }}</vs-td>
                <vs-td :data="tr.gold">{{ tr.gold }}</vs-td>
                <vs-td :data="tr.keystone">
                    <div class="relative inline">
                        <vs-avatar :src="tr.keystone" />
                        <img class="supperposed-avatar rounded" :src="tr.subkeystone" />
                    </div>
                </vs-td>
                <vs-td :data="tr.slots">
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
                <vs-td :data="tr.spells">
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
                name: "matchs",
                params: {
                    region: this.region,
                    summonerId: tr.summonerId,
                    matchId: this.matchId
                }
            });
        }
    }
};
</script>