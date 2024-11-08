@extends('layouts.admin')
@section('title', __('vocab.profile'))
@section('content')
    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
        <div class="row g-4">
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ Auth::user()->name }}</h3>
                    <p class="text-white-75 text-capitalize">{{ Auth::user()->getRoleNames()->first() }}</p>
                </div>
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">{{ __('vocab.overview', ['data' => ('')]) }}</span>
                            </a>
                        </li>
                    </ul>
                    <div class="flex-shrink-0">
                        <a href="{{ route('admin.profile.edit') }}" class="btn btn-success"><i
                                class="ri-edit-box-line align-bottom"></i> {{ __('vocab.edit', ['data' => __('vocab.profile')]) }}</a>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Info</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('vocab.name') }} :</th>
                                                        <td class="text-muted">{{ Auth::user()->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('vocab.username') }} :</th>
                                                        <td class="text-muted">{{ Auth::user()->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('vocab.phone') }} :</th>
                                                        <td class="text-muted">{{ Auth::user()->phone }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">{{ __('vocab.email') }} :</th>
                                                        <td class="text-muted">{{ Auth::user()->email }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">{{ __('vocab.about') }}</h5>
                                        {!! Auth::user()->description !!}
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection
