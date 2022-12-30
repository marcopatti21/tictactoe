<?php

namespace App\Game\Infrastructure\Repositories;

use App\Game\Domain\Models\Game;
use App\Game\Domain\Repositories\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface
{

    public function getById($id): ?Game {
        return Game::find($id);
    }

    public function saveOrUpdate(Game $data): int {
        $data->save();
        return $data->id;
    }

}
