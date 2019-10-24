@section('content')
<section class="mt-5 pb-4">
<div class="container">
<div class="d-flex bd-highlight mb-3 bg-white border shadow">
<div class="mr-auto p-2 bd-highlight top-line">
<p class="mt-4 ml-3 sixteen bold">{{$site_name}}</p>
<br>
<p class="ml-3 mb-4 gray fourteen">{{$url}}</p>
</div>
<div class="p-2 bd-highlight top-line">
<p class="mt-4 mr-3 blue fourteen">期間</p>
<br>
<p class="mr-3 mb-4 red fourteen">比較</p>
</div>
</div>
</div>
</section>
<section class="mb-4">
<div id="app">
<nav-component></nav-component>
</div>
</section>
<script src="{{ asset('/js/app.js') }}"></script>
@endsection
