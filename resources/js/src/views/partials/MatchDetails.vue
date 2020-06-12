<template>
    <!-- Two columns -->
    <div class="vx-row mb-base">
        <div class="vx-col w-full xl:w-1/2 mb-base">
            <vx-card :title="$t('Match.winningTeam')" title-color="#7ed321" content-color="#fff">
                <template slot="actions">
                    <bans :data="data.winners.bans"></bans>
                </template>
                <team
                    :data="data.winners.participants"
                    :region="data.region"
                    :matchId="data.matchId"
                    :summonerId="data.summonerId"
                ></team>
            </vx-card>
        </div>
        <div class="vx-col xl:w-1/2 w-full">
            <vx-card :title="$t('Match.losingTeam')" title-color="#a12b17" content-color="#fff">
                <template slot="actions">
                    <bans :data="data.losers.bans"></bans>
                </template>
                <team
                    :data="data.losers.participants"
                    :region="data.region"
                    :matchId="data.matchId"
                    :summonerId="data.summonerId"
                ></team>
            </vx-card>
        </div>
    </div>
</template>

<script>
import Team from "./match/Team";
import Bans from "./match/Bans";

export default {
    name: "match-details",
    components: {
        Team,
        Bans
    },
    props: ["data"],
    data() {
        return {
            images: {
                background1: require("@assets/images/match/background1.jpg"),
                background2: require("@assets/images/match/background2.jpg")
            }
        };
    }
};
</script>

<style lang="scss">
#avatar-col {
    width: 10rem;
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
