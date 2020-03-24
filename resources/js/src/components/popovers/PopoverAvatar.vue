<template>
<v-popover container="body" trigger="hover" placement="auto" class="inline">
    <img class="tooltip-target w-10 h-10 rounded" :src="src" />
    <template slot="popover">
        <vs-card>
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
            required: true
        },
        src: {
            type: String,
            default: ''
        },
        description: {
            type: String,
            default: ''
        }
    },

}
</script>

<style lang="scss">
@import "@sass/components/popoverAvatar.scss";
</style>
