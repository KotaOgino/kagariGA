@section('head')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name', 'KAGARI') }}</title>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">

<!-- Styles -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<link href="{{ mix('css/all.css') }}" rel="stylesheet">

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/all.js') }}"></script>

<!-- vue -->
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<!-- vuetify -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script> -->
<!--
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet"> -->
<!-- bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- fontawsome -->
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

@endsection
