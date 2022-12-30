<?php

namespace App\Game\Application\Services;

use App\Game\Application\Http\Dtos\GameCreateResponseDto;
use App\Game\Application\Http\Dtos\GameResponseDto;
use App\Game\Application\Http\Dtos\MoveDto;
use App\Game\Domain\Services\GameServiceInterface;

class GameApplicationService implements GameApplicationServiceInterface
{
    private $gameService;

    public function __construct(GameServiceInterface $gameService)
    {
        $this->gameService = $gameService;
    }

    public function createGame(): GameCreateResponseDto {
        return GameCreateResponseDto::from($this->gameService->createGame());
    }

    public function move(MoveDto $moveDto): GameResponseDto {
        return GameResponseDto::from($this->gameService->move($moveDto));
    }
}
