<?php

namespace App\Game\Application\Http\Controllers;

use App\Common\Domain\Constants\HttpStatusCodes;
use App\Game\Application\Http\Dtos\MoveDto;
use App\Game\Application\Services\GameApplicationServiceInterface;
use Illuminate\Http\Request;

class GameController 
{
    private $gameApplicationService;

    public function __construct(GameApplicationServiceInterface $gameApplicationService)
    {
        $this->gameApplicationService = $gameApplicationService;
    }

    public function start()
    {
        $game = $this->gameApplicationService->createGame();
        return response($game, HttpStatusCodes::STATUS_CODE_CREATED);
    }

    public function move(Request $request)
    {
        $game = $this->gameApplicationService->move(
            MoveDto::from($request)
        );
        return response($game, HttpStatusCodes::STATUS_CODE_OK);
    }
}