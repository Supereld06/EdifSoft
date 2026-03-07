<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - EdifSoft</title>

    <!-- Tema Sketchy -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/sketchy/bootstrap.min.css" rel="stylesheet">

    <!-- Tu CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">

    <div class="card shadow p-4" style="max-width:420px; width:100%;">

        <!-- TITULO -->
        <div class="text-center mb-4">
            <h1 class="fw-bold display-5"><span style="color: orange;">Edif</span><span>Soft</span></h1>
            <p class="text-muted">Sistema de gestión de edificios</p>
        </div>

        <!-- SESSION STATUS -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-3">
                <label class="form-label">Email</label>

                <input 
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    required
                    autofocus
                >

                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="mb-3">
                <label class="form-label">Password</label>

                <input 
                    type="password"
                    name="password"
                    class="form-control"
                    required
                >

                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- REMEMBER -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Recordarme
                </label>
            </div>

            <!-- BOTON -->
            <div class="d-grid mb-3">
                <button class="btn btn-primary">
                    Iniciar sesión
                </button>
            </div>

            <!-- FORGOT PASSWORD -->
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>
            @endif

        </form>

    </div>

</div>

</body>
</html>