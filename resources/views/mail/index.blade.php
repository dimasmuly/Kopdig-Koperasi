@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            {{ $title }}
        @endslot
    @endcomponent

    <div class="row mb-3 justify-content-between">
        <div class="col-md-3">
            <button class="btn btn-primary add-item-btn" data-bs-toggle="modal" data-bs-target="#mailModal">Add New
                Mails</button>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="search_field" id="search_field" placeholder="Search mail..">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="table-mails">
                        <thead>
                            <th>#</th>
                            <th>Sender</th>
                            <th style="max-width: 250px">Subject</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($mails as $mail)
                                <tr data-id="{{ $mail['id'] }}" data-user_id="{{ $mail['user_id'] }}"
                                    data-subject="{{ $mail['subject'] }}"
                                    data-body="{{ $mail['body'] }}"
                                    data-name="{{ $mail['name'] }}" data-is_read="{{ $mail['is_read'] }}"
                                    data-status="{{ $mail['status'] }}" data-created_at="{{ $mail['created_at'] }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mail['name'] }}</td>
                                    <td class="text-truncate" style="max-width: 250px">{{ $mail['subject'] }}</td>
                                    <td>
                                        @switch($mail['status'])
                                            @case('read')
                                                <span class="badge bg-success">Read</span>
                                            @break

                                            @case('unread')
                                                <span class="badge bg-danger">Unread</span>
                                            @break

                                            @case('approved')
                                                <span class="badge bg-success">Approved</span>
                                            @break

                                            @case('rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td>{{ date('d M Y', strtotime($mail['created_at'])) }}</td>
                                    <td>
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-light btn-sm dropdown" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-fill align-middle"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" style="">
                                                <li><a class="dropdown-item edit-item-btn" data-id="{{ $mail['id'] }}"
                                                        data-bs-toggle="modal" data-bs-target="#mailModal"><i
                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                        Edit</a></li>
                                                <li>
                                                    <a href="/api/mail/{{ $mail['id'] }}/delete" class="dropdown-item remove-item-btn delete-item-btn" onclick="return(confirm('Are you sure?'))">
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
    <div class="modal fade" id="mailModal" tabindex="-1" aria-labelledby="mailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mailModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="row mb-3">
                            <div class="col">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="body">Body</label>
                                <textarea class="form-control" name="body" id="body" cols="10" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="user_id">User</label>
                                <select class="form-select" name="user_id" id="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="status_read">Status</label>
                                <select class="form-select" name="status" id="status_read">
                                    <option value="read">Read</option>
                                    <option value="unread">Unread</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="is_read" id="is_read">
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
            $('.add-item-btn').on('click', function() {
                $('#mailModal .modal-body form').attr('action', '/api/mail/store');
                $('#status_read').val('unread').trigger('change');
                $('#status_read').attr('disabled', 'true');
                $('#is_read').val(0);

                $('#subject').val('');
                $('#body').val('');
                $('#user_id').val('');
            });

            $('.edit-item-btn').on('click', function() {
                var id = $(this).data('id');
                var subject = $(this).closest('tr').data('subject');
                var body = $(this).closest('tr').data('body');
                var user_id = $(this).closest('tr').data('user_id');
                var status = $(this).closest('tr').data('status');
                var is_read = $(this).closest('tr').data('is_read');

                $('#subject').val(subject);
                $('#body').val(body);
                $('#user_id').val(user_id);
                $('#user_id').attr('disabled', true);
                $('#status_read').val(status).trigger('change');
                $('#is_read').val(is_read);

                $('#mailModal .modal-body form').attr('action', '/api/mail/' + id + '/update');
                $('#status_read').removeAttr('disabled');
                $('#is_read').val(1);

                $('#mailModal .modal-footer button[type="submit"]').text('Update');
            });
        });
    </script>
@endsection
