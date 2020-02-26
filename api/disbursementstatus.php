<?php

include_once '../config/Connection.php';
include_once '../models/Requestdisbursement.php';

// instantiate db & connect
$database = new Connection();
$db = $database->getConnection();

// instantiate Requestdisbursement object
$post = new Requestdisbursement($db);
// get ID
$post->id = isset($_GET['id']) ? $_GET['id'] : isset($argv[1]) ? $argv[1] : die();
$post->checkdisbursementstatus();

if (!empty($post->bank_code)) {

    // update status and return value
    if ($post->status != 'SUCCESS') {
        if ($post->updatestatusdisbursement()) {
            $post_arr = array(
                "id" =>  $post->id,
                "amount" => $post->amount,
                "status" => $post->status,
                "timestamp" => $post->timestamp,
                "bank_code" => $post->bank_code,
                "account_number" => $post->account_number,
                "beneficiary_name" => $post->beneficiary_name,
                "remark" => $post->remark,
                "receipt" => $post->receipt,
                "time_served" =>  $post->time_served,
                "fee" => $post->fee
            );
            // make JSON
            print_r(json_encode($post_arr));
        }
    }
} else {
    $post->checkdisbursementstatus();
    $post_arr = array(
        "id" =>  $post->id,
        "amount" => $post->amount,
        "status" => $post->status,
        "timestamp" => $post->timestamp,
        "bank_code" => $post->bank_code,
        "account_number" => $post->account_number,
        "beneficiary_name" => $post->beneficiary_name,
        "remark" => $post->remark,
        "receipt" => $post->receipt,
        "time_served" =>  $post->time_served,
        "fee" => $post->fee
    );
    // make JSON
    print_r(json_encode($post_arr));
}
