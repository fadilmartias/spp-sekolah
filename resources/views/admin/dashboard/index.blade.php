@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="row project-wrapper">
        <div class="col-12 mb-3">{{ __('message.welcome_back', ['data' => Auth::user()->name]) }}</div>
        <div class="col-xxl-8">
            {{-- <div class="row">
                <div class="col-xl-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                        <i class="ri-customer-service-line text-warning"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-medium text-muted mb-3">Total Music Article</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                                data-target="{{ $totalArticle }}">0</span></h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div>
                </div><!-- end col -->

            </div><!-- end row --> --}}
        </div><!-- end row -->
    </div><!-- end row -->
@endsection
