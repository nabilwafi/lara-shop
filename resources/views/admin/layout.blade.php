<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    @include('admin.partials.head')
</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();

    </script>

    <div id="toaster"></div>

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">

        <!-- Github Link -->
        <a href="https://github.com/tafcoder/sleek-dashboard" target="_blank" class="github-link">
            <svg width="70" height="70" viewBox="0 0 250 250" aria-hidden="true">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="75%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#896def;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#482271;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M 0,0 L115,115 L115,115 L142,142 L250,250 L250,0 Z" fill="url(#grad1)"></path>
            </svg>
            <i class="mdi mdi-github-circle"></i>
        </a>




        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        @include('admin.partials.aside')


        <!-- ====================================
        ——— PAGE WRAPPER
        ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            @include('admin.partials.header')

            <!-- ====================================
            ——— CONTENT WRAPPER
            ==================================== -->
            <div class="content-wrapper">
              <!-- Content -->
              @yield('content')
              <!-- End Content -->
            </div> <!-- End Content Wrapper -->

            <!-- Footer -->
            @include('admin.partials.footer')
            {{-- End Footer --}}
            
        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->

    @include('admin.partials.script')
</body>

</html>
