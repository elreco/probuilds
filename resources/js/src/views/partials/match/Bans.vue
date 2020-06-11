<template >
    <div class="flex items-center">
        <div class="flex items-center">
            <span>{{$t('Match.bans')}}</span>
        </div>
        <ul class="user-list mt-2 mr-2 ml-3 sm:ml-6">
            <li :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                <vx-tooltip :text="tr.title ? tr.title : titleIfNull" position="bottom">
                    <vs-avatar
                        :src="tr.src ? tr.src : srcIfNull"
                        size="30px"
                        class="border-2 border-white border-solid -m-1"
                    ></vs-avatar>
                </vx-tooltip>
            </li>
        </ul>
    </div>
</template>


<script>
export default {
    name: "bans",
    props: ["data"],
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png"),
            titleIfNull: this.$i18n.t("Match.titleIfNull")
        };
    }
};
</script>