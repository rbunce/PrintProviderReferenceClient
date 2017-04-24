<?php
/**
 * This file is part of Print-Provider-Reference-Client.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */

Class PrintProviderReferenceClient_Receive_Update {

    private $errorMessage;
    private $validator;
    private $processor;

    /**
     * @param PrintProviderReferenceClient_Validator_ReceiveUpdateValidator $validator
     * @param PrintProviderReferenceClient_Processor_ProcessorInterface $processor
     */
    public function __construct(PrintProviderReferenceClient_Validator_ReceiveUpdateValidator $validator, PrintProviderReferenceClient_Processor_ProcessorInterface $processor)
    {
        $this->validator = $validator;
        $this->processor = $processor;
    }
    /**
     * @param string $reference
     * @param string $json
     * @return bool
     */
    public function Receive($reference, $json)
    {
        try {
            $model = json_decode($json);
        } catch (Exception $e) {
            //failure
            //do failure stuff
            $this->errorMessage = 'Insert error here!!!!';

            return false;
        }
        $valid = $this->Validate($reference, $model);
        if ($valid) {
            $success = $this->Process($reference, $model);

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
     * @param string $reference
     * @param $model
     * @return bool
     */
    protected function Validate($reference, $model)
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
     * @param $reference
     * @param $model
     * @return bool
     */
    protected function Process($reference, $model)
    {
        //Process and load into system database
        if ($this->processor->Process($reference, $model)) {
            return true;
        } else {
            $this->errorMessage = $this->processor->getErrorMessage();

            return false;
        }
    }

}
