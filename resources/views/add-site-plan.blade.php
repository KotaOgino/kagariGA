@extends('layouts.app')
@include('layouts.head')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="container add-site-plan">
<div class="plan-title">
<h1 class="text-center">サイトのプランを選択してください</h1>
<p class="text-center"><small>※プランは後からでも変更可能です</small></p>
</div>
<div class="row wrapper">
<div class="plan-box-a">
<h2>無料プラン</h2>
<p class="price-plan">無料</p>
<div class="feautuer">
<ul>
<li>サイト分析
<svg class="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
</li>
<li>SEO分析
<svg class="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
</li>
<li>SNS分析
<svg class="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
</li>
<li>1サイトのページ数<span class="page-plan">5ページまで</span></li>
<li>データ保存期間<span class="page-plan">16ヶ月</span></li>
</ul>
</div>
<a class="kagari-btn-box-l" href="{{ action('HomeController@show',$addSite) }}">このプランで登録</a>
</div>
<div class="plan-box-b">
<h2>スタンダードプラン</h2>
<p class="price-plan">¥1,980<span class="s-12">(税込)/月</span></p>
<div class="feautuer">
<ul>
<li>サイト分析
<svg class="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
</li>
<li>SEO分析
<svg class="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
</li>
<li>SNS分析
<svg class="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
</li>
<li>1サイトのページ数<span class="page-plan">無制限</span></li>
<li>データ保存期間<span class="page-plan">無制限</span></li>
</ul>
</div>
<a class="kagari-btn-box-r" href="{{ action('AddSiteController@payment',$addSite) }}">このプランで登録</a>
</div>
<div class="spacial-exp">
<h3>サービス開始記念<br>特別キャンペーン</h3>
<p>2019年9月30日までの期間内に有料プランにご登録いただくと、通常月額4,980円(税込)のところをずっと月額1,980円(税込)でご利用いただけます。</p>
</div>
</div>
</div>
@endsection