@extends('admin.layout.layout')
@section('css')
    .chat-container {
    min-width: 320px;
    width: 90%;
    margin: 30px auto;
    }

    .chat-header {
    background-color: white;
    padding: 20px;
    text-align: center;
    }

    .chat-body {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    padding: 20px;
    max-height: 400px;
    overflow-y: auto;
    display: flex;
    flex-direction: column-reverse;
    }

    .message {
    margin-bottom: 20px;
    }

    .message .sender {
    font-weight: bold;
    margin-bottom: 5px;
    }

    .message .content {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 4px;
    }
    .message .content p {
    white-space: pre-wrap;
    margin-top: 5px;
    }

    .chat-footer {
    background-color: #f8f9fa;
    padding: 20px;
    border-top: 1px solid #ddd;
    }

    .input-group {
    margin-bottom: 10px;
    }

    .input-group-prepend span {
    background-color: #81009f;
    color: #fff;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    }

    .form-control {
    border-radius: 4px;
    }

    .user-message {
    background: #81009f !important;
    color: white;
    }
@endsection


@section('content')
    <div class="chat-container">
        <form action="{{route('sendUserSmsTicket')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$user->id}}">
            <button class="btn btn-danger">ارسال sms</button>
        </form>
        <div class="chat-header">
            <h3>ارسال تیکت</h3>
        </div>
        <div class="chat-body">
            @foreach($messege as $item)
                <div class="message">

                    <div class="content @if($item->admin==1)user-message @endif">
                        <div class="sender">@if($item->admin==1)
                                ادمین آی بلدم :
                            @else
                                {{$user->username}} - {{$user->phon}}
                            @endif
                        </div>

                    @if($item->img)
                            <img style="max-width: 300px" src="/{{$item->img}}" alt="s">
                        @endif
                        <p>{{$item->text}}</p>
                    </div>
                </div>
            @endforeach

            {{--            <div class="message">--}}
            {{--                <div class="sender">Jane 111</div>--}}
            {{--                <div class="content ">بله، متشکرم! شما چطور؟</div>--}}
            {{--            </div>--}}
            {{--            <!-- اضافه کردن پیام‌های بیشتر -->--}}
        </div>

        <form class="form-ticket" action="{{route('ticketStorAdmin')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="chat-footer">
                <label class="mb-2" for="text">متن را تایپ کنید : </label>
                    <textarea required name="text" id="text" class="form-control w-100"></textarea>
                    <input type="hidden" name="ticket_id" value="{{$ticket->id}}"><br>
                <label class="custom-file-upload">
                    <input type="file" name="img">
                    <div style="width: fit-content;" class="base-btn">اگر عکسی دارید میتونید آپلود کنید
                    </div>
                </label><br>
                <input type="submit" class="btn btn-primary" style="margin-top: 5px" value="ازسال">
            </div>
        </form>

    </div>
@endsection
@section('js')
    <script>
        $('.form-ticket').submit(function (e) {
            var fileInput = $('.custom-file-upload input')[0];
            if (fileInput.files.length > 0) {
                $('.stop-ajsx').fadeOut(0)
                $('.loead-wait-cin').css('display', 'flex');
            }
        });
    </script>
    @error('text')
    <script>
        alertEore('اطلاعات صحیح نمی باشد')
    </script>
    @enderror
@endsection
