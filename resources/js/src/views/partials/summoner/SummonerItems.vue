<template>
    <vx-card>
        <div class="text-center mb-base">
            <h4>{{ $t('Summoner.items') }}</h4>
            <p class="text-grey">{{ $t('Summoner.finalItems') }}</p>
        </div>
        <!-- Avatar -->
        <div class="vx-row ml-auto mr-auto w-3/4">
            <!-- Avatar Col -->
            <div
                class="vx-col w-1/2 lg:w-1/3 xl:w-1/6 mb-3 xl:mb-0 text-center"
                v-for="(item, index) in data"
                :key="index"
            >
                <popover-avatar-lg
                    :data="item"
                    :src="item.src"
                    :title="item.title"
                    :description="item.description"
                />
            </div>
        </div>
    </vx-card>
</template>

<script>
import PopoverAvatarLg from "@/components/popovers/PopoverAvatarLg";
export default {
    name: "summoner-items",
    components: {
        PopoverAvatarLg
    },
    props: ["data"]
};
</script>
