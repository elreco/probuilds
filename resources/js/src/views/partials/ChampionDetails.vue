<template>
    <div class="vx-col w-1/2 flex items-stretch">
        <vx-card
            :title="data.title"
            class="vs-con-loading__container"
            id="championLoading"
            :card-background="'linear-gradient(120deg ,rgba(16,22,58,0.85), rgba(16,22,58,0.85)),no-repeat center 25% url(' + data.splash + ')'"
        >
            <!-- Avatar -->
            <div class="vx-row">
                <!-- Avatar Col -->
                <div class="vx-col" id="avatar-col">
                    <div class="img-container mb-4">
                        <img
                            :src="data.src ? data.src : srcIfNull"
                            class="rounded w-full border-solid border-2 border-white"
                        />
                    </div>
                </div>

                <!-- Information - Col 1 -->
                <div class="vx-col flex-1" id="account-info-col-1">
                    <table>
                        <tr>
                            <td class="font-normal">{{$t('Champion.name')}}</td>
                            <td class="font-light">{{data.title}}</td>
                        </tr>

                        <tr>
                            <td class="font-normal">{{$t('Champion.description')}}</td>
                            <td class="font-light">{{data.description}}</td>
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
</template>

<script>
export default {
    name: "champion-details",
    props: ["champion"],
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png"),
            data: {
                title: " "
            }
        };
    },
    mounted() {
        this.getChampion();
    },
    watch: {
        champion: function(newVal, oldVal) {
            // watch it
            this.getChampion();
        }
    },
    methods: {
        getChampion() {
            // loading
            this.loadingData(true);
            this.$http
                .get(`champions/${this.champion}`, {
                    params: {
                        locale: this.$route.params.locale
                    }
                })
                .then(response => {
                    this.data = response.data;
                })
                .then(() => {
                    this.loadingData(false);
                });

            // UPDATE this.users après avoir fait la requête axios
        },
        loadingData(boolean) {
            if (boolean) {
                this.$vs.loading({
                    type: "default",
                    container: "#championLoading"
                });
            } else {
                this.$vs.loading.close("#championLoading > .con-vs-loading");
            }
        }
    }
};
</script>