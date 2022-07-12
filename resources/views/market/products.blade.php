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

    <div class="row g-4 mb-3">
        <div class="col-sm-auto">
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#addProduct" class="btn btn-success"><i
                        class="ri-add-line align-bottom me-1"></i>
                    Add New</a>
            </div>
        </div>
        <div class="col-sm">
            <div class="d-flex justify-content-sm-end">
                <div class="search-box ms-2">
                    <input type="text" class="form-control" id="search-field" placeholder="Search Products">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table align-middle table-striped" id="product-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Rating</th>
                                <th class="text-center">Stock</th>
                                <th>Weight</th>
                                <th>Discount</th>
                                <th class="text-center">Voucher</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ URL::asset($product['thumbnail']) }}" alt=""
                                                    class="avatar-xs rounded-3" style="object-fit: cover" />
                                            </div>
                                            <div class="flex-grow-1 d-block">
                                                {{ $product['name'] }}<br>
                                                <small class="text-muted mt-2">Category:
                                                    {{ ucwords(strtolower($product['productCategory']['name'])) }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{-- if there is discount then set throughline for price --}}
                                        @if ($product['discount'] > 0)
                                            <small>
                                                <del class="text-muted">IDR {{ number_format($product['price']) }}</del>
                                            </small>
                                            <br>
                                            <strong>
                                                <span class="text-primary">IDR
                                                    @if ($product['voucher'])
                                                        {{ number_format($product['price'] * (($product['discount'] / 100) * ($product['voucher']['discount'] / 100))) }}
                                                    @else
                                                        {{ number_format($product['price'] * ($product['discount'] / 100)) }}
                                                    @endif
                                                </span>
                                            </strong>
                                        @else
                                            <span class="text-primary">IDR {{ number_format($product['price']) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span><span class="badge bg-light text-body fs-12 fw-medium"><i
                                                    class="mdi mdi-star text-warning me-1"></i>{{ number_format($product['ratingValue'], 2) }}</span></span>
                                    </td>
                                    <td class="text-center">{{ $product['stock'] }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $product['weight'] > 50 ? 'badge-soft-danger' : 'badge-soft-success' }}">{{ $product['weight'] }}
                                            Kg</span>
                                    </td>
                                    <td>
                                        {{-- discount --}}
                                        @if ($product['discount'] > 0)
                                            <span
                                                class="badge {{ $product['discount'] > 50 ? 'badge-soft-light text-dark' : 'badge-soft-success' }}">{{ $product['discount'] }}
                                                %</span>
                                        @else
                                            <span class="badge badge-soft-success">0%</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($product['voucher'] == null)
                                            <span class="badge badge-soft-danger">NO VOUCHER</span>
                                        @else
                                            <span
                                                class="badge d-block
                                        @if ($product['voucher']['discount'] > 30) bg-light text-dark
                                        @elseif ($product['voucher']['discount'] > 50) bg-warning
                                        @elseif($product['voucher']['discount'] > 70) bg-success
                                        @else bg-secondary @endif">
                                                {{ Str::upper($product['voucher']['code']) }}
                                                {{ $product['voucher']['discount'] }}% <br>
                                                <small class="mt-3 fw-normal">
                                                    {{ Carbon\Carbon::parse($product['voucher']['effective_date'])->format('d M') }}
                                                    -
                                                    {{ Carbon\Carbon::parse($product['voucher']['expired_date'])->format('d M Y') }}
                                                </small>
                                            </span>
                                            </span>
                                        @endempty
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary"><i class="ri-edit-line"></i></a>
                                    <a href="#" class="btn btn-sm btn-danger"><i
                                            class="ri-delete-bin-line"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="addProduct" class="modal fade" tabindex="-1" aria-labelledby="addProductLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="business_detail_id" value="{{ $business_detail_id }}">
                    <div class="col-xxl col-md mb-3">
                        <div>
                            <label for="productname-field" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="productname-field" id="productname-field">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="stock-field" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock-field" id="stock-field">
                            </div>
                        </div>
                        <div class="col-xxl col-md">
                            <div>
                                <label for="price-field" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price-field" id="price-field">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xxl col-md">
                            <div>
                                <label for="productcategory-field" class="form-label">Product Category</label>
                                <select name="productcategory-field" class="form-select" id="productcategory-field">
                                    @foreach ($product_categories as $product_category)
                                        <option value="{{ $product_category['id'] }}">
                                            {{ ucwords(strtolower($product_category['name'])) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xxl col-md">
                            <div>
                                <label for="productiondate-field" class="form-label">Production Date</label>
                                <input type="date" class="form-control" name="productiondate-field"
                                    id="productiondate-field">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xxl col-md">
                            <div>
                                <label for="discount-field" class="form-label">Discount <small
                                        class="text-muted ms-2">Optional</small></label>
                                <div class="form-icon right">
                                    <input type="number" name="discount-field"
                                        class="form-control form-control-icon" id="discount-field">
                                    <i class="ri-percent-line"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl col-md">
                            <div>
                                <label for="weight-field" class="form-label">Weight (Kg) <small
                                        class="text-muted ms-2">Optional</small></label>
                                <input type="number" class="form-control" name="weight-field" id="weight-field">
                            </div>
                        </div>
                        {{-- Voucher --}}
                        {{-- <div class="col-xxl col-md">
                                <div>
                                    <label for="voucherid-field" class="form-label">Voucher <small class="text-muted ms-2">Optional</small></label>
                                    <select name="voucherid-field" id="voucherid-field" class="form-select">
                                        @foreach ($vouchers as $voucher)
                                            <option value="{{ $voucher['id'] }}">
                                                {{ ucwords(strtolower($voucher['name'])) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                    </div>
                    <div class="col-xxl col-md">
                        <div>
                            <label for="description-field" class="form-label">Description</label>
                            <textarea class="form-control" id="description-field" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Save Changes</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<script src="{{ URL::asset('js/jquery-3.5.1.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#search-field').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#product-table tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection
