@extends('admin.layout.layout')
@section('content')
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <td>کلمات</td>
                <td>پیغام خطا</td>
                <td>قیمت</td>
                <td>حذف</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($words as $item)
                <tr>
                    <td>
                        @foreach (json_decode($item->words) as $item2)
                            {{ $item2 }}-
                        @endforeach
                    </td>
                    <td>{{ $item->mesege }}</td>
                    <td>{{ $item->price }}</td>
                    <form action="{{ route('removRejectWord', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('delete')
                        <td><button class="btn btn-danger btn-xs"><i class="icon-trash"></i></button></td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
    <form class="form" action="{{ route('addRejectWord') }}" method="POST">
        @csrf
        <label for="keyWord">کلمه ‌: </label>
        <input type="text" class="wordsReg form-control" style="width: 100%"><br><br>
        <button class="btn btn-danger wordsReg-btn">اضافه کردن</button><br><br>
        <input type="hidden" class="wordsReg-input" name="wordsReg">
        <div class="cover-wordsReg"></div>
        <label for="mesege">پیام اخطار</label>
        <input type="text" class="form-control" name="mesege"><br>
        <input value="ثبت" type="submit" class="btn btn-info">
    </form>
    @if ($errors->any())
        <script>
            alertEore('اطلاعات را صحیح وارد کنید')
        </script>
    @endif
@endsection
