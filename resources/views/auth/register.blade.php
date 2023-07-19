<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APME</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('template/assets/images/logos/logo.png')}}" />
  <link rel="stylesheet" href="{{asset('template/assets/css/styles.min.css')}}" />
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>

        <div id="app">
            <router-view>
                <Register />
            </router-view>
        </div>


  <script src="{{asset('template/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>