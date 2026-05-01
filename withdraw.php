<?php

header('Content-Type: application/json');

$api_key = "cae38438ca292f28637bad60891fb2926901fc083ae3b1e8722993f6e585397e";

// ambil data dari frontend
$amount  = $_POST['amount'];   // sudah BTC
$address = $_POST['address'];

if (!$amount || !$address) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid input"
    ]);
    exit;
}

// FaucetPay API
$url = "https://faucetpay.io/api/v1/send";

$data = [
    "api_key" => $api_key,
    "to" => $address,
    "amount" => $amount,
    "currency" => "BTC"
];

// request ke FaucetPay
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);
curl_close($ch);

// kirim balik ke frontend
echo $response;