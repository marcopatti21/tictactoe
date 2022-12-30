<?php
 
namespace App\Game\Application\Http\Dtos;

use Spatie\LaravelData\Data;

class MoveDto extends Data
{
    public function __construct(
        public int $gameId,
        public int $playerId,
        public int $position
    ) {}
}