<template>
    <div class="the-navbar__user-meta flex items-center" v-if="user.name">
        <div class="text-right leading-tight hidden sm:block">
            <p class="font-semibold">{{ user.name }}</p>
            <small>Available</small>
        </div>

        <vs-dropdown vs-custom-content vs-trigger-click class="cursor-pointer">
            <div class="con-img ml-3">
                <img
                    v-if="user.avatar"
                    key="onlineImg"
                    :src="user.avatar"
                    alt="user-img"
                    width="40"
                    height="40"
                    class="rounded-full shadow-md cursor-pointer block"
                />
            </div>

            <vs-dropdown-menu class="vx-navbar-dropdown">
                <ul style="min-width: 9rem">
                    <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                        <feather-icon icon="UserIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Profile</span>
                    </li>

                    <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                        <feather-icon icon="MailIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Inbox</span>
                    </li>

                    <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                        <feather-icon icon="CheckSquareIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Tasks</span>
                    </li>

                    <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                        <feather-icon icon="MessageSquareIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Chat</span>
                    </li>

                    <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                        <feather-icon icon="HeartIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Wish List</span>
                    </li>

                    <vs-divider class="m-1" />

                    <li
                        class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white"
                        @click.prevent="logout"
                    >
                        <feather-icon icon="LogOutIcon" svgClasses="w-4 h-4" />
                        <span class="ml-2">Logout</span>
                    </li>
                </ul>
            </vs-dropdown-menu>
        </vs-dropdown>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    props: ["user"],
    methods: {
        async logout() {
            // Log out the user.
            await this.$store.dispatch("auth/logout").then(() => {
                this.$vs.notify({
                    title: this.$i18n.t("Message.logoutTitle"),
                    text: this.$i18n.t("Message.logoutMessage"),
                    color: "success",
                    position: "top-center"
                });

                this.$router.go(-1);
            });

            // Redirect to login.
            /* this.$router.go(); */
        }
    }
};
</script>
