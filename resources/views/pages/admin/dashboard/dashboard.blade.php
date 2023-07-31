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
                <p class="pl-0">Welcome to Forsa Platform</p>
            </div>
            <div>

            </div>
        </div>
        {{-- cards-section --}}
        <div class="dashbord-card-main row">
            <div class="dashbord-cards col-md-4">
              <div class="card-counter primary">
                <i class="fa fa-code-fork"></i>
                <span class="count-name">Vendors</span>
                <span class="count-numbers">{{$total_vendors ?? '-'}}</span>
              </div>
            </div>
            <div class="col-md-4">
                <div class="card-counter info">
                  <i class="fa fa-users"></i>
                  <span class="count-name">Users</span>
                  <span class="count-numbers">{{$total_users ?? '-'}}</span>
                </div>
              </div>
        
            <div class="col-md-4">
              <div class="card-counter danger">
                <i class="fa fa-ticket"></i>
                <span class="count-name">Products</span>
                <span class="count-numbers">{{$total_products ?? '-'}}</span>
              </div>
            </div>
        
            
          </div>
        {{-- cards-section-ends --}}



        {{-- chart --}}
        <div class="row mt-3">
            <div class="col-xl-12">
                <div class="tabs">
                    <div class="tabs-header">
                        <div class="tabs-header-left d-flex justify-content-between">

                            <div class="tabs-header-left-content">
                                <h1>Revenue</h1>
                                <img src="{{ asset('public/assets/images/revenue-icon.svg') }}" alt="icon">
                                {{-- <p>Show overview Jan 2022 - Dec 2022</p> --}}
                            </div>
                           

                        </div>

                    </div>
                    <h1 class="overview">Overview</h1>
                    
                    <div class="tab-content">
                        <div class="tab-pane active " id="tabs-1" role="tabpanel">
                            <div class="bar-graph">
                                <div id="chart"></div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
           
        </div>
        {{-- chart-ends --}}

        {{-- top products --}}
       
            <div class="top-product container-fluid  pt-3" >
               <div class="heading-top top-product-heading">
                  <h1>Top Products</h1>
               </div>
               <div class="client-table product-table">
                <table id="detail-table" class="detail-client-table" >
                    <thead>
                      <tr>
                        <th class="table-heading" >Name Vendor</th>
                        <th class="table-heading">Product Name</th>
                        <th class="table-heading">No of Solds</th>
                        <th class="table-heading">Product Price</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                        @if(sizeof($topProducts)>0)
                        @foreach($topProducts as $topProduct)
                      <tr>
                        <td>{{$topProduct['vendor']['name'] ?? '-'}}</td>
                        <td>{{$topProduct['title'] ?? '-'}}</td>
                        <td>{{$topProduct['orders_count'] ?? '-'}}</td>
                        <td>${{$topProduct['price'] ?? '-'}}</td> 
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
               </div>
            </div>
    
        {{-- top products-ends --}}


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