<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>AtecGest Pro</title>
{{-- STYLE SECTION --}}
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
<link rel="stylesheet" href="{!! asset('css/app.css') !!}" media="all" type="text/css" />
<link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/9/91/Gear-icon-blue-white-background.png"
type="image/x-icon">

<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css">


<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<script src="https://kit.fontawesome.com/5931b49df2.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

@yield('styles')
@stack('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const passwordInput1 = document.getElementById('password1');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const togglePasswordBtn1 = document.getElementById('togglePassword1');
        const eyeIcon = togglePasswordBtn.querySelector('i');
        const eyeIcon1 = togglePasswordBtn1.querySelector('i');

        function togglePasswordVisibility(input, eyeIcon) {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            eyeIcon.classList.toggle('fa-eye', type === 'password');
            eyeIcon.classList.toggle('fa-eye-slash', type === 'text');
        }

        togglePasswordBtn.addEventListener('click', function() {
            togglePasswordVisibility(passwordInput, eyeIcon);
        });

        togglePasswordBtn1.addEventListener('click', function() {
            togglePasswordVisibility(passwordInput1, eyeIcon1);
        });
    });
</script>

<div class="content m-0 w-100 h-100">

    <div class="container mx-auto d-flex align-items-center loginPage w-100 fade-in">
        <div class="d-flex justify-content-center align-items-center w-100 h-100">
            <div class="card loginCard" style="border-radius: 2rem; width: 30rem">
            <div class="loginInnerCard d-flex flex-column justify-content-between align-items-center w-100 h-60" style="padding: 5rem;">
                <div class="d-flex flex-column align-items-center h-25 w-100">
                    <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo-login">
                    <h5 class="mt-3"><strong> ATEC GEST PRO </strong></h5>
                </div>
                <form method="POST" action="{{ route('password.change', ['username' => $user->username]) }}"
                    class="d-flex flex-column justify-content-between h-65 w-100 m-0">
                    @csrf
                    <div>
                        <div class="w-100 mb-4">
                            <label for="password">{{ __('Nova Password') }}</label>
                            <div class="d-flex justify-content-between">
                                <input id="password" type="password"
                                class="form-control w-85 @error('password') is-invalid @enderror" name="password"
                                required autocomplete="new-password">
                                <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10"
                                id="togglePassword" style="cursor: pointer;">
                                <i class="fas fa-eye" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="w-100 mb-4">
                        <label for="password1">{{ __('Repita a Nova Password') }}</label>
                        <div class="d-flex justify-content-between">
                            <input id="password1" type="password"
                            class="form-control w-85 @error('password') is-invalid @enderror"
                            name="password_confirmation" required autocomplete="new-password">
                            <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10"
                            id="togglePassword1" style="cursor: pointer;">
                            <i class="fas fa-eye" style="color: #ffffff;"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('error'))
            <div class="mb-3">
                <div>
                                <span class="text-danger font-weight-bold">{{ session('error') }}</span>
                            </div>
                        </div>
                    @endif

                    @if ($errors->has('password'))
                    <div class="mb-3">
                        <div>
                            <span class="text-danger font-weight-bold">{{ $errors->first('password') }}</span>
                        </div>
                    </div>
                    @endif

                    <div>
                        <div>
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Alterar a Password') }}
                            </button>
                        </div>
                        <div class="mt-3">
                            <span class="text-info font-weight-bold">
                                <i class="fas fa-info-circle"></i> Bem-vindo {{ $user->name }}! Para prosseguir para a
                                aplicação, é necessário alterar a sua password.
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
