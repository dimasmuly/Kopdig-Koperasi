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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3 justify-content-between">
                        <div class="col-md-3">
                            {{-- <button class="btn btn-primary" data-bs-target="#installmentModal" data-bs-toggle="modal">Add New
                                Installment</button> --}}
                        </div>
                        <div class="col-md-3">
                            <input type="text" placeholder="Search installment.." class="form-control" name="search_field"
                                id="search_field">
                        </div>
                    </div>
                    <table class="table table-striped table-responsive" id="table-installments">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ins. Number</th>
                                <th>Type</th>
                                <th>Pay Date</th>
                                <th>Lateness</th>
                                <th>Total Ins.</th>
                                <th>Interest</th>
                                <th>Fine</th>
                                <th>Total Pay</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($installments as $installment)
                                <tr data-id="{{ $installment['id'] }}"
                                    data-installment-number="{{ $installment['installment_number'] }}"
                                    data-installment-type="{{ $installment['installment_type'] }}"
                                    data-pay-date="{{ $installment['pay_date'] }}"
                                    data-lateness-date="{{ $installment['lateness_date'] }}"
                                    data-total-installment="{{ $installment['total_installment'] }}"
                                    data-interest="{{ $installment['interest'] }}"
                                    data-fine="{{ $installment['fine'] }}"
                                    data-total-pay="{{ $installment['total_pay'] }}">

                                    <td>{{ $installment['id'] }}</td>
                                    <td>{{ $installment['installment_number'] }}</td>
                                    <td class="text-capitalize">{{ $installment['installment_type'] }}</td>
                                    <td>{{ date('d M Y', strtotime($installment['pay_date'])) }}</td>
                                    <td>{{ date('d M Y', strtotime($installment['lateness_date'])) }}</td>
                                    <td class="">IDR {{ $installment['total_installment'] }}</td>
                                    <td class="text-danger">{{ $installment['interest'] }}</td>
                                    <td class="text-danger">{{ $installment['fine'] }}</td>
                                    <td class="text-success">IDR {{ $installment['total_pay'] }}</td>
                                    <td class="text-center">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-light btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                        data-bs-target="#installmentModal"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a></li>
                                                <li>
                                                    <a class="dropdown-item remove-item-btn delete-item-btn"
                                                        data-id="{{ $installment['id'] }}">
                                                        <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="installmentModal" tabindex="-1" aria-labelledby="installmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="installmentModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="installment_number">Ins. Number</label>
                                    <input type="number" class="form-control" id="installment_number"
                                        name="installment_number">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="installment_type">Type</label>
                                    <input type="text" class="form-control" id="installment_type"
                                        name="installment_type">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pay_date">Pay Date</label>
                                    <input type="date" class="form-control" id="pay_date" name="pay_date">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="lateness_date">Lateness</label>
                                    <input type="date" class="form-control" id="lateness_date" name="lateness_date">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_installment">Total Ins.</label>
                                    <input type="number" class="form-control" id="total_installment"
                                        name="total_installment">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="interest">Interest</label>
                                    <input type="number" class="form-control" id="interest" name="interest">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fine">Fine</label>
                                    <input type="number" class="form-control" id="fine" name="fine">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="total_pay">Total Pay</label>
                                    <input type="number" class="form-control" id="total_pay" name="total_pay">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-3.5.1.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#search_field').on('keyup', function() {
                var val = $(this).val().toLowerCase();
                $('table tbody tr').each(function() {
                    if ($(this).text().toLowerCase().indexOf(val) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('.edit-item-btn').on('click', function() {
                var id = $(this).closest('tr').data('id');
                var installment_number = $(this).closest('tr').data('installment-number');
                var installment_type = $(this).closest('tr').data('installment-type');
                var pay_date = $(this).closest('tr').data('pay-date');
                var lateness_date = $(this).closest('tr').data('lateness-date');
                var total_installment = $(this).closest('tr').data('total-installment');
                var interest = $(this).closest('tr').data('interest');
                var fine = $(this).closest('tr').data('fine');
                var total_pay = $(this).closest('tr').data('total-pay');

                $('#installmentModal').find('#installment_number').val(installment_number);
                $('#installmentModal').find('#installment_type').val(installment_type);
                $('#installmentModal').find('#pay_date').val(pay_date);
                $('#installmentModal').find('#lateness_date').val(lateness_date);
                $('#installmentModal').find('#total_installment').val(total_installment);
                $('#installmentModal').find('#interest').val(interest);
                $('#installmentModal').find('#fine').val(fine);
                $('#installmentModal').find('#total_pay').val(total_pay);
                $('#installmentModalLabel').text('Edit Installment');

                $('#installmentModal').find('form').attr('action', '/api/installment/' + id + '/update');
            });s
        });
    </script>
@endsection
