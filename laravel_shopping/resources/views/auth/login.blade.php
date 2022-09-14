<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('webs/login/login.css') }}">
</head>

<body>
    <div class="container">
        <div class="screen">

            <div class="screen__content">
                @if (session('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                    </div>
                @endif
                <form class="login" action="{{ route('login.post') }}" method="post">
                    @method('post')
                    @csrf
                    <h1>LOGIN</h1>
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="email" class="login__input" name="email" id="email" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" name="password" id="password"
                            placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <button type="submit" class="button login__submit">
                        <span class="btn">Log In Now</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>

                <div class="social-login">
                    <a style="text-decoration: none" href="{{ route('register') }}"> <button
                            class="button login__submit">
                            <span class="button__text">register</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                        </button></a>

                    {{-- <div class="social-icons">

                        <a href="#" class="social-login__icon fab fa-instagram"><i
                                class="fa-brands fa-google-plus-g"></i></a>
                        <a href="#" class="social-login__icon fab fa-facebook"></a>
                        <a href="#" class="social-login__icon fab fa-twitter"></a>
                    </div> --}}
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>

</html>
