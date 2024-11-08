@extends('layouts.admin')
@section('title', isset($oldData) ? __('vocab.edit', ['data' => __('vocab.user')]) : __('vocab.add', ['data' => __('vocab.user')]))
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
                if (htmlContent.trim() === '<p><br></p>') {
                    $("#description").val('');
                } else {
                    $("#description").val(htmlContent);
                }
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
                        @isset($oldData)
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="far fa-user"></i> {{ __('vocab.change_password') }}
                                </a>
                            </li>
                        @endisset
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ route('admin.user.process') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="id" name="id" value="{{ isset($oldData) ? $oldData->id : null }}">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">{{ __('vocab.name') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="firstnameInput"
                                                placeholder="{{ __('auth-page.enter') }} {{ __('vocab.name') }}"
                                                value="{{ old('name', isset($oldData) ? $oldData->name : '') }}" required>
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
                                                value="{{ old('username', isset($oldData) ? $oldData->username : '') }}" required>
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
                                                value="{{ old('phone', isset($oldData) ? $oldData->phone : '') }}" required>
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
                                                value="{{ old('email', isset($oldData) ? $oldData->email : '') }}" required>
                                            @error('email')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="roleInput" class="form-label">{{ __('vocab.role') }} <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select text-capitalize @error('role') is-invalid @enderror" name="role" id="roleInput" required>
                                                <option value="">{{ __('vocab.select', ['data' => __('vocab.role')]) }}</option>
                                                @foreach ($roles as $item)
                                                    <option value="{{ $item->name }}" class="text-capitalize" @selected(isset($oldData) && $oldData->getRoleNames()->first() == $item->name)>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('email')
                                                <div class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!--end col-->

                                    @empty($oldData)
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="passwordInput" class="form-label">{{ __('vocab.password') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="password" name="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="passwordInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.password') }}"
                                                    value="{{ old('password') }}" required>
                                                <div class="text-muted text-sm mt-2">
                                                    {{ __('auth-page.password_requirements') }}
                                                </div>
                                                @error('password')
                                                    <div class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end col-->
                                    @endempty

                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="description" class="form-label">{{ __('vocab.description') }}</label>
                                            <input type="hidden" name="description" id="description" value="{{ old('description', isset($oldData) ? $oldData->description : '') }}" />
                                            <div class="snow-editor" id="descriptionInput" style="height: 300px;">
                                                {!! old('description', isset($oldData) ? $oldData->description : '') !!}
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
                                            <a href="{{ route('admin.user.index') }}"
                                            class="btn btn-soft-dark">{{ __('vocab.cancel') }}</a>
                                            <button type="submit" class="btn btn-primary">{{ isset($oldData) ? __('vocab.update', ['data' => '']) : __('vocab.create', ['data' => '']) }}</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        @isset($oldData)
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{ route('admin.user.processPassword') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" id="id" name="id" value="{{ $oldData->id }}">
                                <div class="row g-2">
                                    <div class="col-lg-6">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">{{ __('vocab.new_password') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="new_password"
                                                class="form-control @error('new_password') is-invalid @enderror"
                                                id="newpasswordInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.new_password') }}" required>
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
                                    <div class="col-lg-6">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">{{ __('vocab.confirm_password') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="confirm_password"
                                                class="form-control @error('confirm_password') is-invalid @enderror"
                                                id="confirmpasswordInput" placeholder="{{ __('auth-page.enter') }} {{ __('vocab.confirm_password') }}"   required>
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
                                            <a href="{{ route('admin.user.index') }}"
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
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
