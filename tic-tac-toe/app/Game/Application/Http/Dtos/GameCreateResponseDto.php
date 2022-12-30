<?php
 
namespace App\Game\Application\Http\Dtos;

use Spatie\LaravelData\Data;

class GameCreateResponseDto extends Data
{
    public function __construct(
        public int $id
    ) {}

    public static function fromId(int $id): self
    {
        return new self($id);
    }
}