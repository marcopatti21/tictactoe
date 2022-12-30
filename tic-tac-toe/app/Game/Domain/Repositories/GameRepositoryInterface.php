<?php

namespace App\Game\Domain\Repositories;

use App\Game\Domain\Models\Game;

interface GameRepositoryInterface
{
    public function getById($id): ?Game;
    public function saveOrUpdate(Game $data): int;
}
