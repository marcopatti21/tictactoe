<?php
 
namespace App\Game\Application\Http\Dtos;

use App\Game\Domain\Models\Game;
use Spatie\LaravelData\Data;

class GameResponseDto extends Data
{
    public function __construct(
        public int $id,
        public BoardResponseDto $board,
        public bool $winner,
        public ?int $winnerId
    ) {}

    public static function fromGame(Game $game): self
    {
        return new self(
            $game->id,
            BoardResponseDto::from($game),
            $game->winner_id != null,
            $game->winner_id
        );
    }
}