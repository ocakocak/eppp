@include('templateadmin.header')

<body>
    <div id="app">
        <div class="main-wrapper">

                @yield('content')
            <footer class="main-footer">
                @include('templateadmin.footer')
                @yield('script')
            </footer>
        </div>
    </div>
</body>

</html>
