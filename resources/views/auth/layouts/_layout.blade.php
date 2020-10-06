<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" itemscope itemtype="http://schema.org/Article">
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="" prefix="og: http://ogp.me/ns#" itemscope itemtype="http://schema.org/Article">
<!--<![endif]-->
<head>
    <!-- Título -->
    <title>Speed VPN</title>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--recaptcha--}}
    <script src='https://www.google.com/recaptcha/api.js'></script>

    @include('auth.layouts.styles')

</head>
<body>

@include('auth.layouts.header')

@yield('content')

@include('auth.layouts.footer')

@include('auth.layouts.scripts')

</body>
</html>
