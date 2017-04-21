<?php
//route with POST to format "/order"
require_once '../Receive/Print_Provider_Reference_Client_Create.php';
$receiverClass = new Print_Provider_Reference_Client_Create();

$success = $receiverClass->Receive(file_get_contents('php://input'));

if ($success) {
    header('HTTP/1.1 200 OK', true, 200);
} else {
    header('HTTP/1.1 400 Bad Request ' . $receiverClass->getErrorMessage(), true, 400);
}
