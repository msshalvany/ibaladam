$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    var Script = (function () {
        jQuery("#sidebar .sub-menu > a").click(function () {
            var last = jQuery(".sub-menu.open", $("#sidebar"));
            last.removeClass("open");
            jQuery(".arrow", last).removeClass("open");
            jQuery(".sub", last).slideUp(200);
            var sub = jQuery(this).next();
            if (sub.is(":visible")) {
                jQuery(".arrow", jQuery(this)).removeClass("open");
                jQuery(this).parent().removeClass("open");
                sub.slideUp(200);
            } else {
                jQuery(".arrow", jQuery(this)).addClass("open");
                jQuery(this).parent().addClass("open");
                sub.slideDown(200);
            }
            var o = $(this).offset();
            diff = 200 - o.top;
            if (diff > 0) $("#sidebar").scrollTo("-=" + Math.abs(diff), 500);
            else $("#sidebar").scrollTo("+=" + Math.abs(diff), 500);
        });
    })();

    var rols = [];
    $(document).ready(function () {
        rols = JSON.parse($(".rols-input").val());
        $(".rols-btn").click(function (e) {
            e.preventDefault();
            if ($(".rols").val() != "") {
                $(".cover-rols").append(`
            <span class='rol'>${$(
                ".rols"
            ).val()}<span onclick="removeRols(event)"><i style="margin: 0 5px 0 0;cursor: pointer" class="icon-trash"></i></span></span>
       `);
                rols.push($(".rols").val());
                $(".rols").val("");
                $(".rols-input").val(JSON.stringify(rols));
            }
        });
    });
    $(".mesege-reject").click(function (e) {
        $(".text-reject").text($(e.target).next().text());
    });
    function removeRols(e) {
        var rolTar = $(e.target).parent().parent().text();
        var index = rols.indexOf(rolTar);
        if (index !== -1) {
            rols.splice(index, 1);
            $(".rols-input").val(JSON.stringify(rols));
            $(e.target).parent().parent().remove();
        }
    }
    $(".icon-reorder").click(function (e) {
        $(".nav-collapse ").toggle();
    });

    var wordReg = [];

    $(".wordsReg-btn").click(function (e) {
        e.preventDefault();
        if ($(".wordsReg").val() != "") {
            $(".cover-wordsReg").append(`
        <span class='rol'>${$(
            ".wordsReg"
        ).val()}<span onclick="removeWordsReg(event)"><i style="margin: 0 5px 0 0;cursor: pointer" class="icon-trash"></i></span></span>
   `);
            wordReg.push($(".wordsReg").val());
            $(".wordsReg").val("");
            $(".wordsReg-input").val(JSON.stringify(wordReg));
        }
    });

    function removeWordsReg(e) {
        var wordsRegTar = $(e.target).parent().parent().text();
        var index = wordReg.indexOf(wordsRegTar);
        if (index !== -1) {
            wordReg.splice(index, 1);
            $(".wordsReg-input").val(JSON.stringify(wordReg));
            $(e.target).parent().parent().remove();
        }
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".pined").change(function (e) {
        id = $(e.target).attr("id");
        var val = $(e.target).attr("checked") ? 1 : 0;
        console.log(val);
        $.ajax({
            type: "post",
            url: `http://127.0.0.1:8000/dashbord/pinDoor/${id}/${val}`,
            success: function (response) {
               location.href=location.pathname
            },
        });
    });
});
