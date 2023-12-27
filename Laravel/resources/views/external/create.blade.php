@extends('master.main')

@section('head')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="{{asset('jquery-ui-1.13.2.custom/jquery-ui.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endsection
@section('content')


    <div class="container">
        <h1>Agendar formação de mercado</h1>
        <form method="POST" action="{{ url('external') }}">
            @csrf
            <div class="row">


                <div class="form-group col-4">
                    <label for="partner_id">Parceiro:</label>
                    <select class="form-control" id="partner_id" name="partner_id" required>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-4">
                    <label for="training_id">Formação:</label>
                    <select class="form-control" id="training_id" name="training_id" required>
                        @foreach($trainings as $training)
                            <option value="{{ $training->id }}">{{ $training->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-4">
                    <label for="user_id">Técnico:</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                        @foreach($users as $user)
                            @foreach($role_users as $role_user)
                                @if($role_user->role_id == 4 && $role_user->user_id == $user->id)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="row">


                <div class="col-8">

                </div>
                <div class="form-group col-4">



                    <label for="start_date">Data de Início:</label>
                    <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>



                    <label for="end_date">Data de Fim:</label>
                    <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Criar Parceiro</button>
            <a href="{{ route('external.index') }}" class="btn btn-secondary ">Voltar</a>

            Date: <div id="datepicker"></div>


        </form>
        <div id="confirmation-message" style="display: none;">
            <p>This is a confirmation message using jQuery!</p>
        </div>

        <button id="show-confirmation-btn" class="btn btn-primary">Show Confirmation</button>
    </div>

    <script>
        // jQuery ready function
        $(function() {
            // Click event handler for the button
            $("#show-confirmation-btn").on("click", function() {
                // Show the confirmation message
                $("#confirmation-message").show();
            });
        });
    </script>
@endsection
