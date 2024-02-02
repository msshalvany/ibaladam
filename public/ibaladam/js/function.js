function alertSucsses(text,time=3500) {
    if ($(".alert-erore").length || $(".alert-sucsses").length) {
        if ($(".alert-sucsses").length) {
            $(".alert-sucsses").animate({ top: -140 }, 600);
            setTimeout(() => {
                $(".alert-sucsses").remove();
            }, 1500);
        } else {
            $(".alert-erore").animate({ top: -140 }, 600);
            setTimeout(() => {
                $(".alert-erore").remove();
            }, 1500);
        }
    }
    $("body").append(`
            <div class="alert-sucsses">${text}</div>
        `);
    $(".alert-sucsses").animate({top: 8,}, 600, function () {
            setTimeout(() => {
                $(".alert-sucsses").animate({ top: -140 }, 600);
            }, time);
        }
    );
    setTimeout(() => {
        $(".alert-sucsses").remove();
    }, time+2000);
}

function alertEore(text,time=3500) {
    if ($(".alert-sucsses").length || $(".alert-erore").length) {
        if ($(".alert-sucsses").length) {
            $(".alert-sucsses").animate({ top: -140 }, 600);
            setTimeout(() => {
                $(".alert-sucsses").remove();
            }, 1500);
        } else {
            $(".alert-erore").animate({ top: -140 }, 600);
            setTimeout(() => {
                $(".alert-erore").remove();
            }, 1500);
        }
    }
    $("body").append(`
            <div class="alert-erore">${text}</div>
        `);
    $(".alert-erore").animate(
        {
            top: 8,
        },
        600,
        function () {
            setTimeout(() => {
                $(".alert-erore").animate({ top: -140 }, 600);
            }, time);
        }
    );
    setTimeout(() => {
        $(".alert-erore").remove();
    }, time+2000);
}

var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    ll = selElmnt.length;
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < ll; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function (e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y =
                        this.parentNode.getElementsByClassName(
                            "same-as-selected"
                        );
                    yl = y.length;
                    for (k = 0; k < yl; k++) {
                        y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function (e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}

function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x,
        y,
        i,
        xl,
        yl,
        arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    xl = x.length;
    yl = y.length;
    for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i);
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}

/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

function setCookie(cname, cvalue) {
    document.cookie = cname + "=" + cvalue + ";";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

loginCkoki = () => {
    if (getCookie("phonIbaladam") && getCookie("passwordIbaladam")) {
        $.ajax({
            type: "post",
            url: "user/loginUser",
            data: {
                phon: getCookie("phonIbaladam"),
                password: getCookie("passwordIbaladam"),
            },
            success: function (response) {
                if (response != 1) {
                    alertEore("در کوکی شما مشکل رخ داده");
                }
            },
        });
    }
};
var popInfo = (text) => {
    $(".pop-info").animate({
        top: "100%",
    });
    $(".pop-info div").html("");
    $(".pop-info div").html(text);
    $(".cancel-pop-info").click(function (e) {
        e.preventDefault();
        $(".pop-info").animate({
            top: "20%",
        });
    });
};
$(".conf-form").submit(function (e) {
    e.preventDefault()
    $(".conf-cont").animate({
        top: "110%",
    });

    $(".conf-cont-n").click(function () {
        $(".conf-cont").animate({
            top: "40%",
        });
    });

    $(".conf-cont-y").click(function () {
        if (isRequestRunning) {
            return; // در صورتی که درخواست در حال اجرا باشد، اجرای مجدد را متوقف کنید
        }
        e.target.submit()
        isRequestRunning = true; // تنظیم پرچم برای نشان دادن اجرای درخواست
    });
});

function loginFotm() {
    var w = innerWidth;
    var h = innerHeight;
    if (w >= 450) {
        $(".mask").fadeIn();
        $(".login-form").css({left: (w - 310) / 2});
        $(".login-form")
            .fadeIn()
            .animate({
                left: (w - 310) / 2,
                top: (h - 500) / 2,
            });
    } else {
        $(".mask").fadeIn();
        $(".login-form").css({
            width: 310,
            height: 200,
            left: (w - 310) / 2,
            top: (h - 500) / 2,
        });
        $(".login-form").fadeIn();
    }
}
function regesterForm() {
    var w = innerWidth;
    var h = innerHeight;
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
}
