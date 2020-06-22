<template>
    <v-popover
        container="body"
        boundariesElement="body"
        trigger="hover"
        placement="auto"
        offset="5"
        class="inline"
        v-if="src"
    >
        <img
            loading="lazy"
            width="32"
            height="32"
            :alt="title"
            :class="classImg"
            class="tooltip-target w-16 h-16 rounded"
            :src="src"
        />

        <template slot="popover" v-if="title">
            <vx-card class="mb-0 bg-primary" :title="title">
                <div class="vx-row">
                    <div class="vx-col w-1/5">
                        <img
                            :src="src"
                            class="w-12 h-12 rounded border-solid border-2 border-white mx-auto text-center"
                        />
                    </div>
                    <div class="vx-col w-4/5 text-left">
                        <p class="text-white text-xs font-light text-shadow" v-html="description"></p>
                    </div>
                </div>
            </vx-card>
        </template>
    </v-popover>
    <div class="relative inline" v-else>
        <img
            loading="lazy"
            width="32"
            height="32"
            alt="None"
            :src="srcIfNull"
            class="tooltip-target mx-auto w-10 h-10 rounded tooltip-target border-solid border-2 border-theme-dark"
        />
    </div>
</template>

<script>
export default {
    name: "popover-avatar-lg",
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
                classImg += " border-solid border-2 border-primary";
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
