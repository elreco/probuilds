<?php

namespace App\Repositories;

interface MatchRepositoryInterface
{
    public function getChallengersLastMatch(Collection $challengers, ?String $champion);
}
