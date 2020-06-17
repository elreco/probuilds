<template>
    <div>
        <popover-avatar
            v-for="(item, index) in data"
            :key="index"
            :data="item"
            :src="item.src"
            :title="item.title"
            :description="item.description"
        />
    </div>
</template>

<script>
import PopoverAvatar from "@/components/popovers/PopoverAvatar";
export default {
    name: "summoner-items",
    components: {
        PopoverAvatar
    },
    props: ["data"]
};
</script>
