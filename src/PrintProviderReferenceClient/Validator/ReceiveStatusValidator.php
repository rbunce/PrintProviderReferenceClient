<?php


class PrintProviderReferenceClient_Validator_ReceiveStatusValidator extends PrintProviderReferenceClient_Validator_BaseValidator
{
    /**
     * @param $model
     * @return bool
     */
    public function Validate($model)
    {
        $requiredFields = array('status');
        $validStatuses = array('Hold', 'Release', 'Cancel');

        foreach ($requiredFields as $field) {
            if (empty($model->{$field})) {
                $this->errorMessage = "Required field {$field} is missing";

                return false;
            }
        }
        if (!in_array($model->status, $validStatuses)) {
            $this->errorMessage = "Invalid status {$model->status}";

            return false;
        }

        return true;
    }
}