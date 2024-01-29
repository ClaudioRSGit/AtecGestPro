@extends('master.main')

@section('content')
    <div class="container">
        <h1 class="h2">Dashboard</h1>



        <div class="row my-4">

            <div class="col-3 col-md-6 mb-4 mb-lg-2 col-lg-3 d-flex">


                <div class="card flex-grow-1">
                    <h5 class="card-header">Usuarios e Materiais</h5>
                    <div class="card-body">
                        @foreach ($userRolesCounts as $roleCount)
                            <h4> {{ $roleCount->name }} : {{ $roleCount->total }}</h4>
                        @endforeach
                        <h4>Material interno : {{ $materialInternalCount }}</h4>
                        <h4>Material Externo : {{ $materialExternalCount }}</h4>
                    </div>
                </div>
            </div>

            <div class="col-3 col-md-6 col-lg-3 mb-4 mb-lg-2 d-flex">
                <div class="card flex-grow-1">

                    <div class="card-body">
                        <canvas id="pieChart"></canvas>

                    </div>
                </div>
            </div>

            <div class="col-6 col-md-6 mb-4 mb-lg-2 col-lg-6 d-flex">
                <div class="card flex-grow-1">
                    <h5 class="card-header">Número de Formações Externas</h5>
                    <div class="card-body">
                        <div id="traffic-chart"></div>
                    </div>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-lg-2">
                <div class="card">
                    <h5 class="card-header">Entregas Incompletas</h5>
                    <div class="card-body">
                        <div id="usersTable" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersWithMaterialsDelivered as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="btn btn-sm btn-primary"
                                                onclick="location.href='{{ route('material-user.create', $user->id) }}'">
                                                View</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- <a href="#" class="btn btn-block btn-light">View all</a> --}}
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">


                <div class="card mb-2">
                    <div class="card-body">
                        <canvas id="pieChartPri"></canvas>

                    </div>
                </div>

                <div class="card ">
                    <h5 class="card-header">Tickets Prioridade</h5>
                    <div class="card-body">
                        @foreach ($ticketStatusCounts as $statusCount)
                            <h5> {{ $statusCount->description }} : {{ $statusCount->total }}</h5>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Pie chart ticket status
        var ctx = document.getElementById('pieChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    data: @json($data['data']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });

        // Pie chart ticket priority
        var ctxPri = document.getElementById('pieChartPri').getContext('2d');
        var myChartPri = new Chart(ctxPri, {
            type: 'pie',
            data: {
                labels: @json($chartData['labels']),
                datasets: [{
                    data: @json($chartData['data']),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
        });



        new Chartist.Line('#traffic-chart', {
            labels: ['January', 'Februrary', 'March', 'April', 'May', 'June'],
            series: [
                [23000, 25000, 19000, 34000, 56000, 64000]
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>

    <style>
        /* .table th{
            width: 100%;
            white-space: nowrap;
        }
        .table td {
            width: 90%;
            white-space: nowrap;
        } */

        .table-responsive {
            max-height: 300px;
            /* Adjust this value as per your requirement */
        }

        .table-responsive thead th {
            position: sticky;
            top: 0;
            background: #fff;
            /* To make the header non-transparent while scrolling */
            box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
            /* Optional: adds a shadow effect */
        }

        #usersTable {
            box-shadow: 1px 2px 1px 2px rgb(230, 229, 229);
            margin: 15px;
            border: 1px solid #141313;
            background-color: #cbeaf8;
            overflow-y: scroll;
            overflow-x: hidden;
            height: 400px;
        }


        .card-header {
            margin-bottom: 0;
        }

        .card-body {
            padding-top: 0;
        }


        /*

                    #usersTable::-webkit-scrollbar {
                        display: none;
                    }


                    #usersTable {
                        -ms-overflow-style: none;
                        scrollbar-width: none;
                    }
                */
    </style>
@endsection
