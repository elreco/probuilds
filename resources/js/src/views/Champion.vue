<template>
    <section id="dashboard-analytics">
        <div class="vx-row" id="page-user-view">
            <!-- CARD 1: CONGRATS -->
            <div class="vx-col xl:w-1/2 w-full mb-base flex items-stretch">
                <search-banner :displayDecore="false">
                    <template v-slot:default>
                        <h1 class="mb-4 text-white">{{ $t("home.welcome") }}</h1>
                        <p
                            class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white"
                            v-html="$t('home.welcomeText')"
                        ></p>
                    </template>
                </search-banner>
            </div>
            <div class="vx-col xl:w-1/2 w-full mb-base flex items-stretch">
                <champion-details :champion="champion" />
            </div>
        </div>
        <div class="vx-row">
            <!-- CARD 1: CONGRATS -->
            <div class="vx-col w-full">
                <live-feed :champion="champion" />
            </div>
        </div>
    </section>
</template>

<script>
import LiveFeed from "./partials/LiveFeed";
import SearchBanner from "./partials/SearchBanner";
import ChampionDetails from "./partials/ChampionDetails";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.home"),
            champion: this.$route.params.champion,
            isFetching: true
        };
    },
    components: {
        LiveFeed,
        SearchBanner,
        ChampionDetails
    },
    /* methods: {
        checkChampion() {
            // check if champion exists
            // if exists
            this.loadingData(true);
            return this.$http
                .get("champions-check", {
                    params: {
                        name: this.$route.params.champion,
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    return this.setChampion(response.data);
                });

            // else if not exist
            // 404
        },
        setChampion(champion) {
            this.champion = champion;
            this.loadingData(false);
        },
        loadingData(boolean) {
            this.isFetching = boolean;
            if (this.isFetching) {
                this.$vs.loading({
                    type: "default",
                    container: "body"
                });
            } else {
                this.$vs.loading.close("body > .con-vs-loading");
            }
        }
    }, */
    metaInfo() {
        // if no subcomponents specify a metaInfo.title, this title will be used
        return {
            title: `${this.title}`,
            // all titles will be injected into this template
            titleTemplate: "Probuilds.eu – %s"
        };
    }
};
</script>

<style lang="scss">
#avatar-col {
    width: 8rem;
}

#page-user-view {
    table {
        td {
            vertical-align: top;
            min-width: 140px;
            padding-bottom: 0.8rem;
            word-break: break-all;
        }

        &:not(.permissions-table) {
            td {
                @media screen and (max-width: 370px) {
                    display: block;
                }
            }
        }
    }
}

// #account-info-col-1 {
//   // flex-grow: 1;
//   width: 30rem !important;
//   @media screen and (min-width:1200px) {
//     & {
//       flex-grow: unset !important;
//     }
//   }
// }

@media screen and (min-width: 1201px) and (max-width: 1211px),
    only screen and (min-width: 636px) and (max-width: 991px) {
    #account-info-col-1 {
        width: calc(100% - 12rem) !important;
    }

    // #account-manage-buttons {
    //   width: 12rem !important;
    //   flex-direction: column;

    //   > button {
    //     margin-right: 0 !important;
    //     margin-bottom: 1rem;
    //   }
    // }
}
</style>