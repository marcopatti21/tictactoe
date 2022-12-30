<?php

namespace App\Game\Domain\Services;

use App\Game\Application\Http\Dtos\MoveDto;
use App\Game\Domain\Models\Game;

interface GameServiceInterface
{
    public function createGame(): int;
    public function move(MoveDto $moveDto): Game;
}
