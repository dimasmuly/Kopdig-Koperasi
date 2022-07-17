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
                                    <tr>
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
                                                    <li><a href="#!" class="dropdown-item"><i
                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                            View</a></li>
                                                    <li><a class="dropdown-item edit-item-btn"><i
                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                            Edit</a></li>
                                                    <li>
                                                        <a class="dropdown-item remove-item-btn">
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
                                <input type="date" class="form-control" id="installment_date"
                                    name="installment_date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md">
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
                        <div class="col-md">
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
                $('#installment_principal').val('');
                $('#installment_period').val('');
                $('#loan_type_id').val('');
                $('#total_installment').val('');
            });
        });
    </script>
@endsection
