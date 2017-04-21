<?php
/**
 * This file is part of InkRouter-PHP-SDK.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */

Class Print_Provider_Reference_Client_Create {

    private $errorMessage;

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
            $this->errorMessage = 'Insert validation failure here!!!';

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
        $requiredFields = array('order', 'reference');
        $orderRequiredFields = array('orderId', 'orderDate', 'deliveryDate', 'shipType', 'requestor', 'shipAddress', 'orderItems');
        $shipTypeRequiredFields = array('shipMethod', 'shipService');
        $requestorRequiredFields = array('name', 'contract');
        $shipAddressRequiredFields = array('attention', 'streetAddress', 'city', 'state', 'zip', 'country');
        $orderItemRequiredFields = array('printGroupId', 'productType', 'paperType', 'quantity', 'regionSize', 'cost', 'sides');
        $sideRequiredFields = array('pageNumber', 'fileUrl', 'fileHash', 'coating', 'orientation');

        return true;
    }

    /**
     * @param $model
     * @return bool
     */
    protected function Process($model)
    {
        //Process and load into system database

        return true;
    }
}
