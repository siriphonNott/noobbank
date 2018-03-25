<?php

require_once 'api/checkAuth.php';
require_once 'app/model/autoload.php';

use Model\Fund;
use Model\Member;
use Model\Transaction;

// Member
$member = new Member();
$user_info_obj = $member->getData($_SESSION['customer_id']);
$user_info = $user_info_obj['rows'][0];

// Transaction
$transaction = new Transaction();
$trans_obj = $transaction->getData($_SESSION['customer_id']);
$trans = $trans_obj['rows'];

// Fund
$fund = new Fund();
$fund_obj = $fund->getData($_SESSION['customer_id']);
$total_fund = $fund_obj['total'];

$count = 0;

?>
<?php include "header.php";?>

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
                      <?=Utility::format_account_no($user_info['account_no']);?>
                    </h5>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col -->
            <!--col -->
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="white-box" style="padding-bottom: 13px;">
                <div class="row">
                  <div class="col-md-5 col-sm-6 col-xs-6">
                    <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                    <h4 class="text-muted vb">ยอดเงินในบัญชี</h4>
                  </div>
                  <div class="col-md-7 col-sm-6 col-xs-6 fz-40">
                    <h4 class="counter text-right text-megna">
                      <?=number_format($user_info['amount'], 2);?>฿</h4>
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
                <div class="row">
                  <div class="col-md-5 col-sm-6 col-xs-6">
                    <i class="linea-icon linea-basic" data-icon="&#xe01b;"></i>
                    <h4 class="text-muted vb">ยอดเงินในกองทุน</h4>
                  </div>
                  <div class="col-md-7 col-sm-6 col-xs-6 fz-40">
                    <h4 class="counter text-right text-megna">
                      <?=number_format($total_fund, 2);?>฿</h4>
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
                    <button class="btn btn-success" onclick="document.getElementById('id01').style.display='block'">โอนเงิน</button>
                  </div>
                  <div class="col-md-8 col-sm-6 col-xs-6">
                    <h5 class="counter  text-primary">สามารถโอนเงินได้ทุก Bank ได้อย่างสะดวกและรวดเร็ว</h5>
                  </div>
                </div>
                <div class=" row">
                  <div class="col-md-4 col-sm-6 col-xs-6">
                    <i class="linea-icon linea-basic" data-icon="&#xe00b;"></i>
                    <button class="btn btn-success" onclick="document.getElementById('id02').style.display='block'"> ซื้อกองทุน</button>
                  </div>
                  <div class="col-md-8 col-sm-6 col-xs-6">
                    <h5 class="counter  text-primary">สามารถซื้อซื้อกองทุนที่ตรงกับไล์สไตล์คุณได้ที่นี่ แค่คลิกเดียว</h5>
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
                <h1 class="box-title">รายการธุรกรรม
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
                            <th>
                              <center>ลำดับ</center>
                            </th>
                            <th>
                              <center>ประเภท</center>
                            </th>
                            <th>
                              <center>วันที่ทำรายการ</center>
                            </th>
                            <th>
                              <center>ต้นทาง</center>
                            </th>
                            <th>
                              <center>ปลายทาง</center>
                            </th>
                            <th>
                              <center>จำนวน</center>
                            </th>
                            <!-- <th></th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($trans as $value) {
    $count++;
    $class = 'receive';
    $type = 'รับเงิน';
    if ($value['source_customer_id'] == $_SESSION['customer_id']) {
        $class = 'transfer';
        $type = 'โอนเงิน';
    }
    echo '<tr  class="' . $class . '">
                            <td>' . $count . '</td>
                            <td>' . $type . '</td>
                            <td>' . date_format(date_create($value['created_at']), "d/m/Y H:i:s") . '</td>
                            <td>' . Utility::format_account_no($value['source_account_no'], true) . '</td>
                            <td>' . Utility::format_account_no($value['destination_account_no'], true) . '</td>
                            <td>' . number_format($value['amount'], 2) . '</td>
                            <!-- <td>
														<div class="block-i-opt">
														<i class="fa fa-edit font-opt mar-r-5"></i>
														<i class="fa fa-trash font-opt"></i>
													</div>
												</td> -->
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
          <div class="w3-container">
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
                      <b>Enter To Amount Number</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="Enter Account Number" id="account_number_des" name="account_number_des"
                      required>
                    <label>
                      <b>Enter Amount</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom allownumericwithdecimal" type="number" placeholder="Enter Amount" id="amount_transfer"
                      name="amount_transfer" required>
                    <label>
                      <b>Fee</b> 25฿
                    </label>

                    <div class="row">
                      <div class="col-lg-9">
                        <span style="line-height:4;" id='status_meessage_transfer'></span>
                      </div>
                      <div class="col-lg-3" style="text-align:right;">
                        <bcutton class="w3-button w3-green w3-section w3-padding" type="submit" id="transfer-submit">Submit</button>
                      </div>
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

                <form class="w3-container" id='fund-form'>
                  <input type="hidden" value="fund" name="action">
                  <div class="w3-section">
                    <label>
                      <b>Please select funds</b>
                    </label>
                    <select class="w3-select w3-padding w3-margin-bottom" name="fund">
                      <option value="1,1000">กองทุนปันผล 20% ต่อปี (1,000/Unit)</option>
                      <option value="2,16">กองทุน Super risk (16/Unit)</option>
                      <option value="3,150">กองทุน Super save (150/Unit)</option>
                      <option value="4,10">กองทุน long term (10/Unit)</option>
                    </select>

                    <label>
                      <b>Enter Unit</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom allownumericwithoutdecimal" type="number" placeholder="Enter Unit" name="fund_unit"
                      required>

                    <label>
                      <b>Amont</b>
                    </label>
                    <input class="w3-input w3-border w3-margin-bottom" readonly type="number" placeholder="0" name="fund_cost" required>

                    <div class="row">
                      <div class="col-lg-9">
                        <span style="line-height:4;" id='status_meessage_fund'></span>
                      </div>
                      <div class="col-lg-3" style="text-align:right;">
                        <bcutton class="w3-button w3-green w3-section w3-padding" type="submit" id="fund-submit">Submit</button>
                      </div>
                    </div>

                  </div>
                </form>

                <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                  <button onclick="document.getElementById('id02').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                </div>

              </div>
            </div>
          </div>
          <footer class="footer text-center"> 2018 &copy; noobbank.com by
            <a target="_blank" href="https://nottdev.com">NottDev</a>
          </footer>
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
      <script type="text/javascript">
        $(document).ready(function () {
          $.toast({
            heading: "Welcome <?=$_SESSION['firstname'] . ' ' . $_SESSION['lastname'];?>",
            text: 'Noob bank is the best of Bank for you.',
            position: 'top-right',
            loaderBg: '#ff6849',
            icon: 'info',
            hideAfter: 3500,
            stack: 6
          })
        });
      </script>
  </body>

  </html>