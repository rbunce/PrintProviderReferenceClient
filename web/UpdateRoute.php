<?php
//route with PUT to format "/order/{reference}"
require_once '../Receive/Print_Provider_Reference_Client_Update.php';
$receiverClass = new Print_Provider_Reference_Client_Update();
$reference = $_REQUEST['reference'];

$success = $receiverClass->Receive($reference, file_get_contents('php://input'));

if ($success) {
    header('HTTP/1.1 200 OK', true, 200);
} else {
    header('HTTP/1.1 400 Bad Request ' . $receiverClass->getErrorMessage(), true, 400);
}
