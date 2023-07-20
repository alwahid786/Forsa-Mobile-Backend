@extends('layouts.admin.admin-default')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="{{ asset('public/assets/dist/apexcharts.css') }}">
@section('content')
@include('includes.admin.navbar')
<main class="content-wrapper">
    <div class="container-fluid py-3">
        <div class="col-12 pl-0 d-flex justify-content-between">
            <div class="heading-top">
                <h1 class="mb-0 pl-0">Dashboard</h1>
                <p class="pl-0">Welcome to Property Management Platform</p>
            </div>
            <div>
                <div class="calendar-range-picker">
                    {{-- <img src="{{asset('public/assets/images/calendar-icon.svg')}}" alt="icon">
                    <input type="text" name="daterange" value="" />
                    <img src="{{asset('public/assets/images/calendar-arrow.svg')}}" alt="icon"> --}}
                    <div id="reportrange">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span></span> <i class="fa fa-caret-down"></i>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-xl-9">
                <div class="tabs">
                    <div class="tabs-header">
                        <div class="tabs-header-left d-flex justify-content-between">

                            <div class="tabs-header-left-content">
                                <h1>Property Revenue Overview</h1>
                                <img src="{{ asset('public/assets/images/revenue-icon.svg') }}" alt="icon">
                                <p>Show overview Jan 2022 - Dec 2022</p>
                            </div>
                            <div class="tabs-header-right-content">
                                <button> <img class="pr-2" src="{{ asset('public/assets/images/report-icon.svg') }}" alt="icon">Download Report</button>
                            </div>

                        </div>

                    </div>
                    <h1 class="overview">Overview</h1>
                    <ul class="nav nav-tabs ml-auto" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Week</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Month</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Year</a>
                        </li>
                    </ul><!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active " id="tabs-1" role="tabpanel">
                            <div class="bar-graph">
                                <div id="chart"></div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <p>Second Panel</p>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <p>Third Panel</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3">

            </div>
        </div>


    </div>
</main>
@endsection
@section('admininsertjavascript')
<script src="{{ asset('public/assets/dist/apexcharts.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    var options = {
        legend: {
            horizontalAlign: 'left',
            markers: {

                fillColors: ['#FF7A21', '#6cc2b6']

            },
        },
        series: [{
            name: 'Expense',
            data: [44, 55, 57, 56, 61, 58, 63, 60, 66]

        }, {
            name: 'Income',
            data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }],
        chart: {
            type: 'bar',
            height: 350,
            toolbar: {
                show: true,
                tools: {
                    download: false
                }
            }
        },

        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
            title: {
                text: '$ (thousands)'
            }
        },
        fill: {
            opacity: 1,
            colors: ['#FF7A21', '#6cc2b6']
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return "$ " + val + " thousands"
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
<script type="text/javascript">
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMM D YY') + ' - ' + end.format('MMM D YY'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            // ranges: {
            //    'Today': [moment(), moment()],
            //    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            //    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            //    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            //    'This Month': [moment().startOf('month'), moment().endOf('month')],
            //    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            // }
        }, cb);

        cb(start, end);

    });
</script>
<script>
    // $(function() {
    //   $('input[name="daterange"]').daterangepicker({
    //     opens: 'left'
    //   }, function(start, end, label) {
    //     console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    //   });
    // });
</script>
<script>
    $('body').addClass('bg-clr')
</script>
<script>
    $('.sidenav  li:nth-of-type(1)').addClass('active');
</script>
@endsection