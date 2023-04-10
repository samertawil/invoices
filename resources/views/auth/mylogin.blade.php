<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my_style.css') }}">
    <title>{{ env('APP_NAME') }}</title>
</head>

 <style>
.image {
    margin: 70px 30px;
}


@font-face {
    font-family: 'Droid';
    src:url(../font/Droid.Arabic.Kufi_DownloadSoftware.iR_.ttf);
}

body{
    font-family: 'Droid', Arial, Helvetica, sans-serif !important;
    font-size: 14px;
    font-weight: 600;
    /* direction: rtl; */

}

</style>

@include('auth.validate')


<body>
    {{-- {{$message }} --}}
    <div class="main_div row">

        <div class="left_side col-6">
            <div class="image" style="width: 450px; height:300px;">
                <img src="{{ asset('img/31.png') }}">


            </div>

        </div>


        <div class="righ_side col-6  ">

            <p class="h3 text-center mb-5"   >تسجيل الدخول</p>
            <form action="{{ Route('login') }}" method="POST" class="main_form">

                @csrf
                <div class="form-group">
                    <label for="name">اسم المستخدم</label>
                    <input type="text" name="name" placeholder="اسم المستخدم"
                        class="form-control my-1
                        @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror

                </div>
                <div class="form-group my-3">
                    <label for="password">الاسم</label>
                    <input type="password" name="password" autocomplete placeholder="كلمة المرور"
                        class="form-control my-1
                    @error('password') is-invalid @enderror">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <small>{{ $message }}</small>
                        </span>
                    @enderror

                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            {{-- <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label> --}}
                        </div>
                    </div>
                </div>


                <button class="btn btn-success  mt-3"  id="ok_btn">دخول</button>
            </form>


        </div>

    </div>




    {{-- <script src="{{ asset('assets/js/bootstrap.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/jQuery.js') }}"></script>


</body>

</html>
