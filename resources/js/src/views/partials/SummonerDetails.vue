<template>
    <div class="vx-row mb-base" id="page-user-view">
        <div class="vx-col w-full">
            <vx-card :title="champion.title">
                <!-- Avatar -->
                <div class="vx-row">
                    <!-- Avatar Col -->
                    <div class="vx-col" id="avatar-col">
                        <div class="img-container mb-4">
                            <img
                                :src="champion.src ? champion.src : srcIfNull"
                                class="rounded w-full"
                            />
                        </div>
                    </div>

                    <!-- Information - Col 1 -->
                    <div class="vx-col flex-1" id="account-info-col-1">
                        <table>
                            <tr>
                                <td class="font-semibold">Player</td>
                                <td>{{summonerName}}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Name</td>
                                <td>sdgdsgsdg</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Email</td>
                                <td>sdgsdgdsg</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /Information - Col 1 -->

                    <!-- Information - Col 2 -->
                    <div class="vx-col flex-1" id="account-info-col-2">
                        <table>
                            <tr>
                                <td class="font-semibold">Status</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Role</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Company</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /Information - Col 2 -->
                    <div class="vx-col w-full flex" id="account-manage-buttons">
                        <!--  <vs-button
                                icon-pack="feather"
                                icon="icon-edit"
                                class="mr-4"
                                :to="{name: 'app-user-edit', params: { userId: $route.params.userId }}"
                            >Edit</vs-button>
                            <vs-button
                                type="border"
                                color="danger"
                                icon-pack="feather"
                                icon="icon-trash"
                                @click="confirmDeleteRecord"
                        >Delete</vs-button>-->
                    </div>
                </div>
            </vx-card>
        </div>
    </div>
</template>

<script>
export default {
    name: "summoner-details",
    props: ["champion", "summonerName"],
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png")
        };
    }
};
</script>