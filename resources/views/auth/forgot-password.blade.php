@extends('layouts.auth')
@section('title', __('auth-page.forgot_password'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card overflow-hidden">
                    <div class="row g-0">

                        <div class="col-12">
                            <div class="p-lg-5 p-4">
                                <h5 class="text-primary">{{ __('auth-page.forgot_password_title') }}</h5>
                                <p class="text-muted">{{ __('auth-page.forgot_password_subtitle') }}</p>

                                <div class="mt-2 text-center">
                                    <lord-icon
                                        src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                                    </lord-icon>
                                </div>

                                <div class="p-2">
                                    <form action="{{ route('forgot-password.process') }}" method="POST">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label">{{ __('auth-page.email') }}</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.email') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ ($message) }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-success w-100" type="submit">{{ __('auth-page.send_reset_link') }}</button>
                                        </div>
                                    </form><!-- end form -->
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="mb-0">{{ __('auth-page.back_to_login') }} <a href="{{ route('login.index') }}" class="fw-semibold text-primary text-decoration-underline"> {{ __('auth-page.click_here') }} </a> </p>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
@endsection
