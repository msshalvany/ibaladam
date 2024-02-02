@extends('ibaladam.layout.layout')
@section('css')
    .panel-nav{
    display: none;
    }
    .container-ch{
    margin: 4px 2px 16px 0 !important;
    }
    .checkmark{
    right: 0;
    }
@endsection
@section('section')
    <div class="save-cont">
        <div>
            @if (count($saveDoors) == 0)
                <p class="m-3">موردی وجود ندارد</p>
            @endif
            @foreach ($saveDoors as $item)
                <span>
                    <span class="w-100" onclick="viweDoor(event,{{ $item->id }})">{{ $item->title }}</span>
                    <form class="remove-save-door d-inline" method="get"
                        action="{{ route('unmark', ['user' => session()->get('user'), 'door' => $item->id]) }}">
                        @csrf
                        <button style="margin-left: 8px" class="border-0 text-danger"><i class="fa fa-bookmark"></i></button>
                    </form>
                </span>
            @endforeach
        </div>
    </div>
    <div class="panel">
        <div class="request-door">
            <p style="font-size: 24px;font-weight: bold;text-align: center">ساخت اتاق</p>
            <div class="container-door">
                @switch($user->status_door)
                    @case('new')
                        <form action="{{ route('doorNwe') }}" class="door-form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="title"> عنوان اتاق:</label>
                            <input type="text" name="title">
                            <span for="price">مبلغ مژدگانی (به هزار تومان)
                                <label class="container-ch" style="display: inline;top: -9px;right: 6px;">
                                    <input class="enable-price" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </span>
                            <div class="d-flex align-items-center">
                                <input class="w-25 price-door" style="margin-left: 12px" type="number" name="price"
                                    step="1" min="0" value="0" disabled required>
                            </div>
                            <label for="topic">توضیحات (الزامی) :</label>
                            <textarea name="topic" id="" cols="30" rows="5"></textarea>
                            <label for="category">دسته بندی</label>
                            <select class="grops-select-door" name="grops" id="">
                                <option value="0">انتخاب کنید</option>
                                @foreach ($grop as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label for="category-lowlevel">زیر گروه دسته بندی</label>
                            <select class="subgrops-select-door" name="subgrops" id="">

                            </select>
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="custom-file-upload">
                                <label for="">استان خود را انتخاب کنید :</label><br>
                                <select class="select-city" @if ($user->other_city == 0) disabled @endif name="city">
                                    <option value="0">استان را انتخاب کنید</option>
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
                            @if ($user->other_city == 0)
                                <div>
                                    <p>برای انتخاب استانی دیگر ، از امتیاز شما 1000 امتیاز کسر می شود . موافقید ؟ </p><a
                                        onclick="otherCity()" class="base-btn">موافقم</a>
                                </div><br>
                            @endif
                            {{-- @if ($user->all_city == 1)
                                <div>نمایش در تمام شهر ها <input name="all_city" style="vertical-align: -2px" type="checkbox"></div>
                            @else
                                <div>نمایش اتاق در تمام شهر ها <span style="color: red;font-weight: bold">25 هزار توان </span><a
                                        href="{{ route('pay_city') }}" style="margin: 0 5px 0 0" class="base-btn">پرداخت</a></div>
                            @endif --}}
                            <span for="price">ساخت اتاق خصوصی (دارای رمز عبور) :
                                <label class="container-ch" style="display: inline;top: -9px;right: 6px;">
                                    <input class="enable-pass" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </span>
                            <div class="password-container" style="display: none">
                                <label for="">رمز عبور اتاق : </label>
                                <input type="password" name="password" id="passwoerd-door">
                            </div>
                            <script></script>
                            <label class="custom-file-upload">
                                <input type="file" name="img">
                                <div style="width: fit-content;" class="base-btn">اگر عکسی دارید میتونید آپلود کنید
                                </div>
                            </label><br>
                            <button class="send-door">ثبت</button>
                        </form>
                    @break

                    @case('check')
                        <div class="status_request">
                            <div class="check-request" id="check" style="font-weight: bold">در حال بررسی ...</div>
                            <div class="loader"></div>
                            <form autocomplete="off" action="{{ route('resetDoor', ['id' => $door->id]) }}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="user" value="{{ $user->id }}">
                                <button class="cancel-request btn btn-danger">انصراف از اتاق</button>
                            </form>
                        </div>
                    @break

                    @case('accept')
                        <div class="status_request">
                            <p style="font-size: 20px;text-align: center;font-weight: bold;"> اتاق گفتگو :</p>
                            <div><b>عنوان اتاق:</b>{{ $door->title }}</div>
                            <p><b>متن:</b><br>{{ $door->topic }} </p>
                            <p><b>شهر:</b>{{ $door->city }} </p>
                            <span>بستن چت کاربران
                                <label class="container-ch" style="display: inline;top: 2px;right: 6px;">
                                    <input class="block-messege-btn" type="checkbox" @if ($door->messegeBlock=='true') checked @endif>
                                    <span class="checkmark"></span>
                                </label>
                            </span>
                            <a class="btn btn-primary" href="/doorViwe/{{ $door->id }}">ورود به اتاق</a>
                            <form autocomplete="off" class="conf-form" action="{{ route('deleteDoor', ['id' => $door->id]) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="user" value="{{ $user->id }}">
                                <button class="cancel-request btn btn-danger">انصراف از اتاق</button>
                            </form>
                        </div>
                        <script>
                            $('.block-messege-btn').click(function(e) {
                                $.ajax({
                                    type: "post",
                                    url: "/user/blockMessege",
                                    data: {
                                        id: {{ $door->id }},
                                        val: $('.block-messege-btn').prop('checked')
                                    },
                                    success: function(response) {
                                        if (response == 1) {
                                            alertSucsses('عملیات موفق')
                                        }
                                    }
                                });
                            });
                        </script>
                    @break

                    @case('reject')
                        <div>
                            <div class="status_request">
                                <div style="color: red;font-weight: bold;margin-top: 20px">اتاق شما رد شده</div>
                                <form autocomplete="off" action="{{ route('resetDoor', ['id' => 0]) }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="user" value="{{ $user->id }}">
                                    <p>{{ $user->rejectDoorMesseg }}</p><br>
                                    <button style="background: rgb(67, 67, 255)" class="cancel-door"> اتاق جدید</button>
                                </form>
                            </div>
                        </div>
                    @break
                @endswitch
            </div>
        </div>
        <div class="panel-information">
            <h2>اطلاعات شخصی شما</h2>
            <img class="panel-img" width="100" height="100" src="{{ $user->image }}" alt="" />
            <form class="chang-img-form mt-2" action="{{ route('imageUpdate') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <label class="chang-img-btn">تغیر عکس
                    <input type="file" class="image-inpute" name="img" style="display: none;" required>
                </label>
            </form>
            <ul>
                <li>نام کاربری : {{ $user->username }}</li>
                <li>شماره همراه :{{ $user->phon }}</li>
                <li>امتیاز :{{ $user->score }}</li>
                <li style="color: red">هر کسی از طرف شما ثبت نام کند و شماره معرف را شماره همراه شما بزند ، به ازای هر معرف
                    100 امتیاز می گیرید</li>
            </ul>
            <div>
                <form autocomplete="off" action="{{ route('editInfoUser', ['id' => $user->id]) }}" method="GET">
                    @csrf
                    <button class="base-btn">ویرایش اطلاعات</button>
                </form>
                <button class="btn btn-primary mt-2  save-shoe-btn">اتاق های ذخیره شده</button>
                <a class="logout btn btn-danger mt-2 d-block ">LOG OUT<i class="fa fa-sign-in"
                        style="vertical-align: -5px;margin-right: 5px" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script>
        $('.enable-pass').click(function(e) {
            var status = $('.enable-pass').prop('checked');
            if (status) {
                $('.password-container').fadeIn();
            } else {
                $('.password-container').fadeOut();
            }
        })
    </script>
    <script>
        $('.image-inpute').change(function(e) {
            $(".chang-img-form").trigger("submit");
            $('.loead-wait-cin').css('display', 'flex');
        });
    </script>
    <script>
        if ($('.check-request').attr('id') == 'check') {
            var user = {{ session()->get('user') }}
            setInterval(() => {
                $.ajax({
                    type: "post",
                    url: `/cehckAcceptDoor/${user}`,
                    success: function(res) {
                        if (res.status == 'check') {
                            console.log('check');
                        } else if (res.status == 'accept') {
                            alertSucsses("اتاق شما تایید شد");
                            $('.check-request').attr('id', 'false')
                            setTimeout(() => {
                                location.href = location.pathname
                            }, 2000);
                        } else {
                            alertEore("اتاق شما تایید نشد");
                            $('.status_request').empty();
                            $('.status_request').append(`
                                    <div style="color: red;font-weight: bold;margin-top: 20px">اتاق شما رد شده</div>
                                    <form autocomplete="off" action="{{ route('resetDoor', ['id' => 0]) }}" method="POST">
                                        @method('put')
                            @csrf
                            <input type="hidden" name="user" value="{{ $user->id }}">
                                        <p>${res}</p><br>
                                        <button style="background: rgb(67, 67, 255)" class="cancel-door"> اتاق جدید</button>
                                    </form>
                          `)
                            $('.check-request').attr('id', 'false')
                        }
                    }
                });
            }, 4000);
        }
    </script>
    @if (session()->exists('paySucc'))
        <script>
            alertSucsses('پرداخت شما موفق بود')
        </script>
    @endif
    <script>
        var isRequestRunning = false;

        function otherCity() {
            $('.conf-cont').animate({
                'top': '110%'
            });

            $('.conf-cont-n').click(function(e) {
                $('.conf-cont').animate({
                    'top': '50%'
                });
            });

            $('.conf-cont-y').click(function(e) {
                if (isRequestRunning) {
                    return; // در صورتی که درخواست در حال اجرا باشد، اجرای مجدد را متوقف کنید
                }

                isRequestRunning = true; // تنظیم پرچم برای نشان دادن اجرای درخواست

                $.ajax({
                    type: "post",
                    url: 'panel/otherCity',
                    success: function(response) {
                        $('.conf-cont').animate({
                            'top': '50%'
                        });
                        if (response == 'scor') {
                            alertEore(
                                'شما امتیاز کافی را ندارید هر کسی از طرف شما ثبت نام کند و شماره معرف را شماره همراه شما بزند ، به ازای هر معرف 100 امتیاز می گیرید'
                            )
                        } else if (response == 1) {
                            alertSucsses('عملیات موفق')
                            setTimeout(() => {
                                location.href = '/panel'
                            }, 2000);
                        }
                    },
                    complete: function() {
                        isRequestRunning = false; // تنظیم پرچم برای اتمام اجرای درخواست
                    }
                });
            });
        }
    </script>
    @if (session()->exists('witeDoor'))
        <script>
            alertSucsses('عملیات موفق منتظر تایید باشید')
        </script>
    @endif
    @if (session()->exists('doorErroe'))
        <script>
            alertEore('اطلاعات اتاق را کامل پر کنید')
        </script>
    @endif
    @if (session()->exists('imgEr'))
        <script>
            alertEore('فایل حتما باید عکس و حد اکثر 100 مگابات')
        </script>
    @endif
    @if (session()->exists('blockErroe'))
        <script>
            alertEore('شما توسط ادمین مسدود شدید برای پیگیری تیکت بزنید')
        </script>
    @endif
    @if (session()->exists('checkText'))
        <script>
            alertEore('{{ session()->get('checkText') }}')
        </script>
    @endif
    <script>
        $('.enable-price').click(function(e) {
            var status = $('.enable-price').prop('checked');
            if (status) {
                $('.price-door').attr('disabled', false)
            } else {
                $('.price-door').attr('disabled', true)
            }
        })
    </script>
@endsection
