$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".category ul li").click(function (e) {
        if ($(e.target).find("div").css("display") == "none") {
            $(".category ul li").find("div").slideUp();
            $(e.target).find("div").slideDown();
        } else {
            $(e.target).find("div").slideUp();
        }
    });
    $(".fade-category-mobile").click(function (e) {
        $(".category").fadeIn();
    });
    $(".fade-category-mobile-cancel").click(function (e) {
        $(".category").fadeOut();
    });
    //==============forms================
    //==============forms================
    //==============forms================
    //==============forms================

    // ligin


    $(".login-butten").click(function () {
        loginFotm();
    });
    $(".mask , .cancelLogin ,.mines-score-door .cancel").click(function (e) {
        e.preventDefault();
        $(".login-form").animate({top: -300});
        $(".mines-score-door").fadeOut();
        $(".mask").fadeOut();
        $('.save-cont').fadeOut()
    });

    $("#phonLogin").keyup(function (e) {
        let phon = $("#phonLogin").val();
        if (!/^[0-9]*$/.test(phon) || phon.length < 11) {
            $("#phonLogin").css({borderColor: "red"});
        } else {
            $("#phonLogin").css({borderColor: "green"});
        }
    });

    $("#passwordLogin").keyup(function (e) {
        let password = $("#passwordLogin").val();
        if (password.length < 4) {
            $("#passwordLogin").css({borderColor: "red"});
        } else {
            $("#passwordLogin").css({borderColor: "green"});
        }
    });
    $("#passwordLogin  , #passwordLogin").keyup(function (e) {
        let phon = $("#phonLogin").val();
        let password = $("#passwordLogin").val();
        if (!/^[0-9]*$/.test(phon) || phon.length < 11 || password.length < 4) {
            $("#sendLogin").prop("disabled", true);
            $("#sendLogin").css({opacity: "50%"});
        } else {
            $("#sendLogin").prop("disabled", false);
            $("#sendLogin").css({opacity: "100%"});
        }
    });
    $(".loginForm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/user/loginUser",
            data: $(this).serialize(),
            success: function (response) {
                if (response == 1) {
                    alertSucsses("عملیات موفق");
                    if ($("#ckokiLogin").prop("checked")) {
                        setCookie("phonIbaladam", $("#phonLogin").val());
                        setCookie(
                            "passwordIbaladam",
                            $("#passwordLogin").val()
                        );
                    }
                    setTimeout(() => {
                        window.location.replace("/panel");
                    }, 2500);
                } else {
                    alertEore("شماره یا رمز عبور صحبح نمی باشد");
                }
            },
        });
    });
    $(".logout").click(function (e) {
        $.ajax({
            type: "post",
            url: "/user/logOutUser",
            data: "",
            success: function () {
                window.location.replace("/");
            },
        });
    });
    // ligin

    // regester
    $(".inpute-number-form").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            processData: false,
            contentType: false,
            url: "/user/sendPhon",
            data: formData,
            success: function (response) {
                if (response == 0) {
                    alertEore("خطا رخ داده لطفا اطلاعات را بررسی کنید");
                } else if (response == 1) {
                    var w = innerWidth;
                    var h = innerHeight;
                    $(".regester-first").fadeOut();
                    $(".regester-secend").fadeIn();
                    if (w >= 550) {
                        $(".mask").fadeIn();
                        $(".regester-form").css({left: (w - 300) / 2});
                        $(".regester-form")
                            .fadeIn()
                            .animate({
                                top: (h - 550) / 2,
                            });
                    } else {
                        $(".mask").fadeIn();
                        $(".regester-form").css({
                            left: (w - 300) / 2,
                            top: (h - 400) / 2,
                        });
                        $(".regester-form").fadeIn();
                    }
                } else if (response == "has") {
                    alertEore("شما قبلا ثبت نام کرده اید");
                    setTimeout(() => {
                        e.preventDefault();
                        $(".regester-form").animate({top: -600});
                        $(".mask").fadeOut();
                        $(".regester-secend").fadeOut();
                        setTimeout(() => {
                            $(".regester-first").fadeIn();
                            $(".regester-form").css({
                                width: "500px",
                                height: "550px",
                            });
                        }, 500);
                        var w = innerWidth;
                        var h = innerHeight;
                        if (w >= 450) {
                            $(".mask").fadeIn();
                            $(".login-form").css({left: (w - 310) / 2});
                            $(".login-form")
                                .fadeIn()
                                .animate({
                                    left: (w - 310) / 2,
                                    top: (h - 200) / 2,
                                });
                        } else {
                            $(".mask").fadeIn();
                            $(".login-form").css({
                                width: 310,
                                height: 200,
                                left: (w - 310) / 2,
                                top: (h - 600) / 2,
                            });
                            $(".login-form").fadeIn();
                        }
                    }, 1000);
                }
            },
        });
    });


    $(".regester-butten").click(function () {
        regesterForm();
    });
    $(".mask , .cancelRegester").click(function (e) {
        e.preventDefault();
        $(".regester-form").animate({top: -600});
        $(".mask").fadeOut();
        $(".regester-secend").fadeOut();
        setTimeout(() => {
            $(".regester-first").fadeIn();
        }, 500);
        setTimeout(() => {
            $(".regester-form").css({width: "300px", height: "150px"});
        }, 500);
    });
    $(".regester-first").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "post",
            processData: false,
            contentType: false,
            url: "/user/sendPhon",
            data: formData,
            success: function (response) {
                if (response == 0) {
                    alertEore("خطا رخ داده لطفا اطلاعات را بررسی کنید");
                } else if (response == 1) {
                    $(".regester-first").fadeOut();
                    var w = innerWidth;
                    var h = innerHeight;
                    setTimeout(() => {
                        $(".regester-secend").fadeIn();
                    }, 500);
                } else if (response == "has") {
                    alertEore("شما قبلا ثبت نام کرده اید");
                    setTimeout(() => {
                        e.preventDefault();
                        $(".regester-form").animate({top: -600});
                        $(".mask").fadeOut();
                        $(".regester-secend").fadeOut();
                        loginFotm();
                    }, 1000);
                }
            },
        });
    });
    $("#codeVerifySend").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/user/AuthStore",
            data: {code: $("#codeVerify").val()},
            success: function (response) {
                if (response == 0) {
                    alertEore("کد وارد شده اشتباه است");
                } else if (response == 1) {
                    $(".regester-secend").fadeOut();
                    var w = innerWidth;
                    var h = innerHeight;
                    setTimeout(() => {
                        $(".regester-3").fadeIn();
                        $(".regester-form").animate({
                            width: "300px",
                            height: "450px",
                            left: (w - 300) / 2,
                            top: (h - 650) / 2,
                        });
                    }, 500);
                }
            },
        });
    });

    $("#username").keyup(function (e) {
        let name = $("#username").val();
        if (!/^[a-zآ-یA-Z\s1-9]*$/.test(name)) {
            $("#username").css({borderColor: "red"});
            $("#regester").prop("disabled", true);
            $("#regester").css({opacity: "50%"});
        } else {
            $("#username").css({borderColor: "green"});
        }
    });
    $("#phon").keyup(function (e) {
        let phon = $("#phon").val();
        if (!/^[0-9]*$/.test(phon) || phon.length < 11) {
            $("#phon").css({borderColor: "red"});
        } else {
            $("#phon").css({borderColor: "green"});
        }
    });
    $("#password").keyup(function (e) {
        let password = $("#password").val();
        if (password.length < 4) {
            $("#password").css({borderColor: "red"});
            $("#regester").prop("disabled", true);
            $("#regester").css({opacity: "50%"});
        } else {
            $("#password").css({borderColor: "green"});
        }
    });
    $("#repassword").keyup(function (e) {
        let repassword = $("#repassword").val();
        if (
            repassword.length < 4 ||
            $("#password").val() != $("#repassword").val()
        ) {
            $("#repassword").css({borderColor: "red"});
            $("#password").css({borderColor: "red"});
            $("#regester").prop("disabled", true);
            $("#regester").css({opacity: "50%"});
        } else {
            $("#repassword").css({borderColor: "green"});
            $("#password").css({borderColor: "green"});
        }
    });
    $("#city").change(function (e) {
        let phon = $("#city").val();
        if (phon == "null") {
            $("#sendRegester").prop("disabled", true);
            $("#sendRegester").css({opacity: "50%"});
        } else {
            $("#sendRegester").prop("disabled", false);
            $("#sendRegester").css({opacity: "100%"});
        }
    });
    $("#phon").keyup(function (e) {
        let phon = $("#phon").val();
        if (phon.length < 11) {
            $("#sendRegester").prop("disabled", true);
            $("#sendRegester").css({opacity: "50%"});
        } else {
            $("#sendRegester").prop("disabled", false);
            $("#sendRegester").css({opacity: "100%"});
        }
    });

    $("#username , #password , #repassword").keyup(function (e) {
        let password = $("#password").val();
        let repassword = $("#repassword").val();
        let username = $("#username").val();
        if (
            repassword.length >= 4 &&
            password.length >= 4 &&
            password == repassword &&
            /^[a-zا-یA-Z\s]*$/.test(username)
        ) {
            $("#regester").prop("disabled", false);
            $("#regester").css({opacity: "100%"});
        } else {
            $("#regester").prop("disabled", true);
            $("#regester").css({opacity: "50%"});
        }
    });

    $(".regester-3").on("submit", function (e) {
        e.preventDefault();
        var data = {
            username: $("#username").val(),
            password: $("#password").val(),
            invider: $("#invider").val(),
            city: $("#city").val(),
        };
        $.ajax({
            type: "post",
            url: "/user/createUser",
            data: data,
            success: function (response) {
                if (response == 1) {
                    alertSucsses("عملیات موفق");
                    setTimeout(() => {
                        location.href = "/panel";
                    }, 2500);
                } else if (response == 0) {
                    alertEore("خطا رخ داده");
                } else if (response == "invider") {
                    alertEore("این شماره معرف وجود ندارد");
                } else if (response == "city") {
                    alertEore("شهر خود را انتخاب کنید");
                } else if (response == "username") {
                    alertEore("نام اجباری است");
                }
            },
        });
    });

    // regester

    // recet password
    $(".rect-passsword-button").click(function (e) {
        e.preventDefault();
        $(".login-form").animate({top: -300});
        var w = innerWidth;
        var h = innerHeight;
        if (w >= 450) {
            $(".mask").fadeIn();
            $(".recet-password-form").css({left: (w - 300) / 2});
            $(".recet-password-form")
                .fadeIn()
                .animate({
                    left: (w - 300) / 2,
                    top: (h - 550) / 2,
                });
        } else {
            $(".mask").fadeIn();
            $(".recet-password-form").css({
                width: 300,
                height: 200,
                left: (w - 300) / 2,
                top: (h - 400) / 2,
            });
            $(".recet-password-form").fadeIn();
        }
    });
    $(".mask ,.cancelRecetPassword").click(function (e) {
        e.preventDefault();
        $(".recet-password-form").animate({top: -300});
        $(".mask").fadeOut();
    });
    $("#phonRecetPassword").keyup(function (e) {
        if (
            $("#phonRecetPassword").val().length < 11 ||
            !/^[0-9]*$/.test($("#phonRecetPassword").val())
        ) {
            $("#sendRegester").prop("disabled", true);
            $("#sendRegester").css({opacity: "50%"});
            $("#phonRecetPassword").css({
                "border-color": "red",
                "border-width": "2px",
                "border-style": "solid",
            });
        } else {
            $("#RecetPassword").prop("disabled", false);
            $("#RecetPassword").css({opacity: "100%"});
            $("#phonRecetPassword").css({
                "border-color": "green",
                "border-width": "2px",
                "border-style": "solid",
            });
        }
    });
    $("#RecetPassword").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/user/recetUserPass",
            data: {phon: $("#phonRecetPassword").val()},
            success: function (response) {
                if (response == 1) {
                    $(".recet-password-first").fadeOut();
                    setTimeout(() => {
                        $(".recet-password-secend").fadeIn();
                    }, 500);
                } else {
                    alertEore("شماره صحیح نیست");
                }
            },
        });
    });
    $("#codeVerifyRecetPass").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/user/recetUserPassAuth",
            data: {code: $(".codeVerifyRecetPass").val()},
            success: function (response) {
                if (response == 1) {
                    alertSucsses(" عملیات موفق ");
                    setTimeout(() => {
                        window.location.href = "recetPassViwe";
                    }, 2500);
                } else {
                    alertEore("کد اشتباه است");
                }
            },
        });
    });

    // recet passwod

    //==============forms================
    //==============forms================
    //==============forms================
    //==============forms================

    // ========panel===========
    // ========panel===========
    // ========panel===========

    $(".tab-door-request button").click(function (e) {
        $(".tab-door-request button").removeClass("tab-door-request-activ");
        $(e.target).addClass("tab-door-request-activ");
        if (
            $(".tab-door-request button")
                .eq(0)
                .hasClass("tab-door-request-activ")
        ) {
            $(".container-request").css({display: "none"});
            $(".container-door").fadeIn();
        } else {
            $(".container-door").css({display: "none"});
            $(".container-request").fadeIn();
        }
    });
    $.ajax({
        type: "get",
        url: `getSubGrop/درخواست  خرید و استخدام`,
        processData: false,
        contentType: false,
        success: function (response) {
            $(".subgrops-select").empty();
            response.forEach((element) => {
                $(".subgrops-select").append(`
               <option value="${element.name}">${element.name}</option>
            `);
            });
        },
    });
    $(".grops-select-door").change(function (e) {
        e.preventDefault();
        $.ajax({
            type: "get",
            url: `getSubGrop/${$(".grops-select-door").val()}`,
            processData: false,
            contentType: false,
            success: function (response) {
                $(".subgrops-select-door").empty();
                response.forEach((element) => {
                    $(".subgrops-select-door").append(`
               <option value="${element.name}">${element.name}</option>
            `);
                });
            },
        });
    });
});

