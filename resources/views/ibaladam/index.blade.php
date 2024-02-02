@extends('ibaladam.layout.layout')
@section('keyWord')
    {{ $info->keyWord }}
@endsection
@section('css')
    .back-home {
    display: none
    }
    .score-nav{
    display: inline;
    }
@endsection

@section('section')
    <picture>
        <source width="100%" media="(max-width:650px)" srcset="/ibaladam/img/009.jpg"/>
        <img width="100%" src="/ibaladam/img/004.jpg" alt=""/>
    </picture>
    <div class="list-result">
        <div class="category">
            <span class="fade-category-mobile-cancel"><i class="fa fa-times"></i></span>
            <ul>
                @foreach ($grop as $item)
                    <li>
                        <i class="fa {{ $item->icon }}"></i>{{ $item->name }}
                        <div>
                            @foreach ($item->subGrop as $item2)
                                <label class="container-ch">{{ $item2 }}
                                    <input class="category-check" value="{{ $item2 }}" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            @endforeach
                        </div>
                    </li>
                @endforeach
            </ul>
            <button class="category-be">اعمال دسته بندی</button>
            <button class="reset-all-cat base-btn mt-2 w-100 fw-bold">ریست دسنه بندی</button>
        </div>
        <div class="result-list">
            <div class="list-pepole">
                <div class="filters2">
                    <div class="search-ref-con">
                        <form autocomplete="off" action="" class="search">
                            <input type="text" placeholder="دنبال چه کلمه ای می گردی ؟ سرچ کن  ... "/>
                            <button><i class="fab fa-sistrix"></i></button>
                        </form>
                        <div>
                            <button class="reset-all base-btn"><i class="fa fa-refresh"></i></button>
                        </div>
                    </div>
                    <div class="filters">
                        <div class="fade-category-mobile base-btn" style="padding: 4px 8px ">
                            {{--                            <i class="fa fa-bars"></i>--}}
                            دسته بندی
                        </div>
                        <div>
                            <select name="city" class="filter-city">
                                <option value="آذربایجان شرقی">آذربایجان شرقی</option>
                                <option value="آذربایجان غربی">آذربایجان غربی</option>
                                <option value="اردبیل">اردبیل</option>
                                <option value="اصفهان">اصفهان</option>
                                <option value="البرز">البرز</option>
                                <option value="ایلام">ایلام</option>
                                <option value="بوشهر">بوشهر</option>
                                <option value="تهران" selected>تهران</option>
                                <option value="چهارمحال بختیاری">چهارمحال بختیاری</option>
                                <option value="خراسان جنوبی">خراسان جنوبی</option>
                                <option value="خراسان رضوی">خراسان رضوی</option>
                                <option value="خراسان شمالی">خراسان شمالی</option>
                                <option value="خوزستان">خوزستان</option>
                                <option value="زنجان">زنجان</option>
                                <option value="سمنان">سمنان</option>
                                <option value="سیستان و بلوچستان">سیستان و بلوچستان</option>
                                <option value="فارس">فارس</option>
                                <option value="قزوین">قزوین</option>
                                <option value="قم">قم</option>
                                <option value="کردستان">کردستان</option>
                                <option value="کرمان">کرمان</option>
                                <option value="کرمانشاه">کرمانشاه</option>
                                <option value="کهکیلویه و بویراحمد">کهکیلویه و بویراحمد</option>
                                <option value="گلستان">گلستان</option>
                                <option value="گیلان">گیلان</option>
                                <option value="لرستان">لرستان</option>
                                <option value="مازندران">مازندران</option>
                                <option value="مرکزی">مرکزی</option>
                                <option value="هرمزگان">هرمزگان</option>
                                <option value="همدان">همدان</option>
                                <option value="یزد">یزد</option>
                            </select>
                        </div>
                        <div>
                            <label class="container-ch">
                                 فقط مژدگانی ها
                                <input class="only-price" type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        {{-- <button class="sub-filter">اعمال فلتر</button> --}}
                    </div>
                </div>
                <div class="container-door">
                    @if ($pinDoor)
                        <div class="pined-request">
                            <div class="pin-door-con">
                                <div class="topc-tetx">
                                    <div>
                                        <div>{{ $pinDoor->title }}</div>
                                        <div class="discription">{{ $pinDoor->topic }}</div>
                                        @if($pinDoor->price!=0)
                                            <div>مژدگانی :<span style="color: red">{{$pinDoor->price}} هزار تومان</span>
                                            </div>
                                        @endif
                                        <i style="transform:rotate(30deg);" class="fa fa-map-pin"></i>اتاق پین شده نمایش در همه استانها . برای پین شده اتاق ، تیکت بزنید
                                        <br>
                                    </div>
                                </div>
                                @if ($pinDoor->img != 'null')
                                    <img class="image-door-cl" src="{{ $pinDoor->img }}" alt="">
                                @endif
                                <span class="pepole-date" style="color: black">{{ $pinDoor->time }}</span>
                            </div>
                            <button onclick="viweDoor({{ $pinDoor->id }},{{$pinDoor->id}})" class="door-button">ورود
                            </button>
                            <span
                                style="color: black">{{ $pinDoor->grops }}-{{ $pinDoor->subgrops }} -
                                {{ $pinDoor->city }}</span>
                        </div>
                    @endif
                    <div>
                        <ul class="list-pepole-list-door">
                            {{-- <li class="list-pepole-li-door">
                                <div>
                                    <div class="topc-tetx">
                                        <div>topic</div>
                                        <div class="discription">sasasam asdas asdasdd</div>
                                        <div>مژدگانی :<span style="color: red">2500 تومان</span></div>
                                    </div>
                                    <img src="" alt="">
                                    <span class="pepole-date" style="color: black">1401-12-23 23:46:01</span>
                                </div>
                                <button onclick="" id="" class="door-button">ورود</button><span
                                    style="color: black">درخواست خرید و استخدام-درخواست استخدام</span>
                            </li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
