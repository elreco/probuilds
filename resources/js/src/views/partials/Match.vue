<template>
    <vs-table noDataText :sst="true" :data="data" id="loadingFeed">
        <template slot="thead">
            <vs-th></vs-th>
            <vs-th>{{ $t("LiveFeed.player") }}</vs-th>
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
            >
                <vs-td :data="data[indextr].champion">
                    <popover-avatar
                        :win="data[indextr].win"
                        :default="false"
                        :src="data[indextr].champion.src"
                        :title="data[indextr].champion.title"
                        :description="data[indextr].champion.description"
                    />
                </vs-td>
                <vs-td :data="data[indextr].player">
                    <vs-chip color="primary">
                        <vs-avatar :src="data[indextr].player.icon" />
                        {{ data[indextr].player.name }}
                    </vs-chip>
                </vs-td>
                <vs-td :data="data[indextr].kda">{{ data[indextr].kda }}</vs-td>
                <vs-td :data="data[indextr].gold">{{ data[indextr].gold }}</vs-td>
                <vs-td :data="data[indextr].keystone">
                    <div class="relative inline">
                        <vs-avatar :src="data[indextr].keystone" />
                        <img class="supperposed-avatar rounded" :src="data[indextr].subkeystone" />
                    </div>
                </vs-td>
                <vs-td :data="data[indextr].slots">
                    <popover-avatar
                        v-for="(slot, index) in data[indextr].slots"
                        :key="index"
                        :data="slot"
                        :src="slot.src"
                        :title="slot.title"
                        :description="slot.description"
                    />

                    <div
                        v-for="n in 6-Object.keys(data[indextr].slots).length"
                        :key="n + 100"
                        class="inline-block w-10 h-10 rounded bg-theme-dark mr-1"
                    ></div>
                </vs-td>
                <vs-td :data="data[indextr].spells">
                    <popover-avatar
                        v-for="(spell, index) in data[indextr].spells"
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
import PopoverAvatar from "../../components/popovers/PopoverAvatar";
export default {
    name: "match",
    components: {
        PopoverAvatar
    },
    props: ["data"]
};
</script>