<?php

namespace App\Game\Domain\Services;

use App\Game\Application\Http\Dtos\MoveDto;
use App\Game\Domain\Exceptions\GameFinishedException;
use App\Game\Domain\Exceptions\GameNotFoundException;
use App\Game\Domain\Exceptions\MissingArgumentsException;
use App\Game\Domain\Exceptions\PlayerNotFoundException;
use App\Game\Domain\Exceptions\PlayerOrderException;
use App\Game\Domain\Exceptions\PositionAlreadyAssignedException;
use App\Game\Domain\Exceptions\PositionNotAllowedException;
use App\Game\Domain\Models\Game;
use App\Game\Domain\Repositories\GameRepositoryInterface;

class GameService implements GameServiceInterface
{
    private $gameRepository;

    public function __construct(
        GameRepositoryInterface $gameRepository
    ) {
        $this->gameRepository = $gameRepository;
    }

    public function createGame(): int {
        return $this->gameRepository->saveOrUpdate(new Game());
    }

    public function move(MoveDto $moveDto): Game {
        $playerId = $moveDto->playerId;
        $gameId = $moveDto->gameId;
        $position = $moveDto->position;

        $game = $this->validateMove($playerId, $gameId, $position);

        $game = $this->checkMove($game, $playerId, $position);

        $this->gameRepository->saveOrUpdate($game);
        
        return $game;
    }

    private function validateMove(int $playerId, int $gameId, int $position): Game
    {   
        if (is_null($playerId) || is_null($gameId) || is_null($position)) {
            throw new MissingArgumentsException();
        }

        if ($playerId < 1 || $playerId > 2) {
            throw new PlayerNotFoundException();
        }

        if ($position < 0 || $position > 8) {
            throw new PositionNotAllowedException();
        }

        $game = $this->gameRepository->getById($gameId);
        
        if ($game == null) {
            throw new GameNotFoundException();
        }

        if ($game->winner_id != null) {
            throw new GameFinishedException();
        }

        if ($game->next_player_id != null && $game->next_player_id != $playerId) {
            throw new PlayerOrderException();
        }

        if ($game->getAttribute("cell_".$position) != null) {
            throw new PositionAlreadyAssignedException();
        }

        return $game;
    }

    private function checkMove(Game $game, int $playerId, int $position): Game
    {
        $game->setAttribute("cell_".$position, $playerId);
        
        // Check in columns
        $previousCellsInRow = $position % 3;

        $game = $this->checkWin(
            $position - $previousCellsInRow, 
            $position - $previousCellsInRow + 2,
            1, 
            $game, $playerId
        );

        if ($game->winner_id != null) {
            return $game;
        }

        // Check in rows
        $game = $this->checkWin($previousCellsInRow, 8, 3, 
            $game, $playerId
        );

        if ($game->winner_id != null) {
            return $game;
        }

        if ($position % 2 == 0) {
            // Check in main diagonal
            $game = $this->checkWin(0, 8, 4, 
                $game, $playerId
            );

            if ($game->winner_id != null) {
                return $game;
            }

            // Check in secondary diagonal
            $game = $this->checkWin(2, 6, 2, 
                $game, $playerId
            );

            if ($game->winner_id != null) {
                return $game;
            }
        }
        
        if ($game->winner_id == null) {
            $game->next_player_id = $playerId == 1 ? 2 : 1;
        }

        return $game;
    }

    private function checkWin(int $start, int $end, int $step, Game $game, int $playerId): Game
    {
        $win = true;
        foreach (range($start, $end, $step) as $column) {
            if ($game->getAttribute("cell_".$column) != $playerId) {
                $win = false;
                break;
            }
        }
        
        if ($win) {
            $game->winner_id = $playerId;
            $game->next_player_id = null;
        }

        return $game;
    }

}
