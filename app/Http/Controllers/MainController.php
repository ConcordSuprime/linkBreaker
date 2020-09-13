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
use App\Models\ShortLink;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        $shortLink = ShortLink::where('info-link',$link)->first();

        if($shortLink == null){
            abort(404);
        }

        return view('link-info',[
            'link' => $shortLink
        ]);
    }

}
