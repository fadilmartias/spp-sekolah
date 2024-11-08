@extends('layouts.auth')
@section('title', __('auth-page.signup'))
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card overflow-hidden m-0">
                    <div class="row justify-content-center g-0">

                        <div class="col-12">
                            <div class="p-lg-5 p-4">
                                <div>
                                    <h5 class="text-primary">{{ __('auth-page.register_title') }}</h5>
                                    <p class="text-muted">{{ __('auth-page.register_subtitle') }}</p>
                                </div>

                                <div class="mt-4">
                                    <form action="{{ route('register.process') }}" method="POST"
                                        class="needs-validation" novalidate>
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('auth-page.name') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.name') }}" value="{{ old('name') }}" required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">{{ __('auth-page.username') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror" id="username"
                                                placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.username') }}" value="{{ old('username') }}" required>
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">{{ __('auth-page.email') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" id="email" placeholder="{{ __('auth-page.enter') }} {{ __('auth-page.email') }}"
                                                required>
                                        </div>

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

                                        <div class="mb-4">
                                        <p class="mb-0 fs-12 text-muted fst-italic">{{ __('auth-page.by_registering_you_agree_to_our') }} <a href="#" class="text-primary text-decoration-underline fst-normal fw-medium">{{ __('auth-page.terms_of_use')  }}</a></p>
                                    </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">{{ __('auth-page.signup') }}</button>
                                        </div>

                                    </form>
                                </div>

                                <div class="mt-5 text-center">
                                    <p class="mb-0">{{ __('auth-page.already_have_an_account') }} <a href="{{ route('login.index') }}"
                                            class="fw-semibold text-primary text-decoration-underline"> {{ __('auth-page.signin') }}</a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
@endsection
