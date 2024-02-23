<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sanatorium System</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/logo/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/images/logo/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    <!-- <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body>
    <div id="auth">
        <div class="d-flex" style="flex-direction:row;">
            <div class="col-lg-5 login-holder">
                <div id="auth-left">
                    <div class="auth-logo">
                        <!-- <a href="index.html"><img src="{{ asset('assets/images/logo/iDentX-logo-new3.png') }}" alt="Logo"></a> -->
                    </div>
                    <div class="logo">
                        <!-- <img id="imglogo" alt="Logo" srcset="" style="height: 35px; width: 100px; object-fit: contain;">
                        <h6 class="modal-title" id="textLogo"  style="font-size: 1.2rem;"></h6> -->
                        <div>
                            <h1 class="logo-title">Sanatorium System</h1>
                        </div>
                    </div>
                    <p class="auth-subtitle mb-5">Log in with Email and Password</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror form-control-xl" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" name="password" type="password" class="form-control form-control-xl @error('password') is-invalid @enderror" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-600" for="remember">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign
                                up</a>.</p>
                        <p><a class="font-bold" href="{{ route('forgotpassword') }}">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 img-holder">
                <div class="img-overlay"></div>
                <img src="{{ asset('assets/images/Hospital/hospital-logo.jpg') }}" style="height:100%; width:100%;">
            </div>
            <!-- <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                        
                </div>
            </div> -->
        </div>
    </div>
    <script>
		var billTextlogo = '{{ env('TEXT_LOGO') }}';
		var BillPlogo = '{{ env('IMG_LOGO') }}';
        var imgElement = document.getElementById('imglogo');
        imgElement.src = BillPlogo;
        // $('#textLogo').text(billTextlogo);
        var textLogo = document.getElementById('textLogo');
        textLogo.innerHTML  = billTextlogo;
        
        if (billTextlogo && billTextlogo.trim() !== '') {
        // If textLogo is not empty, hide the image elements
            imgElement.style.display = 'none';
        } else {
            // If textLogo is empty or null, display the image elements
            imgElement.src = imgLogo;
        }
	</script>
</body>
</html>