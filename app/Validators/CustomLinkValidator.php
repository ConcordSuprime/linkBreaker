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
    /** check for link existence
     * @param $field
     * @param $value
     * @param $param
     * @param $validator
     * @return bool
     */
    public function validLink($field, $value, $param, $validator){

        return NetworkHelper::http_response($value);

    }

    /**  Check link for uniqueness
     *
     * @param $field
     * @param $value
     * @param $param
     * @param $validator
     * @return bool
     */
    public function uniqueNameLink($field, $value, $param, $validator){

        return !(ShortLink::checkForLinkExist($value));
    }

    /** Validate format custom text link
     *
     * @param $field
     * @param $value
     * @param $param
     * @param $validator
     * @return bool
     */
    public function validCustomLink($field, $value, $param, $validator){

        if($value && $value !=null){
            preg_match ('/[a-zA-Z0-9]*/i',$value,$ss);
            if(strlen($ss[0]) != strlen($value)){
                return false;
            }
        }

        return true;

    }
}
