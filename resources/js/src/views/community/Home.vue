<template>
    <section id="dashboard-analytics">
        <vx-tour :steps="steps" v-if="windowWidth >= 1200" />
        <div class="vx-row">
            <!-- CARD 1: CONGRATS -->
            <div class="vx-col w-full mb-base">
                <search-banner :displayDecore="true">
                    <template v-slot:default>
                        <h1 class="mb-4 text-white">SOON</h1>
                        <p
                            class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white"
                            v-html="'SOON'"
                        ></p>
                    </template>
                </search-banner>
            </div>
        </div>
    </section>
</template>

<script>
import SearchBanner from "@/views/main/partials/SearchBanner";

const VxTour = () => import("@/components/VxTour.vue");

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.home"),
            steps: [
                {
                    target: "#btnLogin",
                    content: "Toggle Collapse Sidebar."
                }
            ]
        };
    },
    components: {
        SearchBanner,
        VxTour
    },
    computed: {
        windowWidth() {
            return this.$store.state.windowWidth;
        }
    },
    metaInfo() {
        // if no subcomponents specify a metaInfo.title, this title will be used
        return {
            title: `${this.title}`,
            // all titles will be injected into this template
            titleTemplate: "EvilSpartan.com – %s"
        };
    }
};
</script>
