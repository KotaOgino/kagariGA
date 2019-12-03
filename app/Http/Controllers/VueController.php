<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Google;
use App\User;
use App\AddSite;
use App\Category;
use App\Industry;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Google_Service_Analytics;
use Google_Service_AnalyticsReporting;
use Google_Service_Webmasters;

class VueController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  // NavBar
  public function nav(Google $google, AddSite $addSite){
        $user = Auth::user();
        $id =  $user->id;
        $add_sites = AddSite::where('user_id', $id)->get();
        if (empty($add_sites) || $add_sites == []) {
            return redirect('/accounts.google');
        }
        $addSite = AddSite::where('user_id', $id)->first();
        if (is_null($addSite)) {
            return redirect('/accounts.google');
        }
        $url = $addSite->url;
        $siteName = $addSite->site_name;
        $end = date('Y-m-d', strtotime('-1 day', time()));
        $start = date('Y-m-d', strtotime('-30 days', time()));
        $comEnd = date('Y-m-d', strtotime('-1 day', strtotime($start)));
        $comStart = date('Y-m-d', strtotime('-30 days', strtotime($comEnd)));
        $site_info = [$url,$siteName,$start,$end,$comStart,$comEnd];
        return $data = [
          "id"=>$id,
          "site_info"=>$site_info
        ];
  }

}
