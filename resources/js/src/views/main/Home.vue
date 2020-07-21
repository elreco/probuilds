<template>
    <section id="dashboard-analytics">
        <div class="vx-row">
            <!-- CARD 1: CONGRATS -->
            <div class="vx-col w-full mb-base">
                <search-banner :displayDecore="true">
                    <template v-slot:default>
                        <h1 class="mb-4 text-white">{{ $t("home.welcomeBrand") }}</h1>
                        <p
                            class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white"
                            v-html="$t('home.welcomeTextBrand')"
                        ></p>
                    </template>
                </search-banner>
            </div>
            <div class="vx-col w-full">
                <vx-card content-color="#fff">
                    <!-- CARD 1: CONGRATS -->
                    <div class="vx-row mb-8">
                        <div class="vx-col">
                            <h4 class="text-white">{{$t('LiveFeed.probuilds')}}</h4>
                            <p class="text-gold font-light">{{$t('LiveFeed.probuildsTitle')}}</p>
                        </div>
                    </div>
                    <live-feed />
                </vx-card>
            </div>
        </div>
    </section>
</template>

<script>
import SearchBanner from "./partials/SearchBanner";
import LiveFeed from "@/views/probuilds/partials/LiveFeed";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.home")
        };
    },
    components: {
        SearchBanner,
        LiveFeed
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
