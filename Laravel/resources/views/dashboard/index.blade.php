@extends('master.main')

@section('content')
    <div class="container">
        <h1 class="h2">Dashboard</h1>

        <div class="row my-4">
            <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                <div class="card">
                    <h5 class="card-header">Total Tickets</h5>
                    <div class="card-body">
                        <h5 class="card-title">345k</h5>
                        <p class="card-text">Feb 1 - Apr 1, United States</p>
                        <p class="card-text text-success">18.2% increase since last month</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Resolvidos</h5>
                    <div class="card-body">
                        <h5 class="card-title">$2.4k</h5>
                        <p class="card-text">Feb 1 - Apr 1, United States</p>
                        <p class="card-text text-success">4.6% increase since last month</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tickets Abertos</h5>
                    <div class="card-body">
                        <h5 class="card-title">43</h5>
                        <p class="card-text">Feb 1 - Apr 1, United States</p>
                        <p class="card-text text-danger">2.6% decrease since last month</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
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
            <div class="col-12 col-xl-8 mb-4 mb-lg-0">
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

                                            <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr>
                                    <th scope="row">17371705</th>
                                    <td>Volt Premium Bootstrap 5 Dashboard</td>
                                    <td>johndoe@gmail.com</td>
                                    <td>€61.11</td>
                                    <td>Aug 31 2020</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">17371705</th>
                                    <td>Volt Premium Bootstrap 5 Dashboard</td>
                                    <td>johndoe@gmail.com</td>
                                    <td>€61.11</td>
                                    <td>Aug 31 2020</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">17371705</th>
                                    <td>Volt Premium Bootstrap 5 Dashboard</td>
                                    <td>johndoe@gmail.com</td>
                                    <td>€61.11</td>
                                    <td>Aug 31 2020</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                  </tr>
                                  <tr>
                                    <th scope="row">17371705</th>
                                    <td>Volt Premium Bootstrap 5 Dashboard</td>
                                    <td>johndoe@gmail.com</td>
                                    <td>€61.11</td>
                                    <td>Aug 31 2020</td>
                                    <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                  </tr> --}}
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
