<template>
<div>
    <div ref="twitchVideo" id="twitchVideo" class="m-base"></div>
</div>
</template>

<script>
import './v1.js'
export default {
    name: 'twitch-live',
    data() {
        return {
            player: null
        }
    },
    mounted() {
        const options = {
            width: 300,
            height: 180,
            channel: 'monstercat',
            layout: 'video',
            theme: 'dark'
        };
        // you might need to pass an ID string as a first argument..
        console.log(Twitch);
        this.player = new Twitch.Embed(this.$refs.twitchVideo, options);
        this.player.setVolume(0.5);
    }
};
</script>

<style media="screen">
#twitchVideo {
    z-index: 99999;
    position: fixed;
    padding: 2em;
    left: 90%;
    bottom: 0%;
    transform: translateX(-50%);
}
</style>
