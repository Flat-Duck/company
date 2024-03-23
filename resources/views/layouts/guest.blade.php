<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta_tags')
    
    <title>gujo</title>

    @vite('resources/js/app.js')
    @yield('styles')

    @livewireStyles
  </head>
  <body>
  <body dir="rtl" class=" d-flex flex-column">
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark">
            <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image">
          </a>
        </div>
        @yield('content')
      </div>
    </div>
    @stack('modals')

    @livewireScripts
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    @if (session()->has('success')) 
    <script>   
        var notyf = new Notyf({dismissible: true})
        notyf.success('{{ session('success') }}')
    </script> 
    @endif
    <script>
      function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }          
      </script> 
  </body>
</html>