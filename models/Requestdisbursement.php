<?php
class Requestdisbursement
{
    // db stuff here
    private $conn;
    private $table = 'requestdisbursement';

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

    public function funCurl($request, $type, $params, $url, $token)
    {
        if ($request == 'GET') {
            $urlApi = $url . "/disburse/" . $params;
            $postFields = '';
        } else if ($request == 'POST') {
            $urlApi = $url . "/disburse";
            $postFields = http_build_query($params);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlApi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $request,
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => array( 
                "Content-Type: " . $type,
                "Authorization: Basic " . $token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    // create post
    public function createdisbursement()
    {
        // create query
        $query = 'INSERT INTO ' . $this->table . '
                SET
                id = :id,
                amount = :amount,
                status = :status,
                timestamp = :timestamp,
                bank_code = :bank_code,
                account_number = :account_number,
                beneficiary_name = :beneficiary_name,
                remark = :remark,
                receipt = :receipt,
                time_served = :time_served,
                fee = :fee
                ';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->timestamp = htmlspecialchars(strip_tags($this->timestamp));
        $this->bank_code = htmlspecialchars(strip_tags($this->bank_code));
        $this->account_number = htmlspecialchars(strip_tags($this->account_number));
        $this->beneficiary_name = htmlspecialchars(strip_tags($this->beneficiary_name));
        $this->remark = htmlspecialchars(strip_tags($this->remark));
        $this->receipt = htmlspecialchars(strip_tags($this->receipt));
        $this->time_served = htmlspecialchars(strip_tags($this->time_served));
        $this->fee = htmlspecialchars(strip_tags($this->fee));

        // bind the data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':timestamp', $this->timestamp);
        $stmt->bindParam(':bank_code', $this->bank_code);
        $stmt->bindParam(':account_number', $this->account_number);
        $stmt->bindParam(':beneficiary_name', $this->beneficiary_name);
        $stmt->bindParam(':remark', $this->remark);
        $stmt->bindParam(':receipt', $this->receipt);
        $stmt->bindParam(':time_served', $this->time_served);
        $stmt->bindParam(':fee', $this->fee);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        // print error if something goes wrong
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    //update status disbursement
    function updatestatusdisbursement()
    {
        //update status disbursement to success
        $query = 'UPDATE ' . $this->table . '
                SET
                    status = :status,
                    receipt = :receipt,
                    time_served = :time_served
                WHERE 
                    id = :id
                ';
        // prepare statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->status = "SUCCESS";
        $this->receipt = "https://flip-receipt.oss-ap-southeast-5.aliyuncs.com/debit_receipt/126316_3d07f9fef9612c7275b3c36f7e1e5762.jpg";
        $this->time_served = date("Y-m-d H:i:s");

        // bind the data
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':receipt', $this->receipt);
        $stmt->bindParam(':time_served', $this->time_served);
        $stmt->bindParam(':id', $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }
        // print error if something goes wrong
        printf("Error: %s. \n", $stmt->error);

        return false;
    }

    public function checkdisbursementstatus()
    {
        $query = 'SELECT
                `timestamp` as timerequest,
                bank_code,
                account_number,
                id,
                amount,
                `status`,
                beneficiary_name,
                remark,
                receipt,
                time_served,
                fee
                FROM
                requestdisbursement
                WHERE
                id = ?
                LIMIT 0,1';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // bind id
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->id = $row['id'];
        $this->amount = $row['amount'];
        $this->status = $row['status'];
        $this->timestamp = $row['timerequest'];
        $this->bank_code = $row['bank_code'];
        $this->account_number = $row['account_number'];
        $this->beneficiary_name = $row['beneficiary_name'];
        $this->remark = $row['remark'];
        $this->receipt = $row['receipt'];
        $this->time_served = $row['time_served'];
        $this->fee = $row['fee'];
    }
}