// ============doors============
// ============doors============
// ============doors============

var countDoor = 1;
var scrollLimitDoor = 500;
var city = 'تهران';
if ($(".userCity").text() != 0) {
    city = $(".userCity").text();
    $('.filter-city').val(city);
}else{
    $('.filter-city').val(city);
}
var price = null;
var search = null;
var checkedCategoryDoor = [];

function getDoors(countDoor, categoryDoor, city, price, search) {
    console.log(city)
    $.ajax({
        type: "get",
        url: `/getDoor/${countDoor}/${categoryDoor}/${city}/${price}/${search}`,
        processData: false,
        contentType: false,
        success: function (response) {
            response.forEach(function (res) {
                var see = res.see == 0 ? '' : "bg-warning-y";
                var save = res.save == 0 ? `<i  onclick="setmark(event,${res.id})"  class="fa fa-regular fa-bookmark"></i></span` : `<i onclick="unsetmark(event,${res.id})" class="fa fa-bookmark"></i></span`;
                img = res.img;
                if (res.img == "null") {
                    img = "";
                } else {
                    img = '<img class="image-door-cl" src="${res.title}"';
                }
                $(".list-pepole-list-door").append(`
                <li class="list-pepole-li-door ${see}" id=${res.id}>
                    <div class="door-item-cont">
                        <div class="topc-tetx">
                            <div style='color:red;font-weight:bold'>${res.title}</div>
                            <div class="discription">${res.topic}</div>${res.price == 0 ? "" : `<div>مژدگانی :<span style="color: red">${res.price} هزار تومان</span></div>`}
                        </div>${res.img == "null" ? "" : `<img class="image-door-cl" src="${res.img}" alt="">`}
                        <span class="pepole-date" style="color: black">${res.time}</span>
                    </div>
                    <button onclick="viweDoor(event,${res.id})" id="${res.id}" class="door-button">ورود</button><span style="color: black">${res.subgrops}</span><span class="fa fa-key"></span><span style="color: black">${save}
                </li>
             `);
            });
        },
    });
}

