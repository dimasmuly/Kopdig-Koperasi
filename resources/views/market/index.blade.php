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

    {{-- EARNING, ORDERS, CUSTOMERS --}}
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- EARNINGS -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Earnings</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">IDR <span class="counter-value"
                                    data-target="{{ $total_earnings }}">{{ number_format($total_earnings, 0, ',', '.') }}</span>
                            </h4>
                            <span href="" class="text-muted">Earning this month</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-success rounded fs-3">
                                <i class="bx bx-dollar-circle text-success"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- ORDERS -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                    data-target="{{ $total_order }}">{{ $total_order }}</span></h4>
                            <a href="{{ route('dashboard.order') }}" class="text-decoration-underline">View all orders</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-info rounded fs-3">
                                <i class="bx bx-shopping-bag text-info"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- CUSTOMER -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Business</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                    data-target="{{ $total_business }}">{{ $total_business }}</span></h4>
                            <span class="text-muted">Total Business</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-warning rounded fs-3">
                                <i class="bx bx-user-circle text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>

    <div class="row mt-4">
        @foreach ($businesses as $business)
            <div class="col-xl-3 col-lg-6">
                <div class="card">
                    <div class="card-body text-center p-4">

                        <h5 class="mb-1 mt-4"><a href="/market/{{ $business['id'] }}/products"
                                class="link-primary">{{ $business['business']['name'] }}</a>
                        </h5>
                        <p class="text-muted mb-4">{{ date('d-m-Y', strtotime($business['created_at'])) }}</p>

                        <div class="row mt-4">
                            <div class="col-lg border-end-dashed border-end">
                                <h5>{{ count($business['products']) }}</h5>
                                <span class="text-muted">Total Product</span>
                            </div>
                            {{-- <div class="col-lg-6">
                                <h5>$73,426</h5>
                                <span class="text-muted">Total Revenue</span>
                            </div> --}}
                        </div>
                        <div class="mt-4">
                            <a href="/market/{{ $business['id'] }}/products" class="btn btn-light w-100">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
