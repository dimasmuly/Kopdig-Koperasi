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

    {{-- check all session and display alert --}}
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Success!</strong> {{ Session::get('success') }}
        </div>
    @elseif (Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Error!</strong> {{ Session::get('error') }}
        </div>
    @endif

    <div class="row g-4 mb-3">
        <div class="col-sm-auto">
            <div>
                <a href="#" data-bs-toggle="modal" data-bs-target="#addProduct"
                    class="btn btn-success btn-add-product"><i class="ri-add-line align-bottom me-1"></i>
                    Add New</a>
            </div>
        </div>
        <div class="col-sm">
            <div class="d-flex justify-content-sm-end">
                <div class="search-box ms-2">
                    <input type="text" class="form-control" id="search_field" placeholder="Search Products">
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
                                                <img src="
                                                {{
                                                    // if product image is not empty, display image
                                                    $product['thumbnail'] != null || !URL::asset('products/default.jpg') ?
                                                    URL::asset($product['thumbnail'])
                                                    :
                                                    // else, display default image
                                                    'https://thumbs.dreamstime.com/b/no-thumbnail-images-placeholder-forums-blogs-websites-148010338.jpg'
                                                }}
                                                " alt=""
                                                    class="avatar-xs rounded-3" style="object-fit: cover" />
                                            </div>
                                            <div class="flex-grow-1 d-block">
                                                {{ ucwords(strtolower($product['name'])) }}<br>
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
                                            <span class="text-primary"><strong>IDR
                                                    {{ number_format($product['price']) }}</strong></span>
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
                                    <a href="#" class="btn btn-sm btn-primary btn-edit-product" data-bs-toggle="modal" data-bs-target="#addProduct"
                                        data-productid="{{ $product['id'] }}"><i class="ri-edit-line"></i></a>
                                    <a href="/api/product/delete/{{ $product['id'] }}" class="btn btn-sm btn-danger"
                                        onclick="return(confirm('Are you sure?'))"><i
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
{{-- Modal --}}
<div id="addProduct" class="modal fade" tabindex="-1" aria-labelledby="addProductLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="business_detail_id" value="{{ $business_detail_id }}">
                    <div class="col-xxl col-md mb-3">
                        <div>
                            <label for="thumbnail_field" class="form-label">Product Picture</label>
                            <input type="file" class="form-control" name="thumbnail_field" id="thumbnail_field">
                        </div>
                    </div>
                    <div class="col-xxl col-md mb-3">
                        <div>
                            <label for="productname_field" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="productname_field"
                                id="productname_field">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xxl-3 col-md-6">
                            <div>
                                <label for="stock_field" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock_field" id="stock_field">
                            </div>
                        </div>
                        <div class="col-xxl col-md">
                            <div>
                                <label for="price_field" class="form-label">Price</label>
                                <input type="number" class="form-control" name="price_field" id="price_field">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xxl col-md">
                            <div>
                                <label for="productcategory_field" class="form-label">Product Category</label>
                                <select name="productcategory_field" class="form-select" id="productcategory_field">
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
                                <label for="productiondate_field" class="form-label">Production Date</label>
                                <input type="date" class="form-control" name="productiondate_field"
                                    id="productiondate_field">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-xxl col-md">
                            <div>
                                <label for="discount_field" class="form-label">Discount <small
                                        class="text-muted ms-2">Optional</small></label>
                                <div class="form-icon right">
                                    <input type="number" name="discount_field"
                                        class="form-control form-control-icon" id="discount_field">
                                    <i class="ri-percent-line"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl col-md">
                            <div>
                                <label for="weight_field" class="form-label">Weight (Kg) <small
                                        class="text-muted ms-2">Optional</small></label>
                                <input type="number" class="form-control" name="weight_field" id="weight_field">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl col-md">
                        <div>
                            <label for="description_field" class="form-label">Description</label>
                            <textarea class="form-control" name="description_field" id="description_field" rows="3"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
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
        $('#search_field').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#product-table tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.btn-add-product').on('click', function() {
            $('#addProduct .modal-title').text('Add New Product');
            $('#addProduct #productname_field').val('');
            $('#addProduct #stock_field').val('');
            $('#addProduct #price_field').val('');
            $('#addProduct #productcategory_field').val('');
            $('#addProduct #productiondate_field').val('');
            $('#addProduct #discount_field').val('');
            $('#addProduct #thumbnail_field').val('');
            $('#addProduct #weight_field').val('');
            $('#addProduct #description_field').val('');
            $('#addProduct .modal-body form').attr('action', '{{ route('api.product.store') }}');
        });

        $('.btn-edit-product').on('click', function() {

            $('#addProduct .modal-title').text('Edit Product');
            $('#addProduct #productname_field').val('');
            $('#addProduct #stock_field').val('');
            $('#addProduct #price_field').val('');
            $('#addProduct #productcategory_field').val('');
            $('#addProduct #productiondate_field').val('');
            $('#addProduct #discount_field').val('');
            $('#addProduct #thumbnail_field').val('');
            $('#addProduct #weight_field').val('');
            $('#addProduct #description_field').val('');
            $('#addProduct .modal-body form').attr('action', '/api/product/update/' + $(this).data('productid'));

            $.ajax({
                url: '/api/product/' + $(this).data('productid'),
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#addProduct #productname_field').val(data.name);
                    $('#addProduct #stock_field').val(data.stock);
                    $('#addProduct #price_field').val(parseInt(data.price));
                    $('#addProduct #productcategory_field').val(data.product_category_id);
                    const date = new Date(data.production_date);
                    const dateString = date.toISOString().split('T')[0];
                    $('#addProduct #productiondate_field').val(dateString);
                    $('#addProduct #discount_field').val(parseInt(data.discount));
                    $('#addProduct #weight_field').val(parseInt(data.weight));
                    $('#addProduct #description_field').val(data.description);
                }
            });
        });
    });
</script>
@endsection
