<?php

namespace kirillemko\RequestModel;

use yii\web\BadRequestHttpException;

class InvalidRequestException extends BadRequestHttpException
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
        $this->message = $this->getErrors();
    }


    public function getErrors(): array
    {
        return $this->errors;
    }


    public function __toString()
    {
        return json_encode($this->message) ?: '';
    }

}