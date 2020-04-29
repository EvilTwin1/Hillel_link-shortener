<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Statistic;
use App\Link;
use GeoIp2\Database\Reader;
use hisorange\BrowserDetect\Parser as Browser;

class LinkController extends Controller
{

    public function index($code)
    {
        $link = Link::where('short_code', $code)->get()->first();
        $reader = new Reader(resource_path() . '/GeoLite2/GeoLite2-City.mmdb');

        try {
            $record = $reader->city(request()->ip());
        }catch (\GeoIp2\Exception\AddressNotFoundException $exception){
            $record = $reader->city('212.178.8.114');
        }
        $statistics = new Statistic();
        $statistics->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $statistics->link_id = $link->id;
        $statistics->ip = request()->ip();
        $statistics->user_agent = request()->userAgent();
        $statistics->country_code = $record->country->isoCode;
        $statistics->city_name = $record->city->name;
        $statistics->os = Browser::platformName();
        $statistics->browser = Browser::browserName();
        $statistics->engine = Browser::browserEngine();
        $statistics->device = Browser::deviceFamily();
        $statistics->save();






//        if($link === null){
//            return redirect('/');
//        }
        return redirect($link->source_link);
    }





}
