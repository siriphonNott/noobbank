<?php

require_once 'service/checkAuth.php';
require_once 'app/model/autoload.php';

use Model\Fund;
use Model\Member;
use Utility\Utility;

$member = new Member();
$user_info_obj = $member->getData($_SESSION['customer_id']);
$user_info = $user_info_obj['rows'][0];

$fund = new Fund();
$fund_obj = $fund->getData($_SESSION['customer_id']);
$funds = $fund_obj['rows'];
$total_fund = $fund_obj['total'];

$utility = new Utility();
$count = 0;

function getNameFund($id)
{
    switch ($id) {
        case 1:
            return "กองทุนปันผล 20% ต่อปี";
            break;
        case 2:
            return "กองทุน Super risk";
            break;
        case 3:
            return "กองทุน Super save";
            break;
        case 4:
            return "กองทุน long term";
            break;
        default:
            break;
    }
}

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.ico">
    <title>Noob Bank</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/noobbank.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dataTable.css" rel="stylesheet">
    <!-- <link href="css/main.css" rel="stylesheet"> -->
    <!--fontawesome-->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />

    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
  </head>

  <body>
    <!-- Preloader -->
    <div class="preloader">
      <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
      <!-- Navigation -->
      <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header" style="box-shadow:-7px 3px 12px 0px rgba(100, 100, 100,0.8)">
          <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
            <i class="fa fa-bars"></i>
          </a>
          <div class="top-left-part">
            <a class="logo" href="./">
              <b>
                <img src="img/logo2.png" alt="home" />
              </b>
              <span class="hidden-xs">Noob Bank</span>
            </a>
          </div>
          <ul class="nav navbar-top-links navbar-left m-l-20 hidden-xs">
            <li>
              <form role="search" class="app-search hidden-xs">
                <input type="text" placeholder="Search..." class="form-control">
                <a href="">
                  <i class="fa fa-search"></i>
                </a>
              </form>
            </li>
          </ul>
          <ul class="nav navbar-top-links navbar-right pull-right">
            <li>
              <a class="profile-pic" data-toggle="dropdown" aria-expanded="false">
                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle">
                <b class="hidden-xs">
                  <?=$_SESSION['firstname'] . ' ' . $_SESSION['lastname']?>
                </b>
              </a>
              <ul class="dropdown-menu">
                <!-- <li class="">
								<a href="">
									Setting
								</a>
							</li> -->
                <li class="dropdown-footer">
                  <a href="#">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit profile
                  </a>
                  <a href="javascript:logout()">
                  <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
      </nav>
      <!-- Left navbar-header -->
      <!-- Page Content -->
      <div id="page-wrapper">
        <div class="container-fluid">
          <div class="row bg-title">
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-4 center">
            <h4 class="page-title" style="cursor:pointer;"><a href="./">หน้าหลัก</a></h4>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-4 center active-menu">
              <h4 class="page-title" style="cursor:pointer;"><a href="">กองทุน</a></h4>
            </div>
            <!-- /.col-lg-12 -->
          </div>
          <!-- row -->
          <div class="row">
            <!--col -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="white-box">
                <div class="row">
                  <div class="col-md-4 col-sm-6 col-xs-6">
                    <i data-icon="E" class="linea-icon linea-basic"></i>
                    <h5 class="text-muted vb">ชื่อเจ้าของบัญชี </h5>
                  </div>
                  <div class="col-md-8 col-sm-6 col-xs-6">
                    <h5 class="counter text-right  text-danger">
                      <?=$user_info['firstname'] . ' ' . $user_info['lastname'];?>
                    </h5>
                  </div>
                </div>
                <div class="col-in row">
                  <div class="col-md-4 col-sm-6 col-xs-6">
                    <i data-icon="E" class="linea-icon linea-basic"></i>
                    <h5 class="text-muted vb">เลขที่บัญชี </h5>
                  </div>
                  <div class="col-md-8 col-sm-6 col-xs-6">
                    <h5 class="counter text-right  text-danger">
                      <?=$utility->format_account_no($user_info['account_no']);?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <!--col -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="white-box">
                <div class="col-in row">
                  <div class="col-md-5 col-sm-6 col-xs-6">
                    <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                    <h4 class="text-muted vb">ยอดเงินในกองทุน</h4>
                  </div>
                  <div class="col-md-7 col-sm-6 col-xs-6 fz-40">
                    <h4 class="counter text-right text-megna"><?=number_format($total_fund, 2);?>฿</h4>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="progress">
                      <div class="progress-bar progress-bar-megna" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                        style="width: 33%">
                        <span class="sr-only">40% Complete (success)</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <!--col -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="white-box">
                <div class=" row">
                  <div class="col-md-4 col-sm-6 col-xs-6">
                    <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                    <button class="btn btn-success" onclick="document.getElementById('id02').style.display='block'"> ซื้อกองทุน</button>
                  </div>
                  <div class="col-md-8 col-sm-6 col-xs-6">
                    <h5 class="counter  text-primary">สามารถซื้อกองทุนเพิ่ม เพื่อลงทุนกองทุนอื่นๆ ที่สนใจ</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-sm-6 col-xs-6">
                    <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                    <button class="btn btn-success"  onclick="javascript:alert('ขออภัยค่ะ ขณะนี้ระบบการขายไม่สามารถใช้งานได้ชั่วคราว :( ')" >ขายกองทุน</button>
                  </div>
                  <div class="col-md-8 col-sm-6 col-xs-6">
                    <h5 class="counter  text-primary">สามารถขายกองทุนออกเพื่อทำกำไร</h5>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
          <!--row -->
          <!--row -->
          <div class="row">
            <div class="col-sm-12">
              <div class="white-box">
                <h1 class="box-title">รายการซื้อ-ขาย กองทุน
                  <div class="col-md-2 col-sm-4 col-xs-12 pull-right">
                    <!-- <select class="form-control pull-right row b-none">
												<option>March 2016</option>
												<option>April 2016</option>
												<option>May 2016</option>
												<option>June 2016</option>
												<option>July 2016</option>
											</select> -->
                  </div>
                  </h3>
                  <div class="table-responsive">
                    <div class="tile-body">
                      <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                          <tr>
                            <th>ลำดับ</th>
                            <th>ประเภทรายการ</th>
                            <th>กองทุน</th>
                            <th>วันที่ทำรายการ</th>
                            <th>จำนวนหน่วย</th>
                            <th>ราคา ณ ที่ซื้อ/หน่วย</th>
                            <th>ราคาปัจจุบัน/หน่วย</th>
                            <th>สุทธิ ณ ที่ซื้อ</th>
                            <th>สุทธิปัจจุบัน</th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($funds as $value) {
    $count++;
    $class = 'receive';
    $type = 'ซื้อ';
    echo '<tr  class="' . $class . '">
                            <td>' . $count . '</td>
                            <td>' . $type . '</td>
                            <td>' . getNameFund($value['fund_type']) . '</td>
                            <td>' . date_format(date_create($value['created_at']), "d/m/Y H:i:s") . '</td>
                            <td>' . $value['fund_unit'] . '</td>
                            <td>' . number_format($value['fund_cost'], 2) . '</td>
                            <td>' . number_format($value['fund_cost'], 2) . '</td>
                            <td>' . number_format($value['fund_unit'] * $value['fund_cost'], 2) . '</td>
                            <td>' . number_format($value['fund_unit'] * $value['fund_cost'], 2) . '</td>
                          </tr>';
}?>
                        </tbody>
                      </table>
                    </div>
                  </div>
              </div>
            </div>
            <!-- /.row -->
            <!-- row -->
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->


          <!-- Transfer -->
          <div class="w3-container"   >
            <div id="id01" class="w3-modal">
              <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center">
                  <br>
                  <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright"
                    title="Close Modal">&times;</span>
                  <img src="img/transfer.png" alt="transfer img" style="width:30%" class="w3-circle w3-margin-top">
                </div>

                <form class="w3-container" id='transfer-form'>
                  <input type="hidden" value="transfer" name="action">
                  <div class="w3-section">

                    <label>
                      <b>Enter the amount you wish to deposit</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter Amount" id="amount_transfer" name="amount_transfer" required>

                    <label>
                      <b>Account No. Recipient</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter Account No" id="account_transfer" name="account_transfer" required>

                    <label>
                      <b>Fee</b> 25฿
                    </label>

                    <div class="row">
                      <div class="col-lg-9"><span style="line-height:4;" id='status_meessage_transfer'></span></div>
                      <div class="col-lg-3" style="text-align:right;"><bcutton class="w3-button w3-green w3-section w3-padding" type="submit" id="transfer-submit">Submit</button></div>
                    </div>
                  </div>
                </form>

                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                  <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                </div>

              </div>
            </div>
          </div>

          <!-- Fund -->
          <div class="w3-container">
            <div id="id02" class="w3-modal">
              <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center">
                  <br>
                  <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright"
                    title="Close Modal">&times;</span>
                  <img src="img/fund.png" alt="fund img" style="width:30%" class="w3-circle w3-margin-top">
                </div>

                <form class="w3-container"  id='fund-form' >
                  <input type="hidden" value="fund" name="action">
                  <div class="w3-section">
                    <label>
                      <b>Please select funds</b>
                    </label>
                    <select class="w3-select w3-padding w3-margin-bottom" name="fund" >
                      <option value="1,1000">กองทุนปันผล 20% ต่อปี (1,000/Unit)</option>
                      <option value="2,16">กองทุน Super risk (16/Unit)</option>
                      <option value="3,150">กองทุน Super save (150/Unit)</option>
                      <option value="4,10">กองทุน long term (10/Unit)</option>
                    </select>

                    <label>
                      <b>Enter Unit</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom allownumericwithoutdecimal" type="number" placeholder="Enter Unit" name="fund_unit" required>

                    <label>
                      <b>Amont</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom" readonly type="number" placeholder="0" name="fund_cost" required>

                    <div class="row">
                      <div class="col-lg-9"><span style="line-height:4;" id='status_meessage_fund'></span></div>
                      <div class="col-lg-3" style="text-align:right;"><bcutton class="w3-button w3-green w3-section w3-padding" type="submit" id="fund-submit">Submit</button></div>
                    </div>

                  </div>
                </form>

                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                  <button onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                </div>

              </div>
            </div>
          </div>
          <footer class="footer text-center"> 2018 &copy; noobbank.com by <a target="_blank" href="https://nottdev.com">NottDev</a> </footer>
        </div>
        <!-- /#page-wrapper -->
      </div>
      <!-- /#wrapper -->
      <!-- jQuery -->
      <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap Core JavaScript -->
      <script src="bootstrap/dist/js/bootstrap.min.js"></script>
      <!-- Menu Plugin JavaScript -->
      <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
      <!--slimscroll JavaScript -->
      <script src="js/jquery.slimscroll.js"></script>
      <!--Wave Effects -->
      <!-- DataTable -->
      <script src="js/jquery.dataTables.min.js"></script>
      <script src="js/dataTables.bootstrap.min.js"></script>
      <script type="text/javascript">
        $('#sampleTable').DataTable();
      </script>

      <!-- Custom Theme JavaScript -->
      <script src="js/custom.min.js"></script>
      <script src="plugins/bower_components/toast-master/js/jquery.toast.js"></script>
      <script src="js/main.js"></script>
  </body>

  </html>
