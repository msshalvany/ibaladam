@extends('admin.layout.layout')
@section('content')
    <section>
        <header class="panel-heading">
            لیست منو های اصلی وب سایت
        </header>
        <h3><b>تعداد کاربران : {{ $count }}</b></h3>
        <form action="{{ route('searchUser') }}" method="get">
            <div class="input-group">
                <input class="form-control" name="text" style="width: 200px" type="search">
                <button class="btn btn-info"> search</button>
            </div>
        </form>
        @if ($user->hasPages())
            <ul class="pagination pagination" style="display: flex">
                {{-- Previous Page Link --}}
                @if ($user->onFirstPage())
                    <li class="disabled"><span>«</span></li>
                @else
                    <li><a href="{{ $user->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a></li>
                @endif

                @if ($user->currentPage() > 3)
                    <li class="hidden-xs"><a href="{{ $user->appends(request()->input())->url(1) }}">1</a></li>
                @endif
                @if ($user->currentPage() > 4)
                    <li><span>...</span></li>
                @endif
                @foreach (range(1, $user->lastPage()) as $i)
                    @if ($i >= $user->currentPage() - 2 && $i <= $user->currentPage() + 2)
                        @if ($i == $user->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $user->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if ($user->currentPage() < $user->lastPage() - 3)
                    <li><span>...</span></li>
                @endif
                @if ($user->currentPage() < $user->lastPage() - 2)
                    <li class="hidden-xs"><a href="{{ $user->url($user->lastPage()) }}">{{ $user->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($user->hasMorePages())
                    <li><a href="{{ $user->appends(request()->input())->nextPageUrl() }}" rel="next">»</a></li>
                @else
                    <li class="disabled"><span>»</span></li>
                @endif
            </ul>
        @endif
        <table class="table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <td>نام</td>
                    <td>شماره همراه</td>
                    <td>شهر</td>
                    <td>وضعیت کاربر</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $item)
                    <tr>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->phon }}</td>
                        <td>{{ $item->city }}</td>
                        <td>
                            @if ($item->block == 0)
                                <form class="BlockUserForm" action="{{ route('BlockUser', ['user' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button class="btn btn-warning"><i style="color: white"
                                            class="fa fa-unlock"></i></button>

                                </form>
                            @else
                                <form class="unBlockUserForm" action="{{ route('unBlockUser', ['user' => $item->id]) }}"
                                    method="post">
                                    @csrf
                                    <button class="btn btn-danger"><i style="color: white"
                                            class="fa fa-cancel"></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if ($user->hasPages())
            <ul class="pagination pagination" style="display: flex">
                {{-- Previous Page Link --}}
                @if ($user->onFirstPage())
                    <li class="disabled"><span>«</span></li>
                @else
                    <li><a href="{{ $user->appends(request()->input())->previousPageUrl() }}" rel="prev">«</a></li>
                @endif

                @if ($user->currentPage() > 3)
                    <li class="hidden-xs"><a href="{{ $user->appends(request()->input())->url(1) }}">1</a></li>
                @endif
                @if ($user->currentPage() > 4)
                    <li><span>...</span></li>
                @endif
                @foreach (range(1, $user->lastPage()) as $i)
                    @if ($i >= $user->currentPage() - 2 && $i <= $user->currentPage() + 2)
                        @if ($i == $user->currentPage())
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="{{ $user->appends(request()->input())->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if ($user->currentPage() < $user->lastPage() - 3)
                    <li><span>...</span></li>
                @endif
                @if ($user->currentPage() < $user->lastPage() - 2)
                    <li class="hidden-xs"><a href="{{ $user->url($user->lastPage()) }}">{{ $user->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($user->hasMorePages())
                    <li><a href="{{ $user->appends(request()->input())->nextPageUrl() }}" rel="next">»</a></li>
                @else
                    <li class="disabled"><span>»</span></li>
                @endif
            </ul>
        @endif
    </section>
@section('js')
    <script>
        function loaded() {
            $('.messags-door').fadeIn()
            $('.loader').fadeOut()
        }

        $('.BlockUserForm').submit(function(e) {
            e.preventDefault();
            var form = $(this); // دسترسی به فرم مربوطه

            $('.conf-cont').animate({
                'margin-top': '-80px',
                'top': '50%'
            });

            $('.conf-cont-n').click(function() {
                $('.conf-cont').animate({
                    'top': '-150%'
                });
            });

            $('.conf-cont-y').click(function() {
                $('.conf-cont').animate({
                    'top': '-150%'
                });
                console.log(form);
                form.unbind('submit').submit(); // ارسال فرم
            });
        });
        $('.unBlockUserForm').submit(function(e) {
            e.preventDefault();
            var form = $(this); // دسترسی به فرم مربوطه

            $('.conf-cont').animate({
                'margin-top': '-80px',
                'top': '50%'
            });

            $('.conf-cont-n').click(function() {
                $('.conf-cont').animate({
                    'top': '-150%'
                });
            });

            $('.conf-cont-y').click(function() {
                $('.conf-cont').animate({
                    'top': '-150%'
                });
                console.log(form);
                form.unbind('submit').submit(); // ارسال فرم
            });
        });
    </script>
@endsection
@endsection
