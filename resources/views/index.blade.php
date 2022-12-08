<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('/login/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/login/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>
    <div id="particles-js">

    </div>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('/login/images/download.png') }}');">
            <div class="wrap-login100 p-l-120 p-r-120 p-t-50 p-b-50">
                <h2 class="text-center">
                    Fix Asset Management
                </h2>
                <br>
                <h2 class="text-center">
                    (FAMA)
                </h2>
                <div>
                    <form class="login100-form validate-form flex-sb flex-w" action="masuk" method="post">
                        @csrf
                        <div class="p-t-31 p-b-9">
                            <span class="txt1">
                                Username
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Userid is required">
                            <input class="input100" type="text" name="userid">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="p-t-13 p-b-9">
                            <span class="txt1">
                                Password
                            </span>
                            <a href="#" class="txt2 bo1 m-l-5">
                                Lupa Password?
                            </a>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="pass">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-login100-form-btn m-t-17">
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                {{-- <img src="../images/logo_resmi.png" class="login100-form-title p-b-53" alt="Logo Quality"> --}}

            </div>
        </div>
    </div>

    @include('sweetalert::alert')
    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('/login/js/main.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.3/particles.min.js"
        integrity="sha512-jq8sZI0I9Og0nnZ+CfJRnUzNSDKxr/5Bvha5bn7AHzTnRyxUfpUArMzfH++mwE/hb2efOo1gCAgI+1RMzf8F7g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script type="text/javascript">
        particlesJS.load('particles-js', 'particles.json', function() {
            console.log('particles.json loaded...');
        })
    </script> --}}

</body>

</html>
