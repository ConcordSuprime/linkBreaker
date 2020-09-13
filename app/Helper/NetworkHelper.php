<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.09.2020
 * Time: 10:40
 */

namespace App\Helper;


class NetworkHelper
{
    public static function http_response($url, $status = null)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE); // remove body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $head = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if(!$head)
        {
            return FALSE;
        }

        if($status === null)
        {
            if($httpCode < 400)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        elseif($status == $httpCode)
        {
            return TRUE;
        }
        return FALSE;
    }
}
