<?php

namespace kirillemko\RequestModel;

class InvalidRequestException extends \Exception
{
    /** @var RequestFieldError[] */
    private $errors = [];

    public function __construct($error = null)
    {
        parent::__construct();

        if( $error ) {
            if( $error instanceof RequestFieldError ) {
                $this->addError($error);
            } else {
                $this->addError(new RequestFieldError('*', $error));
            }
        }
    }

    public function addError($error): void
    {
        $this->errors[] = $error;
    }


    public function getErrors(): array
    {
        return $this->errors;
    }
}