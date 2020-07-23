<template>
    <!-- $t('SearchBanner.loading') -->
    <v-popover
        container="body"
        boundariesElement="body"
        trigger="hover"
        placement="auto"
        offset="5"
        class="inline text-white"
        v-if="src"
        :content="getData(type, id)"
    >
        <div class="relative inline">
            <img
                loading="lazy"
                width="32"
                height="32"
                :alt="title"
                :class="classImg"
                class="tooltip-target w-10 h-10 rounded"
                :src="src"
            />
            <div v-if="sold">
                <div
                    loading="lazy"
                    width="32"
                    height="32"
                    :class="classImg"
                    class="w-10 h-10 rounded"
                    style="position:absolute;top:0;background:rgba(255,255,255,0.5);"
                ></div>
                <div
                    class="dot-count vs-avatar--count badgeNumber"
                    style="background: rgb(140, 23, 164);right:-8px;"
                >{{$t('Global.sold')}}</div>
            </div>
        </div>
        <template slot="popover">
            <vx-card class="mb-0 bg-primary">
                <div class="text-left mb-5">
                    <h4 class="text-white">{{ title ? title : ' ' }}</h4>
                </div>
                <div class="vx-row">
                    <div class="vx-col w-1/5">
                        <img
                            :src="src"
                            class="w-12 h-12 rounded border-solid border-2 border-white mx-auto text-center"
                        />
                    </div>
                    <div class="vx-col w-4/5 text-left" :class="{'lds-dual-ring ': isLoading }">
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
            class="inline tooltip-target w-10 h-10 rounded tooltip-target border-solid border-2 border-theme-dark"
        />
    </div>
</template>

<script>
export default {
    name: "popover-avatar",
    props: {
        default: {
            type: Boolean,
            default: true,
            required: false
        },
        src: {
            required: false
        },
        id: {
            required: false
        },
        type: {
            type: String,
            required: false
        },
        forceTitle: {
            type: String,
            required: false
        },
        forceDescription: {
            type: String,
            required: false
        },
        border: {
            type: String,
            default: "",
            required: false
        },
        sold: {
            type: Boolean,
            default: false,
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
            description: "",
            isLoading: true
        };
    },
    methods: {
        getData(type, id) {
            if (type && id) {
                this.$http
                    .get(`${type}/${id}`, {
                        params: {
                            locale: this.$route.params.locale
                        }
                    })
                    .then(response => {
                        this.title = response.data.name;
                        this.description = response.data.description;
                        this.isLoading = false;
                    });
            } else {
                this.description = this.forceDescription;
                this.title = this.forceTitle;
                this.isLoading = false;
            }
        }
    },
    computed: {
        classImg: function() {
            var classImg = "";

            if (this.title) {
                classImg = "tooltip-target";
            }

            if (this.default) {
                classImg += " border-solid border-2";
                if (this.border) {
                    classImg += " border-" + this.border;
                } else {
                    classImg += " border-theme-dark";
                }
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
