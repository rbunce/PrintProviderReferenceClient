<?php


class PrintProviderReferenceClient_Validator_ReceiveUpdateValidator extends PrintProviderReferenceClient_Validator_BaseValidator
{
    /**
     * @param $model
     * @return bool
     */
    public function Validate($model)
    {
        $requiredFields = array('order');

        return parent::Validate($model, $requiredFields);
    }
}