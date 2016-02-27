<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title> @yield('siteTitle') </title>

    <meta name="author" content="a.korani.it[at]gmail[dot]com">

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="canonical" href="http://www.20script.ir" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-touch-fullscreen" content="yes">

    <!-- BEGIN CORE CSS -->
    <link rel="stylesheet" href="{{cdn('newTheme/admin1/css/admin1.css')}}">
    <link rel="stylesheet" href="{{cdn('newTheme/globals/css/elements.css')}}">
    <!-- END CORE CSS -->

    <link rel="stylesheet" href="{{cdn('newTheme/globals/css/plugins.css')}}">

    <link rel="stylesheet" type="text/css" href="{{cdn('css/jsgrid/jsgrid.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{cdn('css/jsgrid/theme.css')}}" />

    @yield('headerCss')
    <link rel="stylesheet" href="{{cdn('newTheme/admin1/css/custom.css')}}">

    <!-- BEGIN SHORTCUT AND TOUCH ICONS -->
    <link rel="shortcut icon" href="{{cdn('newTheme/globals/img/icons/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{cdn('newTheme/globals/img/icons/apple-touch-icon.png')}}">
    <!-- END SHORTCUT AND TOUCH ICONS -->

    <script src="{{cdn('newTheme/globals/plugins/modernizr/modernizr.min.js')}}"></script>
</head>
