<?php

interface PrintProviderReferenceClient_Validator_ValidatorInterface
{
    /**
     * @param $model
     * @return bool
     */
    public function Validate($model);

    /**
     * @return string
     */
    public function getErrorMessage();
}