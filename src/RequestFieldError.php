<?php

namespace kirillemko\RequestModel;

class RequestFieldError
{
    public $field;
    public $error;

    public function __construct($field, $error)
    {
        $this->field = $field;
        $this->error = $error;
    }
}