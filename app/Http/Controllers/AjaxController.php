<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Google;
use App\User;
use App\AddSite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Google_Service_Analytics;
use Google_Service_AnalyticsReporting;
use Google_Service_Webmasters;
use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_Dimension;
use Google_Service_AnalyticsReporting_SegmentDimensionFilter;
use Google_Service_AnalyticsReporting_DimensionFilterClause;
use Google_Service_AnalyticsReporting_OrderBy;
use Google_Service_AnalyticsReporting_ReportRequest;
use Google_Service_AnalyticsReporting_GetReportsRequest;
use Google_Service_Webmasters_SearchAnalyticsQueryRequest;
use Google_Service_Webmasters_ApiDimensionFilter;
use Google_Service_Webmasters_ApiDimensionFilterGroup;

class AjaxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function seoDetail(){
    //   $response = array();
    //    $response["status"] = "OK";
    //    $response["message"] = "success";
    //    return Response::json($response);
    // }
    public function seoDetail(Request $request, Google $google)
    {
        $limit = 10;
        $url = $request->url;
        $content_url = $request->content_url;
        $start = $request->start;
        $end = $request->end;

        $user = Auth::user();

        $client = $google->client();
        $timeCreated = $user->createdAtToken;
        $refreshToken = $user->refresh_token;
        $time =time();
        $timeDifference = $time - $timeCreated;
        // アクセストークン発行から一時間未満なら
        if ($timeDifference < 3600) {
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        }
        // アクセストークン発行から1時間経っていたら
        if ($timeDifference > 3600) {
            $client = $client ->refreshToken($refreshToken);
            // $newToken= $client->getAccessToken();
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
        }

        $gsw = new Google_Service_Webmasters($client);

        $gsw_re = $google->search_analytics($url, $content_url, $limit, $gsw, $start, $end);

        $array = [];
        foreach ($gsw_re as $value) {
            $result = [];
            $word = $value->keys[0];
            $click = $value->clicks;
            $impre = $value->impressions;
            $ctr = round($value->ctr, 2);
            $position = round($value->position, 2);
            $result = [$word, $click, $impre, $ctr, $position];
            array_push($array, $result);
        }
        return Response::json($array);
    }
    public function siteNameChange(Request $request)
    {
        $id = $request->site_id;
        $new_name = $request->new_name;
        $addSite = AddSite::where('id', $id)->first();
        $addSite->site_name = $new_name;
        $addSite->update();
        $name = $addSite->site_name;
        return Response::json($name);
    }

    public function displayConsole(Google $google, Request $request)
    {
        $limit = $request->limit;
        $start = $request->start;
        $end = $request->end;
        $url = $request->url;
        $content_url = $request->content_url;
        $user = Auth::user();
        $client = $google->client();
        $timeCreated = $user->createdAtToken;
        $refreshToken = $user->refresh_token;
        $time =time();
        $timeDifference = $time - $timeCreated;
        // アクセストークン発行から一時間未満なら
        if ($timeDifference < 3600) {
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        }
        // アクセストークン発行から1時間経っていたら
        if ($timeDifference > 3600) {
            $client = $client ->refreshToken($refreshToken);
            // $newToken= $client->getAccessToken();
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
        }

        $gsw = new Google_Service_Webmasters($client);
        $result_url = '';
        try {
            $gsw_re = $google->search_analytics($url, $content_url, $limit, $gsw, $start, $end);
            $result_url = $url;
        } catch (\Exception $e) {
        }
        return Response::json($result_url);
    }

    public function reportSeoDisplay(Google $google, Request $request)
    {
        $contetn_url_json = $request->value;
        $content_url = json_decode($contetn_url_json, true);
        $url = $request->url;
        $start = $request->start;
        $end = $request->end;

        $user = Auth::user();
        $client = $google->client();
        $timeCreated = $user->createdAtToken;
        $refreshToken = $user->refresh_token;
        $time = time();
        $timeDifference = $time - $timeCreated;
        // アクセストークン発行から一時間未満なら
        if ($timeDifference < 3600) {
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        }
        // アクセストークン発行から1時間経っていたら
        if ($timeDifference > 3600) {
            $client = $client->refreshToken($refreshToken);
            // $newToken= $client->getAccessToken();
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
        }

        $gsw = new Google_Service_Webmasters($client);
        $limit = 1;
        $i = 0;
        try {
          $gsw_re = $google->search_analytics($url, $content_url, $limit, $gsw, $start, $end);
          if (count($gsw_re) != 0) {
              foreach ($gsw_re as $value) {
                  $keyword = $value->keys[0];
                  }
          } else {
              $keyword = '';
          }
      } catch (\Exception $e) {
          $keyword = '';
      }
        try {
            $gsw_re = $google->search_analytics_page($url, $content_url, $limit, $gsw, $start, $end);
            if (count($gsw_re) != 0) {
                foreach ($gsw_re as $value) {
                    $result = [];
                    $word = $keyword;
                    $click = $value->clicks;
                    $impre = $value->impressions;
                    $ctr = round($value->ctr, 2);
                    $position = round($value->position, 2);
                    $result = [$word, $click, $impre, $ctr, $position];
                }
            } else {
                $result = [];
                $word = '';
                $click = '';
                $impre = '';
                $ctr = '';
                $position = '';
                $result = [$word, $click, $impre, $ctr, $position];
            }
        } catch (\Exception $e) {
            $result = [];
            $word = '';
            $click = '';
            $impre = '';
            $ctr = '';
            $position = '';
            $result = [$word, $click, $impre, $ctr, $position];
        }

        return Response::json($result);
    }
    public function comparGaReport(Google $google, Request $request){
      $start = $request->start;
      $end = $request->end;
      $VIEW_ID = $request->view_id;

      $user = Auth::user();
      $client = $google->client();
      $timeCreated = $user->createdAtToken;
      $refreshToken = $user->refresh_token;
      $time = time();
      $timeDifference = $time - $timeCreated;
      // アクセストークン発行から一時間未満なら
      if ($timeDifference < 3600) {
          $accessToken = $user->Gtoken;
          $client->setAccessToken($accessToken);
      }
      // アクセストークン発行から1時間経っていたら
      if ($timeDifference > 3600) {
          $client = $client->refreshToken($refreshToken);
          // $newToken= $client->getAccessToken();
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
      }
      $gsa = new Google_Service_AnalyticsReporting($client);
      $ga_result = $google->get_ga_data($gsa, $VIEW_ID, $start, $end);

      return Response::json($ga_result);

    }
    public function comparScReport(Google $google, Request $request){
      $check = 'check'
      return Response::json($check);
    }
}
