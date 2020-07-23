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
            error: this.$route.query.error ? this.$route.query.error : null,
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
        if (this.token) {
            this.$store
                .dispatch("auth/saveToken", {
                    token: this.token
                })
                .then(() => {
                    setTimeout(
                        () =>
                            this.$vs.notify({
                                title: this.$i18n.t("Message.loginTitle"),
                                text: this.$i18n.t("Message.loginMessage"),
                                color: "success",
                                position: "top-center"
                            }),
                        3000
                    );
                    setTimeout(() => this.$router.push(this.redirect), 3000);
                    setTimeout(() => this.$vs.loading.close(), 3000);
                });
        } else {
            this.$vs.loading.close();
            this.$vs.notify({
                title: "Login error",
                text: this.error,
                color: "warning",
                position: "top-center"
            });
            this.$router.push(this.redirect);
        }
    }
};
</script>