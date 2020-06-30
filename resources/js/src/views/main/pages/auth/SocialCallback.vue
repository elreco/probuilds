<template>
    <div class="h-screen flex w-full text-white">
        <div
            class="vx-col flex items-center justify-center flex-col sm:w-1/2 md:w-3/5 lg:w-3/4 xl:w-1/2 mx-auto text-center"
        >
            <h1 class="text-5xl">{{$t('Message.loginWaitTitle')}}</h1>
            <p style="margin-bottom:10rem;">{{$t('Message.loginWaitMessage')}}.</p>
        </div>
    </div>
</template>

<script>
export default {
    /* middleware: ["guest"], */
    data() {
        return {
            token: this.$route.query.token ? this.$route.query.token : null,
            redirect: this.$route.query.redirect
                ? this.$route.query.redirect
                : "/"
        };
    },
    mounted() {
        this.$vs.loading({
            type: "default",
            background: "transparent"
        });
    }
};
</script>