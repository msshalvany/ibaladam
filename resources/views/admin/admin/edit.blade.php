@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section>
                <h1 class="pageLables">افزودن منو جدید</h1>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <section class="panel">
                            <header class="panel-heading">
                                Basic Forms
                            </header>
                            <div class="panel-body">
                                <form role="form" action="{{ route('admins.update', ['admin' => $admins->id]) }}"
                                    method="POST" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">نام کاربری</label>
                                        <input type="text" name="username" value="{{ $admins->username }}"
                                            class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">شماره همراه</label>
                                        <input type="text" name="phon" value="{{ $admins->phon }}"class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">رمز عبور</label>
                                        <input type="text" name="password" value="{{ $admins->password }}"class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <label for="order">مرتبه</label>
                                    <select name="order" id="">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select><br>
                                    <button style="margin-top: 12px;" type="submit" name="btn"class="btn btn-info">اضافه کردن</button>
                                </form>
                            </div>
                        </section>
                    </div>
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
