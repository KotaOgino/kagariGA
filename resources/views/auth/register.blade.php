@extends('layouts.app')
@include('layouts.head')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="container sign-up-form">
<div class="justify-content-center">
<h1 class="font-weight-bold mb-5">新規会員登録</h1>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form method="POST" action="{{ route('register') }}">
@csrf
<div class="form-group">
<label class="required-label" for="company">法人組織名</label>
<input type="text" class="form-control mb-4" placeholder="株式会社ランプ" name="company" value="{{ old('company') }}" required>
</div>

<div class="form-group">
<label class="required-label" for="name">担当者名</label>
<input type="text" class="form-control mb-4" placeholder="ランプ太郎" name="name" value="{{ old('name') }}" required>
</div>

<div class="form-group">
<label class="required-label" for="email">メールアドレス</label>
<input type="email" class="form-control mb-4" placeholder="info@example.com" name="email" value="{{ old('email') }}" required>
</div>

<div class="form-group">
<label class="required-label" for="tell">電話番号(半角・ハイフン無し)</label>
<input type="tel" class="form-control mb-4" placeholder="0123456789" name="tell" value="{{ old('tell') }}" required>
</div>

<div class="form-group">
<label class="required-label" for="password">パスワード*6文字以上</label>
<input type="password" class="form-control mb-4" placeholder="" name="password" required>
</div>

<div class="form-group">
<label class="required-label" for="password_confirmation">パスワード(確認)</label>
<input type="password" class="form-control" name="password_confirmation" required>
</div>

<div class="form-group form-check mb-5">
<div class="text-center">
<input type="checkbox" class="form-check-input" id="terms-of-use" required>
<label class="form-check-label" for="terms-of-use"><a href="https://kagari.ai/terms/" target="_blank">利用規約</a>に同意する</label>
</div>
</div>

<div class="alert alert-info">
<small>※「次へ」をクリックするとGoogleアカウント認証のページに遷移します。
<br>※Googleアカウントは、Google AnalyticsとSearch Consoleに登録済のGoogleアカウントを選択ください。</small>
</div>

<div class="form-group">
<button class="kagari-btn" type="submit" onclick="gtag('event', 'click', {'event_category': 'register','event_label': 'next'});">次へ</button>
</div>

</form>
</div>
</div>
@endsection