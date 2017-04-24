<?php


interface PrintProviderReferenceClient_Processor_ProcessorInterface
{
    /**
     * @param $reference
     * @param $model
     * @return bool
     */
    public function Process($reference, $model);

    /**
     * @return string
     */
    public function getErrorMessage();

    /**
     * @return mixed
     */
    public function getModel();

    /**
     * @return mixed
     */
    public function getReference();
}