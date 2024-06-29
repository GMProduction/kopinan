<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>SPM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/genosstyle.1.0.css')}}"/>
    <script src="{{ asset('js/jquery1.7.1.min.js') }}"></script>

</head>

<body class="main-bg">
<!-- Login Form -->
<div class="position-absolute">
    <div class="relative-button">
        <div class="position-absolute" style=""></div>
        <img src="{{asset('assets/bg-login.jpeg')}}" style=" height: 100vh; width: 100vw">
    </div>
</div>
<div class="container " style="height: 100vh">
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card shadow py-3 rounded">
                <div class="card-title text-center border-bottom">
                    <h5 class="p-3">Selamat Datang Kembali</h5>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Username</label>
                            <input type="text" class="form-control {{ $errors->has('username')?'is-invalid':'' }}" value="{{ old('username') }}" required name="username" id="username"/>
                            @if ($errors->has('username'))
                                <p class="invalid-feedback" style="font-size: 0.8em">
                                    {{ $errors->first('username') }}
                                </p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="d-flex align-items-center gap-1">
                                <input type="password" class="form-control {{ $errors->has('password') ||$errors->has('approve') ?'is-invalid':'' }}" name="password" id="password"/>
                                <span class="text-muted" style=""><i role="button" class="material-icons" id="iconpassword"
                                                                     onclick="showPass(this,'password')">visibility_off</i></span>

                            </div>
                            {{--                            <div style="position:relative;">--}}
                            {{--                                <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" id="password"  required name="password"  placeholder=""--}}
                            {{--                                       value="{{ old('password') }}">--}}
                            {{--                            </div>--}}
                            @if ($errors->has('password'))
                                <p class="text-danger" style="font-size: 0.8em">
                                    {{ $errors->first('password')}}
                                </p>
                            @endif
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn-utama1 d-flex justify-content-center main-bg">Login</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showPass(a, field) {
        console.log($('#' + field).get(0).type)
        if ($(a).html() == 'visibility') {
            $(a).html('visibility_off')
            $('#' + field).get(0).type = 'password'
        } else {
            $(a).html('visibility')
            $('#' + field).get(0).type = 'text'
        }
    }
</script>
</body>

</html>
