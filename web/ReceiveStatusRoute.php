<?php
//route with PUT to format "/order/{reference}"
require_once '../app/config/config.php';
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