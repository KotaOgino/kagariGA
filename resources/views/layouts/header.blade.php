@section('header')
<header>
<div class="d-flex flex-column flex-sm-row align-items-center border-bottom pl-5 pr-5">

@auth
<a href="{{ url('/') }}">
<svg xmlns="http://www.w3.org/2000/svg" width="104.621" height="24" viewBox="0 0 104.621 24">
<g id="グループ化_559" data-name="グループ化 559" transform="translate(0 0)">
<path id="パス_768" data-name="パス 768" d="M624.891,680.428a48.568,48.568,0,0,1-11.471,11.551c-.889.618-1.424-.214-.892-.9A67,67,0,0,1,624,679.53C624.74,679,625.35,679.76,624.891,680.428Zm-4.257-4.287c.545-.784.022-1.565-.892-.9-.553.4-9.24,8.352-10.831,10.076-1.617-1.355-3.331-2.773-3.734-3.085a.636.636,0,0,0-.892.9,44.335,44.335,0,0,0,3.874,4.673,1.055,1.055,0,0,0,1.615.079A67.131,67.131,0,0,0,620.634,676.141Zm-11.7,3.205a60.964,60.964,0,0,0,7.478-6.734,1.09,1.09,0,0,0-.1-1.589c-.261-.23-2.913-2.487-3.206-2.691-.6-.419-1.308.189-.892.9.382.651,1.143,1.84,1.591,2.532-.359.335-5.224,5.987-5.757,6.685C607.528,679.125,608.067,679.971,608.937,679.346Z" transform="translate(-604.145 -668.195)" fill="#fc8c06"/>
<path id="パス_769" data-name="パス 769" d="M695.2,686.618h2.863v5.759l5.28-5.759H706.8l-5.3,5.59,5.54,7.585H703.6l-4.034-5.608-1.506,1.581v4.028H695.2Zm18.59-.094h2.64L722,699.792H719.01l-1.19-2.955h-5.5l-1.19,2.955h-2.919Zm3.011,7.754-1.729-4.272-1.729,4.272Zm6.729-1.035V693.2a6.72,6.72,0,0,1,6.822-6.813,7.093,7.093,0,0,1,5.112,1.807l-1.8,2.2a4.761,4.761,0,0,0-3.4-1.336,3.937,3.937,0,0,0-3.737,4.1v.038a3.926,3.926,0,0,0,3.941,4.178,4.529,4.529,0,0,0,2.7-.79v-1.882h-2.882v-2.5h5.652v5.721a8.388,8.388,0,0,1-5.558,2.089A6.552,6.552,0,0,1,723.527,693.243Zm20.541-6.719h2.64l5.577,13.268h-2.993l-1.19-2.955h-5.5l-1.19,2.955h-2.919Zm3.012,7.754-1.729-4.272-1.729,4.272Zm8.142-7.66h5.949a5.15,5.15,0,0,1,3.793,1.336,4.165,4.165,0,0,1,1.115,3.011V691a4.088,4.088,0,0,1-2.789,4.084l3.179,4.705h-3.346l-2.789-4.216h-2.249v4.216h-2.863Zm5.763,6.4c1.394,0,2.194-.753,2.194-1.863v-.037c0-1.242-.855-1.882-2.25-1.882h-2.844v3.783Zm8.737-6.4h2.863v13.174h-2.863Z" transform="translate(-667.963 -681.094)" fill="#6f7579"/>
</g>
</svg>
</a>
@endauth

