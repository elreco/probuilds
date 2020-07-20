<!-- =========================================================================================
  File Name: TheNavbar.vue
  Description: Navbar component
  Component Name: TheNavbar
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div class="relative">
        <div class="vx-navbar-wrapper navbar-full p-0 vx-navbar-custom">
            <vs-navbar
                class="navbar-custom navbar-skelton"
                :class="navbarClasses"
                :style="navbarStyle"
                :color="navbarColor"
            >
                <router-link tag="div" to="/" class="vx-logo cursor-pointer flex items-center">
                    <logo class="w-10 mr-1 fill-current text-primary pt-0" />
                    <span class="vx-logo-text font-normal text-primary pt-1">EVIL</span>
                    <!--
                    -->
                    <span
                        class="vx-logo-text font-light text-gold text-shadow-gold-special pt-1"
                    >SPARTAN</span>
                    <!--
                    -->
                    <span class="vx-logo-text font-normal text-primary pt-1">.COM</span>
                </router-link>

                <search-bar />

                <i18n />
                <template v-if="user">
                    <notification-drop-down />
                    <profile-drop-down :user="user" />
                </template>

                <login-with-twitch v-else />
            </vs-navbar>
        </div>
    </div>
</template>

<script>
import Bookmarks from "./components/Bookmarks.vue";
import I18n from "./components/I18n.vue";
import SearchBar from "./components/SearchBar.vue";
import NotificationDropDown from "./components/NotificationDropDown.vue";
import ProfileDropDown from "./components/ProfileDropDown.vue";
import LoginWithTwitch from "./components/LoginWithTwitch.vue";
import Logo from "../Logo.vue";
import { mapGetters } from "vuex";

export default {
    name: "the-navbar-horizontal",
    props: {
        logo: {
            type: String
        },
        navbarType: {
            type: String,
            required: true
        }
    },
    components: {
        Logo,
        // Bookmarks,
        SearchBar,
        I18n,
        NotificationDropDown,
        ProfileDropDown,
        LoginWithTwitch
    },
    computed: {
        ...mapGetters({ user: "auth/user" }),
        navbarColor() {
            let color = "#fff";
            if (this.navbarType === "sticky") color = "#f7f7f7";
            else if (this.navbarType === "static") {
                if (this.scrollY < 50) {
                    color = "#f7f7f7";
                }
            }

            if (this.isThemedark === "dark") {
                if (color === "#fff") {
                    color = "#10163a";
                } else {
                    color = "#262c49";
                }
            }

            return color;
        },
        isThemedark() {
            return this.$store.state.theme;
        },
        navbarStyle() {
            return this.navbarType === "static"
                ? {
                      transition: "all .25s ease-in-out"
                  }
                : {};
        },
        navbarClasses() {
            return this.scrollY > 5 && this.navbarType === "static"
                ? null
                : "d-theme-dark-light-bg shadow-none vx-navbar-custom";
        },
        scrollY() {
            return this.$store.state.scrollY;
        },
        verticalNavMenuWidth() {
            return this.$store.state.verticalNavMenuWidth;
        },
        windowWidth() {
            return this.$store.state.windowWidth;
        }
    }
};
</script>
