@extends('layouts.app')
@include('layouts.head')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="siteList container">
<ul class="kagari-site-list">
<li class="">
<p><b>サイト名</b></p>
<p class="genre-list-edit"><b>サイトジャンル</b></p>
<p class="yen-edit-free"><b>プラン</b></p>
</li>
@foreach($add_sites as $addSite)
<?php
$site_id = (string)$addSite->id;
?>
<li class="sites-list-edit">
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
<div id="{{$site_id}}" class="siteNameCurrent siteNameCurrent-{{$site_id}}">
<p><span id="{{$site_id}}" class="siteName siteName-{{$site_id}}">{{$addSite->site_name}}</span><br><small>{{$addSite->url}}</small></p>
<button id="{{$site_id}}" class="siteEditBtn siteEditBtn-{{$site_id}}">
<svg class="editPen" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16.001" viewBox="0 0 16 16.001">
<defs>
<clipPath id="clip-path">
<rect width="16" height="16.001" fill="none"/>
</clipPath>
</defs>
<g id="Icon_-_Edit_1" data-name="Icon - Edit – 1" transform="translate(0 0)" clip-path="url(#clip-path)">
<rect id="長方形_1141" data-name="長方形 1141" width="16" height="16" transform="translate(0 0)" fill="none"/>
<path id="pen" d="M18,6.192a.8.8,0,0,0-.232-.568L14.376,2.232a.811.811,0,0,0-1.136,0L10.976,4.5h0L2.232,13.24A.8.8,0,0,0,2,13.808V17.2a.8.8,0,0,0,.8.8H6.192a.8.8,0,0,0,.608-.232l8.7-8.744h0L17.768,6.8a.952.952,0,0,0,.176-.264.8.8,0,0,0,0-.192.56.56,0,0,0,0-.112ZM5.864,16.4H3.6V14.136l7.944-7.944,2.264,2.264Zm9.072-9.072L12.672,5.064l1.136-1.128,2.256,2.256Z" transform="translate(-2 -2)" fill="#E6830B"/>
</g>
</svg>
編集
</button>
</div>
<div id="{{$site_id}}" class="SiteNameNew SiteNameNew-{{$site_id}} none">
<form id="siteNameForm" class="siteNameForm" action="{{action('AjaxController@siteNameChange',$addSite)}}" method="post" site_id="{{$addSite->id}}">
@csrf
<input type="text" name="site_name" class="site_input" value="{{$addSite->site_name}}" placeholder="サイト名を変更" autofocus>
<button id="{{$site_id}}" type="submit" class="siteEditBtnDone siteEditBtnDone-{{$site_id}}">
<svg class="editPen" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16.001" viewBox="0 0 16 16.001">
<defs>
<clipPath id="clip-path">
<rect width="16" height="16.001" fill="none"/>
</clipPath>
</defs>
<g id="Icon_-_Edit_1" data-name="Icon - Edit – 1" transform="translate(0 0)" clip-path="url(#clip-path)">
<rect id="長方形_1141" data-name="長方形 1141" width="16" height="16" transform="translate(0 0)" fill="none"/>
<path id="pen" d="M18,6.192a.8.8,0,0,0-.232-.568L14.376,2.232a.811.811,0,0,0-1.136,0L10.976,4.5h0L2.232,13.24A.8.8,0,0,0,2,13.808V17.2a.8.8,0,0,0,.8.8H6.192a.8.8,0,0,0,.608-.232l8.7-8.744h0L17.768,6.8a.952.952,0,0,0,.176-.264.8.8,0,0,0,0-.192.56.56,0,0,0,0-.112ZM5.864,16.4H3.6V14.136l7.944-7.944,2.264,2.264Zm9.072-9.072L12.672,5.064l1.136-1.128,2.256,2.256Z" transform="translate(-2 -2)" fill="#E6830B"/>
</g>
</svg>
完了
</button>
</form>
</div>

<?php
$plan = $addSite->plan;
?>
<p class="genre-list-edit">{{$addSite->genre}}</p>
@if($plan === 0)
<p class="yen-edit-free" kagari-id="{{$site_id}}">無料プラン</p>
@else
<p class="yen-edit" kagari-id="{{$site_id}}">有料プラン</p>
@endif
</li>
@endforeach
</ul>

