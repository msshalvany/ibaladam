@extends('admin.layout.layout')
@section('content')
    <div class="col-lg-12">
        <div class="col-lg-8 col-lg-offset-2">
            <section class="panel">
                <header class="panel-heading">
                    اضافه کردن ادمین
                </header>
                <div class="panel-body">
                    <form role="form" action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">نام کاربری</label>
                            <input type="text" name="username" value="" class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">شماره همراه</label>
                            <input type="text" name="phon" value=""class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">رمز عبور</label>
                            <input type="text" name="password" value=""class="form-control"
                                id="exampleInputPassword1">
                        </div>
                        <button style="margin-top: 12px;" type="submit" name="btn"class="btn btn-info">اضافه
                            کردن</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    @if ($errors->any())
        <script>
            alertEore('اطلاعات را صحیح وارد کنید')
        </script>
    @endif
@endsection
