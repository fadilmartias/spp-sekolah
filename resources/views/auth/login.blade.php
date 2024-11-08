@extends('layouts.auth')
@section('title', __('auth-page.signin'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card overflow-hidden">
                    <div class="row g-0">

                        <div class="col-12">
                            <div class="p-lg-5 p-4 text-black">
                                <div>
                                    <h5 class="text-primary">{{ __('auth-page.login_title') }}</h5>
                                    <p class="">{{ __('auth-page.login_subtitle') }}</p>
                                </div>

                                <div class="mt-4">
                                    <form action="{{ route('login.process') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="login"
                                                class="form-label">{{ __('auth-page.email_or_username') }}</label>
                                            <input type="text" class="form-control @error('login') is-invalid @enderror"
                                                id="login" name="login"
                                                placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.email_or_username') }}"
                                                value="{{ old('login') }}" required>
                                            @error('login')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="{{ route('forgot-password.index') }}"
                                                    class="text-muted">{{ __('auth-page.forgot_password') }}?<a>
                                            </div>
                                            <label class="form-label"
                                                for="password-input">{{ __('auth-page.password') }}</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input"
                                                    placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.password') }}"
                                                    pattern=".{8,}" id="password-input" name="password" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="auth-remember-check">
                                            <label class="form-check-label"
                                                for="auth-remember-check">{{ __('auth-page.remember_me') }}</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100"
                                                type="submit">{{ __('auth-page.signin') }}</button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            <div class="signin-other-title">
                                                <h5 class="fs-13 mb-4 title">{{ __('auth-page.signin_with') }}</h5>
                                            </div>

                                            <div>
                                                <button type="button"
                                                    class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                        class="ri-facebook-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                        class="ri-google-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                        class="ri-github-fill fs-16"></i></button>
                                                <button type="button"
                                                    class="btn btn-info btn-icon waves-effect waves-light"><i
                                                        class="ri-twitter-fill fs-16"></i></button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="mb-0">{{ __('auth-page.dont_have_account') }} <a
                                            href="{{ route('register.index') }}"
                                            class="fw-semibold text-primary text-decoration-underline">
                                            {{ __('auth-page.signup') }}</a> </p>
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
