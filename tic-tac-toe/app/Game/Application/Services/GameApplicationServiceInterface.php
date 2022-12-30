<?php

namespace App\Game\Application\Services;

use App\Game\Application\Http\Dtos\GameCreateResponseDto;
use App\Game\Application\Http\Dtos\GameResponseDto;
use App\Game\Application\Http\Dtos\MoveDto;

interface GameApplicationServiceInterface
{
    public function createGame(): GameCreateResponseDto;
    public function move(MoveDto $moveDto): GameResponseDto;
}
