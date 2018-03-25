<?php

namespace DB;

require_once 'Utility.php';
use \PDO;
use \Utility;

class Database
{
    public function connect($username, $password, $dbname)
    {
        $servername = "localhost";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            Utility::write_log("Connection failed: " . $e->getMessage());
            return false;
        }
    }

    public function connect2($username, $password, $dbname)
    {
        $servername = "localhost";

        // Create connection
        $conn = new \mysqli($servername, $username, $password, $dbname);
        $conn->query("set names utf8");
        // Check connection
        if ($conn->connect_error) {
            Utility::write_log("Connection failed: " . $conn->connect_error);
            return false;
        }
        return $conn;
    }

    public function auth($conn = null, $param)
    {
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM customers WHERE username = :user AND password= :pass ");
            $stmt->bindParam(':user', $param[0], PDO::PARAM_STR);
            $stmt->bindParam(':pass', $param[1], PDO::PARAM_STR);
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $temp = [];
            foreach ($stmt->fetchAll() as $k => $v) {
                $temp[] = $v;
            }
            $result['rows'] = ($temp);
            $result['count'] = count($temp);
            return $result;
        } catch (PDOException $e) {
            Utility::write_log("SQL Error: " . $e->getMessage());
            return false;
        }
    }

    public function auth2($conn = null, $param)
    {
        // $username = mysqli_real_escape_string($conn, $param[0]);
        // $password = mysqli_real_escape_string($conn, $param[1]);
        $username = $param[0];
        $password = $param[1];
        $sql = "SELECT * FROM customers WHERE username = '$username' AND password= '$password' ";
        $result = $conn->query($sql);
        $temp = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $temp[] = $row;
            }
        }

        $results['rows'] = ($temp);
        $results['count'] = count($temp);
        return $results;
    }

    public function signup2($conn = null, $param)
    {
        // $username = mysqli_real_escape_string($conn, $param[0]);
        // $password = mysqli_real_escape_string($conn, $param[1]);
        // $email    = mysqli_real_escape_string($conn, $param[2]);
        $username = $param[0];
        $password = $param[1];
        $firstname = $param[2];
        $lastname = $param[3];
        $email = $param[4];
        $tel = $param[5];
        $amount = 10000;
        $token = md5(uniqid());
        $account_no = date("Ymdhis") . str_pad(rand(0, 100), 2, '0', STR_PAD_LEFT);
        $sql = "INSERT INTO  customers (account_no, username, password, firstname, lastname, email, tel, amount, token) VALUES ('$account_no','$username', '$password', '$firstname', '$lastname', '$email', '$tel', '$amount', '$token') ";
        if (mysqli_query($conn, $sql)) {
            return true;
        } else {
            Utility::write_log("SQL Error: " . mysqli_error($conn));
            return mysqli_error($conn);
        }
    }
}
