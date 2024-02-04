<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="/ibaladam/img/title.png">
    <link href="/ibaladam/css/bootstrap.css" rel="stylesheet">
    <link href="{{ asset('/ibaladam/css/all.css') }}?t={{ time() }}" rel="stylesheet">
    <link href="{{ asset('/ibaladam/css/style.css') }}?t={{ time() }}" rel="stylesheet">
    <meta name="keywords" content="@yield('keyWord')" />
    <title>ibaladam</title>
    <style>
        @yield("css")
    </style>
</head>
<body onload="loginCkoki()">

    <!-- ===============header========= -->
    <!-- ===============header========= -->
    <!-- ===============header========= -->
    <a href="{{route('ticket')}}" class="ticket-link"><i class="fa fa-message"><p>تیکت</p></i><p></p></a>
    <div class="mask"></div>
    <div class="loader"></div>
    <div class="mask-all"></div>
    <div class="conf-cont">
        <p>آیا از انجام این عملیات مطمئن هستید</p>
        <div>
            <button class="conf-cont-n btn btn-danger">کنسل</button>
            <button class="conf-cont-y btn btn-success">مطمعن</button>
        </div>
    </div>
    <div class="pop-info">
        <div class="pop-info-div"></div>
        <button class="cancel-pop-info btn btn-danger">کنسل</button>
    </div>
    @if (!session()->get('user'))
        <div class="userCity d-none">0</div>
    @else
        <div class="userCity d-none">{{ $user->city }}</div>
        <div class="user" id="{{ $user->id }}"></div>
    @endif
    <div class="loead-wait-cin">
        <span class="pers"></span>
        <span>در حال آپلود ....</span>
        <button onclick="location.href=window.location.href" class="btn btn-danger stop-ajsx">کنسل</button>
    </div>
    @if ($user)
        <div class="mines-score-door" id="{{ $user->score }}">
            <p>امتیاز شما {{ $user->score }} است در صورت ورود به اتاق 1 امتیاز از شما کسر می شود</p><br>
            <div class="password-door-input" style="display:none">
                <label for="">این اتاق دارای پسورد است :</label>
                <input type="password" name="pasword" value="">
            </div><br>
            <div>
                <input type="submit" class="doorView" style="opacity: 100%" value="ورود (کسر 1 امتیاز)" />
                <button style="margin-right: 8px" class="cancel">انصراف</button>
            </div>
        </div>
    @else
        <div style="display: none;" class="user" id="0"></div>
    @endif
    <nav>
        <div class="nav-buttons">
            @if (!$user)
                <a class="regester-butten">ثبت نام <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                <a class="login-butten">ورود<i class="fas fa-address-card" aria-hidden="true"></i></a>
            @else
                <a class="panel-nav" href="/panel"> پنل<i class="fa fa-dashboard" aria-hidden="true"></i></a>
                <a href="/" class="back-home">صفحه اصلی<i class="fa fa-home"></i></a>
                <a class="score-nav" href="#">امتیاز {{$user->score}}<i class="fa fa-star" aria-hidden="true"></i></a>
                {{-- <a class="walet"><i class="fa fa-solid fa-wallet" aria-hidden="true"></i> {{ $user->membership }}</a> --}}
            @endif
        </div>
        <div class="logo">
            <a href=""><img src="/ibaladam/img/logo.jpg" alt="" /></a>
        </div>
    </nav>
    <header>
        @if (!$user)
            <div class="login-form">
                <form autocomplete="off" class="loginForm" action="" method="POST">
                    @csrf
                    <label for="phone">شماره همراه :</label>
                    <input type="text" id="phonLogin" name="phon" />
                    <label for="password" style="margin-top: 8px">رمز عبور:</label>
                    <input type="password" id="passwordLogin" name="password" /><br>
                    <label for="ckokiLogin">مرا به خاطر بسپار :
                        <input type="checkbox" id="ckokiLogin" /> </label>
                    <div style="margin-top: 12px">
                        <input type="submit" id="sendLogin" disabled value="ورود" />
                        <button style="margin-right:8px " class="cancelLogin">انصراف</button>
                        <a class="rect-passsword-button">رمز را فراموش کردم</a>
                    </div>
                </form>
            </div>
            <div class="recet-password-form">
                <form autocomplete="off" action="" class="recet-password-first">
                    <label for="phone">شماره همراه :</label><br>
                    <input type="text" id="phonRecetPassword" name="phone" /><br>
                    <div style="margin-top: 8px">
                        <input style="margin-right:8px " type="submit" id="RecetPassword" disabled value="مرحله بعد" />
                        <button style="margin-right:10px" class="cancelRecetPassword">انصراف</button>
                    </div>
                </form>
                <form autocomplete="off" action="" style="display: none" class="recet-password-secend">
                    <label for="codeVerify"> کد پیامک شده را وارد کنید :</label><br>
                    <input type="text" class="codeVerifyRecetPass" name="codeVerifyRecetPass" /><br>
                    <div style="margin-top: 8px">
                        <input type="submit" id="codeVerifyRecetPass" value="ارسال" style="opacity: 100%" />
                        <button style="margin-right:10px" class="cancelRecetPassword">انصراف</button>
                    </div>
                </form>
            </div>
            <div class="regester-form">
                <form autocomplete="off" class="regester-first" id="regester-first" method="post">
                    @csrf
                    <label for="phon">شماره خود را وارد کنید:</label>
                    <input type="text" name="phon" id="phon">
                    <div style="margin-top: 8px">
                        <input type="submit" id="sendRegester" disabled value="ثبت نام" />
                        <button style="margin-right: 8px" class="cancelRegester">انصراف</button>
                    </div>
                </form>
                <form autocomplete="off" style="display: none" class="regester-secend" method="POST">
                    @csrf
                    <label for="codeVerify"> کد پیامک شده را وارد کنید :</label>
                    <input type="text" name="codeVerify" id="codeVerify" />
                    <div>
                        <input type="submit" id="codeVerifySend" style="opacity: 100%" value="ثبت نام" />
                        <button style="margin-right: 8px" class="cancelRegester">انصراف</button>
                    </div>
                </form>
                <form autocomplete="off" style="display: none" class="regester-3">
                    @csrf
                    <label for="username">یک نام کاربری برای خود بنویسید</label>
                    <input type="text" name="username" id="username" placeholder="فقط شامل حروف" />
                    <label for="password">رمز عبور برای خود تعیین کنید :</label>
                    <input type="text" name="password" id="password" placeholder="حداقل 4 کاراکتر" />
                    <label for="repassword">مجددا رمز را وارد کنید :</label>
                    <input type="text" name="repassword" id="repassword" placeholder="برابر با رمز قبلی" />
                    <label for="city" class="mt-3">استان خود را انتخاب کنید  ((اجباری)):</label>
                    <div class="mt-1">
                        <select class="w-100 border-3 rounded-3" name="city" id="city">
                            <option value="تهران">تهران</option>
                            <option value="آذربایجان شرقی">آذربایجان شرقی</option>
                            <option value="آذربایجان غربی">آذربایجان غربی</option>
                            <option value="اردبیل">اردبیل</option>
                            <option value="اصفهان">اصفهان</option>
                            <option value="البرز">البرز</option>
                            <option value="ایلام">ایلام</option>
                            <option value="بوشهر">بوشهر</option>
                            <option value="تهران">تهران</option>
                            <option value="چهارمحال بختیاری">چهارمحال بختیاری</option>
                            <option value="خراسان جنوبی">خراسان جنوبی</option>
                            <option value="خراسان رضوی">خراسان رضوی</option>
                            <option value="خراسان شمالی">خراسان شمالی</option>
                            <option value="خوزستان">خوزستان</option>
                            <option value="زنجان">زنجان</option>
                            <option value="سمنان">سمنان</option>
                            <option value="سیستان و بلوچستان">سیستان و بلوچستان</option>
                            <option value="فارس">فارس</option>
                            <option value="قزوین">قزوین</option>
                            <option value="قم">قم</option>
                            <option value="کردستان">کردستان</option>
                            <option value="کرمان">کرمان</option>
                            <option value="کرمانشاه">کرمانشاه</option>
                            <option value="کهکیلویه و بویراحمد">کهکیلویه و بویراحمد</option>
                            <option value="گلستان">گلستان</option>
                            <option value="گیلان">گیلان</option>
                            <option value="لرستان">لرستان</option>
                            <option value="مازندران">مازندران</option>
                            <option value="مرکزی">مرکزی</option>
                            <option value="هرمزگان">هرمزگان</option>
                            <option value="همدان">همدان</option>
                            <option value="یزد">یزد</option>
                        </select>
                    </div>
                    <label for="invider">اگر شماره معرف دارید وارد کنید (اختیاری) :</label>
                    <input type="text" name="invider" id="invider" placeholder="مثال : 09922490802" />
                    <div>
                        <input type="submit" id="regester" style="opacity: 50%" value="ثبت نام" />
                        <button style="margin-right: 8px" class="cancelRegester">انصراف</button>
                    </div>
                </form>
            </div>
        @endif

        <!-- <div class="search-head">
        <form action="" class="search">
          <input type="text" />
          <button><i class="fab fa-sistrix"></i></button>
        </form>
      </div> -->
    </header>
    <!-- ===============header========= -->
    <!-- ===============header========= -->
    <!-- ===============header========= -->

    <section>
        @yield('section')
    </section>
    <!-- ==========section========= -->
    <!-- ==========footer=========== -->
    <!-- ==========footer=========== -->
    <!-- ==========footer=========== -->
    {{-- <footer>
        <div class="information-call">
            <a><i class="fas fa-headset" style="font-size: 36px"></i> {{ $info->suporter }}</a>
            <a><i class="fab fa-telegram-plane" style="font-size: 36px"> </i>{{ $info->telegram }}</a>
            <a><i class="fab fa-instagram" style="font-size: 36px"></i> {{ $info->instagram }}</a>
        </div>
        <div class="information-logo">
            <img width="200" src="/ibaladam/img/logo2.gif" alt="" />
            <p>{{ $info->info }}</p>
        </div>
        <div class="discription">
        <h3>گواهینامه ها</h3>
        <img width="120px" height="120px" src="/ibaladam/img/kasbokar.png" alt="" />
        <img width="120px" height="120px" src="/ibaladam/img/rezi.png" alt="" />
        <img width="120px" height="120px" src="/ibaladam/img/enamad.png" alt="" />
    </div>
    </footer> --}}

    <!-- ==========footer=========== -->
    <!-- ==========footer=========== -->
    <!-- ==========footer=========== -->
