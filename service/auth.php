<?php

require_once '../app/model/autoload.php';

use Auth\Authen;
use DB\Database;

$httpResponse = new SimpleRest();
$auth = new Authen();
$requestContentType = $_SERVER["CONTENT_TYPE"];

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

    $db = new Database();

    // $conn = $db->connect();
    $conn = $db->connect2();

    if ($obj['action'] == 'signin') {
        if (empty($obj['user']) || empty($obj['pass'])) {
            echo $httpResponse->set_http_response_status($requestContentType, 400, 'BAD_REQUEST');
        } else {

            // hash('sha256', 'something' );
            $param[] = (trim($obj['user']));
            $param[] = (trim($obj['pass']));

            // $obj = $db->auth($conn, [$username,$password]);
            $obj = $db->auth2($conn, $param);

            $row = $obj['rows'];
            if ($obj['count'] > 0) {
                $_SESSION['customer_id'] = $row[0]['customer_id'];
                $_SESSION['firstname'] = $row[0]['firstname'];
                $_SESSION['lastname'] = $row[0]['lastname'];
                $_SESSION['account_no'] = $row[0]['account_no'];
                $_SESSION['amount'] = $row[0]['amount'];
                $_SESSION['expired_time'] = strtotime("+15 minutes");
                echo $httpResponse->set_http_response_status($requestContentType, 200, 'CORRECT_LOGIN');
            } else {
                echo $httpResponse->set_http_response_status($requestContentType, 401, 'INCORRECT_LOGIN');
            }
        }
    } elseif ($obj['action'] == 'signup') {
        // hash('sha256', 'something' );
        foreach ($obj as $key => $value) {
            if (empty($value)) {
                echo $httpResponse->set_http_response_status($requestContentType, 400, 'INVALID_FIELD');
                exit();
            }
        }
        $param[] = (trim($obj['username_signup']));
        $param[] = (trim($obj['password_signup']));
        $param[] = (trim($obj['firstname_signup']));
        $param[] = (trim($obj['lastname_signup']));
        $param[] = (trim($obj['email_signup']));
        $param[] = (trim($obj['tel_signup']));

        if ($param[1] != trim($obj['confirm_password_signup'])) {
            echo $httpResponse->set_http_response_status($requestContentType, 400, 'INVALID_FIELD');
        } else {
            // $obj = $db->signup($conn, $param);
            $result = $db->signup2($conn, $param);
            if ($result === true) {
                echo $httpResponse->set_http_response_status($requestContentType, 201, 'CREATED_SUCCESS');
            } else {
                if (strpos($result, 'Duplicate entry') !== false) {
                    echo $httpResponse->set_http_response_status($requestContentType, 400, 'DUPLICATE_ENTRY');
                } else {
                    echo $httpResponse->set_http_response_status($requestContentType, 400, 'CREATED_FAIL');
                }
            }
        }

    } elseif ($obj['action'] == 'logout') {
        $auth->logout();
    }
}
