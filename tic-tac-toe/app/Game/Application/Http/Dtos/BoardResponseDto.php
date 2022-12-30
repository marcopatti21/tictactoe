<?php
 
namespace App\Game\Application\Http\Dtos;

use App\Game\Domain\Models\Game;
use Spatie\LaravelData\Data;

class BoardResponseDto extends Data
{
    public function __construct(
        public ?int $cell0,
        public ?int $cell1,
        public ?int $cell2,
        public ?int $cell3,
        public ?int $cell4,
        public ?int $cell5,
        public ?int $cell6,
        public ?int $cell7,
        public ?int $cell8
    ) {}

    public static function fromGame(Game $game): self
    {
        return new self(
            $game->cell_0,
            $game->cell_1,
            $game->cell_2,
            $game->cell_3,
            $game->cell_4,
            $game->cell_5,
            $game->cell_6,
            $game->cell_7,
            $game->cell_8
        );
    }
}