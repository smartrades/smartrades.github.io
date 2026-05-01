<?php

header('Content-Type: application/json');

// Isi dengan API Key kamu dari FaucetPay
$api_key = "b1690476756ef87da6c73b1c2331eccb760111963b30388ecceee22a9c611c12";

// Ambil data dari AJAX
$amount  = floatval($_POST['amount']);
$address = trim($_POST['address']);

if(empty($address)){
    echo json_encode([
        "status" => "error",
        "message" => "Address cannot be empty"
    ]);
    exit;
}

// API FaucetPay
$url = "https://faucetpay.io/api/v1/send";

$data = [
    "api_key"  => $api_key,
    "to"       => $address,
    "amount"   => $amount,
    "currency" => "BTC"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // <-- UDAH BENER

$response = curl_exec($ch);
curl_close($ch);

// Balikin response ke JavaScript
echo $response;
