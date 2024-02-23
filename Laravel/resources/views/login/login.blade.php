<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="https://kit.fontawesome.com/5931b49df2.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('togglePassword');
        const eyeIcon = togglePasswordBtn.querySelector('i');

        togglePasswordBtn.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            eyeIcon.classList.toggle('fa-eye', type === 'password');
            eyeIcon.classList.toggle('fa-eye-slash', type === 'text');
        });
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('#success-alert').fadeOut('slow');
        }, 3000);
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
                <form method="POST" action="{{ route('login') }}"
                    class="d-flex flex-column justify-content-between h-65 w-100 m-0">
                    @csrf
                    <div>

                        <div class="w-100 mb-4">
                            <label for="username">{{ __('Username') }}</label>

                            <div class="d-flex justify-content-between">
                                <input id="username" type="text"
                                    class="form-control w-85 @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" required autocomplete="username" autofocus>
                                <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10">
                                    <i class="fa-solid fa-user-group" style="color: #ffffff;"></i>
                                </div>
                            </div>
                        </div>

                        <div class="w-100 mb-4">
                            <label for="password">{{ __('Password') }}</label>

                            <div class="d-flex justify-content-between">
                                <input id="password" type="password"
                                    class="form-control w-85 @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                <div class="rounded d-flex justify-content-center align-items-center btn-primary w-10"
                                    id="togglePassword" style="cursor: pointer;">
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
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    @if (session('success'))
                        <div>
                            <div class="mt-3">
                                <span class="text-success font-weight-bold"
                                    id="success-alert">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
