<?php



class PrintProviderReferenceClient_Send_Update
{
    public static $updateTypes = array(
        'PLACED_ON_SHEET' => 'PLACED_ON_SHEET',
        'SHIP' => 'SHIP'
    );

    private $client;

    public function __construct(PrintProviderReferenceClient_Send_RestClient $client)
    {
        $this->client = $client;
    }

    public function SendUpdate($reference, $orderItemId, $type, $trackingNumber = null, $cost = null, $weight = null)
    {
        $orderInfo = new stdclass();
        $orderInfo->invoice = $reference;
        $orderInfo->orderItemId = $orderItemId;
        $orderInfo->updateType = $type;
        $orderInfo->note = '';
        $orderInfo->poid = '';

        if ($type == self::$updateTypes['SHIP']) {
            $orderInfo->trackingNumber = $trackingNumber;
            $orderInfo->cost = $cost;
            $orderInfo->weight = $weight;
        }

        return $this->client->updateOrder($reference, $orderItemId, $orderInfo);
    }
}