</body>

</html>

<script type="text/javascript" src="{{ asset('/ibaladam/js/jquery.js') }}?t={{ time() }}"></script>
<script type="text/javascript" src="{{ asset('/ibaladam/js/function.js') }}?t={{ time() }}"></script>
<script type="text/javascript" src="{{ asset('/ibaladam/js/script.js') }}?t={{ time() }}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

{{-- <script>
    function activeDoor() {
        $('.door-button').click(function(e) {
            if ($('.user').attr('id') = '0') {
                alertEore('ابتدا باید ثبت نام کنید')
            } else {
                window.location.href = `/doorViwe/${e.target.id}`
            }
        });
    }
</script> --}}
@if (!session()->get('user'))
    <script>
        $('.form-door-messege').on('submit', function(e) {
            e.preventDefault()
            alertEore('ابتدا باید ثبت نام کنید')
            regesterForm()
        })
    </script>
@endif
@if (session()->get('errorDoorMessege'))
    <script !src="">
        alertEore('مشخصات را صحیح وارد کنید')
    </script>
@endif


{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}

@if (session()->exists('loginUserErr') == 1)
    <script>
        alertEore('ابتدا باید ثبت نام کنید')
        regesterForm()
    </script>
@endif

{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
{{-- ======================panel==================== --}}
@yield('script')
