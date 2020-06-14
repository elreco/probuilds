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


