@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h2 class="card-title">خوش امدید</h2>
                <h3 class="card-subtitle mb-2 text-muted">{{$admin[0]->username}}</h3>
            </div>
        </div>
    </div>
@endsection
