@include('templateadmin.header')

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                @include('templateadmin.topnav')
            </nav>
            <div class="main-sidebar">
                @include('templateadmin.sidebar')
            </div>

            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>
            <footer class="main-footer">
                @include('templateadmin.footer')
                @yield('script')
                
            </footer>
        </div>
    </div>
</body>

</html>
