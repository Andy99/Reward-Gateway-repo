<?php

namespace App\Exceptions;

class CustomException extends \Exception
{
    protected $code = 500;

    public function getMessageEntity()
    {
        return $this->getMessage();
    }
}
