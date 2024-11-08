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
                                <h5 class="text-primary">{{ __('auth-page.reset_password_title') }}</h5>
                                <p class="text-muted">{{ __('auth-page.reset_password_subtitle') }}</p>

                                <div class="p-2">
                                    <form action="{{ route('forgot-password.processReset') }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="token" name="token" value="{{ $token }}">
                                        <input type="hidden" id="email" name="email" value="{{ $email }}">
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">{{ __('auth-page.password') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password"
                                                    class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                    name="password" onpaste="return false" placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.password') }}"
                                                    id="password-input" aria-describedby="passwordInput"
                                                    pattern=".{8,}" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                <small class="d-inline-block text-muted text-sm mt-2">
                                                   {{ __('auth-page.password_requirements') }}
                                                </small>
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">{{ __('auth-page.confirm_password') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password"
                                                    class="form-control pe-5 password-input @error('confirm_password') is-invalid @enderror"
                                                    name="confirm_password" onpaste="return false" placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.confirm_password') }}"
                                                    id="confirm-password-input" aria-describedby="confirmPasswordInput"
                                                    pattern=".{8,}" required>
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                @error('confirm_password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13">Password must contain:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>
                                        </div> --}}

                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div> --}}

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">{{ __('auth-page.reset_password') }}</button>
                                        </div>

                                    </form>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="mb-0">{{ __('auth-page.back_to_login') }} <a href="auth-signin-cover.html" class="fw-semibold text-primary text-decoration-underline"> {{ __('auth-page.click_here') }} </a> </p>
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
