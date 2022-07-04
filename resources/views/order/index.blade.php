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

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                {{-- Add Order Button --}}
                {{-- <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Recent Order</h4>
                    <div class="flex-shrink-0">
                        <a href="#" class="btn btn-primary btn-label me-2" data-bs-toggle="modal"
                            data-bs-target="#addNewOrder">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="ri-add-line label-icon align-middle fs-16 me-2"></i>
                                </div>
                                <div class="flex-grow-1">
                                    Add New Order
                                </div>
                            </div>
                        </a>
                    </div>
                </div><!-- end card header --> --}}

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Pay</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td><a href="#" class="fw-medium">{{ $loop->iteration }}</a></td>
                                            <td>{{ date('d-m-Y, g:i A', strtotime($order['created_at'])) }}</td>
                                            @if ($order['status'] == 'pending')
                                                <td class="text-primary"><i class="ri-refresh-line fs-17 align-middle"></i>
                                                    Pending
                                                </td>
                                            @elseif ($order['status'] == 'success')
                                                <td class="text-success"><i
                                                        class="ri-checkbox-circle-line fs-17 align-middle"></i> Success
                                                </td>
                                            @elseif ($order['status'] == 'cancel')
                                                <td class="text-danger"><i
                                                        class="ri-close-circle-line fs-17 align-middle"></i> Cancel
                                                </td>
                                            @endif
                                            <td>
                                                <div class="d-flex gap-2 align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ URL::asset($order['user']['profile_photo_path']) }}"
                                                            alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        {{ $order['user']['name'] }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $order['transaction']['product']['name'] }}</td>
                                            <td>{{ $order['transaction']['quantity'] }}</td>
                                            <td>IDR {{ number_format($order['total_pay']) }}</td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#editOrder"
                                                    class="btn btn-success w-sm btn-edit"
                                                    data-id="{{ $order['id'] }}">Edit</a>
                                                <a href="" class="btn btn-danger w-sm">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- <tfoot class="table-light">
                                    <tr>
                                        <td colspan="6">Total</td>
                                        <td>IDR
                                            {{ number_format($orders->sum('total_pay')) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot> --}}
                            </table>
                            <!-- end table -->
                        </div>
                        <!-- end table responsive -->
                    </div>
                    {{-- pagination dynamic from orders --}}
                    <div class="row justify-content-between mt-3">
                        <div class="col-xl-6">
                            <div class="pagination-info">
                                <span>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of
                                    {{ $orders->total() }} entries</span>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="pagination-controls">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                    {{-- end pagination dynamic from orders --}}
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit order --}}
    <div id="editOrder" class="modal fade" tabindex="-1" aria-labelledby="editOrderLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editOrderLabel">Modal Heading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="orderdate-field" class="form-label">Order Date</label>
                        <input type="date" class="form-control" id="orderdate-field">
                    </div>
                    <div class="mt-2">
                        <label for="customername-field" class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="customername-field" disabled>
                    </div>
                    <div class="mt-2">
                        <label for="status-field" class="form-label">Status</label>
                        <select class="form-select mb-3" id="status-field" aria-label="Default select example">
                            <option selected="">Select your Status </option>
                            <option value="success">Success</option>
                            <option value="pending">Pending</option>
                            <option value="cancel">Cancel</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <label for="productname-field" class="form-label">Product</label>
                            <select class="form-select mb-3" id="productname-field" aria-label="Default select example">
                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                                @endforeach
                            </select>
                            <small class="text-primary">Price : IDR <span id="productprice-lable"
                                    class="text-primary"></span></small>
                        </div>
                        <div class="col-xl">
                            <label for="quantity-field" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity-field">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="note-field">Note</label>
                        <input type="text" class="form-control" id="note-field">
                    </div>
                    <div class="mt-2">
                        <label for="destinationaddress-field">Destination Address</label>
                        <textarea  class="form-control" id="destinationaddress-field" cols="20" rows="5"></textarea>
                    </div>
                    <div class="mt-2">
                        <label for="paymentmethod-field" class="form-label">Payment Method</label>
                        <select class="form-select mb-3" id="paymentmethod-field" aria-label="Default select example">
                            @foreach ($payment_methods as $payment_method)
                                <option value="{{ $payment_method['id'] }}">{{ $payment_method['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-2">
                        <label for="totalpay-field" class="form-label">Total Pay</label>
                        <input type="number" class="form-control" id="totalpay-field" disabled>
                    </div>
                    <input type="hidden" id="transactionid-field">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-update">Save Changes</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-3.5.1.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.btn-edit').on('click', function() {
                $('#editOrder .modal-title').html('Edit Order');
                const id = $(this).data('id');
                $.ajax({
                    url: `/api/order/${id}`,
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // get date and passing to date form input
                        const date = new Date(data.created_at);
                        const dateString = date.toISOString().split('T')[0];
                        $('#orderdate-field').val(dateString);
                        $('#customername-field').val(data.user.name);
                        $('#status-field').val(data.status);
                        $('#productname-field').val(data.transaction.product.id);
                        $('#productprice-lable').html(data.transaction.product.price);
                        $('#quantity-field').val(data.transaction.quantity);
                        $('#totalpay-field').val(data.total_pay);
                        $('#note-field').val(data.transaction.note);
                        $('#paymentmethod-field').val(data.payment_method_id);
                        $('#transactionid-field').val(data.id);
                        $('#destinationaddress-field').val(data.transaction.destination_address);
                    }
                });
            });
            
            // update value of total pay when change quantity
            $('#quantity-field').on('input', function() {
                const quantity = $(this).val();
                const price = $('#productprice-lable').html();
                const totalPay = quantity * price;
                $('#totalpay-field').val(totalPay);
            });

            // update order when click button update
            $('#btn-update').on('click', function() {
                const id = $('#transactionid-field').val();
                const created_at = $('#orderdate-field').val();
                const status = $('#status-field').val();
                const product_id = $('#productname-field').val();
                const quantity = $('#quantity-field').val();
                const note = $('#note-field').val();
                const payment_method_id = $('#paymentmethod-field').val();
                const total_pay = $('#totalpay-field').val();
                const destination_address = $('#destinationaddress-field').val();
            });
        });
    </script>
@endsection
