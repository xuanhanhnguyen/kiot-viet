<?php
/**
 * Created by PhpStorm.
 * User: xuanhanh-pc
 * Date: 11-Apr-20
 * Time: 23:31
 */

if (!function_exists('_manny')) {
    function _manny($str)
    {
        $str = strrev($str);
        $tg = "";
        for ($i = 0; $i < strlen($str); $i++) {
            $tg .= $str[$i];
            if (($i + 1) % 3 === 0) {
                $tg .= ',';
            }
        }
        return strrev($tg);
    }
}