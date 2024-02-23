<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="https://kit.fontawesome.com/5931b49df2.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        togglePasswordBtn.addEventListener('click', function () {
            togglePasswordVisibility(passwordInput, eyeIcon);
        });

        togglePasswordBtn1.addEventListener('click', function () {
            togglePasswordVisibility(passwordInput1, eyeIcon1);
        });
    });
</script>


<div class="container mx-auto d-flex align-items-center loginPage w-100 fade-in">
    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <div class="card" style="border-radius: 2rem; width: 30rem">
                <div class="d-flex flex-column justify-content-between align-items-center w-100 h-60" style="padding: 5rem;">
                    <div class="d-flex flex-column align-items-center h-25 w-100">
                        <img src="{{ asset('assets/logo.png') }}" alt="Logo">
                        <h5 class="mt-3"><strong> ATEC GEST PRO </strong></h5>
                    </div>
                    <form method="POST" action="{{ route('password.change', ['username' => $username]) }}" class="d-flex flex-column justify-content-between h-65 w-100 m-0">
                        @csrf
                        <div>
                            <div class="w-100 mb-4">
                                <label for="password">{{ __('Nova Password') }}</label>
                                <div class="d-flex justify-content-between">
                                    <input id="password" type="password" class="form-control w-85 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10" id="togglePassword" style="cursor: pointer;">
                                        <i class="fas fa-eye" style="color: #ffffff;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100 mb-4">
                                <label for="password1">{{ __('Repita a Nova Password') }}</label>
                                <div class="d-flex justify-content-between">
                                    <input id="password1" type="password" class="form-control w-85 @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                                    <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10" id="togglePassword1" style="cursor: pointer;">
                                        <i class="fas fa-eye" style="color: #ffffff;"></i>
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
                                    {{ __('Alterar a Password') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
        </div>
    </div>
</div>