<div class="addsite-btn">
<a href="{{ action('HomeController@addSiteAgain', Auth::id()) }}"><i class="fas fa-plus"></i>サイトを登録</a>
</div>

<div class="editSiteBtn">
<a onclick="history.back()">戻る</a>
</div>
</div>
<!-- 料金用モーダル（有料へ） -->
<div class="modal-plan-edit-free">
<div class="modal-plan-title">
<h2 class="modalTxt-plan">有料プランに変更</h2>
</div>
<div class="modal-plan-exp">
<h3>KAGARIの充実したアクセス機能をご利用ください</h3>
<p class="one-site"><small>1サイト</small></p>
<p class="price-per-month">¥1,980<span class="perMonth">(税込)/月</span></p>
<p class="campaign">サービス開始記念特別キャンペーン</p>
<p class="campaign-exp">2019年9月30日までの期間内に有料プランにご登録いただくと、通常月額4,980円(税込)のところを、ずっと月額1,980円(税込)でご利用いただけます。</p>
<div class="d-flex justify-content-center">
<div class="p-2" style="width:40%">
<p class="limit-exp">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222"><defs><clipPath id="clip-path"><rect width="14.054" height="10.222" fill="none"/></clipPath></defs><g id="コンポーネント" clip-path="url(#clip-path)"><path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/></g></svg>
解析ページ数無制限</p>
<p class="limit-exp-txt">サイト内の全てのページをアクセス解析できます</p>
</div>
<div class="p-2" style="width:40%">
<p class="limit-exp">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222"><defs><clipPath id="clip-path"><rect width="14.054" height="10.222" fill="none"/></clipPath></defs><g id="コンポーネント" clip-path="url(#clip-path)"><path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/></g></svg>
データ蓄積</p>
<p class="limit-exp-txt">データを日々蓄積できます</p>
</div>
</div>
</div>
<div class="change-plan-btn">
<p class="change-plan-free-cancel mr-2">キャンセル</p>
<a class="change-plan-go" href="{{action('HomeController@planEdit',$addSite)}}">プランを変更</a>
</div>
</div>
<!-- 料金用モーダル（無料へ） -->
<div class="modal-plan-edit">
<div class="modal-plan-title">
<h2 class="modalTxt-plan">無料プランに変更</h2>
</div>
<div class="modalContent">
<h3>無料プランに変更してよろしいですか？</h3>
<p><small>以下の機能がご利用いただけなくなります</small></p>
<div class="functionList mt-5">
<div class="row">
<div class="col-md-5 list-o">
<ul>
<li class="mb-5">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
ページ数無制限</li>
<li class="mb-5"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.054" height="10.222" viewBox="0 0 14.054 10.222">
<defs>
<clipPath id="clip-path">
<rect width="14.054" height="10.222" fill="none"/>
</clipPath>
</defs>
<g id="コンポーネント" clip-path="url(#clip-path)">
<path id="パス_767" data-name="パス 767" d="M14.71-10.79a1,1,0,0,0-.71-.3,1,1,0,0,0-.71.3L5.84-3.33,2.71-6.47a1.022,1.022,0,0,0-.992-.247,1.022,1.022,0,0,0-.71.735A1.022,1.022,0,0,0,1.29-5L5.13-1.16a1,1,0,0,0,.71.3,1,1,0,0,0,.71-.3l8.16-8.16a1,1,0,0,0,.322-.735A1,1,0,0,0,14.71-10.79Z" transform="translate(-0.978 11.086)" fill="#E6830B"/>
</g>
</svg>
データ蓄積</li>
</ul>
</div>
<div class="col-md-7 list-normal">
<ul>
<li class="mb-5">サイト内の全てのページをアクセス解析できます</li>
<li class="mb-5">データを日々蓄積できます</li>
</ul>
</div>
</div>
</div>
</div>
<div class="change-plan-btn">
<p class="change-plan-cancel mr-2 mt-2">キャンセル</p>
<form class="plan-edit-form" action="{{ action('HomeController@accountFree', Auth::id()) }}" method="post">
@csrf
<input type="hidden" name="id" value="{{$addSite->id}}">
<input type="hidden" name="plan" value="0">
<button class="change-plan-go ml-2 mt-2" type="submit">プランを変更</button>
</form>
</div>
</div>
@endsection