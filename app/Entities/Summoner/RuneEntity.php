<?php

namespace App\Entities\Summoner;

use App\Entities\Riot\RiotEntity;

// DATADRAGON
use RiotAPI\DataDragonAPI\DataDragonAPI;

class RuneEntity
{

    protected $riot;
    protected $locale;

    public function __construct($riot, $locale)
    {
        $this->riot = $riot;
        $this->locale = $locale;
        app()->setLocale($locale);
        RiotEntity::initDataDragonAPI();
    }

    public function getKeystones($participant)
    {
        $response = $this->initKeystonesArray();
        $runes = $this->riot->getStaticReforgedRunes()->runes;
        $rune_paths = $this->riot->getStaticReforgedRunePaths()->paths;
        $player_stats = $participant->stats;
        $response['keystone'] = !empty($runes[$player_stats->perk0]) ? DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->perk0])->src : '';
        $response['subkeystone'] = !empty($rune_paths[$player_stats->perkSubStyle]) ? DataDragonAPI::getReforgedRunePathIconO($rune_paths[$player_stats->perkSubStyle])->src : '';

        return $response;
    }

    public function getRunes($participant)
    {
        $response = $this->initRunesArray();
        $riotEntity = new RiotEntity($this->locale);
        $runes = $this->riot->getStaticReforgedRunes($riotEntity->localeMutator())->runes;
        $rune_paths = $this->riot->getStaticReforgedRunePaths($riotEntity->localeMutator())->paths;
        //dd($runes);
        $player_stats = $participant->stats;

        $response['first']['principal'] =
            [
                'src' => !empty($rune_paths[$player_stats->perkPrimaryStyle]) ? DataDragonAPI::getReforgedRunePathIconO($rune_paths[$player_stats->perkPrimaryStyle])->src : '',
                'name' => !empty($rune_paths[$player_stats->perkPrimaryStyle]) ? $rune_paths[$player_stats->perkPrimaryStyle]->name : ''
            ];

        for ($i = 0; $i < 4; $i++) {
            $iname = "perk" . $i;
            $response['first']['rune'][$i] =
                [
                    'src' => !empty($runes[$player_stats->$iname]) ? DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->$iname])->src : '',
                    'name' => !empty($runes[$player_stats->$iname]) ? $runes[$player_stats->$iname]->name : '',
                    'description' => !empty($runes[$player_stats->$iname]) ? strip_tags($runes[$player_stats->$iname]->shortDesc) : '',
                ];
        }
        /* dd($player_stats); */
        $response['second']['principal'] =
            [
                'src' => !empty($rune_paths[$player_stats->perkSubStyle]) ? DataDragonAPI::getReforgedRunePathIconO($rune_paths[$player_stats->perkSubStyle])->src : '',
                'name' => !empty($rune_paths[$player_stats->perkSubStyle]) ? $rune_paths[$player_stats->perkSubStyle]->name : ''
            ];
        for ($i = 4; $i < 6; $i++) {
            $iname = "perk" . $i;
            $response['second']['rune'][$i] =
                [
                    'src' => !empty($runes[$player_stats->$iname]) ? DataDragonAPI::getReforgedRuneIconO($runes[$player_stats->$iname])->src : '',
                    'name' => !empty($runes[$player_stats->$iname]) ? $runes[$player_stats->$iname]->name : '',
                    'description' => !empty($runes[$player_stats->$iname]) ? strip_tags($runes[$player_stats->$iname]->shortDesc) : '',
                ];
        }

        return $response;
    }

    public function initKeystonesArray()
    {
        return [
            'keystone' => null,
            'subkeystone' => null
        ];
    }
    public function initRunesArray()
    {
        return [
            'first' => [
                'principal' => [
                    'src' => null,
                    'name' => null
                ],
                'rune' => [
                    0 => [
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    1 => [
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    2 => [
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    3 => [
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                ],
            ],
            'second' => [
                'principal' => [
                    'src' => null,
                    'name' => null
                ],
                'rune' => [
                    4 => [
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                    5 => [
                        'src' => null,
                        'name' => null,
                        'description' => null
                    ],
                ],
            ],
            'third' => [
                0 => [
                    'src' => null,
                    'name' => null,
                    'description' => null
                ],
                1 => [
                    'src' => null,
                    'name' => null,
                    'description' => null
                ],
                2 => [
                    'src' => null,
                    'name' => null,
                    'description' => null
                ],
            ]
        ];
    }
}
