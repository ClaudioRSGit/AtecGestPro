@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">
        <div class="row col-12 mb-4 dashboardRow">
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Administradores:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount dashboardCount">{{$adminCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-user-gear fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Técnicos:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount dashboardCount">{{$technicianCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-helmet-safety fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Funcionários:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$technicianCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-people-carry-box fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Formandos:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$traineeCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-user-graduate fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-12 mb-4 dashboardRow">
            <div class="col-3">
                <div class="card bg-light dashboardCard">
                    <div class="card-body d-flex align-items-center" onclick="location.href='{{ route('course-classes.index') }}'">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Turmas:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$traningsCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-users fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('courses.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Cursos:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$coursesCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-book fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('materials.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Material Interno:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$internalMaterialCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-regular fa-lightbulb fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('materials.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Material Externo:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$externalMaterialCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-box-open fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-12 mb-4 dashboardRow">
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                        <div class="card-body d-flex align-items-center">
                            <div class="dashboardCardContent">
                                <h4 class="dashboardCardTitle">Utilizadores Ativos:</h4>
                                <h3 class="dashboardCardSubtitle dashboardCount">{{$activeUserCount}}</h3>
                            </div>
                            <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                                <i class="fa-solid fa-user fa-2xl" style="color: #116fdc;"></i>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Utilizadores Inativos:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$inactiveUserCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-user-large-slash fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('external.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Parceiros:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$partnerCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-handshake fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('external.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div class="dashboardCardContent">
                            <h4 class="dashboardCardTitle">Formações Externas:</h4>
                            <h3 class="dashboardCardSubtitle dashboardCount">{{$externalTrainingsCount}}</h3>
                        </div>
                        <div class="w-100 h-100 d-flex justify-content-end align-items-center">
                            <i class="fa-solid fa-graduation-cap fa-2xl" style="color: #116fdc;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4 col-12 dashboardGraphsFirst">
            <div class="col-6 custom-scrollbar" style="height: 350px; overflow-y: auto;">
                <div class="card">
                    <h5 class="card-header"><strong>Entregas Incompletas</strong></h5>
                    <div class="card-body">
                        <div id="usersTable" class="table-responsive" style="cursor: pointer">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Username</th>
                                        <th>Concluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersWithMaterialsDelivered as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td class="pl-4"
                                                onclick="location.href='{{ route('material-user.create', $user->id) }}'">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="16" width="20" viewBox="0 0 640 512">
                                                    <path fill="#116fdc"
                                                        d="M58.9 42.1c3-6.1 9.6-9.6 16.3-8.7L320 64 564.8 33.4c6.7-.8 13.3 2.7 16.3 8.7l41.7 83.4c9 17.9-.6 39.6-19.8 45.1L439.6 217.3c-13.9 4-28.8-1.9-36.2-14.3L320 64 236.6 203c-7.4 12.4-22.3 18.3-36.2 14.3L37.1 170.6c-19.3-5.5-28.8-27.2-19.8-45.1L58.9 42.1zM321.1 128l54.9 91.4c14.9 24.8 44.6 36.6 72.5 28.6L576 211.6v167c0 22-15 41.2-36.4 46.6l-204.1 51c-10.2 2.6-20.9 2.6-31 0l-204.1-51C79 419.7 64 400.5 64 378.5v-167L191.6 248c27.8 8 57.6-3.8 72.5-28.6L318.9 128h2.2z" />
                                                </svg>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card h-100">
                    <h5 class="card-header"><strong>Número Total de Tickets: {{$totalTicketsCount}}</strong></h5>
                    <div class="card-body">
                        <canvas id="ticketChart" width="400" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-12 mr-3 dashboardGraphsSecond">
            <div class="col-12">
                <div class="card">
                    <h5 class="card-header" ><strong>Formações Externas por mês</strong></h5>
                    <div class="card-body">
                        <div id="traffic-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('ticketChart').getContext('2d');
        var ticketChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Abertos', 'Em Progresso', 'Pendentes', 'Resolvidos', 'Fechados'],
                datasets: [{
                    label: 'Número de Tickets',
                    data: [
                        <?php echo $openedTicketsCount; ?>,
                        <?php echo $inProgressTicketsCount; ?>,
                        <?php echo $pendingTicketsCount; ?>,
                        <?php echo $solvedTicketsCount; ?>,
                        <?php echo $closedTicketsCount; ?>
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
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


@endsection

