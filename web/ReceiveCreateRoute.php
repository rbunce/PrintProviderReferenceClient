<?php
//route with POST to format "/order"
require_once '../app/config/config.php';
$validator = new PrintProviderReferenceClient_Validator_ReceiveCreateValidator();
$processor = new PrintProviderReferenceClient_Processor_NullProcessor();
$receiverClass = new PrintProviderReferenceClient_Receive_Create($validator, $processor);

$success = $receiverClass->Receive(file_get_contents('php://input'));
$response = new stdclass();
$response->success = $success ? 'true' : 'false';
$response->message = $receiverClass->getErrorMessage();
$response->reference = $processor->getReference();

if ($success) {
    header('HTTP/1.1 200 OK', true, 200);
} else {
    header('HTTP/1.1 400 Bad Request ' . $receiverClass->getErrorMessage(), true, 400);
}

echo json_encode($response);