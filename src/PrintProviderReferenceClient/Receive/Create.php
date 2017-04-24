<?php
/**
 * This file is part of Print-Provider-Reference-Client.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */

Class PrintProviderReferenceClient_Receive_Create {

    private $errorMessage;
    private $validator;
    private $processor;

    /**
     * @param PrintProviderReferenceClient_Validator_ReceiveCreateValidator $validator
     * @param PrintProviderReferenceClient_Processor_ProcessorInterface $processor
     */
    public function __construct(PrintProviderReferenceClient_Validator_ReceiveCreateValidator $validator, PrintProviderReferenceClient_Processor_ProcessorInterface $processor)
    {
        $this->validator = $validator;
        $this->processor = $processor;
    }
    /**
     * @param string $json
     * @return bool
     */
    public function Receive($json)
    {
        try {
            $model = json_decode($json);
        } catch (Exception $e) {
            //failure
            //do failure stuff
            $this->errorMessage = 'Insert error here!!!!';

            return false;
        }
        $valid = $this->Validate($model);
        if ($valid) {
            $success = $this->Process($model);

            return $success;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param $model
     * @return bool
     */
    protected function Validate($model)
    {
        //Validate model for business logic
        if($this->validator->Validate($model)) {
            return true;
        } else {
            $this->errorMessage = $this->validator->getErrorMessage();

            return false;
        }
    }

    /**
     * @param $model
     * @return bool
     */
    protected function Process($model)
    {
        //Process and load into system database
        if ($this->processor->Process($model->reference, $model)) {
            return true;
        } else {
            $this->errorMessage = $this->processor->getErrorMessage();

            return false;
        }
    }
}
