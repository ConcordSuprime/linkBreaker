<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.09.2020
 * Time: 8:16
 */

namespace App\Http\Controllers;


use App\Helper\RandHelper;
use App\Http\Requests\CreateShortLink;
use App\Models\RedirectHistory;
use App\Models\ShortLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Builder;

class MainController extends Controller
{
    public function index(){

        $currentDate = date( 'Y-m-d',strtotime(Carbon::now()->addMonth()));

        return view('main',[
            'currentDate' => $currentDate,
        ]);
    }

    public function createShortLink(CreateShortLink $request){

        $shortLinkModel = new ShortLink;

        $is_commercial = isset($request->is_commercial) ? true : false;

        $newLink = $shortLinkModel->generateShortLink(
            $request->original_link,
            $request->custom_link,
            $request->expiry_date,
            $is_commercial
        );

        return redirect()->route('info',$newLink['info']);
    }

    public function showInfoShortLink($link){

        $shortLink = ShortLink::where('info_link',$link)
            ->with([
                'redirectHistories'
            ])
            ->first();

        if($shortLink == null){
            abort(404);
        }

        $redirectHistories = $shortLink->redirectHistories()->orderBy('created_at','desc')->paginate(10);


        return view('link-info',[
            'link' => $shortLink,
            'redirectHistories' => $redirectHistories,
        ]);
    }

    public function shortLinkRedirect(Request $request,$link){

        $shortLink = ShortLink::where('short',$link)->first();
        $img = null;

        if($shortLink == null || strtotime($shortLink->expiry_date) < strtotime(Carbon::now())){
            abort(404);
        }

        if($shortLink->is_commercial){
            $img = RandHelper::getRandomPicture();
        }

        RedirectHistory::create([
            'user_ip' => $request->getClientIp(),
            'short_link_id' => $shortLink->id,
            'img' => $img,
        ]);


        if($shortLink->is_commercial){

            return view('commercial',[
                'img' => $img,
                'href' => $shortLink->original,
            ]);

        }else{

            return redirect()->to($shortLink->original);
        }

    }

    public function showStatisticAllLink(){

        $links = RedirectHistory::statistic();

        return view('statistic',[
            'links' => $links
        ]);
    }

}
