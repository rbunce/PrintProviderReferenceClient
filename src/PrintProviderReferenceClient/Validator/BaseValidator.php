<?php


class PrintProviderReferenceClient_Validator_BaseValidator implements PrintProviderReferenceClient_Validator_ValidatorInterface
{
    protected $errorMessage = '';

    /**
     * @param $model
     * @param array $topLevel
     * @return bool
     */
    public function Validate($model, array $topLevel = array('order', 'reference'))
    {
        $requiredFields = $topLevel;
        $orderRequiredFields = array('orderId', 'orderDate', 'deliveryDate', 'shipType', 'requester', 'shipAddress', 'orderItems');
        $shipTypeRequiredFields = array('shipMethod', 'shipService');
        $requestorRequiredFields = array('name', 'contract');
        $shipAddressRequiredFields = array('attention', 'street', 'city', 'state', 'zip', 'country');
        $orderItemRequiredFields = array('orderItemId', 'productType', 'substrate', 'quantity', 'regionSize', 'cost', 'sides');
        $sideRequiredFields = array('sideNumber', 'fileUrl', 'fileHash', 'coating', 'orientation');

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
            if (empty($model->order->requester->{$field})) {
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
                    $this->errorMessage = "Required field {$field} is missing from orderItem for " . $orderItem->orderItemId;

                    return false;
                }
            }
            foreach ($orderItem->sides as $side) {
                foreach ($sideRequiredFields as $field) {
                    if (empty($side->{$field}) && $side->{$field} != 0) {
                        $this->errorMessage = "Required field {$field} is missing from side for " . $orderItem->orderItemId;

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