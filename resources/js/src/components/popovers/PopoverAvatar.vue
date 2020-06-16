<template>
    <v-popover container="body" trigger="hover" placement="auto" class="inline" v-if="src">
        <img
            loading="lazy"
            width="32"
            height="32"
            :alt="title"
            :class="classImg"
            class="tooltip-target w-10 h-10 rounded"
            :src="src"
        />

        <template slot="popover" v-if="title">
            <vx-card class="mb-0" :title="title">
                <vs-row>
                    <vs-col vs-type="flex" vs-justify="center" vs-w="2">
                        <div class="img-container">
                            <img
                                :src="src"
                                class="w-10 h-10 rounded border-solid border-2 border-white"
                            />
                        </div>
                    </vs-col>
                    <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="10">
                        <p class="text-white text-xs font-light" v-html="description"></p>
                    </vs-col>
                </vs-row>
            </vx-card>
        </template>
    </v-popover>
    <div class="relative inline" v-else>
        <img
            loading="lazy"
            width="32"
            height="32"
            alt="Kai'Sa"
            :src="srcIfNull"
            class="tooltip-target w-10 h-10 rounded tooltip-target border-solid border-2 border-white"
        />
    </div>
</template>

<script>
export default {
    name: "popover-avatar",
    props: {
        title: {
            type: String,
            required: false
        },
        src: {
            type: String,
            required: false,
            default: require("@assets/images/livefeed/unknown.png")
        },
        description: {
            type: String,
            required: false,
            default: ""
        },
        default: {
            type: Boolean,
            default: true,
            required: false
        },
        win: {
            type: Boolean,
            default: false,
            required: false
        }
    },
    data() {
        return {
            srcIfNull: require("@assets/images/livefeed/unknown.png")
        };
    },
    computed: {
        classImg: function() {
            var classImg = "";

            if (this.title) {
                classImg = "tooltip-target";
            }

            if (this.default) {
                classImg += " border-solid border-2 border-theme-dark";
            } else {
                if (this.win) {
                    classImg += " border-solid border-2 win-border win-shadow";
                } else {
                    classImg +=
                        " border-solid border-2 lose-border lose-shadow";
                }
            }
            return classImg;
        }
    }
};
</script>

<style lang="scss">
@import "@sass/components/popoverAvatar.scss";
</style>
