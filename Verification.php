<?php

$Authority = $_GET['Authority'];
$data = array('MerchantID' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx', 'Authority' => $Authority, 'Amount' => 100);
$jsonData = json_encode($data);
$ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($jsonData)
));

$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    if ($result['Status'] == 100) {
        echo 'Transation success. RefID:' . $result['RefID'];
    } else {
        echo 'Transation failed. Status:' . $result['Status'];
    }
}
?>
