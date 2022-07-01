@extends('partials.dashboard.master')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between px-3">
                <form class="d-none d-sm-inline-block form-inline navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <a href="#" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add New Administrators</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table id="administrators" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Position</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($administrators as $administrator)
                        @if ($administrator['role_id'] != 1)
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle"><b>{{ $administrator['name'] }}</b></td>
                                <td class="align-middle">{{ $administrator['email'] }}</td>
                                <td class="align-middle">{{ $administrator['phone_number'] }}</td>
                                <td class="align-middle">
                                    @if ($administrator['role_id'] == 2)
                                        <span class="badge badge-success">Chairman</span>
                                    @elseif ($administrator['role_id'] == 7)
                                        <span class="badge badge-warning">Vice</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <a href="#" class="btn btn-info btn-circle">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-circle">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
