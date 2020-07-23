<template>
    <section id="dashboard-analytics">
        <vx-tour :steps="steps" v-if="windowWidth >= 1200 && !user" />
        <div class="vx-row">
            <!-- CARD 1: CONGRATS -->
            <div class="vx-col w-full mb-base">
                <search-banner :displayDecore="true">
                    <template v-slot:default>
                        <h1 class="mb-4 text-white">{{$t('Community.title')}}</h1>
                        <p
                            class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white"
                            v-html="$t('Community.description')"
                        ></p>
                    </template>
                </search-banner>
            </div>
        </div>
        <div class="bg-warning text-white px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg
                        class="fill-current h-6 w-6 text-teal-500 mr-4"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                    >
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                        />
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{$t('Message.notAvailable')}}</p>
                    <p class="text-sm" v-html="$t('Message.notAvailableDescription')"></p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import SearchBanner from "@/views/main/partials/SearchBanner";
import { mapGetters } from "vuex";

const VxTour = () => import("@/components/VxTour.vue");

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.community"),
            description: this.$i18n.t("meta.description.community"),
            steps: [
                {
                    target: "#btnLogin",
                    content: this.$i18n.t("Message.tourLoginMessage")
                }
            ]
        };
    },
    components: {
        SearchBanner,
        VxTour
    },
    computed: {
        ...mapGetters({ user: "auth/user" }),
        windowWidth() {
            return this.$store.state.windowWidth;
        }
    },
    metaInfo() {
        // if no subcomponents specify a metaInfo.title, this title will be used
        return {
            title: `${this.title}`,
            // all titles will be injected into this template
            titleTemplate: "EvilSpartan.com – %s",
            meta: [
                { name: "description", content: `${this.description}` },
                {
                    property: "og:title",
                    content: `${this.title}`
                },
                { property: "og:site_name", content: "EvilSpartan.com" },
                { property: "og:type", content: "website" },
                { name: "robots", content: "index,follow" }
            ]
        };
    }
};
</script>
