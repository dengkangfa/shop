<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', '星期天 | 天天好心情')</title>

    <meta name="description" content="星期一网上商城,专业的综合网上购物商城,销售家电、数码通讯、电脑、家居百货、服装服饰、母婴、图书、食品等品牌优质商品.便捷、诚信的服务，为您提供愉悦的网上购物体验!">
    <meta name="black friday, coupon, coupon codes, coupon theme, coupons, deal news, deals, discounts, ecommerce, friday deals, groupon, promo codes, responsive, shop, store coupons">
    <meta name="Keywords" content="网上购物,网上商城,网上买,购物网站,团购,安全购物,电子商务,打折" />

    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <!-- PAGE FAVICON                              -->
    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="apple-touch-icon" href="{{ asset('assets/shop/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('assets/shop/images/favicon/favicon.ico') }}'">

    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <!-- GOOGLE FONTS                              -->
    <!-- ––––––––––––––––––––––––––––––––––––––––– -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/shop/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('assets/shop/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/shop/css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/shop/css/style.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body id="body" class="wide-layout preloader-active">
<!--[if lt IE 9]>
<p class="browserupgrade alert-error">
    你用<strong>过时</strong>浏览器。请<a href="http://browsehappy.com/">升级您的浏览器</a>来提高你的经验。
</p>
<![endif]-->

<noscript>
    <div class="noscript alert-error">
        对于本网站有必要启用JavaScript的全部功能。这是
        <a href="http://www.enable-javascript.com/" target="_blank">
            说明如何启用JavaScript在Web浏览器中</a>.
    </div>
</noscript>

<div id="pageWrapper" class="page-wrapper">
    {{-- PAGE CONTENT --}}
    @yield('main')
    {{-- END PAGE CONENT --}}

    @include('common.home.area')
    {{-- FOOTER --}}
    @include('common.home.footer')
    {{-- END FOOTER --}}
</div>

<!-- Initialize jQuery library                 -->
<!-- ––––––––––––––––––––––––––––––––––––––––– -->
<script src="{{ asset('assets/shop/js/jquery-1.12.3.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/shop/js/bootstrap.min.js') }}"></script>

@yield('script')
</body>
</html>