var viweDoor = (e, id) => {
    var doorHav = null;
    if ($(".user").attr("id") == 0) {
        alertEore("لطفا شماره همراه خود را جهت ثبت نام وارد کنید(در این سایت همه چی رایگان است)");
        regesterForm()
    } else if ($(".mines-score-door").attr("id") == 0) {
        alertEore("شما امتیاز کافی را ندارید هر کسی از طرف شما ثبت نام کند و شماره معرف را شماره همراه شما بزند ، به ازای هر معرف 100 امتیاز می گیرید");
    } else {
        $.ajax({
            type: "post",
            url: `/checkHavDoor/${id}`,
            success: function (response) {
                if (response == 1) {
                    id = $(".doorView").attr("id");
                    window.location.href = `/doorViwe/${id}`;
                } else {
                    $(".mask").fadeIn();
                    $(".mines-score-door").fadeIn();
                    if (response=='p') {
                        $(".password-door-input").fadeIn();
                    }
                }
            },
        });
        $(".doorView").attr("id", id);
    }
};
$(".doorView").click(function (e) {
    e.preventDefault();
    id = $(".doorView").attr("id");
    var password = $('.password-door-input input').val()
    $.ajax({
        type: "get",
        url: `doorViwe/${id}/${password}`,
        success: function (response) {
            if (response=='pass') {
                alertEore('پسورد صحیح نیست')
            }else{
                window.location.href=`doorViwe/${id}/${password}`;
            }
        }
    });
});

