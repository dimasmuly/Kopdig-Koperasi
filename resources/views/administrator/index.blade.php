@extends('layouts.master')
@section('title')
    @lang('translation.team')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Pages
        @endslot
        @slot('title')
            Team
        @endslot
    @endcomponent
    <div class="card">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row g-2">
                <div class="col-sm-4">
                    <div class="search-box">
                        <input type="text" class="form-control"
                            placeholder="Search for name, tasks, projects or something...">
                        <i class="ri-search-line search-icon"></i>
                    </div>
                </div>
                <!--end col-->
                <div class="col-sm-auto ms-auto">
                    <div class="list-grid-nav hstack gap-1">
                        <button type="button" id="grid-view-button"
                            class="btn btn-soft-info nav-link btn-icon fs-14 active filter-button"><i
                                class="ri-grid-fill"></i></button>
                        <button type="button" id="list-view-button"
                            class="btn btn-soft-info nav-link  btn-icon fs-14 filter-button"><i
                                class="ri-list-unordered"></i></button>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addmembers"><i
                                class="ri-add-fill me-1 align-bottom"></i> Add Members</button>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="team-list grid-view-filter row">
                    @foreach ($administrators as $administrator)
                        <div class="col">
                            <div class="card team-box">
                                <div class="team-cover">
                                    <img src="{{ asset($administrator['profile_photo_path']) ?? asset('assets/images/users/avatar-1.jpg') }}"
                                        alt="" class="img-fluid" />
                                </div>
                                <div class="card-body p-4">
                                    <div class="row align-items-center team-row">

                                        <div class="col-lg-4 col">
                                            <div class="team-profile-img">
                                                <div class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                                                    <img src="{{ URL::asset($administrator['profile_photo_path']) ?? URL::asset('assets/images/users/avatar-3.jpg') }}"
                                                        alt="" class="img-fluid d-block rounded-circle" />
                                                </div>
                                                <div class="team-content">
                                                    <a data-bs-toggle="offcanvas" href="#offcanvasExample"
                                                        aria-controls="offcanvasExample">
                                                        <h5 class="fs-16 mb-1">{{ $administrator['name'] }}</h5>
                                                    </a>
                                                    <p class="text-muted mb-0">{{ $administrator['email'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col">
                                            <div class="row text-muted text-center">
                                                <div class="col-6 border-end border-end-dashed">
                                                    <h6 class="mb-1">
                                                        @switch($administrator['role_id'])
                                                            @case(2)
                                                                Chairman
                                                            @break

                                                            @case(3)
                                                                Member
                                                            @break

                                                            @case(5)
                                                                Secretary
                                                            @break

                                                            @case(6)
                                                                Treasurer
                                                            @break

                                                            @case(7)
                                                                Vice
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </h6>
                                                    <p class="text-muted mb-0">Role</p>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="mb-1">{{ $administrator['phone_number'] }}</h6>
                                                    <p class="text-muted mb-0">Phone</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col">
                                            <div class="text-end">
                                                <a data-bs-toggle="modal" data-id="{{ $administrator['id'] }}"
                                                    data-bs-target="#viewmember" class="btn btn-light view-btn">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                    @endforeach
                </div>
                <!--end row-->

                <!-- Modal Add Members-->
                <div class="modal fade" id="addmembers" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Profile Members</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="teammembersName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="teammembersName"
                                                    placeholder="Enter name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="roles" class="form-label">Role</label>
                                                <select name="roles" id="roles" class="form-select">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="number" class="form-control" id="phone"
                                                    placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label for="profile_photo_path" class="form-label">Profile Images</label>
                                                <input class="form-control" type="file" id="profile_photo_path">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end modal-content-->
                    </div>
                    <!--end modal-dialog-->
                </div>
                <!-- Modal View Members-->
                <div class="modal fade" id="viewmember" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Profile Members</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/api/admin/update" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" id="id">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter name">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Enter email">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="role_id" class="form-label">Role</label>
                                                <select name="role_id" id="role_id" class="form-select">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="phone_number" class="form-label">Phone</label>
                                                <input type="number" name="phone_number" class="form-control"
                                                    id="phone_number" placeholder="Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-4">
                                                <label for="profile_photo_path" class="form-label">Profile Images</label>
                                                <input class="form-control" name="profile_photo_path" type="file" id="profile_photo_path">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--end modal-content-->
                    </div>
                    <!--end modal-dialog-->
                </div>
                <!--end modal-->

                <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="offcanvasExample">
                    <!--end offcanvas-header-->
                    <div class="offcanvas-body profile-offcanvas p-0">
                        <div class="team-cover">
                            <img src="{{ asset($administrator['profile_photo_path']) ?? asset('assets/images/users/avatar-1.jpg') }}"
                                alt="" class="img-fluid" />
                        </div>
                        <div class="p-3 text-center">
                            <img src="{{ asset($administrator['profile_photo_path']) ?? asset('assets/images/users/avatar-1.jpg') }}"
                                alt="" class="avatar-lg img-thumbnail rounded-circle mx-auto">
                            <div class="mt-3">
                                <h5 class="fs-15"><a href="javascript:void(0);"
                                        class="link-primary">{{ $administrator['name'] }}</a></h5>
                                <p class="text-muted">
                                    @switch($administrator['role_id'])
                                        @case(2)
                                            'Cooperative Chairman'
                                        @break

                                        @case(3)
                                            'Member'
                                        @break

                                        @case(5)
                                            'Secretary'
                                        @break

                                        @case(6)
                                            'Treasurer'
                                        @break

                                        @case(7)
                                            'Vice'
                                        @break

                                        @default
                                    @endswitch
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end offcanvas-body-->
                    <div class="offcanvas-foorter border p-3 hstack gap-3 text-center position-relative">
                        <a href="#" class="btn btn-primary w-100"><i class="ri-user-3-fill align-bottom ms-1"></i>
                            View Profile</a>
                    </div>
                </div>
                <!--end offcanvas-->
            </div>
        </div><!-- end col -->
    </div>
    <!--end row-->

    <svg class="bookmark-hide">
        <symbol viewBox="0 0 24 24" stroke="currentColor" fill="var(--color-svg)" id="icon-star">
            <path stroke-width=".4"
                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
            </path>
        </symbol>
    </svg>
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/team.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery-3.5.1.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.view-btn').on('click', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '/api/admin/' + id,
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#viewmember #name').val(data.name);
                        $('#viewmember #email').val(data.email);
                        $('#viewmember #role_id').val(data.role_id);
                        $('#viewmember #phone_number').val(data.phone_number);
                        $('#viewmember #id').val(data.id);
                    }
                });
            });
        });
    </script>
@endsection
