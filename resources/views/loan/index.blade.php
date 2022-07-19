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

    <div class="row justify-content-between">
        <div class="col-md-4">
            <button type="button" class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#loanModal">Add New
                Loan</button>
        </div>
        <div class="col-md-3">
            <input type="text" name="search_field" id="search_field" placeholder="Search Loan.." class="form-control">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle table-striped table-sm" id="table-loans">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Member</th>
                                    <th>Amount</th>
                                    <th>Principal</th>
                                    <th>Interest</th>
                                    <th>Total</th>
                                    <th>Remaining</th>
                                    <th>Period</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loans as $loan)
                                    <tr data-id="{{ $loan['id'] }}" data-membername="{{ $loan['name'] }}"
                                        data-loan_type_id="{{ $loan['loan_type_id'] }}"
                                        data-loan_date="{{ $loan['loan_date'] }}"
                                        data-installment_principal="{{ $loan['installment_principal'] }}"
                                        data-installment_period="{{ $loan['installment_remaining'] }}"
                                        data-total_installment="{{ $loan['total_installment'] }}"
                                        data-amount="{{ $loan['amount'] }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date('d-m-Y', strtotime($loan['loan_date'])) }}</td>
                                        <td>{{ $loan['name'] }}</td>
                                        <td class="text-success">{{ number_format($loan['amount']) }}</td>
                                        <td class="text-primary">{{ number_format($loan['installment_principal']) }}</td>
                                        <td>{{ number_format($loan['installment_interest']) }}</td>
                                        <td class="text-danger">{{ number_format($loan['total_installment']) }}</td>
                                        <td class="text-center">{{ $loan['installment_remaining'] }}</td>
                                        <td>
                                            {{-- show in day, month or year --}}
                                            @if ($loan['installment_period'] > 30)
                                                <span class="badge bg-success">{{ $loan['installment_period'] / 30 }}
                                                    months</span>
                                            @elseif($loan['installment_period'] > 365)
                                                <span class="badge bg-success">{{ $loan['installment_period'] / 365 }}
                                                    years</span>
                                            @else
                                                <span class="badge bg-success">{{ $loan['installment_period'] }}
                                                    days</span>
                                            @endif
                                        </td>
                                        <td class="text-capitalize">{{ $loan['type'] }}</td>
                                        <td class="text-center">
                                            <div class="dropdown d-inline-block">
                                                <button class="btn btn-light btn-sm dropdown" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill align-middle"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                                    <li><a class="dropdown-item edit-item-btn" data-bs-toggle="modal"
                                                            data-bs-target="#loanModal"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn delete-item-btn"
                                                            data-id="{{ $loan['id'] }}">
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
    </div>

    {{-- Modal --}}
    <div id="loanModal" class="modal fade" tabindex="-1" aria-labelledby="loanModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loanModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                            <label for="membername_field" class="form-label">Member Name</label>
                            <input type="text" class="form-control" id="membername_field" name="membername_field"
                                readonly>
                        </div>
                        <div class="mb-3">
                            <label for="loan_type_id" class="form-label">Loan Type</label>
                            <select name="loan_type_id" id="loan_type_id" class="form-select">
                                @foreach ($loan_types as $loan_type)
                                    <option value="{{ $loan_type['id'] }}">{{ $loan_type['type'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <label for="installment_date" class="form-label">Installment Date</label>
                                <input type="date" class="form-control" id="installment_date" name="installment_date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
                                <input type="hidden" name="installment_interest" id="installment_interest">
                                <label for="installment_principal" class="form-label">Installment Principal</label>
                                <input type="number" class="form-control" id="installment_principal"
                                    name="installment_principal" readonly>
                            </div>
                            <div class="col-md">
                                <label for="installment_period" class="form-label">Installment Period -
                                    <small>Day</small></label>
                                <input type="number" class="form-control" id="installment_period"
                                    name="installment_period">
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="mb-3">
                            <label for="total_installment" class="form-label">Total Installment</label>
                            <input type="text" class="form-control" id="total_installment" name="total_installment"
                                readonly>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/libs/prismjs/prismjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-3.5.1.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('.edit-item-btn').on('click', function() {
                var id = $(this).closest('tr').data('id');
                var user_id = '{{ auth()->user()->id }}';
                var membername = $(this).closest('tr').data('membername');
                var loan_type_id = $(this).closest('tr').data('loan_type_id');
                var loan_date = $(this).closest('tr').data('loan_date');
                var installment_principal = $(this).closest('tr').data('installment_principal');
                var installment_period = $(this).closest('tr').data('installment_period');
                var amount = $(this).closest('tr').data('amount');
                var total_installment = $(this).closest('tr').data('total_installment');
                var type = $(this).closest('tr').data('type');
                var loan_id = $(this).closest('tr').data('loan_id');
                $('#loanModalLabel').text('Edit Loan');
                $('#membername_field').val(membername);
                $('#user_id').val(user_id);
                $('#loan_type_id').val(loan_type_id);
                $('#installment_date').val(loan_date);
                $('#installment_date').attr('readonly', true);
                $('#installment_principal').val(installment_principal);
                $('#installment_period').val(installment_period);
                $('#installment_period').attr('readonly', true);
                $('#amount').val(amount);
                $('#total_installment').val(total_installment);
                $('#loan_id').val(loan_id);
                $('#loanModal .modal-body form').attr('action', '/api/loan/' + id + '/update');
            });

            $('#search_field').on('keyup', function() {
                var keyword = $(this).val();
                $('#table-loans tbody tr').each(function() {
                    if ($(this).text().toLowerCase().indexOf(keyword) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('.btn-add').on('click', function() {
                $('#loanModalLabel').text('Add New Loan');
                $('#loanModal .modal-body form').attr('action', '/api/loan/store');
                $('#loanModal .modal-footer button[type=submit]').text('Add Loan');

                // reset field
                $('#user_id').val('{{ auth()->user()->id }}');
                $('#membername_field').val('{{ auth()->user()->name }}');
                $('#amount').val('');
                $('#installment_date').val('');
                $('#installment_date').attr('readonly', false);
                $('#installment_principal').val('');
                $('#installment_period').val('');
                $('#installment_period').attr('readonly', false);
                $('#loan_type_id').val('');
                $('#total_installment').val('');
            });

            $('#amount').on('keyup', function() {
                var amount = $(this).val();
                var installment_principal = $('#installment_principal').val();
                var installment_period = $('#installment_period').val();
                var installment_interest = parseInt(amount) - parseInt(installment_principal);
                $('#installment_interest').val(installment_interest);
                var total_installment = 0;
                if (amount != '' || amount != 0) {
                    total_installment = parseInt(amount) + parseInt(installment_interest);
                    $('#total_installment').val(total_installment);
                } else {
                    $('#total_installment').val('');
                }
            });

            $('.delete-item-btn').on('click', function() {
                let isdelete = confirm('Are you sure to delete this item?');
                if (isdelete) {
                    var id = $(this).closest('tr').data('id');
                    $.ajax({
                        url: '/api/loan/' + id + '/delete',
                        type: 'POST',
                        success: function(response) {
                            $('#table-loans tbody tr[data-id=' + id + ']').remove();
                        }
                    });
                }
            });

            $('#loan_type_id').change(function() {
                var loan_type_id = $(this).val();
                $.ajax({
                    url: '/api/loan/loan_type/' + loan_type_id,
                    type: 'GET',
                    success: function(response) {
                        $('#installment_principal').val(response.interest);
                        var mount = $('#amount').val();
                        var total_installment = 0;
                        if (mount != '' || mount != 0) {
                            total_installment = parseInt(mount) * (parseInt(response.interest) *
                                $('#installment_period').val());
                            $('#total_installment').val(total_installment);
                        } else {
                            $('#total_installment').val('');
                        }
                    }
                });
            });
        });
    </script>
@endsection
