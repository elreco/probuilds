<template>
    <vx-card class="vs-con-loading__container" id="spellsLoading">
        <div class="text-center mb-custom">
            <h4>{{ $t('Rune.runes') }}</h4>
        </div>
        <div class="vx-row w-full xl:w-2/3 mx-auto flex items-stretch text-white">
            <div class="vx-col w-full lg:w-1/2">
                <div class="vx-row mb-base">
                    <div class="vx-col w-full">
                        <div class="text-center">
                            <div>
                                <img
                                    :src=" data.first.principal.src ? data.first.principal.src : srcIfNull"
                                    class="mx-auto h-8 w-8 mb-3"
                                />
                            </div>
                            <p
                                class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                            >{{data.first.principal.name}}</p>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col w-full mb-base">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                :src="data.first.rune[0].src ? data.first.rune[0].src : srcIfNull"
                                class="mr-8 rounded-full h-24 w-24"
                            />
                            <div>
                                <p
                                    class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune[0].name}}</p>
                                <p
                                    class="text-sm font-light mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune[0].description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="vx-col w-full mb-base" v-for="n in firstRunesNumbers" :key="n">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                :src="data.first.rune[n].src ? data.first.rune[n].src : srcIfNull"
                                class="mr-8 rounded-full border-solid border-2 border-darker h-12 w-12"
                            />
                            <div>
                                <p
                                    class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune[n].name}}</p>
                                <p
                                    class="text-sm font-light mb-2 mt-4 sm:mt-0"
                                >{{data.first.rune[n].description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="vx-col w-full lg:w-1/2 pl-10">
                <div class="vx-row mb-base">
                    <div class="vx-col w-full">
                        <div class="text-center">
                            <div>
                                <img
                                    :src="data.second.principal.src ? data.second.principal.src : srcIfNull"
                                    class="mx-auto h-8 w-8 mb-3"
                                />
                            </div>
                            <p
                                class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                            >{{data.second.principal.name}}</p>
                        </div>
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col w-full mb-base" v-for="n in secondRunesNumbers" :key="n">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                :src="data.second.rune[n].src ? data.second.rune[n].src : srcIfNull"
                                class="mr-8 rounded-full border-solid border-2 border-darker h-12 w-12"
                            />
                            <div>
                                <p
                                    class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                                >{{data.second.rune[n].name}}</p>
                                <p
                                    class="text-sm font-light mb-2 mt-4 sm:mt-0"
                                >{{data.second.rune[n].description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="vx-col w-full mb-base" v-for="n in thirdRunesNumbers" :key="n">
                        <div class="flex items-start flex-col sm:flex-row">
                            <img
                                :src="data.third[n].src ? data.third[n].src : srcIfNull"
                                class="mr-8 rounded-full border-solid border-2 border-darker h-8 w-8"
                            />
                            <div>
                                <p
                                    class="text-lg font-medium mb-2 mt-4 sm:mt-0"
                                    v-if="data.third[n].name"
                                >{{$t('Special.' + data.third[n].name)}}</p>
                                <p
                                    class="text-sm font-light mb-2 mt-4 sm:mt-0"
                                >{{data.third[n].description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            secondRunesNumbers: [4, 5],
            thirdRunesNumbers: [0, 1, 2]
        };
    },
    components: {
        PopoverAvatar
    },
    props: {
        data: Object
    }
};
</script>
