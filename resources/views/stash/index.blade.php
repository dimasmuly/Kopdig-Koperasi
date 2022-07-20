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
        <div class="col-md-3">
            <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#stashModal">Add New Stash</button>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" id="search_field" placeholder="Search Stash...">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <table class="table align-middle table-striped table-hover" id="table_stash">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Stash Date</th>
                                <th>Member</th>
                                <th>Beginning Balance</th>
                                <th>Amount</th>
                                <th>Ending Balance</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stashes as $stash)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date('d M Y', strtotime($stash['stash_date'])) }}</td>
                                    <td>{{ ucwords(strtolower($stash['name'])) }}</td>
                                    <td>IDR {{ number_format($stash['beginning_balance']) }}</td>
                                    <td>
                                        <h5>
                                            <span class="badge badge-outline-danger">
                                                IDR {{ number_format($stash['stash_amount']) }}
                                            </span>
                                        </h5>
                                    </td>
                                    <td>IDR {{ number_format($stash['ending_balance']) }}</td>
                                    <td>
                                        <a href="#" data-id="{{ $stash['id'] }}" data-bs-toggle="modal"
                                            data-bs-target="#stashModal" class="btn btn-primary btn-sm btn-edit">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <a href="/api/stash/delete/{{ $stash['id'] }}" onclick="return(confirm('Are you sure?'))" class="btn btn-danger btn-sm">
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
    <div class="modal fade" id="stashModal" tabindex="-1" aria-labelledby="stashModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stashModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/api/stash/store" method="POST">
                        {{ csrf_field() }}
                        <div class="col-md mb-3">
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                            <label for="name" class="form-label">Member Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <span>Current Balance: <strong>IDR {{ number_format($current_balance) }}</strong></span>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="stash_amount" class="form-label">Stash Amount</label>
                                <input type="number" class="form-control" id="stash_amount" name="stash_amount">
                            </div>
                            <div class="col-md-6">
                                <label for="stash_date" class="form-label">Stash Date</label>
                                <input type="date" class="form-control" id="stash_date" name="stash_date">
                            </div>
                        </div>
                        {{-- Current Balance = Current Balance - Stash Amount --}}
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="beginning_balance" class="form-label">Beginning Balance</label>
                                <input type="text" class="form-control" name="beginning_balance" id="beginning_balance"
                                    value="{{ number_format($current_balance) }}" readonly>
                                <input type="hidden" name="beginning_balance" value="{{ $current_balance }}">
                            </div>
                            <div class="col-md-6">
                                <label for="ending_balance" class="form-label">Ending Balance</label>
                                <input type="number" class="form-control" id="ending_balance" name="ending_balance"
                                    value="" readonly>
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
                var value = $(this).val().toLowerCase();
                $('#table_stash tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            $('.btn-add').on('click', function() {
                $('#user_id').val({{ auth()->user()->id }});
                $('#name').val('{{ auth()->user()->name }}');
                $('#stash_amount').val('');
                $('#stash_date').val('');
                $('#beginning_balance').val('{{ number_format($current_balance) }}');
                $('#ending_balance').val('');
                $('#stashModalLabel').text('Add New Stash');
                $('#stashModal .modal-body form').attr('action', '/api/stash/store');
                $('#stashModal button[type=submit]').text('Add Stash');
                $('#stash_amount').on('keyup', function() {
                    var amount = $(this).val();
                    var ending_balance = {{ $current_balance }} - parseInt(amount);
                    $('#ending_balance').val(ending_balance);
                    if (ending_balance < 0) {
                        $('#ending_balance').css('color', 'red');
                        $('#stashModal button[type=submit]').attr('disabled', true);
                    } else {
                        $('#ending_balance').css('color', 'black');
                        $('#stashModal button[type=submit]').removeAttr('disabled');
                    }
                });
            });

            $('.btn-edit').on('click', function() {
                var id = $(this).data('id');

                // delete all fields
                $('#stashModal .modal-body form').find('input').val

                $.ajax({
                    url: '/api/stash/' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $('#user_id').val(data.user_id);
                        $('#name').val(data.name);
                        $('#stash_amount').val(data.stash_amount);
                        $('#stash_date').val(data.stash_date);
                        $('#beginning_balance').val(data.beginning_balance);
                        $('#ending_balance').val(data.ending_balance);
                    }
                });

                $('#stashModalLabel').text('Edit Stash');
                $('#stashModal .modal-body form').attr('action', '/api/stash/update/' + id);
                $('#stashModal .modal-body button[type=submit]').text('Update Stash');
                $('#stash_amount').val($(this).data('stash_amount'));
                $('#stash_date').val($(this).data('stash_date'));
                $('#ending_balance').val($(this).data('ending_balance'));
                $('#stash_amount').on('keyup', function() {
                    var amount = $(this).val();
                    var ending_balance = {{ $current_balance }} - parseInt(amount);
                    $('#ending_balance').val(ending_balance);
                    if (ending_balance < 0) {
                        $('#ending_balance').css('color', 'red');
                        $('#stashModal button[type=submit]').attr('disabled', true);
                    } else {
                        $('#ending_balance').css('color', 'black');
                        $('#stashModal button[type=submit]').removeAttr('disabled');
                    }
                });
            });
        });
    </script>
@endsection
