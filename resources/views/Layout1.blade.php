@include('style1.header')
<body>
@include('style1.nav')
<div class="content">
    @include('style1.head')

    @yield('content')
    @include('style1.footer')
</div>

@include('style1.footer_script')

@yield('FooterScripts')
</body>
</html>