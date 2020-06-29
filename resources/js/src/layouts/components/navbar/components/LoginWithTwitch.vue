<template>
    <vs-button
        color="#9147FF"
        icon="fa-twitch"
        icon-pack="fab"
        type="relief"
        class="xl:ml-5 whitespace-no-wrap font-normal text-xs"
        @click="socialLogin('twitch')"
    >
        <span class="uppercase">Login</span>
        <span class="uppercase hidden xl:inline">with Twitch</span>
    </vs-button>
</template>

<script>
export default {
    name: "login-with-twitch",
    methods: {
        socialLogin(service) {
            window.location.href = `${process.env.MIX_APP_URL}/login/${service}?url=${this.$route.query.page}`;
        }
    }
};
</script>
