<?php
namespace Model;

require_once 'config.php';
require_once "Database.php";
require_once 'Utility.php';
use DB\Database;
use \PDO;
use \Utility;

class Fund
{
    public function getData($id = null, $type = null)
    {
        $db = new Database();
        $conn = $db->connect(DB_USERNAME, DB_PASSWORD, DB_NAME);
        try {
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $stmt = $conn->prepare("INSERT INTO customers () VALUES ()");
            if (empty($id)) {
                $stmt = $conn->prepare("SELECT * FROM funds");
            } else {
                $stmt = $conn->prepare("SELECT * FROM funds WHERE customer_id=:id");
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            }
            $stmt->execute();
            // set the resulting array to associative
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $temp = [];
            $total = 0;
            foreach ($stmt->fetchAll() as $k => $v) {
                $temp[] = $v;
                $total += ($v['fund_unit'] * $v['fund_cost']);
            }
            $result['rows'] = ($temp);
            $result['total'] = $total;
            $result['count'] = count($temp);
            return $result;
        } catch (PDOException $e) {
            Utility::write_log("FUND_SQL_ERROR: getData() is " . $e->getMessage());
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
            $customer_id = $param[0];
            $fund_type = $param[1];
            $fund_unit = $param[2];
            $fund_cost = $param[3];

            $sql = "INSERT INTO funds (customer_id, fund_type, fund_unit, fund_cost) ";
            $sql .= " VALUES (:customer_id, :fund_type, :fund_unit, :fund_cost)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
            $stmt->bindParam(':fund_type', $fund_type, PDO::PARAM_INT);
            $stmt->bindParam(':fund_unit', $fund_unit, PDO::PARAM_INT);
            $stmt->bindParam(':fund_cost', $fund_cost, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            Utility::write_log("FUND_SQL_ERROR: insert() is " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }
    }
}
