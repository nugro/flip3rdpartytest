<?php

include_once '../config/Connection.php';
include_once '../models/Requestdisbursementmigrate.php';

// instantiate db & connect
$database = new Connection();
$db = $database->getConnection();

// instantiate Requestdisbursement object
$post = new Requestdisbursementmigrate($db);

// create post
if ($post->createtable()) {
    echo json_encode(
        array('message' => 'Table Successfully Create')
    );
} else {
    echo json_encode(
        array('message' => 'Table Not Created')
    );
}
