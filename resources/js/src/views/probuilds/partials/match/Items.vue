<template>
    <vx-card>
        <div class="text-center mb-base">
            <h4>{{ $t('Summoner.items') }}</h4>
            <p class="text-grey">{{ $t('Summoner.finalItems') }}</p>
        </div>
        <!-- Avatar -->
        <div class="vx-row ml-auto mr-auto w-full" id="items">
            <!-- Avatar Col -->
            <div
                class="vx-col mx-auto w-1/2 lg:w-1/3 xl:w-1/6 mb-3 xl:mb-0 text-center"
                v-for="(item, index) in data"
                :key="index"
            >
                <popover-avatar-lg :src="item.src" :id="item.id" type="items" />
                <p class="text-center text-xs text-white mt-1">{{item.title}}</p>
            </div>
        </div>
    </vx-card>
</template>

<script>
import PopoverAvatarLg from "@/components/popovers/PopoverAvatarLg";
export default {
    name: "items",
    components: {
        PopoverAvatarLg
    },
    props: ["data"]
};
</script>

