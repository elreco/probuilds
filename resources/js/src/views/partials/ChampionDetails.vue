<template>
    <vx-card
        class="vs-con-loading__container"
        id="championLoading"
        :card-background="'linear-gradient(120deg ,rgba(16,22,58,0.85), rgba(16,22,58,0.85)),no-repeat 100% 25%/100% url(' + data.splash + ')'"
        style="background-size: cover;"
    >
        <!-- Avatar -->
        <div class="vx-row mb-8">
            <div class="vx-col">
                <h4 class="text-white">{{ data.name }}</h4>
                <p>{{ data.title }}</p>
            </div>
        </div>
        <div class="vx-row mb-2">
            <!-- Avatar Col -->
            <div class="vx-col xl:mr-4 xl:mb-0 mb-base mx-auto" id="avatar-col">
                <div class="img-container relative">
                    <img
                        :src="data.src ? data.src : srcIfNull"
                        class="rounded w-full border-solid border-2 border-darker"
                    />
                </div>
            </div>

            <!-- Information - Col 1 -->
            <div class="vx-col flex-1 text-sm" id="account-info-col-1">
                <table>
                    <tr>
                        <td class="font-semibold text-white">{{$t('Champion.name')}}</td>
                        <td class="font-light">{{data.title}}</td>
                    </tr>

                    <tr>
                        <td class="font-semibold text-white">{{$t('Champion.description')}}</td>
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
</template>

<script>
export default {
    name: "champion-details",
    props: ["champion"],
    data() {
        return {
            srcIfNull: require("@assets/images/match/none_ban.png"),
            data: {
                name: " ",
                title: " "
            }
        };
    },
    mounted() {
        this.getChampion();
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
<style>
.img-container {
    width: 100px;
    height: 100px;
}
</style>