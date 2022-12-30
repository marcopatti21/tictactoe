<?php

namespace App\Game\Domain\Exceptions;

use App\Common\Domain\Constants\ErrorConstants;
use App\Common\Domain\Constants\HttpStatusCodes;
use App\Common\Domain\Exceptions\HttpException;
use Exception;

class PositionAlreadyAssignedException extends Exception
{
    const STATUS_CODE = HttpStatusCodes::STATUS_CODE_GENERIC_ERROR;
    const ERROR_CODE = ErrorConstants::ERROR_CODE_POSITION_ALREADY_PLAYED;
    const ERROR_MESSAGE = "Position already played.";

    public function render($request)
    {
        return response()->json(
            new HttpException(self::ERROR_CODE, self::ERROR_MESSAGE),
            self::STATUS_CODE
        );
    }
}
