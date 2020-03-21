<template>
<vx-card>
    {{test}}
    <div class="vx-col w-full">
        <vs-navbar active-text-color="rgba(255,255,255,1)" text-color v-model="selectedLane" class="nabarx mb-base lane-selection p-2" type="flat">
            <div slot="title">
                <vs-navbar-title>
                    {{ $t("LiveFeed.title") }}
                </vs-navbar-title>
            </div>
            <vs-navbar-item index="0">
                <a href="#" class="all">{{ $t("LiveFeed.all") }}</a>
            </vs-navbar-item>
            <vs-navbar-item index="1">
                <a href="#" class="top">Top</a>
            </vs-navbar-item>
            <vs-navbar-item index="2">
                <a href="#" class="jungle">Jungle</a>
            </vs-navbar-item>
            <vs-navbar-item index="3">
                <a href="#" class="mid">Mid</a>
            </vs-navbar-item>
            <vs-navbar-item index="4">
                <a href="#" class="bot">Bot</a>
            </vs-navbar-item>
            <vs-navbar-item index="5">
                <a href="#" class="support">Support</a>
            </vs-navbar-item>
            <v-select :value="0" :placeholder="$t('LiveFeed.allRegion')" class="w-48" :options="regions" v-model="selectedRegion" />
        </vs-navbar>
        <vs-table max-items="3" pagination :data="users" @selected="handleSelected" id="loadingFeed">

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
                        <popover-avatar :src="data[indextr].champion.src" :title="data[indextr].champion.title" :description="data[indextr].champion.description" />
                    </vs-td>
                    <vs-td :data="data[indextr].player">
                        {{ data[indextr].player }}
                    </vs-td>
                    <vs-td :data="data[indextr].vs">
                        <popover-avatar :src="data[indextr].vs.src" :title="data[indextr].vs.title" :description="data[indextr].vs.description" />
                    </vs-td>
                    <vs-td :data="data[indextr].kda">
                        {{ data[indextr].kda }}
                    </vs-td>
                    <vs-td :data="data[indextr].gold">
                        {{ data[indextr].gold }}
                    </vs-td>
                    <vs-td :data="data[indextr].keystone">
                        <div class="relative inline">
                            <vs-avatar :src="data[indextr].keystone" />
                            <img class="supperposed-avatar rounded" :src="data[indextr].subkeystone" />
                        </div>
                    </vs-td>
                    <vs-td :data="data[indextr].slots">
                        <popover-avatar v-for="(slot, index) in data[indextr].slots" :key="index" :data="slot" :src="slot.src" :title="slot.title" :description="slot.description" />
                        <div class="con-vs-avatar" v-for="n in 6-data[indextr].slots.length">
                            <span class="con-img vs-avatar--con-img bg-theme-dark"></span>
                        </div>
                    </vs-td>
                    <vs-td :data="data[indextr].spells">
                        <popover-avatar v-for="(spell, index) in data[indextr].spells" :key="index" :data="spell" :src="spell.src" :title="spell.title" :description="spell.description" />
                    </vs-td>
                </vs-tr>
            </template>
        </vs-table>
    </div>