getDoors(countDoor, 0, city, price, search);

////================city==============
////================city==============
$(".filter-city").change(function (e) {
    city = $(".filter-city").val();
    $(".list-pepole-list-door").empty();
    scrollLimitDoor = 580;
    countDoor = 1;
    if (checkedCategoryDoor.length != 0) {
        getDoors(
            countDoor,
            JSON.stringify(checkedCategoryDoor),
            city,
            price,
            search
        );
    } else {
        getDoors(countDoor, 0, city, price, search);
    }
});
////================city==============
////================city==============

////================scroll==============
////================scroll==============
$(".list-pepole-list-door").scroll(function (e) {
    scrollPosition = $(".list-pepole-list-door").scrollTop();
    if (scrollPosition >= scrollLimitDoor) {
        scrollLimitDoor += 500;
        countDoor += 1;
        if (checkedCategoryDoor.length != 0) {
            getDoors(
                countDoor,
                JSON.stringify(checkedCategoryDoor),
                city,
                price,
                search
            );
        } else {
            getDoors(countDoor, 0, city, price, search);
        }
    }
});
////================scroll==============
////================scroll==============

////================category==============
////================category==============
$(".category-be").click(function () {
    checkedCategoryDoor = [];
    $(".list-pepole-list-door").scrollTop(0);
    for (
        let index = 0;
        index < document.getElementsByClassName("category-check").length;
        index++
    ) {
        if (document.getElementsByClassName("category-check")[index].checked) {
            checkedCategoryDoor.push(
                document.getElementsByClassName("category-check")[index].value
            );
        }
        if (checkedCategoryDoor.length != 0) {
            $(".list-pepole-list-door").empty();
            scrollLimitDoor = 580;
            countDoor = 1;
        }
    }
    getDoors(
        countDoor,
        JSON.stringify(checkedCategoryDoor),
        city,
        price,
        search
    );
    if (innerWidth<768){
        $('.category').fadeOut()
    }

});

