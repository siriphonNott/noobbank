<?php

require_once '../app/model/autoload.php';

use Model\Fund;
use Model\Member;
use Model\Transaction;

$httpResponse = new SimpleRest();
$requestContentType = @$_SERVER["CONTENT_TYPE"];
$auth = new Authen();
$member = new Member();
$transaction = new Transaction();
$fund = new Fund();

$obj = [];
if (strpos($requestContentType, 'application/json') !== false) {
    $json = file_get_contents('php://input');
    $obj = json_decode($json, true);
} elseif (strpos($requestContentType, 'text/plain') !== false) {
    $obj = parse_str($_POST);
} elseif (strpos($requestContentType, 'application/x-www-form-urlencoded') !== false) {
    echo $httpResponse->set_http_response_status($requestContentType, 400, 'Unknow Content-type');
    die();
}

if (!isset($_POST) || empty($obj['action'])) {
    echo $httpResponse->set_http_response_status($requestContentType, 403, 'Endpoint not found');
    die();
} else {
    $action = $obj['action'];
    if ($action == 'transfer') {

        $data_src = $member->getData($_SESSION['customer_id']);
        $data_dst = $member->getId($obj['account_number_des']);

        if ($data_dst['count'] == 0) {
            echo $httpResponse->set_http_response_status($requestContentType, 400, 'NOT_FOUND_ACCOUNT_NO');
            die();
        } elseif ($data_src['rows'][0]['account_no'] == $obj['account_number_des']) {
            echo $httpResponse->set_http_response_status($requestContentType, 400, 'INVALID_ACCOUNT_NO');
            die();
        } elseif (($data_src['rows'][0]['amount'] - 25) < $obj['amount_transfer']) {
            echo $httpResponse->set_http_response_status($requestContentType, 400, 'INSUFFICIENT_AMOUNT');
            die();
        }

        $param[] = 'TRANS'; // $types
        $param[] = $_SESSION['customer_id']; // $source_customer_id
        $param[] = $data_dst['rows'][0]['customer_id']; // $destination_customer_id
        $param[] = $_SESSION['account_no']; // $source_account_no
        $param[] = $obj['account_number_des']; // $destination_account_no
        $param[] = $obj['amount_transfer']; // $amount
        $param[] = $_SESSION['customer_id']; // $action_by

        $param_src[] = $_SESSION['customer_id'];
        $param_src[] = (float) $data_src['rows'][0]['amount'] - (float) ($obj['amount_transfer'] + 25);

        $param_dst[] = $data_dst['rows'][0]['customer_id'];
        $param_dst[] = (float) $obj['amount_transfer'] + (float) $data_dst['rows'][0]['amount'];

        $status_trans = $transaction->insert($param);
        $status_update = $member->updateAmount($param_src);
        $status_update = $member->updateAmount($param_dst);

        if ($status_trans && $status_update) {
            Utility::write_log("TRANSFER: acc_src: ['" . $data_src['rows'][0]['account_no'] . "'], acc_des: ['" . $obj['account_number_des'] . "'], amount: ['" . $obj['amount_transfer'] . "'] is Successfully! ");
            echo $httpResponse->set_http_response_status($requestContentType, 200, 'TRANS_SUCCESS');
        } else {
            Utility::write_log("TRANSFER_ERROR: acc_src: ['" . $data_src['rows'][0]['account_no'] . "'], acc_des: ['" . $obj['account_number_des'] . "'] => " . $status_trans);
            echo $httpResponse->set_http_response_status($requestContentType, 400, $status_trans);
        }
        die();

    } elseif ($action == 'fund') {
        $data = $member->getData($_SESSION['customer_id']);

        $temp = explode(',', $obj['fund']);
        $fund_type = $temp[0];
        $fund_cost = $temp[1];

        $param[] = $_SESSION['customer_id'];
        $param[] = (int) $fund_type;
        $param[] = $obj['fund_unit'];
        $param[] = (int) $fund_cost;

        $param2[] = $_SESSION['customer_id'];
        $param2[] = (int) $data['rows'][0]['amount'] - ($fund_cost * $obj['fund_unit']);

        if (($data['rows'][0]['amount']) < ($fund_cost * $obj['fund_unit'])) {
            echo $httpResponse->set_http_response_status($requestContentType, 400, 'INSUFFICIENT_AMOUNT');
            exit();
        }

        $status_fund = $fund->insert($param);
        $status_update = $member->updateAmount($param2);
        if ($status_fund && $status_update) {
            echo $httpResponse->set_http_response_status($requestContentType, 200, 'FUND_SUCCESS');
            Utility::write_log("FUND: cust_id: ['" . $_SESSION['customer_id'] . "'], type: ['" . (int) $fund_type . "'], amount:['" . (int) $fund_cost . "'], unit: ['" . $obj['fund_unit'] . "'] is Successfully! ");
        } else {
            echo $httpResponse->set_http_response_status($requestContentType, 400, $status_fund);
            Utility::write_log("FUND_ERROR: cust_id: '" . $_SESSION['customer_id'] . "' => " . $status_fund);
        }
        exit();

    }

}
