<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\AddSite;
use App\Category;
use App\Industry;
use App\Google;
use Google_Service_Analytics;
use Google_Service_AnalyticsReporting;
use Google_Service_Webmasters;
use Google_Service_Exception;

class AddSiteController extends Controller
{
    public function __construct()
    {
    }

    public function index(Google $google)
    {
        $result_array = [];
        $user = Auth::user();
        $client = $google->client();
        $timeCreated = $user->createdAtToken;
        if ($timeCreated == "") {
            $timeCreated = 0;
        }
        $refreshToken = $user->refresh_token;
        $time = time();
        $timeDifference = $time - $timeCreated;
        if ($timeDifference < 3600) {
            $accessToken = $user->Gtoken;
            $client->setAccessToken($accessToken);
        } elseif ($timeDifference > 3600) {
            $client = $client->refreshToken($refreshToken);
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

        $categories = Category::all(); // カテゴリー
        $industries = Industry::all(); // 業種
        return view('add-site')->with(["client" => $client, "categories" => $categories, "industries" => $industries]);
    }

    public function store(Request $request)
    {
        if (empty($request->site_name) && empty($request->genre)) {
            return redirect('/add-site')->with('message', 'サイト名とサイトジャンルを入力してください');
        } elseif (empty($request->site_name)) {
            return redirect('/add-site')->with('message', 'サイト名を入力してください');
        } elseif (empty($request->genre)) {
            return redirect('/add-site')->with('message', 'サイトを入力してください');
        }
        $add_sites = new AddSite();
        $add_sites->site_name = $request->site_name;
        $add_sites->genre = $request->genre;
        $add_sites->VIEW_ID = $request->view_id;
        $add_sites->url = $request->url;
        $add_sites->plan = $request->plan;
        $add_sites->user_id = Auth::user()->id;
        $add_sites->save();
        return redirect('/add-site/plan');
    }

    public function plan()
    {
        $user = Auth::user();
        $id = $user->id;
        $addSite =AddSite::where('user_id', $id)->latest()->first();
        return view('add-site-plan')->with(['addSite'=>$addSite,'user'=>$user]);
    }

    public function payment()
    {
        $user = Auth::user();
        $id = $user->id;
        $addSite = AddSite::where('user_id', $id)->latest()->first();
        return view('add-site-plan-payment')->with(['addSite'=>$addSite,'user'=>$user]);
    }

    public function done()
    {
        $id = Auth::user()->id;
        $addSite = AddSite::where('user_id', $id);
        return view('kagari.add-site-plan-payment-done');
    }
}
