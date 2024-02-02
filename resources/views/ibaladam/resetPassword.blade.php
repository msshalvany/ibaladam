<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="" type="image/x-icon" />
    <link rel="stylesheet" href="/ibaladam/css/style.css" />
    <title>baladam</title>
    <style>
      form {
        width: 62%;
        margin: 200px auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 12px black;
      }
      form * {
        margin: 10px 0 0 0;
      }
      input[type="submit"] {
        background-color: rgb(6, 106, 255);
        transition: all 0.2s;
        color: white;
        padding: 6px 8px;
        border-radius: 8px;
          border: unset;
      }
      input[type="submit"]:hover{
        transform: scale(1.05);
      }
      button{
        background-color: rgb(255, 41, 41);
        transition: all 0.2s;
        color: white;
        padding: 6px 8px;
        border-radius: 8px;
          border: unset;
      }
      button:hover{
        transform: scale(1.05);
      }
    </style>
  </head>
  <body>
    <form autocomplete="off" action="user/recetUserPsswordEnd" class="recetPass" method="POST">
      @csrf
      <label for="password">رمز جدید:</label>
      <input name="password" id="password" type="password" placeholder="حد اقل 6 کاراکتر" /><br><br>
      <label for="repassword">مجددا وارد کتید:</label>
      <input name="repassword" id="repassword" type="password" /><br><br>
      <input type="submit" value="انجام تغیرات" />
      <button>انصراف</button>
    </form>
  </body>
</html>
<script src="/ibaladam/js/jquery.js"></script>
<script src="/ibaladam/js/function.js"></script>
<script>
  $('button').click(function (e) {
    e.preventDefault();
  });
  $('#password').keyup(function (e) {
    let password = $('#password').val();
    if (password.length < 5) {
      $('#password').css({ borderColor: "red" });
    } else {
      $('#password').css({ borderColor: "green" });
    }
  });
  $('#repassword').keyup(function (e) {
    let repassword = $('#repassword').val();
    if (repassword.length < 5 || $('#password').val() != $('#repassword').val()) {
      $('#repassword').css({ borderColor: "red" });
      $('#password').css({ borderColor: "red" });
    } else {
      $('#repassword').css({ borderColor: "green" });
      $('#password').css({ borderColor: "green" });
    }
  });
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.recetPass').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        console.log(formData);
        $.ajax({
            type: "post",
            processData: false,
            contentType: false,
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
              console.log(response);
                if (response == 0) {
                    alertEore('خطا رخ داده لظفا اطلاعات را برسسی کنید')
                } else {
                    alertSucsses('عملیات موفق')
                    setTimeout(() => {
                        window.location.replace('/panel')
                    }, 3000);
                }
            }
        });
    });
</script>
