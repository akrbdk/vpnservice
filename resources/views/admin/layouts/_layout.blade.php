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
    <title>{{ trans('title.' . $page_key . 'title') }}</title>
    <meta name="description" content="{{ trans('title.' . $page_key . 'description') }}">
    <meta name="keywords" content="{{ trans('title.' . $page_key . 'keywords') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('admin.layouts.styles')

</head>
<body>

    @include('admin.layouts.header')

    @yield('content')

    @include('admin.layouts.footer')

    @include('admin.layouts.scripts')

</body>
</html>
