<template>
<v-popover container="body" trigger="hover" placement="auto" class="inline">
    <img loading="lazy" width="32" height="32" :alt="title" :class="classImg" class="tooltip-target w-10 h-10 rounded" :src="src" />

    <template slot="popover" v-if="title">
        <vs-card class="mb-0">
            <div slot="header">
                <h3>
                    {{title}}
                </h3>
            </div>
            <vs-row>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="4">
                    <div class="img-container">
                        <img :src="src" class="rounded w-16 h-16">
                    </div>
                </vs-col>
                <vs-col vs-type="flex" vs-justify="center" vs-align="center" vs-w="8">
                    <p v-html="description">
                    </p>
                </vs-col>
            </vs-row>
        </vs-card>

    </template>
</v-popover>
</template>

<script>
export default {
    name: 'popover-avatar',
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
            default: ''
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
    computed: {
        classImg: function() {
            var classImg = ""

            if (this.title) {
                classImg = 'tooltip-target'
            }

            if (this.default) {
                classImg += ' border-solid border-2 border-theme-dark'
            } else {
                if (this.win) {
                    classImg += ' border-solid border-2 win-border win-shadow'
                } else {
                    classImg += ' border-solid border-2 lose-border lose-shadow'
                }
            }
            return classImg
        }
    }

}
</script>

<style lang="scss">
@import "@sass/components/popoverAvatar.scss";
</style>
