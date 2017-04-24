<?php

class PrintProviderReferenceClient_Processor_NullProcessor implements PrintProviderReferenceClient_Processor_ProcessorInterface
{
    protected $errorMessage = '';
    protected $model;
    protected $reference;

    /**
     * @param $reference
     * @param $model
     * @return bool
     */
    public function process($reference, $model)
    {
        $this->model = $model;
        $this->reference = $reference;

        return true;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}