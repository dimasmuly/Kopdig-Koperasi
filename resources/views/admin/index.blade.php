@extends('partials.dashboard.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Earnings (Monthly)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Earnings (Annual)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grafik edit ini nill-->
        <div class="row">
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- Profile Koperasi -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">your cooperative</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                src="https://www.freepnglogos.com/uploads/logo-koperasi-png/logo-koperasi-rpp-koperasi-kelas-pgsd-untan-2.png"
                                alt="" title="Logo Koperasi Mu ">
                        </div>
                        <h3 class="text text-dark font-weight-bold">Nama Koperasi mu</h3>
                        <?php
                        $num_char = 150;
                        $desk =
                            '  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis aliquam quia animi ullam vero distinctio adipisci laboriosam id ipsum dolores mollitia quam quisquam, illo eligendi atque nihil quaerat suscipit, pariatur sunt consectetur aut hic? Deleniti in facere officia reiciendis sequi nisi voluptates fugit suscipit, aut unde fuga quidem dolores ullam iusto labore aliquam numquam odio! Dolorem laboriosam ipsam debitis. Earum voluptates ipsum officiis voluptatem ducimus totam qui, cupiditate vero laboriosam laborum! Dolorem tempora sed neque molestiae quidem magnam? Praesentium hic repellendus illo dolorum rerum libero in enim consectetur sed cupiditate excepturi aliquam laboriosam earum eveniet ex voluptatum sapiente inventore incidunt nulla, recusandae aspernatur tenetur, alias odio ipsa. Sint tenetur quas, vel vitae optio, iusto placeat, est neque sapiente quae illo iure minima temporibus illum consequatur voluptas explicabo unde non! Nihil quasi quae expedita labore laudantium rem cum necessitatibus similique, libero vitae animi suscipit sed veniam reprehenderit magni? Deserunt beatae incidunt magnam veritatis repellat recusandae ad nemo corrupti enim vitae velit repudiandae magni placeat necessitatibus quis esse minima earum, dolorum cumque quod. Repellendus, consequatur tempora! Eveniet fuga enim incidunt, hic praesentium, suscipit impedit temporibus dolores explicabo saepe neque quam error laudantium soluta. Quod eligendi pariatur iste saepe, ratione magnam aliquid laboriosam.';
                        if ($desk[$num_char - 1] != ' ') {
                            $num_char = strpos($desk, ' ', $num_char);
                        }
                        ?>
                        <p><?php echo substr($desk, 0, $num_char) . '...'; ?></p>
                        <a target="_self" rel="nofollow" href="admin/profile-cooprative">Check Your Cooperative →</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>

@endsection
