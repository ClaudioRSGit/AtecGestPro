<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<div class="container mx-auto d-flex align-items-center loginPage w-100 fade-in">
    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <div class="card" style="border-radius: 2rem; width: 30rem">
                <div class="d-flex flex-column justify-content-between align-items-center w-100 h-60" style="padding: 5rem;">
                    <div class="d-flex flex-column align-items-center h-25 w-100">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                        <h5 class="mt-3"><strong> ATEC GEST PRO </strong></h5>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="d-flex flex-column justify-content-between h-65 w-100 m-0">
                        @csrf
                        <div>

                            <div class="w-100 mb-4">
                                <label for="username">{{ __('Username') }}</label>

                                <div class="d-flex justify-content-between">
                                    <input id="username" type="text"
                                    class="form-control w-85 @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 512 512"><path fill="#fff" d="M64 112c-8.8 0-16 7.2-16 16v22.1L220.5 291.7c20.7 17 50.4 17 71.1 0L464 150.1V128c0-8.8-7.2-16-16-16H64zM48 212.2V384c0 8.8 7.2 16 16 16H448c8.8 0 16-7.2 16-16V212.2L322 328.8c-38.4 31.5-93.7 31.5-132 0L48 212.2zM0 128C0 92.7 28.7 64 64 64H448c35.3 0 64 28.7 64 64V384c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V128z"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100 mb-4">
                                <label for="password">{{ __('Password') }}</label>

                                <div class="d-flex justify-content-between">
                                    <input id="password" type="password"
                                    class="form-control w-85 @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                    <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 448 512"><path fill="#fff" d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                            @if (session('error'))
                            <div>
                                <div>
                                    <span class="text-danger font-weight-bold">{{ session('error') }}</span>
                                </div>
                            </div>
                            @endif

                            <div>
                                <div>
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