@guest
<svg xmlns="http://www.w3.org/2000/svg" width="104.621" height="24" viewBox="0 0 104.621 24">
<g id="グループ化_559" data-name="グループ化 559" transform="translate(0 0)">
<path id="パス_768" data-name="パス 768" d="M624.891,680.428a48.568,48.568,0,0,1-11.471,11.551c-.889.618-1.424-.214-.892-.9A67,67,0,0,1,624,679.53C624.74,679,625.35,679.76,624.891,680.428Zm-4.257-4.287c.545-.784.022-1.565-.892-.9-.553.4-9.24,8.352-10.831,10.076-1.617-1.355-3.331-2.773-3.734-3.085a.636.636,0,0,0-.892.9,44.335,44.335,0,0,0,3.874,4.673,1.055,1.055,0,0,0,1.615.079A67.131,67.131,0,0,0,620.634,676.141Zm-11.7,3.205a60.964,60.964,0,0,0,7.478-6.734,1.09,1.09,0,0,0-.1-1.589c-.261-.23-2.913-2.487-3.206-2.691-.6-.419-1.308.189-.892.9.382.651,1.143,1.84,1.591,2.532-.359.335-5.224,5.987-5.757,6.685C607.528,679.125,608.067,679.971,608.937,679.346Z" transform="translate(-604.145 -668.195)" fill="#fc8c06"/>
<path id="パス_769" data-name="パス 769" d="M695.2,686.618h2.863v5.759l5.28-5.759H706.8l-5.3,5.59,5.54,7.585H703.6l-4.034-5.608-1.506,1.581v4.028H695.2Zm18.59-.094h2.64L722,699.792H719.01l-1.19-2.955h-5.5l-1.19,2.955h-2.919Zm3.011,7.754-1.729-4.272-1.729,4.272Zm6.729-1.035V693.2a6.72,6.72,0,0,1,6.822-6.813,7.093,7.093,0,0,1,5.112,1.807l-1.8,2.2a4.761,4.761,0,0,0-3.4-1.336,3.937,3.937,0,0,0-3.737,4.1v.038a3.926,3.926,0,0,0,3.941,4.178,4.529,4.529,0,0,0,2.7-.79v-1.882h-2.882v-2.5h5.652v5.721a8.388,8.388,0,0,1-5.558,2.089A6.552,6.552,0,0,1,723.527,693.243Zm20.541-6.719h2.64l5.577,13.268h-2.993l-1.19-2.955h-5.5l-1.19,2.955h-2.919Zm3.012,7.754-1.729-4.272-1.729,4.272Zm8.142-7.66h5.949a5.15,5.15,0,0,1,3.793,1.336,4.165,4.165,0,0,1,1.115,3.011V691a4.088,4.088,0,0,1-2.789,4.084l3.179,4.705h-3.346l-2.789-4.216h-2.249v4.216h-2.863Zm5.763,6.4c1.394,0,2.194-.753,2.194-1.863v-.037c0-1.242-.855-1.882-2.25-1.882h-2.844v3.783Zm8.737-6.4h2.863v13.174h-2.863Z" transform="translate(-667.963 -681.094)" fill="#6f7579"/>
</g>
</svg>
@endguest

