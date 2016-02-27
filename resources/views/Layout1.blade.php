@include('style1.header')
<body >
        @include('style1.head')
        @include('style1.nav')
        @yield('content')
<!-- Container -->
@include('style1.footer')
@include('style1.footer_script')

@yield('FooterScripts')
</body>
</html>