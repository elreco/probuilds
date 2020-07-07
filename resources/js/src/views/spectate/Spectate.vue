<template>
    <section>
        <!-- GRID VIEW -->
        <div class="items-grid-view vx-row match-height">
            <div class="vx-col w-1/6">
                <vx-card class="grid-view-item mb-base overflow-hidden">
                    <template slot="no-body">
                        <!-- ITEM IMAGE -->
                        <div
                            class="item-img-container mx-auto flex items-center justify-center my-4 cursor-pointer"
                        >
                            <img
                                src="https://ddragon.leagueoflegends.com/cdn/10.13.1/img/champion/Nidalee.png"
                                class="rounded-full grid-view-img w-16 h-16"
                            />
                        </div>
                        <div class="item-details px-4">
                            <!-- RATING & PRICE -->
                            <div class="flex justify-between items-center">
                                <div
                                    class="text-warning border border-solid border-warning flex py-1 px-2 rounded"
                                >
                                    <feather-icon icon="VideoIcon" svgClasses="h-4 w-4" />
                                    <span class="text-sm ml-1">28:18</span>
                                </div>
                                <h6 class="font-bold">Nidalee</h6>
                            </div>

                            <!-- TITLE & DESCRIPTION -->
                            <div class="my-4 text-center">
                                <!-- @click="navigate_to_detail_view" -->
                                <h6
                                    class="truncate font-semibold mb-1 hover:text-primary cursor-pointer"
                                >GOSU</h6>
                                <p class="item-description truncate text-sm">Match classé</p>
                            </div>
                        </div>
                        <!-- SLOT: ACTION BUTTONS -->
                        <div class="flex flex-wrap">
                            <!-- PRIMARY BUTTON: ADD TO WISH LIST -->
                            <!-- <div
                                class="item-view-primary-action-btn p-3 flex flex-grow items-center justify-center cursor-pointer"
                            >
                                <feather-icon icon="HeartIcon" />

                                <span class="text-sm font-semibold ml-2">WISHLIST</span>
                            </div>
                            -->
                            <!-- SECONDARY BUTTON: ADD-TO/VIEW-IN CART -->
                            <div
                                class="item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer"
                            >
                                <feather-icon icon="EyeIcon" svgClasses="h-4 w-4" />

                                <span class="text-sm font-semibold ml-2">REGARDER</span>
                            </div>
                        </div>
                    </template>
                </vx-card>
            </div>
        </div>
    </section>
</template>

<script>
import SearchBanner from "@/views/main/partials/SearchBanner";

export default {
    data() {
        return {
            title: this.$i18n.t("meta.title.home")
        };
    },
    components: {
        SearchBanner
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
