<?php
class Connection
{
    // variable for setup database
    private $host = "localhost";
    private $db_name = "fliptest";
    private $username = "root";
    private $password = "nugro.dev";
    public $url = "https://nextar.flip.id/";
    public $token = "SHl6aW9ZN0xQNlpvTzduVFlLYkc4TzRJU2t5V25YMUp2QUVWQWh0V0tadW1vb0N6cXA0MTo=";
    public $conn;

    // get database connection
    public function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
