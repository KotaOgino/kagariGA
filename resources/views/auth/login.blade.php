@extends('layouts.app')
@include('layouts.head')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="container login-form">
<div class="row justify-content-center">
<div class="container">
<div class="justify-content-center">
<form method="POST" action="{{route('login')}}">
@csrf
<h1 class="font-weight-bold mb-5">ログイン</h1>
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<label for="email">メールアドレス</label>
<input type="email" class="form-control mb-4" placeholder="info@example.com" name="email" required autofocus>
<label for="password">パスワード</label>
<input type="password" class="form-control mb-5" name="password" required autofocus>
<button class="kagari-btn" type="submit">ログイン</button>
</form>
<p class="mt-3 text-center">
  <a href="{{ url('/register') }}"><small class="color-gray">新規会員登録はこちらから</a></small>
  @if (Route::has('password.request'))
  <br>
  <a href="{{ route('password.request') }}"><small class="color-gray">パスワードを忘れたかたはこちら</small></a>
  @endif
</p>
</div>
</div>
</div>
</div>
@endsection
