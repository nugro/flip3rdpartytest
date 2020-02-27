<?php
class Requestdisbursementmigrate
{
    // db stuff here
    private $conn;

    // properties
    public $id;
    public $amount;
    public $status;
    public $timestamp;
    public $bank_code;
    public $account_number;
    public $beneficiary_name;
    public $remark;
    public $receipt;
    public $time_served;
    public $fee;

    // constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create table
    public function createtable()
    {
        // create query
        $query = '
        DROP TABLE IF EXISTS `requestdisbursement`;
        CREATE TABLE `requestdisbursement` (
          `id` varchar(20) NOT NULL,
          `amount` decimal(10,2) DEFAULT NULL,
          `status` varchar(10) DEFAULT NULL,
          `timestamp` datetime DEFAULT NULL,
          `bank_code` varchar(10) DEFAULT NULL,
          `account_number` varchar(25) DEFAULT NULL,
          `beneficiary_name` varchar(255) DEFAULT NULL,
          `remark` varchar(255) DEFAULT NULL,
          `receipt` varchar(255) DEFAULT NULL,
          `time_served` datetime DEFAULT NULL,
          `fee` varchar(255) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
        
        SET FOREIGN_KEY_CHECKS = 1;
                ';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        // print error if something goes wrong
        printf("Error: %s. \n", $stmt->error);

        return false;
    }
}
