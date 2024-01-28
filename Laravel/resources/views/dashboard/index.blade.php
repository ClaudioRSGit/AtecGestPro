@extends('master.main')

@section('content')
    <div class="container">
        <h1 class="h2">Dashboard</h1>
        {{-- use foreach loop to create a cart foreach ticket_statuses_id and in h5 put ticket_statuses_description <div class="card">:
        <div class="card">
            <h5 class="card-header">Total Tickets</h5>
            and another loop for  <div class="card-body"> and in h5 put the count from database:
            <div class="card-body">
                <h5 class="card-title">345k</h5>
                <p class="card-text">Feb 1 - Apr 1, United States</p>
                <p class="card-text text-success">18.2% increase since last month</p>
            </div>
        </div> --}}


        <div class="row my-4">
            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-2">
                <div class="card">
                    <h5 class="card-header">Total Tickets</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticketTotal }}</h5>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-2 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Aberto</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticketStatusOpen }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-2 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Em Progresso</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticketStatusProgress }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-2 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Pendente</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticketStatusPending }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-2 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Resolvido</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticketStatusSolved }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-2 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Fechado</h5>
                    <div class="card-body">
                        <h5 class="card-title">{{ $ticketStatusClosed }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-2 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Prioridade</h5>
                    <div class="card-body">
                        <h5 class="card-title">64k</h5>
                        <p class="card-text">Feb 1 - Apr 1, United States</p>
                        <p class="card-text text-success">2.5% increase since last month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-lg-2">
                <div class="card">
                    <h5 class="card-header">Entregas Incompletas</h5>
                    <div class="card-body">
                        <div class="table-responsive">
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

                                            <td  class="btn btn-sm btn-primary" onclick="location.href='{{ route('users.show', $user->id) }}'">View</td>
                                        </tr>
                                    @endforeach

                                </tbody>


                            </table>
                        </div>
                        <a href="#" class="btn btn-block btn-light">View all</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-4">
                <div class="card">
                    <h5 class="card-header">Número de Formações Externas</h5>
                    <div class="card-body">
                        <div id="traffic-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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
@endsection
