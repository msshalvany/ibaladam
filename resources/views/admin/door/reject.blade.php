@extends('admin.layout.layout')
@section('content')
    <div class="reject-form">
        <form action="{{ route('rejecDoor', ['id' => $id, 'user_id' => $user_id]) }}" method="post">
            @csrf
            <textarea name="mesege" class="form-control text-reject"></textarea><br>
            <input type="radio" class="mesege-reject"><span>به علت نا هماهنگی</span><br>
            <input type="radio" class="mesege-reject"><span>افزایش اعتبار</span><br>
            <input type="radio" class="mesege-reject"><span>نبودن بودجه</span><br>
            <input type="submit" class="btn btn-info">
        </form>
    </div>
@endsection
