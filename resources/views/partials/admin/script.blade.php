<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/jquery/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/toastify-js/src/toastify.js') }}"></script>
<script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Toastify -->
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
@elseif($errors->any() || session('error'))
@php
    $error_message = $errors->any() ? implode(' ', $errors->all()) : session('error');
@endphp
    <script>
        Toastify({
            text: "{!! $error_message ?? 'Error Occured!' !!}",
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

<!-- Script from pages -->
@stack('script')