////================category==============
////================category==============

////================price==============
////================price==============
$(".only-price").change(function (e) {
    if (e.target.checked == true) {
        price = true;
    } else {
        price = null;
    }
    $(".list-pepole-list-door").empty();
    scrollLimitDoor = 580;
    countDoor = 1;
    if (checkedCategoryDoor.length != 0) {
        getDoors(
            countDoor,
            JSON.stringify(checkedCategoryDoor),
            city,
            price,
            search
        );
    } else {
        getDoors(countDoor, 0, city, price, search);
    }
});

////================price==============
////================price==============

////================search==============
////================search==============

$(".search").submit(function (e) {
    e.preventDefault();
    text = $(e.target).find("input").val();
    if (text == "") {
        search = null;
    } else {
        search = text;
        $(".list-pepole-list-door").empty();
        scrollLimitDoor = 580;
        countDoor = 1;
        if (checkedCategoryDoor.length != 0) {
            getDoors(
                countDoor,
                JSON.stringify(checkedCategoryDoor),
                city,
                price,
                search
            );
        } else {
            getDoors(countDoor, 0, city, price, search);
        }
    }
});

////================search==============
////================search==============

//====== reset ======
$(".reset-all,.reset-all-cat").click(function (e) {''
    $('.category input').prop('checked',false);
    countDoor = 1;
    scrollLimitDoor = 500;
    price = null;
    search = null;
    city = 'تهران';
    if ($(".userCity").text() != 0) {
        city = $(".userCity").text();
        $('.filter-city').val(city);
    }else{
        $('.filter-city').val(city);
    }
    checkedCategoryDoor = [];
    $(".only-price").prop("checked", false);
    $(".search").find("input").val("");
    $(".list-pepole-list-door").empty();
    getDoors(countDoor, 0, city, price, search);
});

function setmark(e, id) {
    if ($('.user').attr('id') != 0) {
        var parentTime = id
        var user = $('.user').attr('id')
        $.ajax({
            type: "get",
            url: `/user/mark/${user}/${parentTime}`,
            success: function (response) {
                if (response == 1) {
                    $(e.target).removeClass('fa-regular');
                    $(e.target).attr('onclick', `unsetmark(event,${id})`);
                    alertSucsses('عملیات موفق',1500)
                }
            }
        });
    } else {
        alertEore('شما نام ثبت نکرده اید')
    }
}

function unsetmark(e, id) {
    var parentTime = id
    var user = $('.user').attr('id')
    $.ajax({
        type: "get",
        url: `/user/unmark/${user}/${parentTime}`,
        success: function (response) {
            if (response == 1) {
                $(e.target).addClass('fa-regular');
                $(e.target).attr('onclick', `setmark(event,${id})`);
                alertSucsses('عملیات موفق',1500)
            }
        }
    });
}

$('.remove-save-door').submit(function (e) {
    e.preventDefault()
    var url = $(e.target).attr('action')
    var parent = $(e.target).parents().filter('li')
    $.ajax({
        type: "get",
        url: url,
        success: function (response) {
            if (response == 1) {
                $(parent).remove()
                alertSucsses('عملیات موفق',1500)
            }
        }
    });
})
$('.save-shoe-btn').click(function (e) {
    $('.mask').fadeIn()
    $('.save-cont').fadeIn()
})
//====== reset ======
// ============doors============
// ============doors============
// ============doors============
