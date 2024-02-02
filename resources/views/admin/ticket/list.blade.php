@extends('admin.layout.layout')
@section('content')
    <ul class="list-group">
        @foreach($ticket as $item)
            @php
                $lastMessege = \App\Models\TicketMesseg::orderBy('id', 'DESC')->where('ticket_id',$item->id)->where('user_id','!=',0)->first();
                $user = \App\Models\User::find($item->user_id);
            @endphp
            @if($lastMessege)
                <a href="{{route('ticketShow',['id'=>$item->id])}}">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p>{{$user->username}}-{{$user->phon}}</p>

                        {{$lastMessege->text}}
                        {{--                    {{$item->lastSee}}--}}
                        {{--                    {{$lastMessege->id}}--}}
                        @if($lastMessege->id > $item->lastSee)
                            <span class="badge" style="background:#0c63e4">
                            پیام
                         </span>
                        @endif


                    </li>
                </a>
            @endif
        @endforeach
    </ul>
@endsection
