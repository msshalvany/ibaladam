@extends('ibaladam.layout.layout')
@section('section')
    <section class="info-layout">
        <div class="info">
            <h2>توضیحات وب سایت:</h2>
            <p>{{$info->info}}</p>
        </div>
        <div class="rouls">
            <h2>قوانین وب سایت :</h2>
            <ol>
                @foreach ($rols as $item)
                    <li style="list-style: disc;list-style-position: inside">{{$item}}</li>
                @endforeach
            </ol>
        </div>
        <a href="panel">شروع</a>
    </section>
@endsection