@extends('layouts.admin')
@section('title', __('vocab.edit', ['data' => __('vocab.profile')]))
@push('style')
    <link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('script')
    <script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quill = new Quill('#descriptionInput', {
                theme: 'snow',
                modules: {
                    toolbar: false
                }
            });
            quill.clipboard.addMatcher(Node.ELEMENT_NODE, (node, delta) => {
                delta.ops = delta.ops.map(op => {
                    return {
                        insert: op.insert
                    }
                })
                return delta
            })
            quill.on('text-change', (delta, oldDelta, source) => {
                // Mendapatkan HTML dari konten yang diketik
                const htmlContent = quill.root.innerHTML;
                $("#description").val(htmlContent);
                console.log('Current HTML content:', htmlContent);
            });
        })
    </script>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> {{ __('vocab.personal_details') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> {{ __('vocab.change_password') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ route('admin.profile.update') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">{{ __('vocab.name') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="firstnameInput"
                                                placeholder="{{ __('auth-page.enter') }} {{ __('vocab.name') }}"
                                                value="{{ old('name', Auth::user()->name) }}">
                                            @error('name')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="usernameInput" class="form-label">{{ __('vocab.username') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                id="usernameInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.username') }}"
                                                value="{{ old('username', Auth::user()->username) }}">
                                            @error('username')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">{{ __('vocab.phone') }}</label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                id="phonenumberInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.phone') }}"
                                                value="{{ old('phone', Auth::user()->phone) }}">
                                            @error('phone')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">{{ __('vocab.email') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="emailInput"
                                                placeholder="{{ __('auth-page.enter') }} {{ __('vocab.email') }}"
                                                value="{{ old('email', Auth::user()->email) }}">
                                            @error('email')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="description" class="form-label">{{ __('vocab.description') }}</label>
                                            <input type="hidden" name="description" id="description" />
                                            <div class="snow-editor" id="descriptionInput" style="height: 300px;">
                                                {!! old('description', Auth::user()->description) !!}
                                            </div>
                                            <!-- end Snow-editor-->
                                            @error('description')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{ route('admin.profile.index') }}"
                                                class="btn btn-soft-dark">{{ __('vocab.cancel') }}</a>
                                            <button type="submit" class="btn btn-primary">{{ __('vocab.update') }}</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('admin.profile.updatePassword') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">{{ __('vocab.old_password') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="old_password"
                                                class="form-control @error('old_password') is-invalid @enderror"
                                                id="oldpasswordInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.current_password') }}">
                                            @error('old_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">{{ __('vocab.new_password') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="new_password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="newpasswordInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.new_password') }}">
                                                <small class="d-inline-block text-muted text-sm mt-2">
                                                    {{ __('auth-page.password_requirements') }}
                                                 </small>
                                            @error('new_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">{{ __('vocab.confirm_password') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="confirm_password"
                                                class="form-control @error('confirm_password') is-invalid @enderror"
                                                id="confirmpasswordInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.confirm_password') }}">
                                            @error('confirm_password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->
                                    {{-- <div class="col-lg-12">
                                    <div class="mb-3">
                                        <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                    </div>
                                </div> --}}
                                    <!--end col-->
                                    <div class="col-lg-12 mt-3 pt-2">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{ route('admin.profile.index') }}"
                                            class="btn btn-soft-dark">{{ __('vocab.cancel') }}</a>
                                            <button type="submit" class="btn btn-primary">{{ __('vocab.change_password') }}</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
