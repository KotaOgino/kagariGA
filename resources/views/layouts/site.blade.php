@push('scripts')
<script src="{{ mix('js/addsite.js') }}"></script>
@endpush

@section('content')
<div class="container add-site">
@if (session('message'))
<div class="row my-5">
<div class="col-md-8 col-md-offset-2">
<div class="alert alert-warning">
{{ session('message') }}
</div>
</div>
</div>
@endif
<div class="row">
<h2>GoogleAnalyticsのビューを選択してください</h2>
<p><small>お探しのサイトが無い場合はGoogleAnalyticsにて追加してください</small>
<br><small><a href="https://kagari.ai/blog/google-analytics/" target="_blank"><i class="fas fa-link mr-sm-1"></i>GoogleAnalyticsの設定方法</a></small></p>
@inject('google','App\Google')
<?php
$analytics = new Google_Service_Analytics($client);

$properties = $google->get_properties($analytics);
$analytics_lists = $google->get_account_data($properties);
?>
<div class="site-search">
<input id="ga-search" type="text" placeholder="検索">
</div>
<div class="search-accounts">
<ul class="site-account">
@forelse($analytics_lists as $list)
<?php
$limit = 1;
$start = date('Y-m-d', strtotime('-10 day', time()));
$end = date('Y-m-d', strtotime('-3 day', time()));
$url = $list[2];
$content_url = $url;
?>
<li  class="pulldown-a">
<span>
<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
<g id="グループ化_804" data-name="グループ化 804" transform="translate(-22 -298)">
<path id="パス_762" data-name="パス 762" d="M17-16.5H10.72l-.32-1a3,3,0,0,0-2.84-2H3a3,3,0,0,0-3,3v13a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3v-10A3,3,0,0,0,17-16.5Zm1,13a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1v-13a1,1,0,0,1,1-1H7.56a1,1,0,0,1,.95.68l.54,1.64a1,1,0,0,0,.95.68h7a1,1,0,0,1,1,1Z" transform="translate(22 318)" fill="#959ea7"/>
<rect id="長方形_1177" data-name="長方形 1177" width="20" height="20" transform="translate(22 298)" fill="none"/>
</g>
</svg>
{{$list[1]}}
</span>
<form class="site-add-form">
@csrf
<div class="form-group site-info">
<label class="required-label" for="site-name">サイト名</label>
<input type="text" class="form-control" id="site-name" placeholder="入力してください" required>
</div>
<div class="form-group">
<label class="required-label" for="business">業種</label>
<select class="form-control" name="business" id="business">
@foreach($industries as $industry)
<option value="{{$industry->name}}">{{$industry->name}}</option>
@endforeach
</select>
</div>
<div class="form-group">
<label class="required-label" for="site-genre">サイトのジャンル</label>
<select class="form-control" id="site_genre" required>
@foreach($categories as $category)
<option value="{{$category->cat}}">{{$category->cat}}</option>
@endforeach
</select>
</div>
<input id="view_id" type="hidden" value="{{$list[4]}}">
<input id="url" type="hidden" value="{{$list[2]}}">
<input id="plan" type="hidden" value="0">
<button action="{{action('AjaxController@displayConsole')}}" class="kagari-btn-sm"type="button" limit={{$limit}} start={{$start}} end={{$end}} url={{$url}} content_url={{$content_url}}>このサイトを追加</button>
</form>
</li>
@empty
<li>登録されているアカウントがありません</li>
@endforelse
</ul>
</div>
<!-- <div class="col-md-6">
<h2>SearchConsoleのサイト選択</h2>
<p><small>選択したいURLが無い場合は他のGoogleアカウントでログインしてください。</small>
<br><small><a href="https://kagari.ai/blog/search-console/" target="_blank"><i class="fas fa-link mr-sm-1"></i>SearchConsoleの設定方法</a></small></p>
<div class="url-search">
<p class="result_url">
<svg id="match-glob" class="match-glob mr-1 display-inline-block" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><clipPath id="clip-path"><rect width="20" height="20" fill="none"/></clipPath></defs><g id="Icon_-_Globe" data-name="Icon - Globe" clip-path="url(#clip-path)">
<path id="パス_4" data-name="パス 4" d="M3,3a9.078,9.078,0,0,1,7-3,9.078,9.078,0,0,1,7,3,9.078,9.078,0,0,1,3,7,9.078,9.078,0,0,1-3,7,9.078,9.078,0,0,1-7,3,9.078,9.078,0,0,1-7-3,9.98,9.98,0,0,1-3-7A9.078,9.078,0,0,1,3,3Zm8.333,15a4.1,4.1,0,0,0,2.5-1.5A7.28,7.28,0,0,0,15,13a2.76,2.76,0,0,0-.833-2A2.934,2.934,0,0,0,12,10H10.333a4.866,4.866,0,0,1-1.5-.333,1.513,1.513,0,0,1-.5-1.167.866.866,0,0,1,.333-.667A1.264,1.264,0,0,1,9.333,7.5a1.138,1.138,0,0,1,.833.5c.333.167.5.333.667.333a1,1,0,0,0,.667.167,1,1,0,0,0,.167-.667,2.652,2.652,0,0,0-.833-1.667,6.894,6.894,0,0,0,.833-3.167.358.358,0,0,0-.333-.333A5.152,5.152,0,0,0,10,2,8.337,8.337,0,0,0,5.667,3.333a4.2,4.2,0,0,0-1.5,3.333A4.267,4.267,0,0,0,5.5,9.833a4.553,4.553,0,0,0,3.167,1.333h0v.667A2.14,2.14,0,0,0,9.333,13.5a2.427,2.427,0,0,0,1.5,1v3c0,.167,0,.167.167.333S11.167,18,11.333,18Z" fill="#6F7579"/></g></svg>
<span>先にGoogleアナリティクスのビューを選択してください</span></p>
</div>
</div> -->
</div>
<form class="" action="{{ action('AddSiteController@store') }}" method="post">
@csrf
<input type="hidden" name="site_name" value="">
<input type="hidden" name="genre" value="">
<input type="hidden" name="view_id" value="">
<input type="hidden" name="url" value="">
<input type="hidden" name="plan" value="">
<button id="kagari-btn-md" class="kagari-btn-md" type="submit" disabled="disabled">次へ</button>
</form>
</div>
@endsection
