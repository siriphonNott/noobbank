<?php

namespace Model;

require_once 'config.php';
require_once "Database.php";
require_once 'Utility.php';
use \Utility;
use DB\Database;
use \PDO;

class Transaction
{
    public function getData($id = null, $type = null)
    {
        $db = new Database();
        $conn = $db->connect(DB_USERNAME, DB_PASSWORD, DB_NAME);
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $stmt = $conn->prepare("INSERT INTO customers () VALUES ()");
            if (empty($id)) {
                $stmt = $conn->prepare("SELECT * FROM transactions");
            } else {
                $stmt = $conn->prepare("SELECT * FROM transactions WHERE action_by=:id OR destination_customer_id=:id OR source_customer_id=:id");
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
            Utility::write_log("TRANSFER_SQL_ERROR: getData() is " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }
    }

    public function update($param)
    {
        $db = new Database();
        # code...
    }

    public function delete($id)
    {
        $db = new Database();
        # code...
    }

    public function insert($param)
    {
        $db = new Database();
        $conn = $db->connect(DB_USERNAME, DB_PASSWORD, DB_NAME);
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $stmt = $conn->prepare("INSERT INTO customers () VALUES ()");
            $type = $param[0];
            $source_customer_id = $param[1];
            $destination_customer_id = $param[2];
            $source_account_no = $param[3];
            $destination_account_no = $param[4];
            $amount = $param[5];
            $action_by = $param[6];

            $sql = "INSERT INTO transactions (type, source_customer_id, destination_customer_id, source_account_no, destination_account_no, amount, action_by) ";
            $sql .= " VALUES (:type, :source_customer_id, :destination_customer_id, :source_account_no, :destination_account_no, :amount, :action_by)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            $stmt->bindParam(':source_customer_id', $source_customer_id, PDO::PARAM_INT);
            $stmt->bindParam(':destination_customer_id', $destination_customer_id, PDO::PARAM_INT);
            $stmt->bindParam(':source_account_no', $source_account_no, PDO::PARAM_STR);
            $stmt->bindParam(':destination_account_no', $destination_account_no, PDO::PARAM_STR);
            $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $stmt->bindParam(':action_by', $action_by, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            Utility::write_log("TRANSFER_SQL_ERROR: insert() is " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }
    }
}
