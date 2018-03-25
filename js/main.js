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

function logout() {
  $.ajax({
    type: 'POST',
    url: 'api/auth.php',
    contentType: "application/json; charset=utf-8",
    data: JSON.stringify({
      action: 'logout'
    }),
    success: function (re) {
      $(location).attr('href', './login.php');
    }
  });
}

function close_modal(id) {
  $('#' + id).fadeOut();
  clear_status('transfer');
  clear_status('fund');
  clear_border();
}


$('#transfer-submit').click(function () {
  var $form = $('#transfer-form');
  var serializedData = $form.serializeArray();
  var json = serializeToJson(serializedData, true);
  clear_border();
  if (json.account_number_des == "") {
    $('#status_meessage_transfer').addClass('error').html('<i class="fa fa-times-circle"></i> Enter To Amount Number');
    $('#account_transfer').addClass('error-border');
  } else if (json.amount_transfer == "") {
    $('#status_meessage_transfer').addClass('error').html('<i class="fa fa-times-circle"></i> Enter Amount');
    $('#amount_transfer').addClass('error-border');
  } else {
    clear_status('transfer');

    $.ajax({
      type: 'POST',
      url: 'api/services.php',
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      data: JSON.stringify(json),
      success: function (data, textStatus, jqXHR) {
        if (data.statusMessage == 'TRANS_SUCCESS') {
          $("#status_meessage_transfer").addClass("success");
          $('#status_meessage_transfer').html('<i class="fa fa-check-circle"></i> Successfully Transfered!');
          setTimeout(function () {
            clear_status('transfer');
            $('#transfer-form')[0].reset();
            location.reload();
          }, 2000);
        }
      },
      error: function (jqXHR, textStatus, statusText) {
        var textResponse = 'Please check your infomation again.';
        if (jqXHR.responseJSON.errorMessage == 'NOT_FOUND_ACCOUNT_NO') {
          textResponse = ' Not found Account Number.';
        } else if (jqXHR.responseJSON.errorMessage == 'INVALID_ACCOUNT_NO') {
          textResponse = ' Account Number is invalid.';
        } else if (jqXHR.responseJSON.errorMessage == 'INSUFFICIENT_AMOUNT') {
          textResponse = ' Your balance is not enough..';
        }
        $('#status_meessage_transfer').addClass('error').html(' <i class="fa fa-times-circle"></i>' + textResponse);
      }
    });
  }
});

function clear_border() {
  $('#amount_transfer').removeClass('error-border');
  $('#account_transfer').removeClass('error-border');
  $('[name=fund_unit]').removeClass('error-border');
}

function clear_status(name) {
  $('#status_meessage_' + name).text('');
  $('#status_meessage_' + name).removeClass('error');
  $('#status_meessage_' + name).removeClass('success');
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


$("[name=fund_unit]").keyup(function () {
  var temp_unit = $('[name=fund]').val();
  var unit = temp_unit.split(',');
  var result = this.value * unit[1];
  $('[name=fund_cost]').val(parseInt(result));
});

$('#fund-submit').click(function () {
  var $form = $('#fund-form');
  var serializedData = $form.serializeArray();
  var json = serializeToJson(serializedData, true);
  console.log(json);
  clear_border();
  if (json.fund_unit == '') {
    $('[name=fund_unit]').addClass('error-border');
    $('#status_meessage_fund').addClass('error');
    $('#status_meessage_fund').html(' <i class="fa fa-times-circle"></i> Please Enter unit');
  } else {
    clear_status('fund');
    $.ajax({
      type: 'POST',
      url: 'api/services.php',
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      data: JSON.stringify(json),
      success: function (data, textStatus, jqXHR) {
        if (data.statusMessage == 'FUND_SUCCESS') {
          $("#status_meessage_fund").addClass("success");
          $('#status_meessage_fund').html('<i class="fa fa-check-circle"></i> Successfully Purchase!');
          setTimeout(function () {
            clear_status('fund');
            $('#fund-form')[0].reset();
            location.reload();
          }, 2000);
        }
      },
      error: function (jqXHR, textStatus, statusText) {
        console.log(jqXHR);
        var textResponse = 'Please check your infomation again.';
        if (jqXHR.responseJSON.errorMessage == 'INSUFFICIENT_AMOUNT') {
          textResponse = ' <i class="fa fa-times-circle"></i> Your balance is not enough..';
        }
        $('#status_meessage_fund').addClass('error');
        $('#status_meessage_fund').html(textResponse);
      }
    });
  }
});