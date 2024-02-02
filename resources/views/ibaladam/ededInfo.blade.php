@extends('ibaladam.layout.layout')
@section('css')
    form {
    width: 82%;
    margin: 50px auto;
    display: flex;
    justify-content: space-around;
    flex-direction: column;
    background-color: white;
    box-shadow: 0 0 12px black;
    padding: 16px;
    }

    form * {
    margin-top: 8px;
    }

    .sendEdet {
    background-color: rgb(0, 119, 255);
    color: white;
    padding: 5px 12px;
    border-radius: 8px;
    transition: all 0.4s;
    border: unset;
    }

    .cancelEdet {
    background-color: red;
    color: white;
    padding: 5px 12px;
    border-radius: 8px;
    transition: all 0.4s;
    border: unset;
    }

    .cancelEdet:hover,
    .sendEdet:hover {
    transform: scale(1.08);
    }
@endsection

@section('section')
    <p style="text-align: center;font-size:26px;font-weight: bold;margin-top:20px  ">ویرایش اطلاعات</p>
    <form autocomplete="off" action="{{ route('userupdate') }}" class="edit-info-form">
        <label for="username">نام کاربری:</label>
        <input type="text" id="username" name="username" value="{{ $user->username }}"
               placeholder="نام شما باید فقط شامل حروف باشد" required/><br>
        <label for="password" required>رمز خود را وارد کنید:</label>
        <input type="password" value="{{ $user->password }}" id="password" name="password" required
               placeholder="حد اقل 4 حرف را وارد کنید"/><br>
        <label for="repassword">رمز را مجددا وارد کنید:</label>
        <input type="password" value="{{ $user->password }}" id="repassword" name="repassword" required
               placeholder="حد اقل 4 حرف را وارد کنید"/><br>
        <input type="hidden" value="{{ $user->id }}" name='id'>
        <div>
            <input type="submit" id="sendEdet" class="sendEdet" value="ویرایش"/>
            <button class="cancelEdet">انصراف</button>
        </div>
    </form>
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.edit-info-form').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            console.log(formData);
            $.ajax({
                type: "post",
                processData: false,
                contentType: false,
                url: $(this).attr('action'),
                data: formData,
                success: function (response) {
                    if (response == 0) {
                        alertEore('خطا رخ داده لطفا اطلاعات را بررسی کنید')
                    } else {
                        alertSucsses('عملیات موفق')
                        setTimeout(() => {
                            window.location.replace('/panel')
                        }, 3000);
                    }
                }
            });
        });
        $('.cancelEdet').click(function (e) {
            e.preventDefault();
            window.location.replace('/panel')
        });
    </script>
@endsection
