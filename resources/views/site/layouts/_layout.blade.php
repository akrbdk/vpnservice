<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" itemscope itemtype="http://schema.org/Article">
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="" prefix="og: http://ogp.me/ns#" itemscope itemtype="http://schema.org/Article">
<!--<![endif]-->
<head>
    <title>{{ $title }}</title>
    <meta name="description" content="{{ (isset($description)) ? $description : ''}}">
    <meta name="keywords" content="{{ (isset($keywords)) ? $keywords : ''}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--recaptcha--}}
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    @include('site.layouts.styles')

</head>
<body>

    @include('site.layouts.header')

    @yield('content')

    @include('site.layouts.footer')

    @include('site.layouts.scripts')
    
</body>
</html>