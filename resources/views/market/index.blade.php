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

    {{-- EARNING, ORDERS, CUSTOMERS --}}
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <!-- EARNINGS -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Earnings</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">IDR <span class="counter-value"
                                    data-target="{{ $total_earnings }}">{{ number_format($total_earnings, 0, ',', '.') }}</span>
                            </h4>
                            <span href="" class="text-muted">Earning this month</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-success rounded fs-3">
                                <i class="bx bx-dollar-circle text-success"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- ORDERS -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Orders</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                    data-target="{{ $total_order }}">{{ $total_order }}</span></h4>
                            <a href="{{ route('dashboard.order') }}" class="text-decoration-underline">View all orders</a>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-info rounded fs-3">
                                <i class="bx bx-shopping-bag text-info"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <!-- CUSTOMER -->
            <div class="card card-animate">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1 overflow-hidden">
                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Business</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-end justify-content-between mt-4">
                        <div>
                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                    data-target="{{ $total_business }}">{{ $total_business }}</span></h4>
                            <span class="text-muted">Total Business</span>
                        </div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-soft-warning rounded fs-3">
                                <i class="bx bx-user-circle text-warning"></i>
                            </span>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        {{-- Tharixs Add Grafic --}}
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                        <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                ALL
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-soft-primary btn-sm">
                                1Y
                            </button>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-header p-0 border-0 bg-soft-light">
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="7585">7,585</span></h5>
                                    <p class="text-muted mb-0">Orders</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1">$<span class="counter-value" data-target="22.89">22.89</span>k</h5>
                                    <p class="text-muted mb-0">Earnings</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="367">367</span></h5>
                                    <p class="text-muted mb-0">Refunds</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                    <h5 class="mb-1 text-success"><span class="counter-value"
                                            data-target="18.92">18.92</span>%</h5>
                                    <p class="text-muted mb-0">Conversation Ratio</p>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body p-0 pb-2">
                        <div class="w-100">
                            <div id="customer_impression_charts"
                                data-colors="[&quot;--vz-primary&quot;, &quot;--vz-success&quot;, &quot;--vz-danger&quot;]"
                                class="apex-charts" dir="ltr" style="min-height: 385px;">
                                <div id="apexchartsi906lnv9"
                                    class="apexcharts-canvas apexchartsi906lnv9 apexcharts-theme-light"
                                    style="width: 600px; height: 370px;"><svg id="SvgjsSvg1451" width="600"
                                        height="370" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev"
                                        class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS"
                                        transform="translate(0, 0)" style="background: transparent;">
                                        <foreignObject x="0" y="0" width="600" height="370">
                                            <div class="apexcharts-legend apexcharts-align-center apx-legend-position-bottom"
                                                xmlns="http://www.w3.org/1999/xhtml"
                                                style="inset: auto 0px 10px 20px; position: absolute; max-height: 185px;">
                                                <div class="apexcharts-legend-series" rel="1" seriesname="Orders"
                                                    data:collapsed="false" style="margin: 0px 10px;"><span
                                                        class="apexcharts-legend-marker" rel="1"
                                                        data:collapsed="false"
                                                        style="background: rgb(64, 81, 137) !important; color: rgb(64, 81, 137); height: 9px; width: 9px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;"></span><span
                                                        class="apexcharts-legend-text" rel="1" i="0"
                                                        data:default-text="Orders" data:collapsed="false"
                                                        style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Orders</span>
                                                </div>
                                                <div class="apexcharts-legend-series" rel="2"
                                                    seriesname="Earnings" data:collapsed="false"
                                                    style="margin: 0px 10px;"><span class="apexcharts-legend-marker"
                                                        rel="2" data:collapsed="false"
                                                        style="background: rgb(10, 179, 156) !important; color: rgb(10, 179, 156); height: 9px; width: 9px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;"></span><span
                                                        class="apexcharts-legend-text" rel="2" i="1"
                                                        data:default-text="Earnings" data:collapsed="false"
                                                        style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Earnings</span>
                                                </div>
                                                <div class="apexcharts-legend-series" rel="3" seriesname="Refunds"
                                                    data:collapsed="false" style="margin: 0px 10px;"><span
                                                        class="apexcharts-legend-marker" rel="3"
                                                        data:collapsed="false"
                                                        style="background: rgb(240, 101, 72) !important; color: rgb(240, 101, 72); height: 9px; width: 9px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 6px;"></span><span
                                                        class="apexcharts-legend-text" rel="3" i="2"
                                                        data:default-text="Refunds" data:collapsed="false"
                                                        style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">Refunds</span>
                                                </div>
                                            </div>
                                            <style type="text/css">
                                                .apexcharts-legend {
                                                    display: flex;
                                                    overflow: auto;
                                                    padding: 0 10px;
                                                }

                                                .apexcharts-legend.apx-legend-position-bottom,
                                                .apexcharts-legend.apx-legend-position-top {
                                                    flex-wrap: wrap
                                                }

                                                .apexcharts-legend.apx-legend-position-right,
                                                .apexcharts-legend.apx-legend-position-left {
                                                    flex-direction: column;
                                                    bottom: 0;
                                                }

                                                .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-left,
                                                .apexcharts-legend.apx-legend-position-top.apexcharts-align-left,
                                                .apexcharts-legend.apx-legend-position-right,
                                                .apexcharts-legend.apx-legend-position-left {
                                                    justify-content: flex-start;
                                                }

                                                .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-center,
                                                .apexcharts-legend.apx-legend-position-top.apexcharts-align-center {
                                                    justify-content: center;
                                                }

                                                .apexcharts-legend.apx-legend-position-bottom.apexcharts-align-right,
                                                .apexcharts-legend.apx-legend-position-top.apexcharts-align-right {
                                                    justify-content: flex-end;
                                                }

                                                .apexcharts-legend-series {
                                                    cursor: pointer;
                                                    line-height: normal;
                                                }

                                                .apexcharts-legend.apx-legend-position-bottom .apexcharts-legend-series,
                                                .apexcharts-legend.apx-legend-position-top .apexcharts-legend-series {
                                                    display: flex;
                                                    align-items: center;
                                                }

                                                .apexcharts-legend-text {
                                                    position: relative;
                                                    font-size: 14px;
                                                }

                                                .apexcharts-legend-text *,
                                                .apexcharts-legend-marker * {
                                                    pointer-events: none;
                                                }

                                                .apexcharts-legend-marker {
                                                    position: relative;
                                                    display: inline-block;
                                                    cursor: pointer;
                                                    margin-right: 3px;
                                                    border-style: solid;
                                                }

                                                .apexcharts-legend.apexcharts-align-right .apexcharts-legend-series,
                                                .apexcharts-legend.apexcharts-align-left .apexcharts-legend-series {
                                                    display: inline-block;
                                                }

                                                .apexcharts-legend-series.apexcharts-no-click {
                                                    cursor: auto;
                                                }

                                                .apexcharts-legend .apexcharts-hidden-zero-series,
                                                .apexcharts-legend .apexcharts-hidden-null-series {
                                                    display: none !important;
                                                }

                                                .apexcharts-inactive-legend {
                                                    opacity: 0.45;
                                                }
                                            </style>
                                        </foreignObject>
                                        <g id="SvgjsG1453" class="apexcharts-inner apexcharts-graphical"
                                            transform="translate(78.42152557373046, 30)">
                                            <defs id="SvgjsDefs1452">
                                                <clipPath id="gridRectMaski906lnv9">
                                                    <rect id="SvgjsRect1459" width="640.6859199523926"
                                                        height="266.2333312759399" x="-19.63610763549805" y="-1.1"
                                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                                <clipPath id="forecastMaski906lnv9"></clipPath>
                                                <clipPath id="nonForecastMaski906lnv9"></clipPath>
                                                <clipPath id="gridRectMarkerMaski906lnv9">
                                                    <rect id="SvgjsRect1460" width="605.4137046813964"
                                                        height="268.03333127593993" x="-2" y="-2"
                                                        rx="0" ry="0" opacity="1" stroke-width="0"
                                                        stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                </clipPath>
                                            </defs>
                                            <line id="SvgjsLine1458" x1="0" y1="0" x2="0"
                                                y2="264.03333127593993" stroke="#b6b6b6" stroke-dasharray="3"
                                                stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0"
                                                y="0" width="1" height="264.03333127593993" fill="#b1b9c4"
                                                filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                            <g id="SvgjsG1500" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                <g id="SvgjsG1501" class="apexcharts-xaxis-texts-g"
                                                    transform="translate(0, -4)"><text id="SvgjsText1503"
                                                        font-family="Helvetica, Arial, sans-serif" x="0"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1504">Jan</tspan>
                                                        <title>Jan</title>
                                                    </text><text id="SvgjsText1506"
                                                        font-family="Helvetica, Arial, sans-serif" x="54.67397315285423"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1507">Feb</tspan>
                                                        <title>Feb</title>
                                                    </text><text id="SvgjsText1509"
                                                        font-family="Helvetica, Arial, sans-serif" x="109.34794630570846"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1510">Mar</tspan>
                                                        <title>Mar</title>
                                                    </text><text id="SvgjsText1512"
                                                        font-family="Helvetica, Arial, sans-serif" x="164.02191945856268"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1513">Apr</tspan>
                                                        <title>Apr</title>
                                                    </text><text id="SvgjsText1515"
                                                        font-family="Helvetica, Arial, sans-serif" x="218.6958926114169"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1516">May</tspan>
                                                        <title>May</title>
                                                    </text><text id="SvgjsText1518"
                                                        font-family="Helvetica, Arial, sans-serif" x="273.3698657642711"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1519">Jun</tspan>
                                                        <title>Jun</title>
                                                    </text><text id="SvgjsText1521"
                                                        font-family="Helvetica, Arial, sans-serif" x="328.0438389171253"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1522">Jul</tspan>
                                                        <title>Jul</title>
                                                    </text><text id="SvgjsText1524"
                                                        font-family="Helvetica, Arial, sans-serif" x="382.7178120699795"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1525">Aug</tspan>
                                                        <title>Aug</title>
                                                    </text><text id="SvgjsText1527"
                                                        font-family="Helvetica, Arial, sans-serif" x="437.39178522283373"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1528">Sep</tspan>
                                                        <title>Sep</title>
                                                    </text><text id="SvgjsText1530"
                                                        font-family="Helvetica, Arial, sans-serif" x="492.06575837568795"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1531">Oct</tspan>
                                                        <title>Oct</title>
                                                    </text><text id="SvgjsText1533"
                                                        font-family="Helvetica, Arial, sans-serif" x="546.7397315285423"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1534">Nov</tspan>
                                                        <title>Nov</title>
                                                    </text><text id="SvgjsText1536"
                                                        font-family="Helvetica, Arial, sans-serif" x="601.4137046813966"
                                                        y="293.03333127593993" text-anchor="middle"
                                                        dominant-baseline="auto" font-size="12px" font-weight="400"
                                                        fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label "
                                                        style="font-family: Helvetica, Arial, sans-serif;">
                                                        <tspan id="SvgjsTspan1537">Dec</tspan>
                                                        <title>Dec</title>
                                                    </text></g>
                                            </g>
                                            <g id="SvgjsG1550" class="apexcharts-grid">
                                                <g id="SvgjsG1551" class="apexcharts-gridlines-horizontal"></g>
                                                <g id="SvgjsG1552" class="apexcharts-gridlines-vertical">
                                                    <line id="SvgjsLine1553" x1="0" y1="0"
                                                        x2="0" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1554" x1="54.673973152854224" y1="0"
                                                        x2="54.673973152854224" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1555" x1="109.34794630570845" y1="0"
                                                        x2="109.34794630570845" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1556" x1="164.02191945856268" y1="0"
                                                        x2="164.02191945856268" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1557" x1="218.6958926114169" y1="0"
                                                        x2="218.6958926114169" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1558" x1="273.36986576427114" y1="0"
                                                        x2="273.36986576427114" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1559" x1="328.04383891712536" y1="0"
                                                        x2="328.04383891712536" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1560" x1="382.7178120699796" y1="0"
                                                        x2="382.7178120699796" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1561" x1="437.3917852228338" y1="0"
                                                        x2="437.3917852228338" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1562" x1="492.065758375688" y1="0"
                                                        x2="492.065758375688" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1563" x1="546.7397315285423" y1="0"
                                                        x2="546.7397315285423" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                    <line id="SvgjsLine1564" x1="601.4137046813966" y1="0"
                                                        x2="601.4137046813966" y2="264.03333127593993" stroke="#e0e0e0"
                                                        stroke-dasharray="0" stroke-linecap="butt"
                                                        class="apexcharts-gridline"></line>
                                                </g>
                                                <line id="SvgjsLine1566" x1="0" y1="264.03333127593993"
                                                    x2="601.4137046813964" y2="264.03333127593993" stroke="transparent"
                                                    stroke-dasharray="0" stroke-linecap="butt"></line>
                                                <line id="SvgjsLine1565" x1="0" y1="1" x2="0"
                                                    y2="264.03333127593993" stroke="transparent" stroke-dasharray="0"
                                                    stroke-linecap="butt"></line>
                                            </g>
                                            <g id="SvgjsG1461" class="apexcharts-area-series apexcharts-plot-series">
                                                <g id="SvgjsG1462" class="apexcharts-series" seriesName="Orders"
                                                    data:longestSeries="true" rel="1" data:realIndex="0">
                                                    <path id="SvgjsPath1465"
                                                        d="M 0 264.03333127593993L 0 189.22388741442361L 54.67397315285422 121.0152768348058L 109.34794630570843 162.82055428682963L 164.02191945856265 114.4144435529073L 218.69589261141687 156.21972100493113L 273.3698657642711 129.81638787733712L 328.0438389171253 171.62166532936095L 382.7178120699795 167.2211098080953L 437.39178522283373 92.41166594657898L 492.06575837568795 149.61888772303263L 546.7397315285422 125.41583235607146L 601.4137046813964 116.61472131354014L 601.4137046813964 264.03333127593993M 601.4137046813964 116.61472131354014z"
                                                        fill="rgba(64,81,137,0.1)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-area" index="0"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 0 264.03333127593993L 0 189.22388741442361L 54.67397315285422 121.0152768348058L 109.34794630570843 162.82055428682963L 164.02191945856265 114.4144435529073L 218.69589261141687 156.21972100493113L 273.3698657642711 129.81638787733712L 328.0438389171253 171.62166532936095L 382.7178120699795 167.2211098080953L 437.39178522283373 92.41166594657898L 492.06575837568795 149.61888772303263L 546.7397315285422 125.41583235607146L 601.4137046813964 116.61472131354014L 601.4137046813964 264.03333127593993M 601.4137046813964 116.61472131354014z"
                                                        pathFrom="M -1 264.03333127593993L -1 264.03333127593993L 54.67397315285422 264.03333127593993L 109.34794630570843 264.03333127593993L 164.02191945856265 264.03333127593993L 218.69589261141687 264.03333127593993L 273.3698657642711 264.03333127593993L 328.0438389171253 264.03333127593993L 382.7178120699795 264.03333127593993L 437.39178522283373 264.03333127593993L 492.06575837568795 264.03333127593993L 546.7397315285422 264.03333127593993L 601.4137046813964 264.03333127593993">
                                                    </path>
                                                    <path id="SvgjsPath1466"
                                                        d="M 0 189.22388741442361L 54.67397315285422 121.0152768348058L 109.34794630570843 162.82055428682963L 164.02191945856265 114.4144435529073L 218.69589261141687 156.21972100493113L 273.3698657642711 129.81638787733712L 328.0438389171253 171.62166532936095L 382.7178120699795 167.2211098080953L 437.39178522283373 92.41166594657898L 492.06575837568795 149.61888772303263L 546.7397315285422 125.41583235607146L 601.4137046813964 116.61472131354014"
                                                        fill="none" fill-opacity="1" stroke="#405189"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="2"
                                                        stroke-dasharray="0" class="apexcharts-area" index="0"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 0 189.22388741442361L 54.67397315285422 121.0152768348058L 109.34794630570843 162.82055428682963L 164.02191945856265 114.4144435529073L 218.69589261141687 156.21972100493113L 273.3698657642711 129.81638787733712L 328.0438389171253 171.62166532936095L 382.7178120699795 167.2211098080953L 437.39178522283373 92.41166594657898L 492.06575837568795 149.61888772303263L 546.7397315285422 125.41583235607146L 601.4137046813964 116.61472131354014"
                                                        pathFrom="M -1 264.03333127593993L -1 264.03333127593993L 54.67397315285422 264.03333127593993L 109.34794630570843 264.03333127593993L 164.02191945856265 264.03333127593993L 218.69589261141687 264.03333127593993L 273.3698657642711 264.03333127593993L 328.0438389171253 264.03333127593993L 382.7178120699795 264.03333127593993L 437.39178522283373 264.03333127593993L 492.06575837568795 264.03333127593993L 546.7397315285422 264.03333127593993L 601.4137046813964 264.03333127593993">
                                                    </path>
                                                    <g id="SvgjsG1463" class="apexcharts-series-markers-wrap"
                                                        data:realIndex="0">
                                                        <g class="apexcharts-series-markers">
                                                            <circle id="SvgjsCircle1572" r="0" cx="0"
                                                                cy="0" class="apexcharts-marker w4u1n68xl"
                                                                stroke="#ffffff" fill="#405189" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="0.9"
                                                                default-marker-size="0"></circle>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1467" class="apexcharts-bar-series apexcharts-plot-series">
                                                <g id="SvgjsG1468" class="apexcharts-series" rel="1"
                                                    seriesName="Earnings" data:realIndex="1">
                                                    <path id="SvgjsPath1472"
                                                        d="M -8.201095972928133 264.03333127593993L -8.201095972928133 67.6585411394596Q -8.201095972928133 67.6585411394596 -8.201095972928133 67.6585411394596L 8.201095972928133 67.6585411394596Q 8.201095972928133 67.6585411394596 8.201095972928133 67.6585411394596L 8.201095972928133 67.6585411394596L 8.201095972928133 264.03333127593993L 8.201095972928133 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M -8.201095972928133 264.03333127593993L -8.201095972928133 67.6585411394596Q -8.201095972928133 67.6585411394596 -8.201095972928133 67.6585411394596L 8.201095972928133 67.6585411394596Q 8.201095972928133 67.6585411394596 8.201095972928133 67.6585411394596L 8.201095972928133 67.6585411394596L 8.201095972928133 264.03333127593993L 8.201095972928133 264.03333127593993z"
                                                        pathFrom="M -8.201095972928133 264.03333127593993L -8.201095972928133 264.03333127593993L 8.201095972928133 264.03333127593993L 8.201095972928133 264.03333127593993L 8.201095972928133 264.03333127593993L 8.201095972928133 264.03333127593993L 8.201095972928133 264.03333127593993L -8.201095972928133 264.03333127593993"
                                                        cy="67.6585411394596" cx="8.201095972928133" j="0"
                                                        val="89.25" barHeight="196.37479013648033"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1474"
                                                        d="M 46.47287717992609 264.03333127593993L 46.47287717992609 47.129949632755284Q 46.47287717992609 47.129949632755284 46.47287717992609 47.129949632755284L 62.87506912578235 47.129949632755284Q 62.87506912578235 47.129949632755284 62.87506912578235 47.129949632755284L 62.87506912578235 47.129949632755284L 62.87506912578235 264.03333127593993L 62.87506912578235 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 46.47287717992609 264.03333127593993L 46.47287717992609 47.129949632755284Q 46.47287717992609 47.129949632755284 46.47287717992609 47.129949632755284L 62.87506912578235 47.129949632755284Q 62.87506912578235 47.129949632755284 62.87506912578235 47.129949632755284L 62.87506912578235 47.129949632755284L 62.87506912578235 264.03333127593993L 62.87506912578235 264.03333127593993z"
                                                        pathFrom="M 46.47287717992609 264.03333127593993L 46.47287717992609 264.03333127593993L 62.87506912578235 264.03333127593993L 62.87506912578235 264.03333127593993L 62.87506912578235 264.03333127593993L 62.87506912578235 264.03333127593993L 62.87506912578235 264.03333127593993L 46.47287717992609 264.03333127593993"
                                                        cy="47.129949632755284" cx="62.87506912578235" j="1"
                                                        val="98.58" barHeight="216.90338164318464"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1476"
                                                        d="M 101.1468503327803 264.03333127593993L 101.1468503327803 112.78623801003903Q 101.1468503327803 112.78623801003903 101.1468503327803 112.78623801003903L 117.54904227863656 112.78623801003903Q 117.54904227863656 112.78623801003903 117.54904227863656 112.78623801003903L 117.54904227863656 112.78623801003903L 117.54904227863656 264.03333127593993L 117.54904227863656 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 101.1468503327803 264.03333127593993L 101.1468503327803 112.78623801003903Q 101.1468503327803 112.78623801003903 101.1468503327803 112.78623801003903L 117.54904227863656 112.78623801003903Q 117.54904227863656 112.78623801003903 117.54904227863656 112.78623801003903L 117.54904227863656 112.78623801003903L 117.54904227863656 264.03333127593993L 117.54904227863656 264.03333127593993z"
                                                        pathFrom="M 101.1468503327803 264.03333127593993L 101.1468503327803 264.03333127593993L 117.54904227863656 264.03333127593993L 117.54904227863656 264.03333127593993L 117.54904227863656 264.03333127593993L 117.54904227863656 264.03333127593993L 117.54904227863656 264.03333127593993L 101.1468503327803 264.03333127593993"
                                                        cy="112.78623801003903" cx="117.54904227863656" j="2"
                                                        val="68.74" barHeight="151.2470932659009"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1478"
                                                        d="M 155.82082348563452 264.03333127593993L 155.82082348563452 24.489091475843423Q 155.82082348563452 24.489091475843423 155.82082348563452 24.489091475843423L 172.22301543149078 24.489091475843423Q 172.22301543149078 24.489091475843423 172.22301543149078 24.489091475843423L 172.22301543149078 24.489091475843423L 172.22301543149078 264.03333127593993L 172.22301543149078 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 155.82082348563452 264.03333127593993L 155.82082348563452 24.489091475843423Q 155.82082348563452 24.489091475843423 155.82082348563452 24.489091475843423L 172.22301543149078 24.489091475843423Q 172.22301543149078 24.489091475843423 172.22301543149078 24.489091475843423L 172.22301543149078 24.489091475843423L 172.22301543149078 264.03333127593993L 172.22301543149078 264.03333127593993z"
                                                        pathFrom="M 155.82082348563452 264.03333127593993L 155.82082348563452 264.03333127593993L 172.22301543149078 264.03333127593993L 172.22301543149078 264.03333127593993L 172.22301543149078 264.03333127593993L 172.22301543149078 264.03333127593993L 172.22301543149078 264.03333127593993L 155.82082348563452 264.03333127593993"
                                                        cy="24.489091475843423" cx="172.22301543149078" j="3"
                                                        val="108.87" barHeight="239.5442398000965"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1480"
                                                        d="M 210.49479663848874 264.03333127593993L 210.49479663848874 93.42379371647007Q 210.49479663848874 93.42379371647007 210.49479663848874 93.42379371647007L 226.896988584345 93.42379371647007Q 226.896988584345 93.42379371647007 226.896988584345 93.42379371647007L 226.896988584345 93.42379371647007L 226.896988584345 264.03333127593993L 226.896988584345 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 210.49479663848874 264.03333127593993L 210.49479663848874 93.42379371647007Q 210.49479663848874 93.42379371647007 210.49479663848874 93.42379371647007L 226.896988584345 93.42379371647007Q 226.896988584345 93.42379371647007 226.896988584345 93.42379371647007L 226.896988584345 93.42379371647007L 226.896988584345 264.03333127593993L 226.896988584345 264.03333127593993z"
                                                        pathFrom="M 210.49479663848874 264.03333127593993L 210.49479663848874 264.03333127593993L 226.896988584345 264.03333127593993L 226.896988584345 264.03333127593993L 226.896988584345 264.03333127593993L 226.896988584345 264.03333127593993L 226.896988584345 264.03333127593993L 210.49479663848874 264.03333127593993"
                                                        cy="93.42379371647007" cx="226.896988584345" j="4"
                                                        val="77.54" barHeight="170.60953755946986"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1482"
                                                        d="M 265.1687697913429 264.03333127593993L 265.1687697913429 79.143991049963Q 265.1687697913429 79.143991049963 265.1687697913429 79.143991049963L 281.5709617371992 79.143991049963Q 281.5709617371992 79.143991049963 281.5709617371992 79.143991049963L 281.5709617371992 79.143991049963L 281.5709617371992 264.03333127593993L 281.5709617371992 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 265.1687697913429 264.03333127593993L 265.1687697913429 79.143991049963Q 265.1687697913429 79.143991049963 265.1687697913429 79.143991049963L 281.5709617371992 79.143991049963Q 281.5709617371992 79.143991049963 281.5709617371992 79.143991049963L 281.5709617371992 79.143991049963L 281.5709617371992 264.03333127593993L 281.5709617371992 264.03333127593993z"
                                                        pathFrom="M 265.1687697913429 264.03333127593993L 265.1687697913429 264.03333127593993L 281.5709617371992 264.03333127593993L 281.5709617371992 264.03333127593993L 281.5709617371992 264.03333127593993L 281.5709617371992 264.03333127593993L 281.5709617371992 264.03333127593993L 265.1687697913429 264.03333127593993"
                                                        cy="79.143991049963" cx="281.5709617371992" j="5"
                                                        val="84.03" barHeight="184.88934022597692"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1484"
                                                        d="M 319.84274294419714 264.03333127593993L 319.84274294419714 151.29109882111356Q 319.84274294419714 151.29109882111356 319.84274294419714 151.29109882111356L 336.2449348900534 151.29109882111356Q 336.2449348900534 151.29109882111356 336.2449348900534 151.29109882111356L 336.2449348900534 151.29109882111356L 336.2449348900534 264.03333127593993L 336.2449348900534 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 319.84274294419714 264.03333127593993L 319.84274294419714 151.29109882111356Q 319.84274294419714 151.29109882111356 319.84274294419714 151.29109882111356L 336.2449348900534 151.29109882111356Q 336.2449348900534 151.29109882111356 336.2449348900534 151.29109882111356L 336.2449348900534 151.29109882111356L 336.2449348900534 264.03333127593993L 336.2449348900534 264.03333127593993z"
                                                        pathFrom="M 319.84274294419714 264.03333127593993L 319.84274294419714 264.03333127593993L 336.2449348900534 264.03333127593993L 336.2449348900534 264.03333127593993L 336.2449348900534 264.03333127593993L 336.2449348900534 264.03333127593993L 336.2449348900534 264.03333127593993L 319.84274294419714 264.03333127593993"
                                                        cy="151.29109882111356" cx="336.2449348900534" j="6"
                                                        val="51.24" barHeight="112.74223245482635"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1486"
                                                        d="M 374.51671609705136 264.03333127593993L 374.51671609705136 201.1713956546599Q 374.51671609705136 201.1713956546599 374.51671609705136 201.1713956546599L 390.9189080429076 201.1713956546599Q 390.9189080429076 201.1713956546599 390.9189080429076 201.1713956546599L 390.9189080429076 201.1713956546599L 390.9189080429076 264.03333127593993L 390.9189080429076 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 374.51671609705136 264.03333127593993L 374.51671609705136 201.1713956546599Q 374.51671609705136 201.1713956546599 374.51671609705136 201.1713956546599L 390.9189080429076 201.1713956546599Q 390.9189080429076 201.1713956546599 390.9189080429076 201.1713956546599L 390.9189080429076 201.1713956546599L 390.9189080429076 264.03333127593993L 390.9189080429076 264.03333127593993z"
                                                        pathFrom="M 374.51671609705136 264.03333127593993L 374.51671609705136 264.03333127593993L 390.9189080429076 264.03333127593993L 390.9189080429076 264.03333127593993L 390.9189080429076 264.03333127593993L 390.9189080429076 264.03333127593993L 390.9189080429076 264.03333127593993L 374.51671609705136 264.03333127593993"
                                                        cy="201.1713956546599" cx="390.9189080429076" j="7"
                                                        val="28.57" barHeight="62.86193562128003"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1488"
                                                        d="M 429.1906892499056 264.03333127593993L 429.1906892499056 60.35361897415862Q 429.1906892499056 60.35361897415862 429.1906892499056 60.35361897415862L 445.59288119576183 60.35361897415862Q 445.59288119576183 60.35361897415862 445.59288119576183 60.35361897415862L 445.59288119576183 60.35361897415862L 445.59288119576183 264.03333127593993L 445.59288119576183 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 429.1906892499056 264.03333127593993L 429.1906892499056 60.35361897415862Q 429.1906892499056 60.35361897415862 429.1906892499056 60.35361897415862L 445.59288119576183 60.35361897415862Q 445.59288119576183 60.35361897415862 445.59288119576183 60.35361897415862L 445.59288119576183 60.35361897415862L 445.59288119576183 264.03333127593993L 445.59288119576183 264.03333127593993z"
                                                        pathFrom="M 429.1906892499056 264.03333127593993L 429.1906892499056 264.03333127593993L 445.59288119576183 264.03333127593993L 445.59288119576183 264.03333127593993L 445.59288119576183 264.03333127593993L 445.59288119576183 264.03333127593993L 445.59288119576183 264.03333127593993L 429.1906892499056 264.03333127593993"
                                                        cy="60.35361897415862" cx="445.59288119576183" j="8"
                                                        val="92.57" barHeight="203.6797123017813"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1490"
                                                        d="M 483.8646624027598 264.03333127593993L 483.8646624027598 170.82956533553312Q 483.8646624027598 170.82956533553312 483.8646624027598 170.82956533553312L 500.26685434861605 170.82956533553312Q 500.26685434861605 170.82956533553312 500.26685434861605 170.82956533553312L 500.26685434861605 170.82956533553312L 500.26685434861605 264.03333127593993L 500.26685434861605 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 483.8646624027598 264.03333127593993L 483.8646624027598 170.82956533553312Q 483.8646624027598 170.82956533553312 483.8646624027598 170.82956533553312L 500.26685434861605 170.82956533553312Q 500.26685434861605 170.82956533553312 500.26685434861605 170.82956533553312L 500.26685434861605 170.82956533553312L 500.26685434861605 264.03333127593993L 500.26685434861605 264.03333127593993z"
                                                        pathFrom="M 483.8646624027598 264.03333127593993L 483.8646624027598 264.03333127593993L 500.26685434861605 264.03333127593993L 500.26685434861605 264.03333127593993L 500.26685434861605 264.03333127593993L 500.26685434861605 264.03333127593993L 500.26685434861605 264.03333127593993L 483.8646624027598 264.03333127593993"
                                                        cy="170.82956533553312" cx="500.26685434861605" j="9"
                                                        val="42.36" barHeight="93.2037659404068"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1492"
                                                        d="M 538.5386355556141 264.03333127593993L 538.5386355556141 69.2867466823279Q 538.5386355556141 69.2867466823279 538.5386355556141 69.2867466823279L 554.9408275014704 69.2867466823279Q 554.9408275014704 69.2867466823279 554.9408275014704 69.2867466823279L 554.9408275014704 69.2867466823279L 554.9408275014704 264.03333127593993L 554.9408275014704 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 538.5386355556141 264.03333127593993L 538.5386355556141 69.2867466823279Q 538.5386355556141 69.2867466823279 538.5386355556141 69.2867466823279L 554.9408275014704 69.2867466823279Q 554.9408275014704 69.2867466823279 554.9408275014704 69.2867466823279L 554.9408275014704 69.2867466823279L 554.9408275014704 264.03333127593993L 554.9408275014704 264.03333127593993z"
                                                        pathFrom="M 538.5386355556141 264.03333127593993L 538.5386355556141 264.03333127593993L 554.9408275014704 264.03333127593993L 554.9408275014704 264.03333127593993L 554.9408275014704 264.03333127593993L 554.9408275014704 264.03333127593993L 554.9408275014704 264.03333127593993L 538.5386355556141 264.03333127593993"
                                                        cy="69.2867466823279" cx="554.9408275014704" j="10"
                                                        val="88.51" barHeight="194.74658459361203"
                                                        barWidth="16.402191945856266"></path>
                                                    <path id="SvgjsPath1494"
                                                        d="M 593.2126087084683 264.03333127593993L 593.2126087084683 183.56917356959724Q 593.2126087084683 183.56917356959724 593.2126087084683 183.56917356959724L 609.6148006543247 183.56917356959724Q 609.6148006543247 183.56917356959724 609.6148006543247 183.56917356959724L 609.6148006543247 183.56917356959724L 609.6148006543247 264.03333127593993L 609.6148006543247 264.03333127593993z"
                                                        fill="rgba(10,179,156,0.9)" fill-opacity="1" stroke-opacity="1"
                                                        stroke-linecap="butt" stroke-width="0" stroke-dasharray="0"
                                                        class="apexcharts-bar-area" index="1"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 593.2126087084683 264.03333127593993L 593.2126087084683 183.56917356959724Q 593.2126087084683 183.56917356959724 593.2126087084683 183.56917356959724L 609.6148006543247 183.56917356959724Q 609.6148006543247 183.56917356959724 609.6148006543247 183.56917356959724L 609.6148006543247 183.56917356959724L 609.6148006543247 264.03333127593993L 609.6148006543247 264.03333127593993z"
                                                        pathFrom="M 593.2126087084683 264.03333127593993L 593.2126087084683 264.03333127593993L 609.6148006543247 264.03333127593993L 609.6148006543247 264.03333127593993L 609.6148006543247 264.03333127593993L 609.6148006543247 264.03333127593993L 609.6148006543247 264.03333127593993L 593.2126087084683 264.03333127593993"
                                                        cy="183.56917356959724" cx="609.6148006543247" j="11"
                                                        val="36.57" barHeight="80.46415770634269"
                                                        barWidth="16.402191945856266"></path>
                                                    <g id="SvgjsG1470" class="apexcharts-bar-goals-markers"
                                                        style="pointer-events: none">
                                                        <g id="SvgjsG1471" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1473" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1475" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1477" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1479" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1481" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1483" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1485" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1487" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1489" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1491" className="apexcharts-bar-goals-groups"></g>
                                                        <g id="SvgjsG1493" className="apexcharts-bar-goals-groups"></g>
                                                    </g>
                                                </g>
                                            </g>
                                            <g id="SvgjsG1495" class="apexcharts-line-series apexcharts-plot-series">
                                                <g id="SvgjsG1496" class="apexcharts-series" seriesName="Refunds"
                                                    data:longestSeries="true" rel="1" data:realIndex="2">
                                                    <path id="SvgjsPath1499"
                                                        d="M 0 246.43110919087727L 54.67397315285422 237.62999814834595L 109.34794630570843 248.6313869515101L 164.02191945856265 226.62860934518176L 218.69589261141687 217.82749830265044L 273.3698657642711 239.83027590897876L 328.0438389171253 253.03194247277577L 382.7178120699795 244.23083143024445L 437.39178522283373 248.6313869515101L 492.06575837568795 200.22527621758778L 546.7397315285422 237.62999814834595L 601.4137046813964 187.0236096537908"
                                                        fill="none" fill-opacity="1" stroke="rgba(240,101,72,1)"
                                                        stroke-opacity="1" stroke-linecap="butt" stroke-width="2.2"
                                                        stroke-dasharray="8" class="apexcharts-line" index="2"
                                                        clip-path="url(#gridRectMaski906lnv9)"
                                                        pathTo="M 0 246.43110919087727L 54.67397315285422 237.62999814834595L 109.34794630570843 248.6313869515101L 164.02191945856265 226.62860934518176L 218.69589261141687 217.82749830265044L 273.3698657642711 239.83027590897876L 328.0438389171253 253.03194247277577L 382.7178120699795 244.23083143024445L 437.39178522283373 248.6313869515101L 492.06575837568795 200.22527621758778L 546.7397315285422 237.62999814834595L 601.4137046813964 187.0236096537908"
                                                        pathFrom="M -1 264.03333127593993L -1 264.03333127593993L 54.67397315285422 264.03333127593993L 109.34794630570843 264.03333127593993L 164.02191945856265 264.03333127593993L 218.69589261141687 264.03333127593993L 273.3698657642711 264.03333127593993L 328.0438389171253 264.03333127593993L 382.7178120699795 264.03333127593993L 437.39178522283373 264.03333127593993L 492.06575837568795 264.03333127593993L 546.7397315285422 264.03333127593993L 601.4137046813964 264.03333127593993">
                                                    </path>
                                                    <g id="SvgjsG1497" class="apexcharts-series-markers-wrap"
                                                        data:realIndex="2">
                                                        <g class="apexcharts-series-markers">
                                                            <circle id="SvgjsCircle1573" r="0" cx="0"
                                                                cy="0" class="apexcharts-marker wepvmhpgz"
                                                                stroke="#ffffff" fill="#f06548" fill-opacity="1"
                                                                stroke-width="2" stroke-opacity="0.9"
                                                                default-marker-size="0"></circle>
                                                        </g>
                                                    </g>
                                                </g>
                                                <g id="SvgjsG1464" class="apexcharts-datalabels" data:realIndex="0"></g>
                                                <g id="SvgjsG1469" class="apexcharts-datalabels" data:realIndex="1"></g>
                                                <g id="SvgjsG1498" class="apexcharts-datalabels" data:realIndex="2"></g>
                                            </g>
                                            <line id="SvgjsLine1567" x1="-16.53610763549805" y1="0"
                                                x2="617.9498123168945" y2="0" stroke="#b6b6b6"
                                                stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"
                                                class="apexcharts-ycrosshairs"></line>
                                            <line id="SvgjsLine1568" x1="-16.53610763549805" y1="0"
                                                x2="617.9498123168945" y2="0" stroke-dasharray="0"
                                                stroke-width="0" stroke-linecap="butt"
                                                class="apexcharts-ycrosshairs-hidden"></line>
                                            <g id="SvgjsG1569" class="apexcharts-yaxis-annotations"></g>
                                            <g id="SvgjsG1570" class="apexcharts-xaxis-annotations"></g>
                                            <g id="SvgjsG1571" class="apexcharts-point-annotations"></g>
                                            <rect id="SvgjsRect1574" width="0" height="0" x="0"
                                                y="0" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"
                                                class="apexcharts-zoom-rect"></rect>
                                            <rect id="SvgjsRect1575" width="0" height="0" x="0"
                                                y="0" rx="0" ry="0" opacity="1"
                                                stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"
                                                class="apexcharts-selection-rect"></rect>
                                        </g>
                                        <rect id="SvgjsRect1457" width="0" height="0" x="0"
                                            y="0" rx="0" ry="0" opacity="1"
                                            stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                        <g id="SvgjsG1538" class="apexcharts-yaxis" rel="0"
                                            transform="translate(29.885417938232422, 0)">
                                            <g id="SvgjsG1539" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1540"
                                                    font-family="Helvetica, Arial, sans-serif" x="20"
                                                    y="31.4" text-anchor="end" dominant-baseline="auto"
                                                    font-size="11px" font-weight="400" fill="#373d3f"
                                                    class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1541">120.00</tspan>
                                                    <title>120.00</title>
                                                </text><text id="SvgjsText1542" font-family="Helvetica, Arial, sans-serif"
                                                    x="20" y="97.40833281898499" text-anchor="end"
                                                    dominant-baseline="auto" font-size="11px" font-weight="400"
                                                    fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1543">90.00</tspan>
                                                    <title>90.00</title>
                                                </text><text id="SvgjsText1544" font-family="Helvetica, Arial, sans-serif"
                                                    x="20" y="163.41666563796997" text-anchor="end"
                                                    dominant-baseline="auto" font-size="11px" font-weight="400"
                                                    fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1545">60.00</tspan>
                                                    <title>60.00</title>
                                                </text><text id="SvgjsText1546" font-family="Helvetica, Arial, sans-serif"
                                                    x="20" y="229.42499845695497" text-anchor="end"
                                                    dominant-baseline="auto" font-size="11px" font-weight="400"
                                                    fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1547">30.00</tspan>
                                                    <title>30.00</title>
                                                </text><text id="SvgjsText1548" font-family="Helvetica, Arial, sans-serif"
                                                    x="20" y="295.4333312759399" text-anchor="end"
                                                    dominant-baseline="auto" font-size="11px" font-weight="400"
                                                    fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label "
                                                    style="font-family: Helvetica, Arial, sans-serif;">
                                                    <tspan id="SvgjsTspan1549">0.00</tspan>
                                                    <title>0.00</title>
                                                </text></g>
                                        </g>
                                        <g id="SvgjsG1454" class="apexcharts-annotations"></g>
                                    </svg>
                                    <div class="apexcharts-tooltip apexcharts-theme-light">
                                        <div class="apexcharts-tooltip-title"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(64, 81, 137);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label"></span><span
                                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 2;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(10, 179, 156);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label"></span><span
                                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                        <div class="apexcharts-tooltip-series-group" style="order: 3;"><span
                                                class="apexcharts-tooltip-marker"
                                                style="background-color: rgb(240, 101, 72);"></span>
                                            <div class="apexcharts-tooltip-text"
                                                style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                <div class="apexcharts-tooltip-y-group"><span
                                                        class="apexcharts-tooltip-text-y-label"></span><span
                                                        class="apexcharts-tooltip-text-y-value"></span></div>
                                                <div class="apexcharts-tooltip-goals-group"><span
                                                        class="apexcharts-tooltip-text-goals-label"></span><span
                                                        class="apexcharts-tooltip-text-goals-value"></span></div>
                                                <div class="apexcharts-tooltip-z-group"><span
                                                        class="apexcharts-tooltip-text-z-label"></span><span
                                                        class="apexcharts-tooltip-text-z-value"></span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light">
                                        <div class="apexcharts-xaxistooltip-text"
                                            style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                    </div>
                                    <div
                                        class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                        <div class="apexcharts-yaxistooltip-text"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
