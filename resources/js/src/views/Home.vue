<template>
    <section id="dashboard-analytics">
        <div class="vx-row">

            <!-- CARD 1: CONGRATS -->
            <div class="vx-col w-full mb-base">

                <vx-card slot="no-body" class="text-center bg-primary-gradient greet-user">
                    <ul class="circles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <img :src="images.raka" class="decore-left" alt="card-img-left">
                    <img :src="images.leona" class="decore-right" alt="card-img-right">
                    <h1 class="mb-6 text-white">{{ $t("demoText") }},</h1>
                    <p class="xl:w-3/4 lg:w-4/5 md:w-2/3 w-4/5 mx-auto text-white">You have done <strong></strong> more sales today. Check your new badge in your profile.</p>
                </vx-card>
            </div>
        </div>

    </section>
</template>
<script>
export default {
    data() {
        return {
            images: {
                raka: require("@assets/images/home/home_raka.png"),
                leona: require("@assets/images/home/home_leona.png"),
            }
        }
    }
}
</script>
<style lang="scss">
@import "@sass/vuexy/pages/home.scss";
#dashboard-analytics {
    .greet-user{
        position: relative;
        .decore-left{
            position: absolute;
            left:0;
            top: 0;
            max-height:100%;
        }
        .decore-right{
            position: absolute;
            right:0;
            top: 0;
            max-height:100%;
        }
    }
    @media(max-width: 576px) {
        .decore-left, .decore-right{
            width: 140px;
        }
    }
}
</style>
