@include('style.header')
<body class="smart-style-1">
        @include('style.head')
        @include('style.nav')
        @yield('content')
<!-- Container -->
@include('style.footer')
@include('style.footer_script')

@yield('FooterScripts')
</body>
</html>
