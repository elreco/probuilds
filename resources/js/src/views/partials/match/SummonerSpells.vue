<template>
    <vx-card>
        <div class="text-center mb-custom">
            <h4>{{ $t('Summoner.summoners') }}</h4>
        </div>
        <!-- Avatar -->
        <div class="vx-row ml-auto mr-auto w-3/4">
            <!-- Avatar Col -->
            <div
                class="vx-col w-full lg:w-1/2 xl:w-1/2 mb-3 xl:mb-0 text-center"
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
    name: "summoner-spells",
    components: {
        PopoverAvatarLg
    },
    props: ["data"]
};
</script>
<style>
.mb-custom {
    margin-bottom: 3.4rem;
}
</style>
