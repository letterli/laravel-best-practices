<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    public function __construct($code, $message)
    {
        parent::__construct($message, $code);
    }

    public function report()
    {
        //
    }

    public function render($request)
    {
        return [
            'code' => $this->getCode(),
            'msg' => $this->getMessage()
        ];
    }

}

