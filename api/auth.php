<?php

require_once '../app/model/autoload.php';
require_once '../app/model/config.php';
require_once '../app/controller/mailer.php';

use DB\Database;
$requestContentType = $_SERVER["CONTENT_TYPE"];

$obj = [];
if (strpos($requestContentType, 'application/json') !== false) {
    $json = file_get_contents('php://input');
    $obj = json_decode($json, true);
} elseif (strpos($requestContentType, 'text/plain') !== false) {
    $obj = parse_str($_POST);
} elseif (strpos($requestContentType, 'application/x-www-form-urlencoded') !== false) {
    echo SimpleRest::set_http_response_status($requestContentType, 400, 'Unknow Content-type');
    die();
}

if (!isset($_POST) || empty($obj['action'])) {
    echo SimpleRest::set_http_response_status($requestContentType, 403, 'Endpoint not found');
    die();
} else {

    $db = new Database();

    // $conn = $db->connect(DB_USERNAME, DB_PASSWORD, DB_NAME);
    $conn = $db->connect2(DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($obj['action'] == 'signin') {
        if (empty($obj['user']) || empty($obj['pass'])) {
            echo SimpleRest::set_http_response_status($requestContentType, 400, 'BAD_REQUEST');
        } else {

            // hash('sha256', '<data>' );
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
                $_SESSION['role'] = $row[0]['role'];
                $_SESSION['expired_time'] = strtotime("+15 minutes");
                Utility::write_log("Authen: [" . $obj['user'] . "] is Successfully!");
                echo SimpleRest::set_http_response_status($requestContentType, 200, 'CORRECT_LOGIN');
            } else {
                Utility::write_log("Authen: [" . $obj['user'] . "] is failed!");
                echo SimpleRest::set_http_response_status($requestContentType, 401, 'INCORRECT_LOGIN');
            }
        }
    } elseif ($obj['action'] == 'signup') {
        // hash('sha256', 'something' );

        // CHECK EMPTY FIELD
        foreach ($obj as $key => $value) {
            if (empty($value)) {
                echo SimpleRest::set_http_response_status($requestContentType, 400, 'INVALID_FIELD');
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
            echo SimpleRest::set_http_response_status($requestContentType, 400, 'INVALID_FIELD');
            exit();
        }

        $url = Utility::$uri_apilayer . "check?access_key=" . Utility::$access_key_apilayer . "&email=" . $param[4];
        $resutl_check_mail = Utility::call_api($url, "GET");

        // CHECK FORMAT EMAIL
        if (!$resutl_check_mail['format_valid']) {
            echo SimpleRest::set_http_response_status($requestContentType, 400, 'INVALID_FORMAT_EMAIL');
            exit();
        }
        // CHECK SMTP EMAIL
        if (!$resutl_check_mail['smtp_check']) {
            echo SimpleRest::set_http_response_status($requestContentType, 400, 'INVALID_SMTP_EMAIL');
            exit();
        }

        // print_r($resutl_check_mail);
        // die();

        // $obj = $db->signup($conn, $param);
        $result = $db->signup2($conn, $param);
        if ($result === true) {
            echo SimpleRest::set_http_response_status($requestContentType, 201, 'CREATED_SUCCESS');
        } else {
            if (strpos($result, 'Duplicate entry') !== false) {
                echo SimpleRest::set_http_response_status($requestContentType, 400, 'DUPLICATE_ENTRY');
            } else {
                echo SimpleRest::set_http_response_status($requestContentType, 400, 'CREATED_FAIL');
            }
        }

        if (set_mail($param[2], $param[4]) === true) {
            Utility::write_log("SENT_EMAIL: " . $param[2] . " : " . $param[4] . " is Successfully!");
        } else {
            Utility::write_log("SENT_EMAIL: " . $param[2] . " : " . $param[4] . " is failed!");
        }

    } elseif ($obj['action'] == 'logout') {
        Authen::logout();
    }
}
