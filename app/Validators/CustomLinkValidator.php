<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.09.2020
 * Time: 10:35
 */

namespace App\Validators;


use App\Helper\NetworkHelper;
use App\Models\ShortLink;

class CustomLinkValidator
{
    /**
     * @param $field
     * @param $value
     * @param $param
     * @param $validator
     * @return bool
     */
    public function validLink($field, $value, $param, $validator){

        return NetworkHelper::http_response($value);

    }

    public function uniqueNameLink($field, $value, $param, $validator){

        return !(ShortLink::checkForLinkExist($value));
    }
}
