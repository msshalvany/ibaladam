<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/ibaladam/img/logo.gif">
    <link href="{{ asset('/ibaladam/css/all.css') }}?t={{ time() }}" rel="stylesheet">
    <link href="{{ asset('/ibaladam/css/style.css') }}?t={{ time() }}" rel="stylesheet">
    <link href="{{ asset('/ibaladam/css/bootstrap.css') }}?t={{ time() }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>chat</title>
    <style>
        .back-home-door {
            position: fixed;
            top: 12px;
            left: 12px;
            z-index: 4;
            text-decoration: none
        }
    </style>
</head>

<body onload="loaded()">
    <a href="/dashbord" class="back-home-door base-btn"><i class="fa fa-home"></i>صفحه اصلی</a>
    <div class="d-flex justify-content-around flex-wrap p-3" style="width: 600px;">
        <b>نام کاربر : {{ $user->username }}</b>
        <p>نام کاربر : {{ $user->phon }}</p>
        <p>نام کاربر : {{ $user->city }}</p>
    </div>
    <div class="conf-cont">
        <p>ایا از انجام این عملیات مطمعن هستید</p>
        <div>
            <button class="conf-cont-n btn btn-danger">کنسل</button>
            <button class="conf-cont-y btn btn-success">مطمعن</button>
        </div>
    </div>
    <div class="door_id" id="{{ $user->id }}"></div>
    <div class="door-cont-contain">
        <div>
            <h1>{{ $door->title }}</h1>
            <p>{{ $door->topic }}</p>
        </div>
        @if($door->img!='null')
            <img src="{{ '/' . $door->img }}" alt="">
        @endif
    </div>
    <div style="position: fixed;margin-left: -60px;left: 50%;top:40%" class="loader"></div>
    <div style="display: none" class="messags-door">
        @foreach ($messege as $item)
            <div class="messags-container" id="{{ $item->id }}">
                @if ($item->user_id == $door->user_id)
                    <div class="message-user">
                        @if ($item->img != 'null')
                            <img style="max-width: 100%" src="{{ $item->img }}" alt=""><br><br>
                        @endif
                        {{ $item->text }}
                    </div>
                    <img class="profile-user" width="50px" height="50px"
                        src="{{ \App\Models\User::find($item->user_id)->image }}" alt="sa">
                @else
                    <img class="profile-user" width="80px" height="80px"
                        src="{{ \App\Models\User::find($item->user_id)->image }}" alt="sa">
                    <div class="message">
                        @if ($item->img != 'null')
                            <img style="max-width: 100%" src="{{ $item->img }}" alt=""><br><br>
                        @endif
                        {{ $item->text }}
                    </div>
                @endif
                <div class="d-flex m-1">
                    <form class="deleteMesesegeForm" style="margin-left:5px "
                        action="{{ route('deleteMesesege', ['id' => $item->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-danger"><i style="color: white" class="fa fa-trash"></i></button>
                    </form>
                    @php
                        $user = App\Models\User::find($item->user_id);
                    @endphp
                    @if ($user->block != 1)
                        <form class="BlockUserForm"
                            action="{{ route('BlockUser', ['user' => $item->user_id, 'doorMessege' => $item->id]) }}"
                            method="post">
                            @csrf
                            <button class="btn btn-warning"><i style="color: white" class="fa fa-cancel"></i></button>
                        </form>
                    @endif

                </div>
            </div>
        @endforeach
    </div>

</body>

</html>
<script type="text/javascript" src="{{ asset('/ibaladam/js/jquery.js') }}?t={{ time() }}"></script>
<script type="text/javascript" src="{{ asset('/ibaladam/js/function.js') }}?t={{ time() }}"></script>
<script type="text/javascript" src="{{ asset('/ibaladam/js/script.js') }}?t={{ time() }}"></script>
<script>
    function loaded() {
        $('.messags-door').fadeIn()
        $('.loader').fadeOut()
    }
    $('.deleteMesesegeForm').submit(function(e) {
        e.preventDefault();
        var form = $(this); // دسترسی به فرم مربوطه

        $('.conf-cont').animate({
            'margin-top': '-80px',
            'top': '50%'
        });

        $('.conf-cont-n').click(function() {
            $('.conf-cont').animate({
                'top': '-150%'
            });
        });

        $('.conf-cont-y').click(function() {
            $('.conf-cont').animate({
                'top': '-150%'
            });
            console.log(form);
            form.unbind('submit').submit(); // ارسال فرم
        });
    });
    $('.BlockUserForm').submit(function(e) {
        e.preventDefault();
        var form = $(this); // دسترسی به فرم مربوطه

        $('.conf-cont').animate({
            'margin-top': '-80px',
            'top': '50%'
        });

        $('.conf-cont-n').click(function() {
            $('.conf-cont').animate({
                'top': '-150%'
            });
        });

        $('.conf-cont-y').click(function() {
            $('.conf-cont').animate({
                'top': '-150%'
            });
            console.log(form);
            form.unbind('submit').submit(); // ارسال فرم
        });
    });
</script>
