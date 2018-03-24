<?php
session_start();
if (isset($_SESSION['customer_id'])) {
    header('location: index.php');
}

?>

  <!DOCTYPE html>

  <html xmlns="http://www.w3.org/1999/xhtml">
  <!--Head-->

  <head>
    <meta charset="utf-8" />
    <title>Noob Bank</title>

    <meta name="description" content="login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!--fontawesome-->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!-- <script defer src="assets/fonts/fontawesome/svg-with-js/js/fontawesome-all.js"></script> -->
    <!--Basic Styles-->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link id="beyond-link" href="css/login.css" rel="stylesheet" />
  </head>
  <!--Head Ends-->
  <!--Body-->

  <body>
    <div class="row">
      <div class="col-lg-3 col-lg-offset-1" style="padding-top:1%;">
        <div class="login-container animated fadeInDown">
          <div class="loginbox bg-white" style="padding:15px;">

            <div style="text-align: center;">
              <h1>NOOB BANK</h1>
              <a href="https://nottdev.com" target="_blank"><span>By NottDev</span></a>
            </div>
            <div class="loginbox-title" id="title">SIGN IN</div>

            <div class="loginbox-or">
              <div class="or-line"></div>
            </div>

            <div id="error_meessage" class="error-block"></div>

            <form method="post" id="form-login" data-toggle="validator" role="form" style="padding:15px;">
              <input name="action" type="hidden" value="signin" />
              <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-user f25"></i>
                  </span>
                  <input type="text" class="form-control" id="user" name="user" placeholder="Username" required data-error="Please Enter Username.">
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-lock f25"></i>
                  </span>
                  <input type="text" class="form-control" id="pass" name="pass" placeholder="Password" required data-error="Please Enter Password.">
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div style="padding: 15px 0; text-align: center;">
                <div id="sign_up" onclick="showSignUp()" style="display:inline-block; cursor:pointer;">SIGN UP &nbsp;|&nbsp; </div>
                <div id="forgot_password" style="display:inline-block; cursor:pointer;">Forgot Password</div>
              </div>

              <div class="loginbox-submit text-align-center">
                  <button type="submit" id="btn-signin" class="btn-noob">SIGN IN</button>
              </div>
              <!-- <div class="loginbox-submit"><center>or</center></div> -->
              <!-- <div class="loginbox-submit">
                  <center><div class="fb-login-button" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div></center>
                </div> -->
            </form>

            <form data-toggle="validator" role="form" id="form-signup" style="display:none; padding:15px;">
              <input name="action" type="hidden" value="signup" />


              <div class="form-group has-feedback">
                <input type="text" class="form-control"  name="username_signup"  pattern="^[_A-z ]{1,}$" data-minlength="3"  placeholder="Username" required data-error="Please Enter Username.">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control" pattern="^[_A-z ]{1,}$" data-minlength="3" name="firstname_signup" placeholder="Firstname" required data-error="Please Enter Firstname.">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group has-feedback">
                <input type="text" class="form-control"  name="lastname_signup"  pattern="^[_A-z ]{1,}$" data-minlength="3"  placeholder="Lastname" required data-error="Please Enter Lastname.">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-envelope-o"></i>
                  </span>
                  <input type="text" class="form-control" name="email_signup" placeholder="Email" pattern="^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$"  data-error="that email address is invalid" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </span>
                  <input type="text" class="form-control allownumericwithoutdecimal"  name="tel_signup"  pattern="^[0-9]{1,}$" data-minlength="9" maxlength="10" placeholder="Phone" required data-error="Please Enter Phone.">
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </span>
                  <input type="password" data-minlength="1" class="form-control" id="inputPassword" name="password_signup" placeholder="Password" required data-error="Please Enter Password.">
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>

              <div class="form-group has-feedback">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-lock"></i>
                  </span>
                  <input type="password" class="form-control" id="inputPasswordConfirm" name="confirm_password_signup" data-match="#inputPassword" data-error="Please Enter Confirm." data-match-error="These don't match"
                      placeholder="Confirm" required>
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors"></div>
              </div>


              <div style="padding:10px 0 25px 0; text-align: center;">
                <div id="sign_up" onclick="showSignIn()" style="display:inline-block; cursor:pointer;">
                  <i class="fa fa-undo" aria-hidden="true"></i> Go back to SIGN IN </div>
              </div>

              <div class="form-group text-align-center" style="margin-bottom: 0;">
                <button type="submit" class="btn-primary btn-noob" id="btn-signup">SIGN UP</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!--Basic Scripts-->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/validator.js"></script>
    <script src="js/login.js"></script>

    <style type="text/css">
      .loginbox-warning {
        padding: 0 40px;
      }

      .suucess {
        color: green;
      }

      .f25 {
        font-size: 22px !important;
      }
    </style>

  </body>
  <!--Body Ends-->

  </html>
