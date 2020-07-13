<template>
    <v-popover
        container="body"
        boundariesElement="body"
        trigger="hover"
        placement="auto"
        offset="5"
        class="inline"
        v-if="src"
        :content="getData(type, id)"
        :loadingContent="$t('SearchBanner.loading')"
    >
        <img
            loading="lazy"
            width="32"
            height="32"
            :alt="title"
            :class="classImg"
            class="tooltip-target w-16 h-16 rounded-lg shadow-primary"
            :src="src"
        />

        <template slot="popover">
            <vx-card class="mb-0 bg-primary" :title="title">
                <div class="vx-row">
                    <div class="vx-col w-1/5">
                        <img
                            :src="src"
                            class="w-12 h-12 border-solid border-2 rounded border-white mx-auto text-center"
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
        id: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true
        },
        src: {
            type: String,
            required: false,
            default: require("@assets/images/livefeed/unknown.png")
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
            srcIfNull: require("@assets/images/livefeed/unknown.png"),
            title: "",
            description: ""
        };
    },
    methods: {
        getData(type, id) {
            this.$http
                .get(`${type}/${id}`, {
                    params: {
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    this.title = response.data.name;
                    this.description = response.data.description;
                });
        }
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
