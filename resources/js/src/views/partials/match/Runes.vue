<template>
    <vx-card class="vs-con-loading__container" id="spellsLoading">
        <div class="text-center mb-custom">
            <!-- <h4>{{ $t('Rune.runes') }}</h4> -->
        </div>
        <div class="vx-row w-2/3 mx-auto flex items-stretch text-white">
            <div class="vx-col w-1/2">
                <div class="vx-row mb-base">
                    <div class="vx-col w-full">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img :src="data.first.principal.src" class="mr-8 rounded h-10 w-10" />
                            <div class>
                                <p
                                    class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                                >{{data.first.principal.name}}</p>
                                <p class="text-sm font-light mb-2 mt-4 sm:mt-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col w-full">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                :src="data.first.rune0.src ? data.first.rune0.src : srcIfNull"
                                class="mr-8 rounded h-24 w-24"
                            />
                            <div>
                                <p
                                    class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune0.name}}</p>
                                <p
                                    class="text-sm font-light mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune0.description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="vx-col w-full" v-for="n in firstRunesNumbers" :key="n">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                :src="data.first.['rune' + n].src ? data.first.rune0.src : srcIfNull"
                                class="mr-8 rounded h-24 w-24"
                            />
                            <div>
                                <p
                                    class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune0.name}}</p>
                                <p
                                    class="text-sm font-light mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune0.description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vx-col w-1/2"></div>
        </div>
    </vx-card>
</template>

<script>
import PopoverAvatar from "@/components/popovers/PopoverAvatar";

export default {
    name: "runes",
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png"),
            firstRunesNumbers: [1, 2, 3],
            secondRunesNumbers: [4, 5]
        };
    },
    components: {
        PopoverAvatar
    },
    props: ["data"],
    mounted() {
        /* console.log(this.data); */
    }
};
</script>
