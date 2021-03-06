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

class AxiosController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  // サマリー
  public function analyticsAxios(Google $google, AddSite $addSite, Request $request){
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
    $VIEW_ID =(string)$addSite->VIEW_ID;
    $url = $addSite->url;
    $siteName = $addSite->site_name;
    $site_info = [$url,$siteName];
    $client = $google->client();
    $timeCreated = $user->createdAtToken;
    $refreshToken = $user->refresh_token;
    $time = time();
    $timeDifference = $time - $timeCreated;
    if ($timeDifference < 3600) {
        $accessToken = $user->Gtoken;
        $client->setAccessToken($accessToken);
    } elseif ($timeDifference > 3600) {
        try {
            $client = $client ->refreshToken($refreshToken);
            $newTimeCreated = $client['created'];
            $newAccessToken = $client['access_token'];
            $newRefreshToken = $client['refresh_token'];
            $user->Gtoken = $newAccessToken;
            $user->refresh_token = $newRefreshToken;
            $user->createdAtToken = $newTimeCreated;
            $user->update();
            $client = $google->client();
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        } catch (ErrorException $e) {
            return redirect('login');
        }
    }
    $gsa = new Google_Service_AnalyticsReporting($client);

    $end = $request->end;
    $start = $request->start;
    $comEnd = $request->comEnd;
    $comStart = $request->comStart;

    $ga_result = $google->get_ga_data($gsa, $VIEW_ID, $start, $end, $comStart, $comEnd);
    $originResult = $ga_result[0][0];
    $comResult = $ga_result[0][1];
    $originUser = $ga_result[1]['original'];
    $compareUser = $ga_result[1]['compare'];
    $ss = $originResult[0];
    $ps = $originResult[1];
    $user = $originResult[2];
    $time = $originResult[3];
    $br = $originResult[4];
    $aveSs = $originResult[5];
    $pv = $originResult[6];
    $exit = $originResult[7];
    $comSS = $comResult[0];
    $comPs = $comResult[1];
    $comUser = $comResult[2];
    $comTime = $comResult[3];
    $comBr = $comResult[4];
    $comAveSs = $comResult[5];
    $comPv = $comResult[6];
    $comExit = $comResult[7];
    $site_info = [$url,$siteName,$start,$end,$comStart,$comEnd];
    $axios = 'axios';
    $data =[
    "session"=>$ss,
    "pSession"=>$ps,
    "user"=>$user,
    "time"=>$time,
    "bRate"=>$br,
    "aveSs"=>$aveSs,
    "pv"=>$pv,
    "exit"=>$exit,
    "comSession"=>$comSS,
    "comPSession"=>$comPs,
    "comUser"=>$comUser,
    "comTime"=>$comTime,
    "comBRate"=>$comBr,
    "originUser"=>$originUser,
    "compareUser"=>$compareUser,
    "comAveSs"=>$comAveSs,
    "comPv"=>$comPv,
    "comExit"=>$comExit,
    "site_info"=>$site_info,
    "axios" => $axios,
    "ga_result" => $ga_result
  ];

    return $data;
  }
  // // ユーザー分析
  public function userAxios(Google $google, AddSite $addSite, Request $request){
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
    $VIEW_ID =(string)$addSite->VIEW_ID;
    $url = $addSite->url;
    $client = $google->client();
    $timeCreated = $user->createdAtToken;
    $refreshToken = $user->refresh_token;
    $time = time();
    $timeDifference = $time - $timeCreated;
    if ($timeDifference < 3600) {
        $accessToken = $user->Gtoken;
        $client->setAccessToken($accessToken);
    } elseif ($timeDifference > 3600) {
        try {
            $client = $client ->refreshToken($refreshToken);
            $newTimeCreated = $client['created'];
            $newAccessToken = $client['access_token'];
            $newRefreshToken = $client['refresh_token'];
            $user->Gtoken = $newAccessToken;
            $user->refresh_token = $newRefreshToken;
            $user->createdAtToken = $newTimeCreated;
            $user->update();
            $client = $google->client();
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        } catch (ErrorException $e) {
            return redirect('login');
        }
    }
    $gsa = new Google_Service_AnalyticsReporting($client);
    $end = $request->end;
    $start = $request->start;
    $comEnd = $request->comEnd;
    $comStart = $request->comStart;
    $ga_user = $google->get_ga_user($gsa, $VIEW_ID, $start, $end, $comStart, $comEnd);
    $ga_userOne = $ga_user[0];
    $ga_userType = $ga_user[1];
    $data = [
      "user"=>$ga_userOne,
      "userTypes"=>$ga_userType
    ];
    return $data;
  }
  // // 流入元分析
  public function inflowAxios(Google $google, AddSite $addSite, Request $request){
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
    $VIEW_ID =(string)$addSite->VIEW_ID;
    $url = $addSite->url;
    $client = $google->client();
    $timeCreated = $user->createdAtToken;
    $refreshToken = $user->refresh_token;
    $time = time();
    $timeDifference = $time - $timeCreated;
    if ($timeDifference < 3600) {
        $accessToken = $user->Gtoken;
        $client->setAccessToken($accessToken);
    } elseif ($timeDifference > 3600) {
        try {
            $client = $client ->refreshToken($refreshToken);
            $newTimeCreated = $client['created'];
            $newAccessToken = $client['access_token'];
            $newRefreshToken = $client['refresh_token'];
            $user->Gtoken = $newAccessToken;
            $user->refresh_token = $newRefreshToken;
            $user->createdAtToken = $newTimeCreated;
            $user->update();
            $client = $google->client();
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        } catch (ErrorException $e) {
            return redirect('login');
        }
    }
    $gsa = new Google_Service_AnalyticsReporting($client);
    $end = $request->end;
    $start = $request->start;
    $comEnd = $request->comEnd;
    $comStart = $request->comStart;
    $ga_inflow = $google->get_ga_inflow($gsa, $VIEW_ID, $start, $end, $comStart, $comEnd);
    $data = ["inflow"=>$ga_inflow];
    return $data;
  }
  // // ユーザー行動分析
  public function actionAxios(Google $google, AddSite $addSite, Request $request){
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
    $VIEW_ID =(string)$addSite->VIEW_ID;
    $url = $addSite->url;
    $client = $google->client();
    $timeCreated = $user->createdAtToken;
    $refreshToken = $user->refresh_token;
    $time = time();
    $timeDifference = $time - $timeCreated;
    if ($timeDifference < 3600) {
        $accessToken = $user->Gtoken;
        $client->setAccessToken($accessToken);
    } elseif ($timeDifference > 3600) {
        try {
            $client = $client ->refreshToken($refreshToken);
            $newTimeCreated = $client['created'];
            $newAccessToken = $client['access_token'];
            $newRefreshToken = $client['refresh_token'];
            $user->Gtoken = $newAccessToken;
            $user->refresh_token = $newRefreshToken;
            $user->createdAtToken = $newTimeCreated;
            $user->update();
            $client = $google->client();
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        } catch (ErrorException $e) {
            return redirect('login');
        }
    }
    $gsa = new Google_Service_AnalyticsReporting($client);
    $end = $request->end;
    $start = $request->start;
    $comEnd = $request->comEnd;
    $comStart = $request->comStart;

    $ga_action = $google->get_ga_action($gsa, $VIEW_ID, $start, $end, $comStart, $comEnd);
    $data = $ga_action;

    return $data;
  }

  public function conversionAxios(Google $google, AddSite $addSite, Request $request){
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
    $VIEW_ID =(string)$addSite->VIEW_ID;
    $url = $addSite->url;
    $client = $google->client();
    $timeCreated = $user->createdAtToken;
    $refreshToken = $user->refresh_token;
    $time = time();
    $timeDifference = $time - $timeCreated;
    if ($timeDifference < 3600) {
        $accessToken = $user->Gtoken;
        $client->setAccessToken($accessToken);
    } elseif ($timeDifference > 3600) {
        try {
            $client = $client ->refreshToken($refreshToken);
            $newTimeCreated = $client['created'];
            $newAccessToken = $client['access_token'];
            $newRefreshToken = $client['refresh_token'];
            $user->Gtoken = $newAccessToken;
            $user->refresh_token = $newRefreshToken;
            $user->createdAtToken = $newTimeCreated;
            $user->update();
            $client = $google->client();
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        } catch (ErrorException $e) {
            return redirect('login');
        }
    }
    $gsa = new Google_Service_AnalyticsReporting($client);
    $end = $request->end;
    $start = $request->start;
    $comEnd = $request->comEnd;
    $comStart = $request->comStart;
    $ga_cv = $google->get_ga_cv($gsa, $VIEW_ID, $start, $end, $comStart, $comEnd);
    $ga_cvOne = $ga_cv[0];
    $ga_cvTwo = $ga_cv[1];
    $data = [
      "cv"=>$ga_cvTwo,
      "cvReport"=>$ga_cvOne
    ];
    return $data;
  }

  public function adAxios(Google $google, AddSite $addSite, Request $request){
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
    $VIEW_ID =(string)$addSite->VIEW_ID;
    $url = $addSite->url;
    $client = $google->client();
    $timeCreated = $user->createdAtToken;
    $refreshToken = $user->refresh_token;
    $time = time();
    $timeDifference = $time - $timeCreated;
    if ($timeDifference < 3600) {
        $accessToken = $user->Gtoken;
        $client->setAccessToken($accessToken);
    } elseif ($timeDifference > 3600) {
        try {
            $client = $client ->refreshToken($refreshToken);
            $newTimeCreated = $client['created'];
            $newAccessToken = $client['access_token'];
            $newRefreshToken = $client['refresh_token'];
            $user->Gtoken = $newAccessToken;
            $user->refresh_token = $newRefreshToken;
            $user->createdAtToken = $newTimeCreated;
            $user->update();
            $client = $google->client();
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        } catch (ErrorException $e) {
            return redirect('login');
        }
    }
    $gsa = new Google_Service_AnalyticsReporting($client);
    $end = $request->end;
    $start = $request->start;
    $comEnd = $request->comEnd;
    $comStart = $request->comStart;
    $ga_ad = $google->get_ga_ad($gsa, $VIEW_ID, $start, $end, $comStart, $comEnd);
    $ga_adOne = $ga_ad[0];
    $ga_adTwo = $ga_ad[1];
    $data = [
      "cv"=>$ga_adOne,
      "cvReport"=>$ga_adTwo
    ];
    return $data;
  }


}
