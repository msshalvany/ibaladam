@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    لیست منو های اصلی وب سایت
                </header>
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <td>نام</td>
                            <td>شماره همراه</td>
                            <td>رمز عبور</td>
                            <td>درجه</td>
                            <td>حذف</td>
                            <td>ویرایش</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $item)
                            <tr>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->phon }}</td>
                                <td>{{ $item->password }}</td>
                                <td>{{ $item->order }}</td>
                                <form action="{{ route('admins.destroy', ['admin' => $item->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <td><button class="btn btn-danger btn-xs"><i class="icon-trash "></i></button></td>
                                </form>
                                <form action="{{ route('admins.edit', ['admin' => $item->id]) }}" method="get">
                                    @csrf
                                    <td><button class="btn btn-info btn-xs"><i class="icon-edit"></i></button></td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
    </div>
@endsection
