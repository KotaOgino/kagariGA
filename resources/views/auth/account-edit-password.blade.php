@extends('layouts.app')
@include('layouts.head')
@include('layouts.header')
@include('layouts.footer')

@section('content')
<div class="container profile-edit">
@if (session('message'))
<div class="my-5">
<div class="alert alert-warning">
{{ session('message') }}
</div>
</div>
@endif
<div class="justify-content-center">
<form method="POST" action="{{ action('HomeController@accountPasswordEdit', Auth::id()) }}" onSubmit="return check()">
@csrf
<label for="newpass">新しいパスワード*6文字以上</label>
<input type="password" class="form-control mb-4" name="newpass" required autofocus>
<label for="newpassConfirm">新しいパスワード(確認)</label>
<input type="password" class="form-control mb-4" name="newpassConfirm" required autofocus>
<label for="password">現在のパスワード</label>
<input type="password" class="form-control mb-4" name="password" required autofocus>
<div class="edit-profile-btn">
<p class="edit-profile-cancel mr-2 mt-2"><a href="{{ action('HomeController@accountEdit', Auth::id()) }}">キャンセル</a></p>
<button type="submit" class="edit-profile-go ml-2 mt-2">
完了</button>
</div>
</form>
</div>
</form>
</div>
<script>
function check() {
  if(window.confirm('パスワード更新してもよろしいでしょうか？')) {
    return true;
  } else {
    return false;
  }
}
</script>
@endsection