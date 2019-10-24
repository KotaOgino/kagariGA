@extends('layouts.app')
@include('layouts.head')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="account">
<div class="container">
@if (session('message'))
<div class="my-5">
<div class="alert alert-warning">
{{ session('message') }}
</div>
</div>
@endif

<div class="editTitle">
<h2>アカウント</h2>
<p><a href="{{ action('HomeController@accountProfile', Auth::id()) }}">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16.001" viewBox="0 0 16 16.001">
<defs>
<clipPath id="clip-path">
<rect width="16" height="16.001" fill="none"/>
</clipPath>
</defs>
<g id="Icon_-_Edit_1" data-name="Icon - Edit – 1" transform="translate(0 0)" clip-path="url(#clip-path)">
<rect id="長方形_1141" data-name="長方形 1141" width="16" height="16" transform="translate(0 0)" fill="none"/>
<path id="pen" d="M18,6.192a.8.8,0,0,0-.232-.568L14.376,2.232a.811.811,0,0,0-1.136,0L10.976,4.5h0L2.232,13.24A.8.8,0,0,0,2,13.808V17.2a.8.8,0,0,0,.8.8H6.192a.8.8,0,0,0,.608-.232l8.7-8.744h0L17.768,6.8a.952.952,0,0,0,.176-.264.8.8,0,0,0,0-.192.56.56,0,0,0,0-.112ZM5.864,16.4H3.6V14.136l7.944-7.944,2.264,2.264Zm9.072-9.072L12.672,5.064l1.136-1.128,2.256,2.256Z" transform="translate(-2 -2)" fill="#E6830B"/>
</g>
</svg>編集</a></p>
</div>
<div class="editContent">
<h3>法人・組織名</h3>
<p>{{$user->company}}</p>
</div>
<div class="editContent">
<h3>担当者名</h3>
<p>{{$user->name}}</p>
</div>
<div class="editContent">
<h3>メールアドレス</h3>
<p>{{$user->email}}</p>
</div>
<div class="editContent">
<h3>電話番号</h3>
<p>{{$user->tell}}</p>
</div>
<div class="editTitle">
<h2>パスワード</h2>
<p><a href="{{ action('HomeController@accountPassword', Auth::id()) }}">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16.001" viewBox="0 0 16 16.001">
<defs>
<clipPath id="clip-path">
<rect width="16" height="16.001" fill="none"/>
</clipPath>
</defs>
<g id="Icon_-_Edit_1" data-name="Icon - Edit – 1" transform="translate(0 0)" clip-path="url(#clip-path)">
<rect id="長方形_1141" data-name="長方形 1141" width="16" height="16" transform="translate(0 0)" fill="none"/>
<path id="pen" d="M18,6.192a.8.8,0,0,0-.232-.568L14.376,2.232a.811.811,0,0,0-1.136,0L10.976,4.5h0L2.232,13.24A.8.8,0,0,0,2,13.808V17.2a.8.8,0,0,0,.8.8H6.192a.8.8,0,0,0,.608-.232l8.7-8.744h0L17.768,6.8a.952.952,0,0,0,.176-.264.8.8,0,0,0,0-.192.56.56,0,0,0,0-.112ZM5.864,16.4H3.6V14.136l7.944-7.944,2.264,2.264Zm9.072-9.072L12.672,5.064l1.136-1.128,2.256,2.256Z" transform="translate(-2 -2)" fill="#E6830B"/>
</g>
</svg>変更</a></p>
</div>
<div class="editContent">
</div>
<div class="accountBtn">
<p><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
</p>
</div>
<div class="deletBtn">
<p><a href="{{ action('HomeController@accountDelet', Auth::id()) }}">退会はこちら</a></p>
</div>
</div>
</div>
@endsection