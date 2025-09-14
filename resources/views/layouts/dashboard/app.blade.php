
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
 @include('layouts.dashboard._head')
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
   @include('layouts.dashboard._header')
   @include('layouts.dashboard._sidebar')

@yield('content')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  @include('layouts.dashboard._footer')
  @include('layouts.dashboard._scripts')
</body>
</html>
