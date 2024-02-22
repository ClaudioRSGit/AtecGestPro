@extends('master.main')

@section('content')
    <div class="container w-100 fade-in">
        <div class="row col-12 mb-4">
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-1" style="font-family: 'Muli', sans-serif;">Administradores:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$adminCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/2942/2942813.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-1" style="font-family: 'Muli', sans-serif;">Técnicos:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$technicianCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/554/554795.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-1" style="font-family: 'Muli', sans-serif;">Funcionários:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$technicianCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/554/554795.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-1" style="font-family: 'Muli', sans-serif;">Formandos:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$traineeCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/2941/2941658.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>

        </div>
        <div class="row col-12 mb-4">
            <div class="col-3">
                <div class="card bg-light dashboardCard">
                    <div class="card-body d-flex align-items-center" onclick="location.href='{{ route('course-classes.index') }}'">
                        <div>
                            <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Turmas:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$traningsCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/2941/2941658.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('courses.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Cursos:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$coursesCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/3197/3197967.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('materials.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Material Interno:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$internalMaterialCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/3082/3082008.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('materials.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Material Externo:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$externalMaterialCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/3616/3616470.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;">
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-12 mb-4">
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                        <div class="card-body d-flex align-items-center">
                            <div>
                                <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Utilizadores Ativos:</h4>
                                <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$activeUserCount}}</h3>
                            </div>
                        <img src="https://cdn-icons-png.freepik.com/256/2919/2919931.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;"">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('users.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Utilizadores Inativos:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$inactiveUserCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.freepik.com/512/5671/5671947.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;"">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('external.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Parceiros:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$partnerCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.freepik.com/512/4214/4214107.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;"">
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card bg-light dashboardCard" onclick="location.href='{{ route('external.index') }}'">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <h4 class="mb-0" style="font-family: 'Muli', sans-serif;">Formações Externas:</h4>
                            <h3 class="mb-0 py-2 font-weight-bold text-primary">{{$externalTrainingsCount}}</h3>
                        </div>
                        <img src="https://cdn-icons-png.flaticon.com/512/5663/5663343.png" alt="" style="height: 50px; margin-left: auto; margin-right: 20px;"">
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4 col-12">
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
                                        <th>Email</th>
                                        <th>Concluir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usersWithMaterialsDelivered as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td
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
                <div class="card">
                    <h5 class="card-header"><strong>Número Total de Tickets: {{$totalTicketsCount}}</strong></h5>
                    <div class="card-body">
                        <canvas id="ticketChart" width="400" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .dashboardCard:hover {
    background-color: #116FDC!important;
    cursor: pointer;
}

.dashboardCard:hover h4, .dashboardCard:hover h3 {
    color: #ffffff!important;
}

.dashboardCard {
    position: relative;
    height: 120px;
    overflow: hidden;
}

        </style>

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
</script>
@endsection
