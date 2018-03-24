<?php

namespace Utility;

class Utility
{
    public function format_account_no($data, $opt=false)
    {
        $arr = str_split($data);
        $len = count($arr);
        $result = '';
        $round = 0;
        for ($i = 1; $i <= $len; $i++) {
            if($opt && in_array($round,[1,2])) {
              $result .= 'x';
            } else {
              $result .= $arr[$i - 1];
            }
            if ($i % 4 == 0 && $i != $len) {
                $result .= '';
                $round ++;
            }
        }
        return $result;
    }
}
