<?php

header('Content-Type: application/json');

$api_key = "b1690476756ef87da6c73b1c2331eccb760111963b30388ecceee22a9c611c12";

// AMBIL APA ADANYA, JANGAN di-floatval! Biar tetap bulat
$amount  = $_POST['amount']; 
$address = trim($_POST['address']);

if(empty($address)){
    echo json_encode([
        "status" => "error",
        "message" => "Address cannot be empty"
    ]);
    exit;
}

$url = "https://faucetpay.io/api/v1/send";

$data = [
    "api_key"  => $api_key,
    "to"       => $address,
    "amount"   => $amount, // <-- Ini isinya angka bulat contoh: 50
    "currency" => "BTC"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
