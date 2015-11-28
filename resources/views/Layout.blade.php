@include('style.header')
<body class="">
        @include('style.head')
        @include('style.nav')
        @yield('content')
<!-- Container -->
@include('style.footer')
@include('style.footer_script')

@yield('FooterScripts')
</body>
</html>