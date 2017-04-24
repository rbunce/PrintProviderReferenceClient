<?php
//route with PUT to format "/order/{reference}/status"
require_once '../app/config/bootstrap.php';

//Check auth headers
//X-InkRouter-Client and X-InkRouter-ApiKey for what is setup in your inkrouter portal for your binding info
$headers = getallheaders();
$clientName = $headers['X-InkRouter-Client'];
$apiKey = $headers['X-InkRouter-ApiKey'];
//if not valid return a 401
//header('HTTP/1.1 401 Authentication Failure, true, 401);
//$response = new stdclass();
//$response->success = 'false';
//$response->message = 'Authentication Failure';
//$response->reference = 0;
//echo json_encode($response);
//exit;

$validator = new PrintProviderReferenceClient_Validator_ReceiveStatusValidator();
$processor = new PrintProviderReferenceClient_Processor_NullProcessor();
$receiverClass = new PrintProviderReferenceClient_Receive_Status($validator, $processor);
$reference = $_REQUEST['reference'];

$success = $receiverClass->Receive($reference, file_get_contents('php://input'));
$response = new stdclass();
$response->success = $success ? 'true' : 'false';
$response->message = $receiverClass->getErrorMessage();
$response->reference = $reference;

if ($success) {
    header('HTTP/1.1 200 OK', true, 200);
} else {
    header('HTTP/1.1 400 Bad Request ' . $receiverClass->getErrorMessage(), true, 400);
}

echo json_encode($response);