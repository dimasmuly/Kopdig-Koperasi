@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('content')
    @component('components.breadcrumb')
        {{-- @slot('li_1') Pages @endslot --}}
        @slot('title')
            {{ $title }}
        @endslot
    @endcomponent

    {{-- Total Administrator, Total Revenue, Mails --}}
    <div class="row">
        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-user text-warning">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden ms-3">
                            <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">Total Administrators</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                        data-target="{{ $total_administrator }}">{{ $total_administrator }}</span>
                                </h4>
                                <span class="badge badge-soft-warning fs-12"><i
                                        class=" ri-user-line fs-13 align-middle me-1"></i>{{ $total_administrator }}</span>
                            </div>
                            <p class="text-muted text-truncate mb-0">Progress this month</p>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-dollar-sign text-success">
                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-uppercase fw-semibold text-truncate text-muted mb-3">Total Revenue</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                        data-target="{{ $total_revenue }}">{{ number_format($total_revenue) }}</span>
                                </h4>
                                <span class="badge badge-soft-success fs-12"><i
                                        class="ri-arrow-up-s-line fs-13 align-middle me-1"></i>{{ number_format($percentage_revenue) }}%</span>
                            </div>
                            <p class="text-muted mb-0">Revenue this month</p>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->

        <div class="col-xl-4">
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-danger text-danger rounded-2 fs-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-shopping-cart text-danger">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                            </span>
                        </div>
                        <div class="flex-grow-1 overflow-hidden ms-3">
                            <p class="text-uppercase fw-semibold text-muted text-truncate mb-3">Orders</p>
                            <div class="d-flex align-items-center mb-3">
                                <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value"
                                        data-target="{{ $total_order }}">{{ $total_order }}</span>
                                </h4>
                                <span class="badge badge-soft-danger fs-12"><i
                                        class="ri-send-plane-2-line fs-13 align-middle me-1"></i>{{ number_format($percentage_order) }}
                                    %</span>
                            </div>
                            <p class="text-muted text-truncate mb-0">Orders this month</p>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
