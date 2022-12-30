<?php

namespace App\Game\Domain\Exceptions;

use App\Common\Domain\Constants\ErrorConstants;
use App\Common\Domain\Constants\HttpStatusCodes;
use App\Common\Domain\Exceptions\HttpException;
use Exception;

class GameNotFoundException extends Exception
{
    const STATUS_CODE = HttpStatusCodes::STATUS_CODE_NOT_FOUND;
    const ERROR_CODE = ErrorConstants::ERROR_CODE_GAME_NOT_FOUND;
    const ERROR_MESSAGE = "Game not found";

    public function render($request)
    {
        return response()->json(
            new HttpException(self::ERROR_CODE, self::ERROR_MESSAGE),
            self::STATUS_CODE
        );
    }
}
