@extends('admin.layout.layout')
@section('content')
    <form class="form" action="{{ route('infoUpfate') }}" method="POST">
        @csrf
        <label for="keyWord">کلمات کلیدی ‌: </label>
        <textarea  style="width: 100%" rows="8" name="keyWord" id="">{{$info->keyWord}}</textarea><br><br>
        <label for="keyWord"> توضیحات ‌: </label>
        <textarea  style="width: 100%" rows="8" name="info" id="">{{$info->info}}</textarea><br><br>
        <label for="keyWord">قوانین وب سایت ‌: </label>
        <textarea class="rols" style="width: 100%" rows="4" id=""></textarea><br><br>
        <button class="btn btn-danger rols-btn">اضافه کردن</button><br><br>
        <input type="hidden" class="rols-input" name="rols" value="{{json_encode($rols)}}">
        <div class="cover-rols">
            @foreach ($rols as $item)
             <span class='rol'>{{$item}}<span onclick="removeRols(event)"><i style="margin: 0 5px 0 0;cursor: pointer" class="icon-trash"></i></span></span>
            @endforeach
        </div>
        <label for="telegram">تلگرام :</label>
        <input type="text" name="telegram" class="form-control" value="{{$info->telegram}}"><br>
        <label for="instagram">انستگرام :</label>
        <input type="text" name="instagram" class="form-control" value="{{$info->instagram}}"><br>
        <label for="suporter">پشتیبانی :</label>
        <input type="text" name="suporter" class="form-control" value="{{$info->suporter}}"><br>
        <input value="اعمال تغیرات" type="submit" class="btn btn-info">
    </form>
@endsection
