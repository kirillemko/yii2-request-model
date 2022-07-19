<?php

namespace kirillemko\RequestModel;

use yii\base\Model;

class RequestModel extends Model
{
    public function __construct($config = [], $autoload=true)
    {
        parent::__construct($config);
        if( $autoload ){
            $this->load();
            $this->validate();
        }
    }

    public function load($data=null, $formName = null)
    {
        if( !$data ){
            $data = \Yii::$app->request->isGet ? \Yii::$app->request->get() : \Yii::$app->request->getBodyParams();
        }
        parent::load($data, '');
        return $this;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        if( !parent::validate($attributeNames, $clearErrors) ) {
            $errors = $this->getErrors();

            $ex = new InvalidRequestException();

            foreach ($errors as $field => $field_errors) {
                foreach ($field_errors as $error) {
                    $ex->addError(new RequestFieldError($field, $error));
                }
            }

            throw $ex;
        }
    }
}