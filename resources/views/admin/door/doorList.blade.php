@extends('admin.layout.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    اتاق ها
                </header>
                @if ($door->hasPages())
                    <ul class="pagination pagination" style="display: flex">
                        {{-- Previous Page Link --}}
                        @if ($door->onFirstPage())
                            <li class="disabled"><span>«</span></li>
                        @else
                            <li><a href="{{ $door->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                            </li>
                        @endif

                        @if ($door->currentPage() > 3)
                            <li class="hidden-xs"><a href="{{ $door->appends(request()->input())->url(1) }}">1</a> </li>
                        @endif
                        @if ($door->currentPage() > 4)
                            <li><span>...</span></li>
                        @endif
                        @foreach (range(1, $door->lastPage()) as $i)
                            @if ($i >= $door->currentPage() - 2 && $i <= $door->currentPage() + 2)
                                @if ($i == $door->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a href="{{ $door->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                        @if ($door->currentPage() < $door->lastPage() - 3)
                            <li><span>...</span></li>
                        @endif
                        @if ($door->currentPage() < $door->lastPage() - 2)
                            <li class="hidden-xs"><a href="{{ $door->url($door->lastPage()) }}">{{ $door->lastPage() }}</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($door->hasMorePages())
                            <li><a href="{{ $door->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                            </li>
                        @else
                            <li class="disabled"><span>»</span></li>
                        @endif
                    </ul>
                @endif
                <table class="table table-striped table-advance table-hover">
                    <thead>
                        <tr>
                            <td> تیتر و توضیحات</td>
                            <td>پین کردن</td>
                            <td>مشاهده اطلاعات کاربر</td>
                            <td>ثبت</td>
                            <td>رد کردن</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($door as $item)
                            @php
                                $user = App\Models\User::find($item->user_id);
                            @endphp
                            <tr>
                                <td>{{ $item->title }}<br>{{ $item->topic }}</td>
                                @if ($item->pin == 0)
                                    <td>
                                        <form action="{{ route('pinDoor', ['id' => $item->id, 'val' => 0]) }}"
                                            method="POST">
                                            @csrf
                                            <input class="pined btn btn-primary" id="{{ $item->id }}" type="submit"
                                                value="پین کردن">
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <form action="{{ route('pinDoor', ['id' => $item->id, 'val' => 1]) }}"
                                            method="POST">
                                            @csrf
                                            <input class="pined btn btn-danger" id="{{ $item->id }}" type="submit"
                                                value="لغو پین">
                                        </form>
                                    </td>
                                @endif
                                <td><button
                                        onclick="popInfo('<img width=300 src={{ $user->image }}><br><p>{{ $user->id }}</p><p>{{ $user->phon }}</p><p>{{ $user->username }}</p><p>{{ $user->city }}</p>')"
                                        class="btn btn-warning"><i class="fa fa-user"></i></button></td>
                                <form action="{{ route('doorShow', ['id' => $item->id]) }}" method="get">
                                    @csrf
                                    <td>
                                        <button class="btn btn-primary">مشاهده</button>
                                    </td>
                                </form>
                                <form
                                    action="{{ route('rejecDoorViwe', ['id' => $item->id, 'user_id' => $item->user_id]) }}"
                                    method="get">
                                    @csrf
                                    <td>
                                        <button class="btn btn-danger">رد</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($door->hasPages())
                    <ul class="pagination pagination" style="display: flex">
                        {{-- Previous Page Link --}}
                        @if ($door->onFirstPage())
                            <li class="disabled"><span>«</span></li>
                        @else
                            <li><a href="{{ $door->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a>
                            </li>
                        @endif

                        @if ($door->currentPage() > 3)
                            <li class="hidden-xs"><a href="{{ $door->appends(request()->input())->url(1) }}">1</a> </li>
                        @endif
                        @if ($door->currentPage() > 4)
                            <li><span>...</span></li>
                        @endif
                        @foreach (range(1, $door->lastPage()) as $i)
                            @if ($i >= $door->currentPage() - 2 && $i <= $door->currentPage() + 2)
                                @if ($i == $door->currentPage())
                                    <li class="active"><span>{{ $i }}</span></li>
                                @else
                                    <li><a
                                            href="{{ $door->appends(request()->input())->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach
                        @if ($door->currentPage() < $door->lastPage() - 3)
                            <li><span>...</span></li>
                        @endif
                        @if ($door->currentPage() < $door->lastPage() - 2)
                            <li class="hidden-xs"><a
                                    href="{{ $door->url($door->lastPage()) }}">{{ $door->lastPage() }}</a>
                            </li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($door->hasMorePages())
                            <li><a href="{{ $door->appends(request()->input())->nextPageUrl() }}" rel="next">»</a>
                            </li>
                        @else
                            <li class="disabled"><span>»</span></li>
                        @endif
                    </ul>
                @endif
            </section>
        </div>
    </div>
@endsection
