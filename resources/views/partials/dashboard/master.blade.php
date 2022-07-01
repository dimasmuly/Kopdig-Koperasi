@include('partials.dashboard.header')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    {{-- <h1 class="h3 mb-4 text-gray-800">{{ $page }}</h1> --}}
    {{-- Main Content --}}
    @yield('content')
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@include('partials.dashboard.footer')
