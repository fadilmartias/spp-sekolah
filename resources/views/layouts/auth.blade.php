<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin Starter Template" name="description" />
    <meta content="M. Fadil Martias" name="author" />
    <title>@yield('title') | Template</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('assets/css/user.css') }}" rel="stylesheet" type="text/css" /> --}}

    <!-- Toastify Css-->
    <link href="{{ asset('assets/libs/toastify-js/src/toastify.css') }}" rel="stylesheet" type="text/css" />
    @vite([])
</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            @yield('content')
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer" style="color: var(--text-color);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center d-flex justify-content-center gap-5 align-items-center">
                            <p class="mb-0">
                                &copy; {{ date('Y') }} <a href="/">STARTER ADMIN TEMPLATE</a>. ALL RIGHTS
                                RESERVED
                            </p>
                            <x-locale-changer type="text"/>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/libs/toastify-js/src/toastify.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('assets/js/pages/password-addon.init.js') }}"></script>
    @if (session('success'))
        <script>
            Toastify({
                text: "{!! session('success') !!}",
                duration: 3000,
                close: true,
                className: 'success',
                style: {
                    background: '#0ab39c'
                },
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();
        </script>
    @elseif ($errors->any() || session('error'))
        <script>
            Toastify({
                text: "{!! session('error') ? session('error') : 'Error! An error occured!' !!}",
                duration: 3000,
                close: true,
                className: 'danger',
                style: {
                    background: '#f06548'
                },
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
            }).showToast();
        </script>
    @endif
</body>

</html>
