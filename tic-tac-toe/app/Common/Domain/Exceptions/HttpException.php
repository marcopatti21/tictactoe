<?php

namespace App\Common\Domain\Exceptions;

use Illuminate\Contracts\Support\Arrayable;

class HttpException implements Arrayable
{
    public $error;

    /**
     * HttpException constructor.
     * @param $code
     * @param $message
     */
    public function __construct($code, $message)
    {
        $this->error = array('code' => $code, 'message' => $message);
    }

    public function toArray()
    {
        return $this->error;
    }
}
