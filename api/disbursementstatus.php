<?php

include_once '../config/Connection.php';
include_once '../models/Requestdisbursement.php';

// instantiate db & connect
$database = new Connection();
$db = $database->getConnection();

// instantiate Requestdisbursement object
$reqCheckDisbursement = new Requestdisbursement($db);
// get ID
$reqCheckDisbursement->id = isset($_GET['id']) ? $_GET['id'] : isset($argv[1]) ? $argv[1] : die();

$data = json_decode($reqCheckDisbursement->funCurl('GET', 'application/json', $reqCheckDisbursement->id, $database->url, $database->token));

if (!empty($data->bank_code)) {

    // update status and return value
    if ($reqCheckDisbursement->status != 'SUCCESS') {

        $reqCheckDisbursement->id = $data->id;
        $reqCheckDisbursement->amount = $data->amount;
        $reqCheckDisbursement->status = $data->status;
        $reqCheckDisbursement->timestamp = $data->timestamp;
        $reqCheckDisbursement->bank_code = $data->bank_code;
        $reqCheckDisbursement->account_number = $data->account_number;
        $reqCheckDisbursement->beneficiary_name = $data->beneficiary_name;
        $reqCheckDisbursement->remark = $data->remark;
        $reqCheckDisbursement->receipt = $data->receipt;
        $reqCheckDisbursement->time_served = $data->time_served;
        $reqCheckDisbursement->fee = $data->fee;
        
        if ($reqCheckDisbursement->updatestatusdisbursement()) {
            $dataArr = array(
                "id" =>  $data->id,
                "amount" => $data->amount,
                "status" => $data->status,
                "timestamp" => $data->timestamp,
                "bank_code" => $data->bank_code,
                "account_number" => $data->account_number,
                "beneficiary_name" => $data->beneficiary_name,
                "remark" => $data->remark,
                "receipt" => $data->receipt,
                "time_served" =>  $data->time_served,
                "fee" => $data->fee
            );
            // make JSON
            print_r(json_encode($dataArr));
        }
    }
} else {
    $dataArr = array(
        "message" =>  "Data Not Found"
    );
    // make JSON
    print_r(json_encode($dataArr));
}
