<?php
/**
 * This file is part of Print-Provider-Reference-Client.
 *
 * Copyright (c) Opensoft (http://opensoftdev.com)
 */


/**
 * Client for sending requests to InkRouter
 *
 */
class PrintProviderReferenceClient_Send_RestClient
{


    private static $UPDATE_PATH = '/api/v1/order/%s/item/%s';


    /**
     * @var string
     */
    private $baseUrl;

    /**
     * Id associated with a certain customer
     *
     * @var string
     */
    private $clientId;

    /**
     * Key that is used by customer for accessing InkRouter
     *
     * @var string
     */
    private $secretKey;

    /**
     *
     * @param string $baseUrl
     * @param string $clientId
     * @param string $secretKey
     */
    public function __construct($baseUrl, $clientId, $secretKey)
    {
        $this->baseUrl = $baseUrl;
        $this->clientId = $clientId;
        $this->secretKey = $secretKey;
    }


    /**
     * @param int $orderId
     * @param string $itemId
     * @param $orderInfo
     * @return mixed
     * @throws Exception
     */
    public function updateOrder($orderId, $itemId, $orderInfo)
    {
        return $this->sendRequest(sprintf($this->baseUrl . self::$UPDATE_PATH, $orderId, $itemId), 'POST',
            array('Content-Type: application/json', 'accept: application/json'), json_encode($orderInfo));
    }

    /**
     * @return mixed
     * @throws Exception
     **/
    private function sendRequest($url, $httpMethod, $headers, $body = null) {
        $curlResource = curl_init();
        if ($body !== null) {
            switch ($httpMethod) {
                case 'POST':
                    curl_setopt($curlResource, CURLOPT_POSTFIELDS, $body);
                    break; 
                case 'PUT':
                    $fp = fopen('php://temp/maxmemory:256000', 'w');
                    fwrite($fp, $body);
                    fseek($fp, 0);
                    curl_setopt($curlResource, CURLOPT_BINARYTRANSFER, true);
                    curl_setopt($curlResource, CURLOPT_PUT, true);
                    curl_setopt($curlResource, CURLOPT_INFILE, $fp);
                    curl_setopt($curlResource, CURLOPT_INFILESIZE, strlen($body)); 
                    break;
                case 'DELETE':
                    curl_setopt($curlResource, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    break;
            }
        }
        curl_setopt($curlResource, CURLOPT_URL, $url);
        curl_setopt($curlResource, CURLOPT_HTTPHEADER, 
            array_merge($headers, array('X-InkRouter-Client: ' . $this->clientId, 'X-InkRouter-ApiKey: ' . $this->secretKey)));
        curl_setopt($curlResource, CURLOPT_RETURNTRANSFER, true);
        $responseMessage = curl_exec($curlResource);
        if ($responseMessage === false) {
            throw new Exception('No Response from ' . $url);
        }

        $statusCode = curl_getinfo($curlResource, CURLINFO_HTTP_CODE);
        switch ($statusCode) {
            case 201:
                return $responseMessage;
            case 200:
                return $responseMessage;
            case 401:
                throw new Exception($responseMessage);
            case 404:
                throw new Exception($url . ' 404 Not Found, incorrect order and/or order item');
            case 500:
                throw new Exception($responseMessage);
            case 409:
                throw new Exception($responseMessage);
            default:
                throw new Exception('Unknown error occured from ' . $url . ' ' . $statusCode .  ' ' . $responseMessage);
        }
    }
}