@if(Request::is('add-site'))
<p class="header-center">サイト登録</p>
@elseif(Request::is('add-site/*') || Route::current()->getName() == 'again')
<p class="header-center">サイト登録</p>
@elseif(Route::current()->getName() == 'accountEdit')
<p class="header-center">アカウント</p>
@elseif(Route::current()->getName() == 'profile')
<p class="header-center">アカウント編集</p>
@elseif(Route::current()->getName() == 'site')
<p class="header-center">サイト管理</p>
@elseif(Route::current()->getName() == 'password')
<p class="header-center">パスワード変更</p>
@elseif(Route::current()->getName() == 'payment')
<p class="header-center">料金プラン変更</p>
@elseif(Route::current()->getName() == 'show' || Route::current()->getName() == 'top' || Route::current()->getName() == 'updata')
<p class="header-center modal-open">{{$addSite->url}}<i class="fas fa-angle-down"></i></p>
<!-- モーダルウィンドウ -->
<div class="modal">
<div class="modal-title">
<h2 class="modalTxt">サイト一覧</h2>
<i class="fas fa-times modal-close"></i>
</div>
<div class="sites-list-group">
<ul>
@foreach($add_sites as $addSite)
<li class="sites-list">
<a href="{{action('HomeController@show',$addSite)}}">
<p>
<svg class="globe" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20">
<defs>
<clipPath id="clip-path">
<rect width="20" height="20" fill="none"/>
</clipPath>
</defs>
<g id="Icon_-_Globe" data-name="Icon - Globe" clip-path="url(#clip-path)">
<path id="パス_4" data-name="パス 4" d="M3,3a9.078,9.078,0,0,1,7-3,9.078,9.078,0,0,1,7,3,9.078,9.078,0,0,1,3,7,9.078,9.078,0,0,1-3,7,9.078,9.078,0,0,1-7,3,9.078,9.078,0,0,1-7-3,9.98,9.98,0,0,1-3-7A9.078,9.078,0,0,1,3,3Zm8.333,15a4.1,4.1,0,0,0,2.5-1.5A7.28,7.28,0,0,0,15,13a2.76,2.76,0,0,0-.833-2A2.934,2.934,0,0,0,12,10H10.333a4.866,4.866,0,0,1-1.5-.333,1.513,1.513,0,0,1-.5-1.167.866.866,0,0,1,.333-.667A1.264,1.264,0,0,1,9.333,7.5a1.138,1.138,0,0,1,.833.5c.333.167.5.333.667.333a1,1,0,0,0,.667-.167,1,1,0,0,0,.167-.667,2.652,2.652,0,0,0-.833-1.667,6.894,6.894,0,0,0,.833-3.167.358.358,0,0,0-.333-.333A5.152,5.152,0,0,0,10,2,8.337,8.337,0,0,0,5.667,3.333a4.2,4.2,0,0,0-1.5,3.333A4.267,4.267,0,0,0,5.5,9.833a4.553,4.553,0,0,0,3.167,1.333h0v.667A2.14,2.14,0,0,0,9.333,13.5a2.427,2.427,0,0,0,1.5,1v3c0,.167,0,.167.167.333S11.167,18,11.333,18Z" fill="#959ea7"/>
</g>
</svg>
</p>
<span>{{$addSite->site_name}}<br><small>{{$addSite->url}}</small></span>
<?php
$plan = $addSite->plan;
?>
@if($plan === 0)
<div class="list-right">
<p class="genre-list">{{$addSite->genre}}</p>
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
<path id="yen-circle" d="M9,1a8,8,0,1,0,8,8A8,8,0,0,0,9,1ZM9,15.545A6.545,6.545,0,1,1,15.545,9,6.545,6.545,0,0,1,9,15.545ZM11.058,4.964,9,8.055,6.942,4.964a.727.727,0,0,0-1.215.8L7.262,8.069H6.818a.727.727,0,0,0,0,1.455H8.273l.036.058v.669H6.818a.727.727,0,1,0,0,1.455H8.273v1.658a.727.727,0,0,0,1.455,0V11.705h1.455a.727.727,0,0,0,0-1.455H9.727V9.582l.036-.058h1.418a.727.727,0,1,0,0-1.455h-.444l1.535-2.305a.727.727,0,0,0-1.215-.8Z" transform="translate(-1 -1)" fill="#959ea7"/>
</svg>
</div>
@else
<div class="list-right">
<p class="genre-list">{{$addSite->genre}}</p>
<!-- <div class="yen"> -->
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
<path id="yen-circle" d="M9,1a8,8,0,1,0,8,8A8,8,0,0,0,9,1ZM9,15.545A6.545,6.545,0,1,1,15.545,9,6.545,6.545,0,0,1,9,15.545ZM11.058,4.964,9,8.055,6.942,4.964a.727.727,0,0,0-1.215.8L7.262,8.069H6.818a.727.727,0,0,0,0,1.455H8.273l.036.058v.669H6.818a.727.727,0,1,0,0,1.455H8.273v1.658a.727.727,0,0,0,1.455,0V11.705h1.455a.727.727,0,0,0,0-1.455H9.727V9.582l.036-.058h1.418a.727.727,0,1,0,0-1.455h-.444l1.535-2.305a.727.727,0,0,0-1.215-.8Z" transform="translate(-1 -1)" fill="#E6830B"/>
</svg>
</div>
@endif
</a>
</li>
@endforeach
</ul>
</div>
<div class="add-sites">
<a href="{{action('HomeController@addSiteAgain',$addSite)}}"><i class="fas fa-plus"></i>サイトを登録</a>
</div>
</div>
@else
<p class="header-center"></p>
@endif
<!-- 右上のアイコン群 -->
<button type="button" class="drawer-toggle drawer-hamburger">
<span class="drawer-hamburger-icon"></span>
<span class="menu-str">MENU</span>
</button>
<nav class="drawer-nav" role="navigation">
<ul class="drawer-menu">
<li><a class="drawer-menu-item" href="https://kagari.ai/news/" target="_blank"><i class="fas fa-bell mr-sm-3"></i>お知らせ</a></li>
@auth
<li><a class="drawer-menu-item" href="{{ action('HomeController@accountEdit', Auth::id()) }}"><i class="fas fa-user mr-sm-3"></i>アカウント</a></li>
<li><a class="drawer-menu-item" href="{{ action('HomeController@accountSite', Auth::id()) }}"><i class="fas fa-list-ul mr-sm-3"></i>サイト管理</a></li>
@endauth
<li class="drawer-dropdown">
<a class="drawer-menu-item" href="#" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fas fa-book-open mr-sm-3"></i>マニュアル</a>
<ul class="drawer-dropdown-menu">
<li><a class="drawer-menu-item" href="https://kagari.ai/how-to-use/" target="_blank">使い方</a></li>
<li><a class="drawer-menu-item" href="https://kagari.ai/blog/manual/" target="_blank">設定方法</a></li>
<li><a class="drawer-menu-item" href="https://kagari.ai/blog/improve/" target="_blank">改善方法</a></li>
</ul>
</li>
<li><a class="drawer-menu-item" href="https://kagari.ai/contact/" target="_blank">お問い合わせ</a></li>
<li><a class="drawer-menu-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a></li>
</ul>
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{csrf_field()}}</form>
</div>
</header>
@endsection
