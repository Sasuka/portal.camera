<?php
/**
 * Created by PhpStorm.
 * User: tient
 * Date: 01/11/2018
 * Time: 11:31
 */

namespace App\Helpers;


class Common
{
    /*
     * Response format
     * @params code: status of https
     * @params msg: string notify
     * @params data array or json
     * */
    public static function formatData($code = 401, $msg = '', $data = null)
    {
//        if (empty(trim($data)))
//            $msg = 'empty';
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return $data;
    }
}