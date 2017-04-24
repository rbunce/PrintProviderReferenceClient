<?php


class PrintProviderReferenceClient_Validator_ReceiveCreateValidator implements PrintProviderReferenceClient_Validator_ValidatorInterface
{
    protected $errorMessage = '';

    /**
     * @param $model
     * @return bool
     */
    public function Validate($model)
    {
        $requiredFields = array('order', 'reference');
        $orderRequiredFields = array('orderId', 'orderDate', 'deliveryDate', 'shipType', 'requestor', 'shipAddress', 'orderItems');
        $shipTypeRequiredFields = array('shipMethod', 'shipService');
        $requestorRequiredFields = array('name', 'contract');
        $shipAddressRequiredFields = array('attention', 'streetAddress', 'city', 'state', 'zip', 'country');
        $orderItemRequiredFields = array('printGroupId', 'productType', 'paperType', 'quantity', 'regionSize', 'cost', 'sides');
        $sideRequiredFields = array('pageNumber', 'fileUrl', 'fileHash', 'coating', 'orientation');

        foreach ($requiredFields as $field) {
            if (empty($model->{$field})) {
                $this->errorMessage = "Required field {$field} is missing";

                return false;
            }
        }

        foreach ($orderRequiredFields as $field) {
            if (empty($model->order->{$field})) {
                $this->errorMessage = "Required field {$field} is missing from order";

                return false;
            }
        }

        foreach ($shipTypeRequiredFields as $field) {
            if (empty($model->order->shipType->{$field})) {
                $this->errorMessage = "Required field {$field} is missing from shipType";

                return false;
            }
        }

        foreach ($requestorRequiredFields as $field) {
            if (empty($model->order->requestor->{$field})) {
                $this->errorMessage = "Required field {$field} is missing from requestor";

                return false;
            }
        }

        foreach ($shipAddressRequiredFields as $field) {
            if (empty($model->order->shipAddress->{$field})) {
                $this->errorMessage = "Required field {$field} is missing from shipAddress";

                return false;
            }
        }
        foreach ($model->order->orderItems as $orderItem) {
            foreach ($orderItemRequiredFields as $field) {
                if (empty($orderItem->{$field})) {
                    $this->errorMessage = "Required field {$field} is missing from orderItem for " . $orderItem->printGroupId;

                    return false;
                }
            }
            foreach ($orderItem->sides as $side) {
                foreach ($sideRequiredFields as $field) {
                    if (empty($side->{$field})) {
                        $this->errorMessage = "Required field {$field} is missing from side for " . $orderItem->printGroupId;

                        return false;
                    }
                }
            }

        }

        return true;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}