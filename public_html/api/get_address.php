<?php
header('Content-Type: application/json');

$env = parse_ini_file('../../.env');
$api_key = $env['POSTCODE_APIKEY'];


$headers = getallheaders();

$postcode = $headers['postcode'];
$houseNumber = $headers['houseNumber'];

$options = ['http' => ['header' => "Authorization: Bearer $api_key"]];
$context = stream_context_create($options);

$streetName = file_get_contents("https://postcode.tech/api/v1/postcode?postcode=$postcode&number=$houseNumber", false, $context);
error_log($streetName);
$streetName = json_decode($streetName);

if ($streetName) {
    echo json_encode($streetName);
} else {
    echo json_encode(['street' => false, 'city' => false]);
}
