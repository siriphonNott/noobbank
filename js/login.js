$('#form-login').validator().submit(function (event) {
  if (event.isDefaultPrevented()) {} else {
    event.preventDefault();
    set_btn_loading('btn-signin');
    setTimeout(() => {
      sign_in();
    }, 2000);
  }
});

function sign_in() {
  var $form = $('#form-login');
  var serializedData = $form.serializeArray();
  var json = serializeToJson(serializedData, true);
  var username = $('#username').val();
  var password = $('#password').val();

  $.ajax({
    type: 'POST',
    url: 'api/auth.php',
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    data: JSON.stringify(json),
    success: function (data, textStatus, jqXHR) {
      if (jqXHR.responseJSON.statusMessage == 'CORRECT_LOGIN') {
        reset_btn_loading('btn-signin', 'SIGN IN');
        $(location).attr('href', './');
      }
    },
    error: function (jqXHR, textStatus, statusText) {
      reset_btn_loading('btn-signin', 'SIGN IN');
      if (jqXHR.responseJSON.errorMessage == "INCORRECT_LOGIN") {
        var errorMessage = "Username or Password is invalid.";
      }
      $('.form-group').has('#user').addClass("has-error");
      $('.form-group').has('#pass').addClass("has-error");
      $('#form-login .glyphicon').removeClass("glyphicon-ok");
      $('#form-login .glyphicon').addClass("glyphicon-remove");
      $('#error_meessage').text(errorMessage);
    }
  });
}

function reset_btn_loading(id, text = '') {
  $('#' + id).html(text);
}

function set_btn_loading(id, text = '') {
  $('#' + id).html('<i class="fa fa-refresh fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> Loading..');
}

function serializeToJson(data, obj = false) {
  var result = {};
  var temp_spilt = {};
  if (obj) {
    for (i in data) {
      result[data[i].name] = data[i].value;
    }
    return result;
  } else {
    var list = data.split("&");
    for (i in list) {
      temp_spilt = list[i].split("=");
      result[temp_spilt[0]] = temp_spilt[1];
    }
    return result;
  }
}

$('#form-signup').validator().submit(function (event) {
  if (event.isDefaultPrevented()) {
    console.log('invalid--signup');
  } else {
    event.preventDefault();
    set_btn_loading('btn-signup');
    setTimeout(() => {
      sign_up();
    }, 2000);
  }
});

function sign_up() {
  var $form = $('#form-signup');
  var serializedData = $form.serializeArray();
  var json = serializeToJson(serializedData, true);

  $.ajax({
    type: 'POST',
    url: 'api/auth.php',
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    data: JSON.stringify(json),
    success: function (data, textStatus, jqXHR) {
      if (data.statusMessage == 'CREATED_SUCCESS') {
        $("#error_meessage").addClass("success");
        $('#error_meessage').html('<i class="fa fa-check-circle"></i> Successfully Signed Up!');
        setTimeout(function () {
          showSignIn();
          $('#form-signup')[0].reset();
        }, 2000);
      }
    },
    error: function (jqXHR, textStatus, statusText) {
      reset_btn_loading('btn-signup', 'SIGN UP');
      var textResponse = 'Please check your infomation again.';
      if (jqXHR.responseJSON.errorMessage == 'DUPLICATE_ENTRY') {
        textResponse = 'Your email is already in use.';
      } else if (jqXHR.responseJSON.errorMessage == 'INVALID_FORMAT_EMAIL') {
        textResponse = 'Your email is wrong format.';
      } else if (jqXHR.responseJSON.errorMessage == 'INVALID_SMTP_EMAIL') {
        textResponse = 'This email does not exist.';
      } else if (jqXHR.responseJSON.errorMessage == 'CREATED_FAIL') {
        textResponse = 'Sorry! System malfunction.<br> Please contand admin.';
      } else {
        textResponse = jqXHR.responseJSON.errorMessage;
      }
      $('#error_meessage').text(textResponse);
    }
  });
}

function showSignIn() {
  $('#title').text('SIGN IN');
  $('#form-login').fadeIn("slow");
  $('#form-signup').hide();
  $('#error_meessage').text('');
  $('#error_meessage').hide();
  $('#error_meessage').show();
  $("#error_meessage").removeClass("success");
}

function showSignUp() {
  $('#title').text('SIGN UP');
  $('#form-signup').fadeIn("slow");
  $('#form-login').hide();
  $('#error_meessage').text('');
  $('#error_meessage').hide();
  $('#error_meessage').show();
}

function maxLengthCheck(object) {
  if (object.value.length > object.maxLength)
    object.value = object.value.slice(0, object.maxLength)
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

// allow numeric with decimal.
$(".allownumericwithdecimal").on("keypress keyup blur", function (event) {
  //this.value = this.value.replace(/[^0-9\.]/g,'');
  $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    event.preventDefault();
  }
});

// Allow numeric without decimal.
$(".allownumericwithoutdecimal").on("keypress keyup blur", function (event) {
  $(this).val($(this).val().replace(/[^\d].+/, ""));
  if ((event.which < 48 || event.which > 57)) {
    event.preventDefault();
  }
});