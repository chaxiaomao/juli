<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/style/weui.css"/>
    <link rel="stylesheet" href="/style/weui2.css"/>
    <link rel="stylesheet" href="/style/weui3.css"/>
    <link rel="stylesheet" href="/style/juli.css"/>
</head>
@yield('m-style')
<body>
<!-- tooltips -->
<div class="juli_toptips"><span></span></div>
@extends('compoent.loading')
@yield('content')
</body>
<script src="/js/jquery-1.11.2.min.js"></script>
@yield('m-js')
</html>