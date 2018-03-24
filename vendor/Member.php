<?php

namespace Model;

require_once "Database.php";
use DB\Database;
use \PDO;

class Member
{
    public function getData($id = null)
    {
        $db = new Database();
        $conn = $db->connect();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $stmt = $conn->prepare("INSERT INTO customers () VALUES ()");
            if (empty($id)) {
                $stmt = $conn->prepare("SELECT * FROM customers");
            } else {
                $stmt = $conn->prepare("SELECT * FROM customers WHERE used=1 AND customer_id=:id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }
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
            return "Error: " . $e->getMessage();
        }
    }

    public function getId($account_no)
    {
        $db = new Database();
        $conn = $db->connect();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $stmt = $conn->prepare("INSERT INTO customers () VALUES ()");

            $stmt = $conn->prepare("SELECT customer_id,amount FROM customers WHERE account_no=:account_no");
            $stmt->bindParam(':account_no', $account_no, PDO::PARAM_STR);

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
            return "Error: " . $e->getMessage();
        }

    }

    public function updateAmount($param)
    {
        $db = new Database();
        $conn = $db->connect();
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $stmt = $conn->prepare("INSERT INTO customers () VALUES ()");
            $customer_id = $param[0];
            $amount = $param[1];
            $sql = "UPDATE customers SET amount=:amount WHERE customer_id=:customer_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function delete($id)
    {
        $db = new Database();
        # code...
    }

    public function insert(Type $var = null)
    {
        $db = new Database();
        # code...
    }
}
