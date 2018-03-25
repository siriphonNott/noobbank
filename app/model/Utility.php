<?php
date_default_timezone_set('Asia/Bangkok');

class Utility
{
    public static $uri_apilayer = "http://apilayer.net/api/";
    public static $path_log = __DIR__ . "/../../logs/";
    public static $access_key_apilayer = "ba170435eb82bcd583dde27a769593e5";

    public static function format_account_no($data, $opt = false)
    {
        $arr = str_split($data);
        $len = count($arr);
        $result = '';
        $round = 0;
        for ($i = 1; $i <= $len; $i++) {
            if ($opt && in_array($round, [1, 2])) {
                $result .= 'x';
            } else {
                $result .= $arr[$i - 1];
            }
            if ($i % 4 == 0 && $i != $len) {
                $result .= '';
                $round++;
            }
        }
        return $result;
    }

    public static function call_api($url, $method, $param = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_PORT, null);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        $resJson = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($resJson, true);
        return $result;
    }

    public static function not_found()
    {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
        include __DIR__ . "/../../errordocs/error.php";
        exit();
    }

    public static function check_admin($role)
    {
        if ($role == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function write_log($data)
    {
        $date = date('d_m_Y');
        $time = date('H:i:s');
        $file_name = $date . ".log";
        $file = self::$path_log . $file_name;
        if (file_exists($file)) {
        } else {
            fopen($file, "w");
        }
        $current = file_get_contents($file);
        $current .= $time . "=> " . ($data) . "\n";
        file_put_contents($file, $current);
    }
}
