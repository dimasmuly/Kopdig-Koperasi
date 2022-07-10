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
        {{-- <a class="btn btn-soft-secondary btn-sm" type="button" href="views/administrator/business">View</a> --}}
        <!-- nila -->
        <div class="row g-4 mb-3">
            <div class="col-sm-auto">
                <div>
                    <a href="apps-ecommerce-add-product.html" class="btn btn-success"><i
                            class="ri-add-line align-bottom me-1"></i> Add New</a>
                </div>
            </div>
            <div class="col-sm">
                <div class="d-flex justify-content-sm-end">
                    <div class="search-box ms-2">
                        <input type="text" class="form-control" placeholder="Search Products...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="table-product-list-all" class="table-card gridjs-border-none">
                    <div role="complementary" class="gridjs gridjs-container" style="width: 100%;">
                        <div class="gridjs-wrapper" style="height: auto;">
                            <table role="grid" class="gridjs-table" style="height: auto;">
                                <thead class="gridjs-thead">
                                    <tr class="gridjs-tr">
                                        <th data-column-id="productListAllCheckbox" class="gridjs-th text-muted"
                                            style="width: 40px;">
                                            <div class="gridjs-th-content">#</div>
                                        </th>
                                        <th data-column-id="product" class="gridjs-th gridjs-th-sort text-muted"
                                            tabindex="0" style="width: 360px;">
                                            <div class="gridjs-th-content">Product</div>
                                            <button tabindex="-1" aria-label="Sort column descending"
                                                title="Sort column descending" class="gridjs-sort gridjs-sort-asc">
                                            </button>
                                        </th>
                                        <th data-column-id="stock" class="gridjs-th gridjs-th-sort text-muted"
                                            tabindex="0" style="width: 94px;">
                                            <div class="gridjs-th-content">Stock</div>
                                            <button tabindex="-1" aria-label="Sort column ascending"
                                                title="Sort column ascending"
                                                class="gridjs-sort gridjs-sort-neutral"></button>
                                        </th>
                                        <th data-column-id="price" class="gridjs-th gridjs-th-sort text-muted"
                                            tabindex="0" style="width: 101px;">
                                            <div class="gridjs-th-content">Price</div>
                                            <button tabindex="-1" aria-label="Sort column ascending"
                                                title="Sort column ascending"
                                                class="gridjs-sort gridjs-sort-neutral"></button>
                                        </th>
                                        <th data-column-id="orders" class="gridjs-th gridjs-th-sort text-muted"
                                            tabindex="0" style="width: 84px;">
                                            <div class="gridjs-th-content">Orders</div>
                                            <button tabindex="-1" aria-label="Sort column ascending"
                                                title="Sort column ascending"
                                                class="gridjs-sort gridjs-sort-neutral"></button>
                                        </th>
                                        <th data-column-id="rating" class="gridjs-th gridjs-th-sort text-muted"
                                            tabindex="0" style="width: 105px;">
                                            <div class="gridjs-th-content">Rating</div>
                                            <button tabindex="-1" aria-label="Sort column ascending"
                                                title="Sort column ascending"
                                                class="gridjs-sort gridjs-sort-neutral"></button>
                                        </th>
                                        <th data-column-id="published" class="gridjs-th gridjs-th-sort text-muted"
                                            tabindex="0" style="width: 220px;">
                                            <div class="gridjs-th-content">Published</div>
                                            <button tabindex="-1" aria-label="Sort column ascending"
                                                title="Sort column ascending"
                                                class="gridjs-sort gridjs-sort-neutral"></button>
                                        </th>
                                        <th data-column-id="action" class="gridjs-th text-muted" style="width: 80px;">
                                            <div class="gridjs-th-content">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="gridjs-tbody">
                                    <tr class="gridjs-tr">
                                        <td data-column-id="productListAllCheckbox" class="gridjs-td">
                                            <input type="checkbox" class="gridjs-checkbox">
                                        </td>
                                        <td data-column-id="product" class="gridjs-td"><span>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm bg-light rounded p-1">
                                                            <img src="assets/images/products/img-1.png" alt=""
                                                                class="img-fluid d-block">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-14 mb-1"><a
                                                                href="apps-ecommerce-product-details.html"
                                                                class="text-dark">Half Sleeve Round Neck T-Shirts</a></h5>
                                                        <p class="text-muted mb-0">Category : <span
                                                                class="fw-medium">Clothes</span></p>
                                                    </div>
                                                </div>
                                            </span></td>
                                        <td data-column-id="stock" class="gridjs-td">12</td>
                                        <td data-column-id="price" class="gridjs-td">$ 115.00</td>
                                        <td data-column-id="orders" class="gridjs-td">48</td>
                                        <td data-column-id="rating" class="gridjs-td"><span><span
                                                    class="badge bg-light text-body fs-12 fw-medium"><i
                                                        class="mdi mdi-star text-warning me-1"></i>4.2</span></span></td>
                                        <td data-column-id="published" class="gridjs-td"><span>12 Oct, 2021<small
                                                    class="text-muted ms-1">10:05 AM</small></span></td>
                                        <td data-column-id="action" class="gridjs-td"><span>
                                                <div class="dropdown">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="ri-more-fill"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item"
                                                                href="apps-ecommerce-product-details.html"><i
                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                View</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="apps-ecommerce-add-product.html"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#removeItemModal"><i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Delete</a></li>
                                                    </ul>
                                                </div>
                                            </span></td>
                                    </tr>
                                    <tr class="gridjs-tr">
                                        <td data-column-id="productListAllCheckbox" class="gridjs-td"><input
                                                type="checkbox" class="gridjs-checkbox"></td>
                                        <td data-column-id="product" class="gridjs-td"><span>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar-sm bg-light rounded p-1"><img
                                                                src="assets/images/products/img-7.png" alt=""
                                                                class="img-fluid d-block"></div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-14 mb-1"><a
                                                                href="apps-ecommerce-product-details.html"
                                                                class="text-dark">Noise Evolve Smartwatch</a></h5>
                                                        <p class="text-muted mb-0">Category : <span
                                                                class="fw-medium">Watches</span></p>
                                                    </div>
                                                </div>
                                            </span></td>
                                        <td data-column-id="stock" class="gridjs-td">12</td>
                                        <td data-column-id="price" class="gridjs-td">$ 95.00</td>
                                        <td data-column-id="orders" class="gridjs-td">45</td>
                                        <td data-column-id="rating" class="gridjs-td"><span><span
                                                    class="badge bg-light text-body fs-12 fw-medium"><i
                                                        class="mdi mdi-star text-warning me-1"></i>4.3</span></span></td>
                                        <td data-column-id="published" class="gridjs-td"><span>15 May, 2021<small
                                                    class="text-muted ms-1">03:40 PM</small></span></td>
                                        <td data-column-id="action" class="gridjs-td"><span>
                                                <div class="dropdown"><button
                                                        class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="ri-more-fill"></i></button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item"
                                                                href="apps-ecommerce-product-details.html"><i
                                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                View</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="apps-ecommerce-add-product.html"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit</a></li>
                                                        <li class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#removeItemModal"><i
                                                                    class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Delete</a></li>
                                                    </ul>
                                                </div>
                                            </span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="gridjs-footer">
                            <div class="gridjs-pagination">
                                <div role="status" aria-live="polite" class="gridjs-summary" title="Page 1 of 2">
                                    Showing <b>1</b> to <b>10</b> of <b>12</b> results</div>
                                <div class="gridjs-pages"><button tabindex="0" role="button" disabled=""
                                        title="Previous" aria-label="Previous" class="">Previous</button><button
                                        tabindex="0" role="button" class="gridjs-currentPage" title="Page 1"
                                        aria-label="Page 1">1</button><button tabindex="0" role="button"
                                        class="" title="Page 2" aria-label="Page 2">2</button><button
                                        tabindex="0" role="button" title="Next" aria-label="Next"
                                        class="">Next</button></div>
                            </div>
                        </div>
                        <div id="gridjs-temp" class="gridjs-temp">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- nila end -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
