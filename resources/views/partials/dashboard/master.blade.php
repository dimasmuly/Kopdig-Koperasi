@include('partials.dashboard.header')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $page }}</h1>
    {{-- Main Content --}}
    <div class="card shadow mb-4">
        <div class="card-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@include('partials.dashboard.footer')
