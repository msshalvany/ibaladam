<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" type="image/png" href="/ibaladam/img/title.png">
    <link href="{{ asset('/ibaladam/css/all.css') }}?t={{ time() }}" rel="stylesheet">
    <link href="{{ asset('/ibaladam/css/style.css') }}?t={{ time() }}" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <style>
        .back-home-door {
            position: fixed;
            top: 4px;
            right: 18px;
            z-index: 4;
        }

        .count-user {
            position: fixed;
            top: 5px;
            left: 18px;
        }
    </style>
</head>

<body onload="loaded()">
    <span class="base-btn count-user"> تعداد اعضای اتاق :{{ $door->count }} <i class="fa fa-user"></i></span>
    <div style="display: none;" class="user" id="{{ session()->get('user') }}"></div>
    <div class="mask"></div>
    <div class="mask-all"></div>
    <div class="door_id" id="{{ $door->user_id }}"></div>
    <a href="/" class="back-home-door base-btn"><i class="fa fa-home"></i> صفحه اصلی </a>
    <div>
        <div class="door-cont-contain">
            <div>
                <h1>{{ $door->title }}</h1>
                <p>{{ $door->topic }}</p>
            </div>
            @if ($door->img != 'null')
                <img src="{{ '/' . $door->img }}" alt="">
            @endif
            <div class="mark-door-v-con">
                @php
                    $user = \App\Models\User::find(session()->get('user'));
                    $save = json_decode($user->saveDoor);
                @endphp
                @if (in_array($door->id, $save))
                    <i onclick="unsetmark(event,{{ $door->id }})" class="fa fa-bookmark"></i>
                @else
                    <i onclick="setmark(event,{{ $door->id }})" class="fa fa-regular fa-bookmark"></i>
                @endif
            </div>
        </div>
        <div style="position: fixed;margin-left: -60px;left: 50%;top:40%" class="loader"></div>
        <div style="display: none" class="messags-door">
            @foreach ($messege as $item)
                <div class="messags-container" id="{{ $item->id }}">
                    @if ($item->user_id == $door->user_id)
                        <div class="message-user">
                            @if ($item->img != 'null')
                                <img style="max-width: 100%;width: 300px;" src="{{ $item->img }}"
                                    alt=""><br><br>
                            @endif
                            @if ($item->mp4 != 'null')
                                <video style="max-width: 100%;width: 300px;" src="{{ $item->mp4 }}" controls></video>
                            @endif
                            <p>{{ $item->text }}</p>
                        </div>
                        <img class="profile-user" width="60px" height="60px"
                            src="{{ \App\Models\User::find($item->user_id)->image }}" alt="sa">
                    @else
                        <img class="profile-user" width="60px" height="60px"
                            src="{{ \App\Models\User::find($item->user_id)->image }}" alt="sa">
                        <div class="message">
                            @if ($item->img != 'null')
                                <img style="max-width: 100%;width: 300px;" src="{{ $item->img }}"
                                    alt=""><br><br>
                            @endif
                            @if ($item->mp4 != 'null')
                                <video style="max-width: 100%;width: 300px;" src="{{ $item->mp4 }}" controls></video>
                            @endif
                            <p>{{ $item->text }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div>
            <form class="form-door-messege" action="/door/setmessege" method="post" enctype="multipart/form-data">
                @csrf
                <textarea autofocus rows="1" name="messege"></textarea>
                @if (session()->get('user'))
                    <input type="hidden" name="user" value="{{ session()->get('user') }}">
                @endif
                <input type="hidden" name="door" value="{{ $door->id }}">
                <div class="file-door-messege">
                    <label class="custom-file-upload">
                        <input type="file" accept="image/*, .pdf, .doc" name="img" />
                        <i style="font-size: 28px" class="fa fa-file-clipboard"></i>
                    </label>
                </div>
                <button type="submit">ارسال</button>
            </form>
        </div>
    </div>
</body>

</html>
<script type="text/javascript" src="{{ asset('/ibaladam/js/jquery.js') }}?t={{ time() }}"></script>
<script type="text/javascript" src="{{ asset('/ibaladam/js/function.js') }}?t={{ time() }}"></script>
<script type="text/javascript" src="{{ asset('/ibaladam/js/script.js') }}?t={{ time() }}"></script>
@if (session()->get('errorDoorMessege')==1)
    <script>
        alertEore('حتما باید متنی تایپ کنید')
    </script>
@endif

@if (session()->get('errorDoorImg'))
    <script>
        alertEore(' حجم عکس باید حداکثر 2 مگابایت باشد')
    </script>
@endif
@if (session()->get('messegeBlock'))
    <script>
        alertEore('ارسال پیام در این اتاق مقدور نیست')
    </script>
@endif
@if (session()->get('userError'))
    <script>
        alertEore('ابتدا باید ثبت نام کنید')
        var w = innerWidth;
        var h = innerHeight;
        if (w >= 550) {
            $(".mask").fadeIn();
            $(".regester-form").css({
                left: (w - 300) / 2
            });
            $(".regester-form")
                .fadeIn()
                .animate({
                    top: (h - 550) / 2,
                });
        } else {
            $(".mask").fadeIn();
            $(".regester-form").css({
                left: (w - 300) / 2,
                top: (h - 400) / 2,
            });
            $(".regester-form").fadeIn();
        }
    </script>
@endif
<script>
    function loaded() {
        $('.messags-door').fadeIn()
        $('.loader').fadeOut()
    }
</script>
<script>
    $('form').submit(function (e) {
        $('.mask-all').fadeIn();
        $('.loader').fadeIn()
    });
</script>
<script>
    setInterval(function() {
        var lastMessege = $('.messags-container').attr('id')
        var door = window.location.href
        door = door.split('/')
        door = door[door.length - 1]
        $.ajax({
            type: 'get',
            url: `/door/checkMessege/${door}/${lastMessege}`,
            processData: false,
            contentType: false,
            success: function(response) {
                var img = " "
                if (response.img != 'null') {
                    var img = `<img style="width: 300px" src="${response.img}" alt=""><br><br>`
                }
                if (response != 0) {
                    if ($('.door_id').attr('id') == response.user_id) {
                        $('.messags-door').prepend(`
                        <div class="messags-container" id="${response.id}">
                                 <div class="message-user">
                                      ${img}
                                      <p>${response.text}</p>
                                </div>
                               <img class="profile-user" width="60px" height="60px" src="${response.profile}" alt="sa">
                         </div>
                    `)
                    } else {
                        $('.messags-door').prepend(`
                        <div class="messags-container" id="${response.id}">
                        <img class="profile-user" width="60px" height="60px" src="${response.profile}" alt="sa">
                                 <div class="message">
                                      ${img}
                                      <p>${response.text}</p>
                                </div>
                         </div>
                    `)
                    }

                }
            }
        })
    }, 2000);
</script>
@if (session()->exists('blockErroe'))
    <script>
        alertEore('شما توسط ادمین مسدود شدید برای پیگیری تیکت بزنید')
    </script>
@endif
