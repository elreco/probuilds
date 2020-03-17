<template>
<vx-card>
    <div class="vx-col w-full">
        <h4 class="mb-base">Live Feed</h4>
        <vs-table max-items="3" pagination v-model="selected" :data="users" @selected="handleSelected">

            <template slot="thead">
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th>{{ $t("LiveFeed.player") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.vs") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.kda") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.gold") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.keystone") }}</vs-th>
                <vs-th>{{ $t("LiveFeed.build") }}</vs-th>
                <vs-th></vs-th>
            </template>

            <template slot-scope="{data}">
                <vs-tr :data="tr" :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td :data="data[indextr].date">
                        {{ data[indextr].date }}
                    </vs-td>
                    <vs-td :data="data[indextr].champion">
                        <vs-avatar :src="data[indextr].champion" />
                    </vs-td>
                    <vs-td :data="data[indextr].player">
                        {{ data[indextr].player }}
                    </vs-td>
                    <vs-td :data="data[indextr].vs">
                        <vs-avatar :src="data[indextr].vs" />
                    </vs-td>

                    <vs-td :data="data[indextr].kda">
                        {{ data[indextr].kda }}
                    </vs-td>

                    <vs-td :data="data[indextr].gold">
                        {{ data[indextr].gold }}
                    </vs-td>
                    <vs-td :data="data[indextr].keystone">
                        <vs-avatar :src="data[indextr].keystone" />
                    </vs-td>
                    <vs-td :data="data[indextr].slots">
                        <!-- <vs-dropdown>
                            <a class="flex items-center" href="#">

                            </a>

                            <vs-dropdown-menu>
                                <h3>Test</h3>
                            </vs-dropdown-menu>
                        </vs-dropdown> -->
                        <div>

                            <v-popover delay="300" container="body" trigger="hover" placement="auto" class="inline" v-for="(slot, index) in data[indextr].slots" :key="index" :data="slot">
                                <vs-avatar class="tooltip-target" :src="slot.src" icon="fiber_manual_record" />
                                <template slot="popover">
                                    <vs-card class="cardx">
                                        <div slot="header">
                                            <h3>
                                                Hello world !
                                            </h3>
                                        </div>
                                        <div slot="media">
                                            <img :src="src">
                                        </div>
                                        <div>
                                            <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                                nisi ut aliquip ex ea commodo consequat.</span>
                                        </div>
                                        <div slot="footer">
                                            <vs-row vs-justify="flex-end">
                                                <vs-button type="gradient" color="danger" icon="favorite"></vs-button>
                                                <vs-button color="primary" icon="turned_in_not"></vs-button>
                                                <vs-button color="rgb(230,230,230)" color-text="rgb(50,50,50)" icon="settings"></vs-button>
                                            </vs-row>
                                        </div>
                                    </vs-card>

                                </template>
                            </v-popover>
                        </div>
                    </vs-td>
                    <vs-td :data="data[indextr].spells">
                        <vs-avatar v-for="(spell, index) in data[indextr].spells" :key="index" :data="spell" :src="spell" />
                    </vs-td>
                </vs-tr>
            </template>
        </vs-table>
    </div>
</vx-card>
</template>

<script>
export default {
    data() {
        return {
            selected: [],
            users: [{
                    'id': 1,
                    'champion': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Senna.png',
                    'date': 'Il y a 10 minutes',
                    'player': 'Ruler',
                    'vs': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Pyke.png',
                    'kda': "7/8/22",
                    'gold': '35k',
                    'keystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/Inspiration/GlacialAugment/GlacialAugment.png',
                    'subkeystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/7201_Precision.png',
                    'slots': [{
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                            'id': 1,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3814.png',
                            'id': 2,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                            'id': 3,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/2055.png',
                            'id': 4,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3179.png',
                            'id': 5,
                        },
                        {
                            'src': null,
                            'id': 1,
                        }
                    ],
                    'spells': [
                        'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerBarrier.png',
                        'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerFlash.png',
                    ]
                },
                {
                    'id': 2,
                    'champion': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Pantheon.png',
                    'date': 'Il y a 10 minutes',
                    'player': 'Ruler',
                    'vs': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Annie.png',
                    'kda': "7/8/22",
                    'gold': '35k',
                    'keystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/Inspiration/GlacialAugment/GlacialAugment.png',
                    'subkeystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/7201_Precision.png',
                    'slots': [{
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                            'id': 1,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3814.png',
                            'id': 2,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                            'id': 3,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/2055.png',
                            'id': 4,
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3179.png',
                            'id': 5,
                        },
                        {
                            'src': null,
                            'id': 1,
                        }
                    ],
                    'spells': [
                        'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerHeal.png',
                        'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerFlash.png',
                    ]
                },
            ]
        }
    },
    methods: {
        handleSelected(tr) {
            this.$vs.notify({
                title: `Selected ${tr.username}`,
                text: `Email: ${tr.email}`
            })
        }
    }
}
</script>
