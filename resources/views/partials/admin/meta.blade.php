<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="M. Fadil Martias" name="author" />

@hasSection('meta')
    @yield('meta')
@endif

@sectionMissing('meta')
    <meta content="Admin Starter Template" name="description" />
@endif

@sectionMissing('meta_title')
    <title>@yield('title') | Template</title>
@endif
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