</vx-card>
</template>
<script>
import PopoverAvatar from '../../components/popovers/PopoverAvatar'
export default {
    data() {
        return {
            selectedLane: 0,
            selectedRegion: 0,
            test: null,
            activeLoading: false,
            regions: ['EUW', 'NA', 'EUNE'],
            users: [{
                    'id': 1,
                    'champion': {
                        'title': 'Senna',
                        'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Senna.png',
                        'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                    },
                    'date': 'Il y a 10 minutes',
                    'player': 'Ruler',
                    'vs': {
                        'title': 'Pyke',
                        'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Pyke.png',
                        'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                    },
                    'kda': "7/8/22",
                    'gold': '35k',
                    'keystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/Inspiration/GlacialAugment/GlacialAugment.png',
                    'subkeystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/7201_Precision.png',
                    'slots': [{
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3814.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/2055.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3179.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        }
                    ],
                    'spells': [{
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerHeal.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerFlash.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        }
                    ]
                },
                {
                    'id': 2,
                    'champion': {
                        'title': 'Pantheon',
                        'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Pantheon.png',
                        'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                    },

                    'date': 'Il y a 10 minutes',
                    'player': 'Ruler',
                    'vs': {
                        'title': 'Annie',
                        'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Annie.png',
                        'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                    },
                    'kda': "7/8/22",
                    'gold': '35k',
                    'keystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/Inspiration/GlacialAugment/GlacialAugment.png',
                    'subkeystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/7201_Precision.png',
                    'slots': [{
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3814.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/2055.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3179.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        }
                    ],
                    'spells': [{
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerHeal.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        },
                        {
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerFlash.png',
                            'title': 'Summoner Flash',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                        }
                    ]
                },
            ]
        }
    },
    mounted() {
        //this.getFeed()
    },
    methods: {
        handleSelected(tr) {
            this.$vs.notify({
                title: `Selected ${tr.username}`,
                text: `Email: ${tr.email}`
            })
        },
        getFeed() {
            // loading
            this.$vs.loading({
                type: 'material',
                container: '#loadingFeed',
            })
            setTimeout(() => {
                this.users = [{
                        'id': 1,
                        'champion': {
                            'title': 'Senna',
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Vayne.png',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                        },
                        'date': 'Il y a 10 minutes',
                        'player': 'Ruler',
                        'vs': {
                            'title': 'Pyke',
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Pyke.png',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                        },
                        'kda': "7/8/22",
                        'gold': '35k',
                        'keystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/Inspiration/GlacialAugment/GlacialAugment.png',
                        'subkeystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/7201_Precision.png',
                        'slots': [{
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3814.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/2055.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3179.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            }
                        ],
                        'spells': [{
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerHeal.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerFlash.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            }
                        ]
                    },
                    {
                        'id': 2,
                        'champion': {
                            'title': 'Pantheon',
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Pantheon.png',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                        },

                        'date': 'Il y a 10 minutes',
                        'player': 'Ruler',
                        'vs': {
                            'title': 'Annie',
                            'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/champion/Annie.png',
                            'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.'
                        },
                        'kda': "7/8/22",
                        'gold': '35k',
                        'keystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/Inspiration/GlacialAugment/GlacialAugment.png',
                        'subkeystone': 'https://ddragon.leagueoflegends.com/cdn/img/perk-images/Styles/7201_Precision.png',
                        'slots': [{
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3814.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum.Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3864.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/2055.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/item/3179.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            }
                        ],
                        'spells': [{
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerHeal.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            },
                            {
                                'src': 'https://ddragon.leagueoflegends.com/cdn/10.4.1/img/spell/SummonerFlash.png',
                                'title': 'Summoner Flash',
                                'description': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi dignissim egestas enim non interdum. Vestibulum non quam vitae mauris mollis accumsan.Maecenas non justo quis ante fermentum eleifend.',
                            }
                        ]
                    },
                ]
                this.$vs.loading.close('#loadingFeed > .con-vs-loading')
            }, 3000);
            // UPDATE this.users après avoir fait la requête axios
        }
    },
    computed: {
        filterTable: function() {
            const selectedLane = this.selectedLane
            const selectedRegion = this.selectedRegion

            return {
                selectedLane,
                selectedRegion
            }
        }
    },
    watch: {
        filterTable: function() {
            this.getFeed();
        },
    },
    components: {
        PopoverAvatar
    }
}
</script>
<style lang="css">
.selectExample {
  margin: 10px;
}
.con-select-example {
  display: flex;
  align-items: center;
  justify-content: center;
}
.con-select .vs-select {
  width: 100%
}
@media (max-width: 550px) {
  .con-select {
    flex-direction: column;
  }
  .con-select .vs-select {
    width: 100%
  }
}
</style>
