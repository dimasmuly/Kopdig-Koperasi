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
    <div class="row mb-3 justify-content-between">
        <div class="col-md-3">
            <button class="btn btn-primary btn-add" data-bs-target="#duesModal" data-bs-toggle="modal">Add New Dues</button>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" id="search_field" placeholder="Search dues..">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped align-middle" id="table-dues">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Member</th>
                                <th>Total Pay</th>
                                <th>Dues Amount</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dues as $due)
                                <tr data-id="{{ $due['id'] }}" data-user-id="{{ $due['user_id'] }}"
                                    data-member="{{ $due['name'] }}" data-total-pay="{{ $due['total_pay'] }}"
                                    data-dues-amount="{{ $due['dues_amount'] }}" data-type="{{ $due['type'] }}"
                                    data-dues_type_id="{{ $due['dues_type_id'] }}"
                                    data-created-at="{{ $due['created_at'] }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $due['name'] }}</td>
                                    <td class="text-success">IDR {{ $due['total_pay'] }}</td>
                                    <td class="text-success">IDR {{ $due['dues_amount'] }}</td>
                                    <td>{{ $due['type'] }}</td>
                                    <td>
                                        @if ($due['created_at'] != null)
                                            {{ date('d M Y', strtotime($due['created_at'])) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" data-id="{{ $due['id'] }}" data-bs-toggle="modal"
                                            data-bs-target="#duesModal" class="btn btn-primary btn-sm btn-edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <a href="/api/dues/{{ $due['id'] }}/delete"
                                            onclick="return(confirm('Are you sure?'))" class="btn btn-danger btn-sm">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
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
    <div class="modal fade" id="duesModal" tabindex="-1" aria-labelledby="duesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="duesModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="member">Member</label>
                                <select id="member" name="user_id" class="form-select">
                                    <option value="">Select Member</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member['id'] }}">{{ $member['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="type">Type</label>
                                <select name="dues_type_id" id="dues_type_id" class="form-select">
                                    <option value="">Select Type</option>
                                    @foreach ($dues_types as $type)
                                        <option value="{{ $type['id'] }}">{{ $type['type'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="dues_amount">Dues Amount</label>
                                <input type="number" name="dues_amount" id="dues_amount" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="total_pay">Total Pay</label>
                                <input type="number" name="total_pay" id="total_pay" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="date">Date</label>
                                <input type="date" name="created_at" id="created_at" class="form-control">
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
                $('#table-dues tbody tr').each(function() {
                    if ($(this).text().toLowerCase().indexOf($('#search_field').val()
                            .toLowerCase()) > -1) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            $('.btn-add').on('click', function() {
                $('#duesModalLabel').text('Add Dues');
                $('#duesModal form').attr('action', '/api/dues/store');
                $('#member').val({{ auth()->user()->id }});
                $('#member').attr('readonly', true);
                $('#dues_amount').attr('readonly', true);
                $('#created_at').val(new Date().toISOString().split('T')[0]);
                $('#created_at').attr('readonly', true);
            });

            $('#total_pay').on('keyup', function() {
                var val = $(this).val();
                if (val < parseInt($('#dues_amount').val())) {
                    $('#duesModal .modal-footer button[type="submit"]').attr('disabled', true);
                } else {
                    $('#duesModal .modal-footer button[type="submit"]').attr('disabled', false);
                }
            });

            $('#dues_type_id').change(function() {
                var value = $(this).val();
                $.ajax({
                    url: '/api/dues/type/' + value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#dues_amount').val(data.amount);
                        $('#total_pay').val(data.amount);
                    }
                });
            });

            $('.btn-edit').on('click', function() {
                var id = $(this).closest('tr').data('id');
                $('#duesModalLabel').text('Edit Dues');
                $('#duesModal form').attr('action', '/api/dues/' + id + '/update');
                var user_id = $(this).closest('tr').data('user-id');
                var dues_type_id = $(this).closest('tr').data('dues_type_id');
                var amount = $(this).closest('tr').data('dues-amount');
                var total_pay = $(this).closest('tr').data('total-pay');
                var created_at = $(this).closest('tr').data('created-at');

                $('#member').val(user_id).trigger('change');
                $('#member').attr('disabled', true);
                $('#dues_type_id').val(dues_type_id).trigger('change');
                $('#dues_amount').val(amount);
                $('#total_pay').val(total_pay);
                $('#created_at').val(new Date(created_at).toISOString().split('T')[0]);
            });

        });
    </script>
@endsection
