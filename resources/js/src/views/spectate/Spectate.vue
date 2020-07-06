<template>
    <section>
        <!-- GRID VIEW -->
        <div class="items-grid-view vx-row match-height">
            <div class="vx-col">
                <vx-card class="grid-view-item mb-base overflow-hidden" v-on="$listeners">
                    <template slot="no-body">
                        <!-- ITEM IMAGE -->
                        <div
                            class="item-img-container bg-white h-64 flex items-center justify-center mb-4 cursor-pointer"
                        >
                            <img
                                src="https://ddragon.leagueoflegends.com/cdn/10.13.1/img/profileicon/4491.png"
                                class="grid-view-img px-4"
                            />
                        </div>
                        <div class="item-details px-4">
                            <!-- RATING & PRICE -->
                            <div class="flex justify-between items-center">
                                <div
                                    class="text-warning border border-solid border-warning flex py-1 px-2 rounded"
                                >
                                    <span class="text-sm mr-1">1</span>
                                    <feather-icon icon="StarIcon" svgClasses="h-4 w-4" />
                                </div>
                                <h6 class="font-bold">1</h6>
                            </div>

                            <!-- TITLE & DESCRIPTION -->
                            <div class="my-4">
                                <!-- @click="navigate_to_detail_view" -->
                                <h6
                                    class="truncate font-semibold mb-1 hover:text-primary cursor-pointer"
                                >sdgsdg</h6>
                                <p class="item-description truncate text-sm">sdgsdg</p>
                            </div>
                        </div>
                        <!-- SLOT: ACTION BUTTONS -->
                        <div class="flex flex-wrap">
                            <!-- PRIMARY BUTTON: ADD TO WISH LIST -->
                            <div
                                class="item-view-primary-action-btn p-3 flex flex-grow items-center justify-center cursor-pointer"
                            >
                                <feather-icon icon="HeartIcon" />

                                <span class="text-sm font-semibold ml-2">WISHLIST</span>
                            </div>

                            <!-- SECONDARY BUTTON: ADD-TO/VIEW-IN CART -->
                            <div
                                class="item-view-secondary-action-btn bg-primary p-3 flex flex-grow items-center justify-center text-white cursor-pointer"
                            >
                                <feather-icon icon="ShoppingBagIcon" svgClasses="h-4 w-4" />

                                <span class="text-sm font-semibold ml-2">ADD TO CART</span>
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
