<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Alya Story - Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7eeee;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
        }

        .login-card {
            width: 100%;
            max-width: 360px;
            background: #fffafa;
            border: 1px solid #d9aeb2;
            border-radius: 17px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(130, 80, 85, 0.13);
        }

        /* HEADER */
        .login-header {
            position: relative;
            background: #b2767a;
            color: white;
            padding: 25px 34px 29px;
            overflow: hidden;
        }

        .login-header::before {
            content: "";
            position: absolute;
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
            right: -20px;
            top: -25px;
        }

        .login-header::after {
            content: "";
            position: absolute;
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
            left: -35px;
            bottom: -35px;
        }

        .heart {
            position: relative;
            z-index: 2;
            width: 48px;
            height: 48px;
            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 23px;
            margin-bottom: 15px;
        }

        .login-title {
            position: relative;
            z-index: 2;
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            font-size: 30px;
            font-weight: normal;
        }

        .login-subtitle {
            position: relative;
            z-index: 2;
            margin-top: 7px;
            font-size: 13px;
        }

        /* BODY */
        .login-body {
            padding: 27px 34px 25px;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #633f43;
            font-size: 13px;
            font-weight: 600;
        }

        .input-box {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #8f6870;
            font-size: 13px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 45px;
            padding: 0 13px 0 40px;
            border: 1px solid #dfb4b8;
            border-radius: 9px;
            background: #eef4ff;
            color: #4e383b;
            outline: none;
            font-size: 13px;
        }

        .form-control::placeholder {
            color: #9c9295;
        }

        .form-control:focus {
            border-color: #b2767a;
            box-shadow: 0 0 0 3px rgba(178,118,122,0.12);
        }

        /* ERROR */
        .error-message {
            color: #c84b4b;
            font-size: 12px;
            margin-top: 7px;
        }

        /* BUTTON */
        .btn-login {
            width: 100%;
            height: 45px;
            border: none;
            border-radius: 9px;
            background: #b2767a;
            color: white;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 2px;
            box-shadow: 0 5px 12px rgba(130,80,85,0.18);
        }

        .btn-login:hover {
            background: #a4676c;
        }

        /* FOOTER */
        .bottom-text {
            text-align: center;
            border-top: 1px solid #ead5d7;
            margin-top: 20px;
            padding-top: 18px;
            font-size: 12px;
            color: #a06e73;
        }

        .bottom-text strong {
            color: #8d555b;
        }
    </style>
</head>

<body>

<div class="login-page">

    <div class="login-card">

        {{-- HEADER --}}
        <div class="login-header">

            <div class="heart">
                ♡
            </div>

            <h1 class="login-title">
                Alya Story
            </h1>

            <div class="login-subtitle">
                Silakan masuk untuk melanjutkan
            </div>

        </div>


        {{-- FORM --}}
        <div class="login-body">

            <form action="{{ route('auth') }}" method="POST">

                @csrf

                {{-- EMAIL --}}
                <div class="form-group">

                    <label class="form-label">
                        Email address
                    </label>

                    <div class="input-box">

                        <span class="input-icon">
                            ✉
                        </span>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                        >

                    </div>

                    {{-- ERROR EMAIL --}}
                    @if(session('login_error_email'))

                        <div class="error-message">
                            {{ session('login_error_email') }}
                        </div>

                    @elseif($errors->has('email'))

                        <div class="error-message">
                            {{ $errors->first('email') }}
                        </div>

                    @endif

                </div>


                {{-- PASSWORD --}}
                <div class="form-group">

                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-box">

                        <span class="input-icon">
                            🔒
                        </span>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                        >

                    </div>

                    {{-- ERROR PASSWORD --}}
                    @if(session('login_error_password'))

                        <div class="error-message">
                            {{ session('login_error_password') }}
                        </div>

                    @elseif($errors->has('password'))

                        <div class="error-message">
                            {{ $errors->first('password') }}
                        </div>

                    @endif

                </div>


                {{-- BUTTON --}}
                <button type="submit" class="btn-login">
                    Masuk ke Aplikasi
                </button>

            </form>


            {{-- FOOTER --}}
            <div class="bottom-text">
                Belum punya akun?
                <strong>Hubungi admin</strong>
            </div>

        </div>

    </div>

</div>

</body>
</html>
