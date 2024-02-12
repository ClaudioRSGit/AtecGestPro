@extends('master.main')

@section('content')
    <div class="container w-100">
        <h1 class="h2">Dashboard</h1>



        <div class="row my-4">

            <div class="col-3 col-md-6 mb-4 mb-lg-2 col-lg-3 d-flex">


                <div class="card flex-grow-1">
                    <h5 class="card-header"><strong>Usuários & Materiais</strong></h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($userRolesCounts as $roleCount)
                            <li class="list-group-item">
                                <strong>{{ $roleCount->name }} :</strong> {{ $roleCount->total }}
                            </li>
                        @endforeach
                        <li class="list-group-item">
                            <strong>Material interno :</strong> {{ $materialInternalCount }}
                        </li>
                        <li class="list-group-item">
                            <strong>Material Externo :</strong> {{ $materialExternalCount }}
                        </li>
                    </ul>
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
                    <h5 class="card-header"><strong>Total de Formações Externas</strong></h5>
                    <div class="card-body d-flex flex-column justify-content-end">
                        <div id="traffic-chart" style="width: 100%; height: 100%;"></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-lg-2">
                <div class="card">
                    <h5 class="card-header"><strong>Entregas Incompletas</strong></h5>
                    <div class="card-body">
                        <div id="usersTable" class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th></th>
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
                                                Visualizar
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">


                <div class="card mb-2">
                    <h5 class="card-header"><strong>Tickets Prioridades</strong></h5>
                    <div class="card-body">
                        <canvas id="pieChartPri"></canvas>

                    </div>
                </div>



            </div>
        </div>
    </div>





    <script>
        function createPieChart(elementId, labels, data) {
            var ctx = document.getElementById(elementId).getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
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
        }

        //grafic of tickets states
        createPieChart('pieChart', @json($data['labels']), @json($data['data']));
        //grafic of tickets priorities
        createPieChart('pieChartPri', @json($chartData['labels']), @json($chartData['data']));


        //grafic of number of external formations per month changing dinamically
        var chartDataStartDate = @json($chartDataStartDate);


        var currentMonth =  new Date().getMonth() + 1;
        var labels = chartDataStartDate.labels.slice(0, currentMonth);

        new Chartist.Line('#traffic-chart', {
            labels: labels,
            series: [
                chartDataStartDate.data.slice(0, currentMonth)
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>

    <style>
        .ct-series-a .ct-area{
            fill: #36A2EB;

        }
        .ct-series-a .ct-line,
        .ct-series-a .ct-point {

            stroke: #36A2EB;
        }

        .table-responsive thead th {
            position: sticky;
            top: 0;
            background: #fff;

            box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);

        }

        #usersTable {
            box-shadow: 1px 2px 1px 2px rgb(230, 229, 229);
            margin: 15px;
            border: 1px solid #141313;
            background-color: rgba(203, 234, 248, 0.3);
            overflow-y: auto;
            overflow-x: auto;
            height: 355px;
        }


        .card-header {
            margin-bottom: 0;
        }

        .card-body {
            padding-top: 0;
        }
    </style>
@endsection
