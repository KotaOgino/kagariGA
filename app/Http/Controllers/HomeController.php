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

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function header()
    {
        $auths = Auth::user();
        return view(
          ['layouts.header', ['auths' => $auths]],
          ['auth.account', ['auths' => $auths]],
          ['auth.account-edit-password', ['auths' => $auths]],
          ['auth.account-edit-site', ['auths' => $auths]],
          ['auth.account-edit-profile', ['auths' => $auths]]
        );
    }

    // TOPでの分析
    public function index(Google $google, AddSite $addSite)
    {
        $user = Auth::user();
        $id = $user->id;
        $add_sites = AddSite::where('user_id', $id)->get();
        if (empty($add_sites) || $add_sites == []) {
            return redirect('/accounts.google');
        }
        $addSite = AddSite::where('user_id', $id)->first();
        if (is_null($addSite)) {
            return redirect('/accounts.google');
        }
        $site_name = (string)$addSite->site_name;
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
        $gsw = new Google_Service_Webmasters($client);
        $end = date('Y-m-d', strtotime('-1 day', time()));
        $start = date('Y-m-d', strtotime('-31 days', time()));
        $comEnd = date('Y-m-d', strtotime('-1 day', strtotime($end)));
        $comStart = date('Y-m-d', strtotime('-31 days', strtotime($comEnd)));
        $ga_result = $google->get_ga_data($gsa, $VIEW_ID, $start, $end, $comStart, $comEnd);
        $ga_result = $ga_result[0];
        // $ga_user = $google->get_ga_user($gsa, $VIEW_ID, $start, $end);
        // $ga_inflow = $google->get_ga_inflow($gsa, $VIEW_ID, $start, $end);
        // $data = ["inflow"=>$ga_inflow];
        // dd($ga_inflow,$ga_user,$data);
        // $ga_inflow = $google->get_ga_inflow($gsa, $VIEW_ID, $start, $end);
        // dd($ga_inflow);
        // $ga_country = $google->get_ga_city($gsa, $VIEW_ID, $start, $end);
        // dd($ga_country);
        // $aaa = $google->get_ga_action($gsa, $VIEW_ID, $start, $end);
        // dd($aaa);
        // $ga_city = $google->get_ga_city($gsa, $VIEW_ID, $start, $end);
        // $ga_gender = $google->get_ga_gender($gsa, $VIEW_ID, $start, $end);
        // $ga_age = $google->get_ga_age($gsa, $VIEW_ID, $start, $end);
        // $ga_device = $google->get_ga_device($gsa, $VIEW_ID, $start, $end);
        // $ga_medium = $google->get_ga_medium($gsa, $VIEW_ID, $start, $end);
        // $ga_social = $google->get_ga_social($gsa, $VIEW_ID, $start, $end);
        // dd(array('social'=>$ga_social,'medium'=>$ga_medium,'city'=>$ga_city,'age'=>$ga_age,'device'=>$ga_device));
        return view('top')->with([
          'ga_result'=>$ga_result,
          'add_sites'=>$add_sites,
          'addSite'=>$addSite,
          'gsw'=>$gsw,
          'start'=>$start,
          'end'=>$end,
          'VIEW_ID'=>$VIEW_ID,
          'url'=>$url,
          'site_name'=>$site_name
        ]);
    }

    // Google OAuth認証
    public function google(Google $google, Request $request)
    {
        $client = $google->client();
        $code = $request->input('code');
        if ($code != '') {
            $client->authenticate($request->get('code'));
            $token = $client->getAccessToken();
            $timeCreated = $token['created'];
            $accessToken = $token['access_token'];
            if (isset($token['refresh_token'])) {
                $refreshToken = $token['refresh_token'];
                $user = Auth::user();
                $user->Gtoken = $accessToken;
                $user->refresh_token = $refreshToken;
                $user->createdAtToken = $timeCreated;
                $user->update();
            } else {
                $user = Auth::user();
                $user->Gtoken = $accessToken;
                $user->createdAtToken = $timeCreated;
                $user->update();
            }
            return redirect('/add-site');
        } else {
            $auth_url = $client->createAuthUrl();
            return redirect($auth_url);
        }
    }

    //日付の更新
    public function updata(Google $google, Request $request)
    {
        $url = $request->url;
        $VIEW_ID = $request->view_id;
        $id = $request->id;

        $addSites = AddSite::where('id', $id)->get();
        foreach ($addSites as $addSite) {
        }
        // VIEWのカレンダーからデータを取得
        $start = $request->start;
        $end = $request->end;
        // 今日の日付
        $today = time();
        // 終了日の日付と今日の日付の差
        $endDiffernce = $today - strtotime($end);
        // 終了日と今日の差が3日以内なら駄目
        if ($endDiffernce < 259200) {
            return redirect()->action('HomeController@show', $addSite)->with('message', '終了日を本日より3日以上前に設定してください');
        }
        // 終了の日付が今日よりも大きかったら
        if (strtotime($end) > $today) {
            return redirect()->action('HomeController@show', $addSite)->with('message', '終了日を本日の日付より前に設定してください');
        }
        // もし開始が終了より小さかったら
        if (strtotime($end) < strtotime($start)) {
            return redirect()->action('HomeController@show', $addSite)->with('message', '終了日を開始日より後に設定してください');
        }

        $user = Auth::user();
        $id = $user->id;
        // サイトの全データ,リスト出力用
        $add_sites = AddSite::where('user_id', $id)->get();

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
        $gsw = new Google_Service_Webmasters($client);
        $ga_result = $google->get_ga_data($gsa, $VIEW_ID, $start, $end);

        return view('report-show')->with([
          'ga_result'=>$ga_result,
          'add_sites'=>$add_sites,
          'addSite'=>$addSite,
          'gsw'=>$gsw,
          'start'=>$start,
          'end'=>$end,
          'VIEW_ID'=>$VIEW_ID
        ]);
    }

    // サイトごとの分析
    public function show(AddSite $addSite, Google $google)
    {
        $user = Auth::user();
        $id = $user->id;
        $user_id = $addSite->user_id;
        if ($id != $user_id) {
            return redirect('/');
        }
        // サイトの全データ
        $add_sites = AddSite::where('user_id', $id)->get();
        // 個別のデータ
        $VIEW_ID =(string)$addSite->VIEW_ID;
        $url = $addSite->url;

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
        $gsw = new Google_Service_Webmasters($client);

        $start = date('Y-m-d', strtotime('-33 day', time()));
        $end = date('Y-m-d', strtotime('-3 day', time()));

        $ga_result = $google->get_ga_data($gsa, $VIEW_ID, $start, $end);

        // $ga_city = $google->get_ga_city($gsa, $VIEW_ID, $start, $end);
        // $ga_gender = $google->get_ga_gender($gsa, $VIEW_ID, $start, $end);
        // $ga_age = $google->get_ga_age($gsa, $VIEW_ID, $start, $end);
        // $ga_device = $google->get_ga_device($gsa, $VIEW_ID, $start, $end);
        // $ga_medium = $google->get_ga_medium($gsa, $VIEW_ID, $start, $end);
        // $ga_social = $google->get_ga_social($gsa, $VIEW_ID, $start, $end);
        //dd(array('social'=>$ga_social,'medium'=>$ga_medium,'city'=>$ga_city,'age'=>$ga_age,'device'=>$ga_device));

        return view('report-show')->with([
        'ga_result'=>$ga_result,
        'add_sites'=>$add_sites,
        'addSite'=>$addSite,
        'gsw'=>$gsw,
        'start'=>$start,
        'end'=>$end,
        'VIEW_ID'=>$VIEW_ID,
        'url'=>$url
       ]);
    }

    public function get_plan($id)
    {
        $addSite = AddSite::find($id);
        return $addSite;
    }

    public function planEdit($id, Request $request)
    {
        $user = Auth::user();
        $addSite = AddSite::find($id);

        return view('kagari.plan-change')->with(['addSite'=>$addSite,'user'=>$user]);
    }

    public function planEditDone(Request $request, $id)
    {
        $addSite = AddSite::find($id);
        $addSite->plan = $request->plan;
        $addSite->save();
        return view('kagari.plan-change-done')->with('addSite', $addSite);
    }

    public function planEditFinish($id)
    {
        $addSite = AddSite::find($id);
        return view('kagari.plan-change-done')->with('addSite', $addSite);
    }

    public function accountEdit($id)
    {
        $user = Auth::user($id);
        $addSites = AddSite::where('user_id', $id)->get();
        return view('auth.account')->with(['addSites'=>$addSites,'user'=>$user]);
    }

    public function accountDelet($id)
    {
        $user = Auth::user($id);
        return view('auth.account-delet')->with('user', $user);
    }

    public function accountDeletDone()
    {
        $user = Auth::user();
        $user->delete();
        return redirect('login');
    }

    public function accountProfile($id)
    {
        $user = Auth::user($id);
        $addSites = AddSite::where('user_id', $id)->get();
        return view('auth.account-edit-profile')->with(['addSites'=>$addSites, 'user'=>$user]);
    }

    public function accountProfileEdit(Request $request, $id)
    {
        $all = $request->only(['email','tell']);
        $validator = Validator::make($all, [
            'email' => 'required|unique:users,email,'.$request->user_id.'|max:255|email',
            'tell' => 'required|numeric|digits_between:8,11',
        ]);

        if ($validator->fails()) {
            return redirect($id.'/account/profile')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = Auth::user();
            $addSite = AddSite::find($id);
            $user->company = $request->company;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->tell = $request->tell;
            $user->update();
            return redirect()->action('HomeController@accountEdit', $addSite);
        }
    }

    public function accountPassword($id)
    {
        $user = Auth::user($id);
        return view('auth.account-edit-password')->with(['user'=>$user]);
    }

    public function accountPasswordEdit(Request $request, $addSite)
    {
        $user = Auth::user();

        $newpass = Hash::make($request->newpass);
        $password = $request->password;

        if (Hash::check($password, $user->password)) {
            if ($request->newpass === $request->newpassConfirm) {
                $user->password = $newpass;
                $user->update();
                return redirect()->action('HomeController@accountEdit', $addSite)->with('message', 'パスワードを変更しました');
            } else {
                return redirect()->action('HomeController@accountPassword', $addSite)->with('message', '確認パスワードに誤りがあります');
            }
        } else {
            return redirect()->action('HomeController@accountPassword', $addSite)->with('message', '現在のパスワードに誤りがあります');
        }
    }

    public function accountSite($addSite)
    {
        $user = Auth::user();
        $id = $user->id;
        // サイトの全データ
        $add_sites = AddSite::where('user_id', $id)->get();
        return view('auth.account-edit-site')->with(['addSite'=>$addSite,'add_sites'=>$add_sites,'user'=>$user]);
    }

    //サイト管理画面で有料プランから無料プランに変更
    public function accountFree(Request $request)
    {
        $id = $request->id;
        $addSite = AddSite::find($id);
        $addSite->plan = $request->plan;
        $addSite->save();

        return redirect()->action('HomeController@accountSite', $addSite);
    }
    // クレカ情報編集
    public function accountCreditCard($addSite)
    {
        $user = Auth::user();
        return view('kagari.account-edit-payment')->with('user', $user);
    }

    // サイトを新しく追加する
    public function addSiteAgain(Google $google)
    {
        $result_array = [];
        $user = Auth::user();
        $client = $google->client();
        $timeCreated = $user->createdAtToken;
        $refreshToken = $user->refresh_token;
        $time =time();
        $timeDifference = $time - $timeCreated;
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

        $categories = Category::all(); // カテゴリー
        $industries = Industry::all(); // 業種
        return view('add-site')->with(["client" => $client, "categories" => $categories, "industries" => $industries]);
    }
}
