<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container mx-auto d-flex align-items-center loginPage w-100 fade-in">
    <div class="row justify-content-center w-100 ">
        <div class="col-md-6">
            <div class="card my-auto">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                        <h5 class="mt-3"><strong> ATEC GEST PRO </strong></h5>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="username"
                                class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4 mb-2">
                                    <span class="text-danger font-weight-bold">{{ session('error') }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2 pl-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
