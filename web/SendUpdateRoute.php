<?php
//send status updates to inkrouter"
require_once '../app/config/bootstrap.php';

if (!empty($_POST)) {
    $client = new PrintProviderReferenceClient_Send_RestClient($config['inkrouter_base_url'], $config['inkrouter_client_id'], $config['inkrouter_api_key']);
    $updateSender = new PrintProviderReferenceClient_Send_Update($client);

    try {
        $response = $updateSender->SendUpdate($_POST['referenceId'], $_POST['orderItemId'], $_POST['type'], $_POST['trackingNumber'], $_POST['cost'], $_POST['weight']);
        $color = 'green';
    } catch (Exception $e) {
        $response = $e->getMessage();
        $color = 'red';
    }

    echo "<div style='background-color:{$color}'>" . $response . '</div>';
}

$updateTypes = PrintProviderReferenceClient_Send_Update::$updateTypes;
$updateOptions = '';
foreach ($updateTypes as $type){
    $updateOptions .= "<option value='" .  $type . "'>" . $type ."</option>";
}

$html = file_get_contents('../src/PrintProviderReferenceClient/Resources/html/SendUpdateForm.html');
echo str_replace('%%%options%%%', $updateOptions, $html);