<?php

// $conn = mysqli_connect("localhost", "root", "", "great_library_db") or die("Couldn't connect to the database" . $conn->connect_error);

class Database
{

    public $conn;

    public function __construct($host, $username, $password, $dbName)
    {
        $this->conn = new mysqli($host, $username, $password, $dbName);

        if ($this->conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->conn->connect_error;
            exit();
        }
    }

    public function get($table, ...$columns)
    {
        $sql = "SELECT * FROM $table";
        if (count($columns) > 0) {
            $cols = implode(",", $columns);
            $sql = "SELECT $cols FROM $table";
        }
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insert($table, $data, $type)
    {
        $cols = implode(",", array_keys($data));
        $values = array_values($data);
        $placeHolder = [];
        for ($i = 0; $i < count($data); $i++) {
            array_push($placeHolder, '?');
        }

        $placeHolder = implode(",", $placeHolder);

        $sql = "INSERT INTO $table ($cols) VALUES ($placeHolder)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($type, ...$values);

        if ($stmt->execute()) {
            return "success";
        } else {
            return "failed";
        }
    }

    public function search_user($table, $serchCol, $column, $value)
    {
        $sql = "SELECT $serchCol FROM $table WHERE $column = ?";
        // $result = $this->conn->query($sql);
        // return $result->fetch_all(MYSQLI_ASSOC);
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function search_user_data($table, $column, $value)
    {
        $sql = "SELECT * FROM $table WHERE $column = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function __destruct()
    {
        $this->conn->close();
    }
}

$gl_db = new Database("localhost", "root", "", "great_library_db");

