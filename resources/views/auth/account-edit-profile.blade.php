@extends('layouts.app')
@include('layouts.head')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="container profile-edit">
<div class="justify-content-center">
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form method="POST" action="{{ action('HomeController@accountProfileEdit', Auth::id()) }}" onSubmit="return check()">
@csrf
<label for="company">法人組織名</label>
<input type="text" class="form-control mb-4" value="{{$user->company}}" name="company" required autofocus>
<label for="name">担当者名</label>
<input type="text" class="form-control mb-4" value="{{$user->name}}" name="name" required autofocus>
<label for="email">メールアドレス</label>
<input type="email" class="form-control mb-4" value="{{$user->email}}" name="email" required autofocus>
<label for="tell">電話番号(半角・ハイフン無し)</label>
<input type="text" class="form-control mb-4" value="{{$user->tell}}" name="tell" required autofocus>
<div class="edit-profile-btn">
<p class="edit-profile-cancel mr-2 mt-2"><a href="{{ action('HomeController@accountEdit', Auth::id()) }}">キャンセル</a></p>
<button type="submit" class="edit-profile-go ml-2 mt-2">完了</button>

<input type="hidden" name="user_id" value="{{$user->id}}">
</form>
</div>
</form>
</div>
</div>

<script>
function check() {
  if(window.confirm('変更してもよろしいですか？')) {
    return true;
  } else {
    return false;
  }
}
</script>
@endsection