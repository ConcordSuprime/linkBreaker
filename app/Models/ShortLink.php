<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.09.2020
 * Time: 9:07
 */

namespace App\Models;


use App\Helper\RandHelper;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'original', 'short', 'is_commercial','expiry_date','created_at','info_link'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expiry_date' => 'datetime',
    ];

    /**
     * @param null $custom_link
     * @return array
     */
    public function generateShortLink($originalLink,$custom_link = null,$expiry_date,$is_commercial = false){

        //generate short link name
        if($custom_link != null)
            $newShortLinkName = $custom_link;
        else{
            do {
                $newShortLinkName = RandHelper::generateRandomString(10);
            }
            while($this->checkForLinkExist($newShortLinkName));
        }

        //generate setting link name
        do {
            $linkInfo = RandHelper::generateRandomString(16);
        } while($this->checkForLinkInfoExist($linkInfo));


        $this->create([
            'original' => $originalLink,
            'short' => $newShortLinkName,
            'info_link' => $linkInfo,
            'expiry_date' =>$expiry_date,
            'is_commercial' => $is_commercial,
        ]);
        return [
            'link'=>$newShortLinkName,
            'info'=>$linkInfo,
        ];
    }

    /** check on exist link
     *
     * @param $newShortLink
     * @return bool
     */
    public static function checkForLinkExist($newShortLink){

        return  ShortLink::where('short',$newShortLink)->first() != null ? true : false;
    }
    /** check on exist link
     *
     * @param $newShortLink
     * @return bool
     */
    public static function checkForLinkInfoExist($newShortLink){

        return  ShortLink::where('info_link',$newShortLink)->first() != null ? true : false;
    }

    public function redirectHistories(){

        return $this->hasMany(RedirectHistory::class);
    }

    /** short link with domain
     * @return string
     */
    public function shortLink(){
        return config('app.url').'/'.$this->short;
    }


    /** info link with domain
     * @return string
     */
    public function infoLink(){
        return config('app.url').'/statistic/'.$this->info_link;
    }
}
