<?php

header('Content-Type: application/json');

$api_key = "API_KEY_KAMU";

$amount  = floatval($_POST['amount']);
$address = $_POST['address'];

// minimum check
if ($amount < 0.00000010) {
    echo json_encode([
        "status" => "error",
        "message" => "Minimum 0.00000010 BTC"
    ]);
    exit;
}

$url = "https://faucetpay.io/api/v1/send";

$data = [
    "api_key" => $api_key,
    "to" => $address,
    "amount" => $amount,
    "currency" => "BTC"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);
curl_close($ch);

// DEBUG penting
echo $response;
