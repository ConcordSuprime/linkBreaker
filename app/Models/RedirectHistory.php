<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 13.09.2020
 * Time: 15:53
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RedirectHistory extends Model
{
    protected $fillable = [
        'user_ip',
        'short_link_id',
        'img',
        'created_at',
    ];

    public function shortLink(){
        $this->belongsTo(ShortLink::class);
    }

    /** Return  Transition Time at moscow time
     *
     * @return false|string
     */
    public function transitionTime(){
        return  date('d.m.Y (H:i)',strtotime(\Carbon\Carbon::parse($this->created_at)->addHours(3)));
    }

    /** get statistic for 2 week
     * @param int $lastWeeks
     * @return array
     */
    public static function statistic($lastWeeks = 2){

        $linksArr = [];
        $links =  RedirectHistory::join('short_links','redirect_histories.short_link_id','=','short_links.id')
            ->select(
                'redirect_histories.short_link_id',
                'redirect_histories.user_ip',
                'redirect_histories.created_at',
                'short_links.short',
                'short_links.original',
                'short_links.is_commercial',
                'short_links.info_link'

            )
            ->where('redirect_histories.created_at','>',Carbon::now()->addWeeks(-$lastWeeks))
            ->get()
            ->groupBy('short_link_id');

        foreach ($links as $key => $link){
            $linksArr[$key]['short'] = config('app.url').'/'.$link[0]['short'];
            $linksArr[$key]['original'] = $link[0]['original'];
            $linksArr[$key]['is_commercial'] = $link[0]['is_commercial'];
            $linksArr[$key]['info_link'] = config('app.url').'/statistic/'.$link[0]['info_link'];
            $linksArr[$key]['count'] = count($link->unique('user_ip'));
        }

        return $linksArr;
    }
}
