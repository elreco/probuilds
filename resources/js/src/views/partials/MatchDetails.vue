<template>
    <vx-card
        :title="win ? $t('Match.winningTeam') : $t('Match.losingTeam')"
        :title-color="win ? '#7ed321' : '#a12b17'"
        content-color="#fff"
    >
        <template slot="actions">
            <bans :data="data.bans"></bans>
        </template>
        <team
            :data="data.participants"
            :region="region"
            :matchId="matchId"
            :summonerId="summonerId"
        ></team>
    </vx-card>
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
    props: ["data", "win", "region", "summonerId", "matchId"],
    data() {
        return {
            losers: {
                bans: [],
                participants: []
            },
            winners: {
                bans: [],
                participants: []
            },
            images: {
                background1: require("@assets/images/match/background1.jpg"),
                background2: require("@assets/images/match/background2.jpg")
            }
        };
    }
};
</script>


