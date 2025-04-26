<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login_page/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login_page/css/owl.carousel.min.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login_page/css/bootstrap.min.css') }}">

    {{-- <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm')}}"
    crossorigin="anonymous"> --}}

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login_page/css/style.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="icon" href="{{ asset('images/portfolio/favicon.png') }}">
    <title>Register | Rental System</title>
</head>

<style>
    * {
        overflow: hidden;
    }

</style>

<body>
    <div class="d-lg-flex half">
        <div class="bg order-0 order-md-0" style="background-image: url('login_page/images/bg_2.jpg');"></div>
        <div class="contents order-1 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3>Registration to <strong>Rental System</strong></h3>
                        <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.
                        </p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group first">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Name">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group first">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    placeholder="Email">
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror" name="password" 
                                required autocomplete="current-password" placeholder="Password">
                            </div>
                            <div class="form-group last mb-5">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" 
                                class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>

                            <div class="d-flex my-3 align-items-center">
                                <span class="mr-auto">
                                    <a href="/" class="">Login</a>
                                </span>
                            </div>

                        </form>


                    </div>
                </div>
            </div>
        </div>


    </div>





    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
