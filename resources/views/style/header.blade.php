<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('siteTitle') </title>
    <meta name="description" content="">
    <meta name="author" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/font-awesome.min.css')}}">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/smartadmin-production-plugins.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/smartadmin-production.min.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/smartadmin-skins.min.css')}}">

    @yield('header_extra')
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/your_style.css')}}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{cdn('css/demo.min.css')}}">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="{{cdn('img/favicon/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{cdn('img/favicon/favicon.ico')}}" type="image/x-icon">

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="{{cdn('css/google_font.css')}}">

    <!-- Specifying a Webpage Icon for Web Clip
         Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="{{cdn('img/splash/sptouch-icon-iphone.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{cdn('img/splash/touch-icon-ipad.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{cdn('img/splash/touch-icon-iphone-retina.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{cdn('img/splash/touch-icon-ipad-retina.png')}}">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="{{cdn('img/splash/ipad-landscape.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="{{cdn('img/splash/ipad-portrait.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="{{cdn('img/splash/iphone.png')}}" media="screen and (max-device-width: 320px)">

</head>
