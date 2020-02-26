<?php

include_once '../config/Connection.php';
include_once '../models/Requestdisbursement.php';

// instantiate db & connect
$database = new Connection();
$db = $database->getConnection();

// instantiate Requestdisbursement object
$post = new Requestdisbursement($db);

$params = array(
    "bank_code" => "BNI",
    "account_number" => "1234567890",
    "amount" => 10000,
    "remark" => "sample remark"
);

$data = json_decode($post->funCurl('POST', 'application/x-www-form-urlencoded', $params, $database->url, $database->token));

$post->id = $data->id;
$post->amount = $data->amount;
$post->status = $data->status;
$post->timestamp = $data->timestamp;
$post->bank_code = $data->bank_code;
$post->account_number = $data->account_number;
$post->beneficiary_name = $data->beneficiary_name;
$post->remark = $data->remark;
$post->receipt = $data->receipt;
$post->time_served = $data->time_served;
$post->fee = $data->fee;

// create post
if ($post->createdisbursement()) {
    echo json_encode(
        array('message' => 'Post Created')
    );
} else {
    echo json_encode(
        array('message' => 'Post Not Created')
    );
}
