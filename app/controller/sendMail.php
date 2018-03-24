
<?php
require_once 'phpmailer/class.phpmailer.php';
// require_once 'vendor/autoload.php';

$access_key = "ba170435eb82bcd583dde27a769593e5";
$email = 'siriphonnots@mail.com';
$uri = "http://apilayer.net/api/";

$url = $uri . "check?access_key=" . $access_key . "&email=" . $email;

// USE Httpful
// $response = \Httpful\Request::get($path)->send();
// echo "<pre>";
// var_dump($response->body);
// die();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_PORT, null);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_POSTFIELDS, null);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
$resJson = curl_exec($ch);
curl_close($ch);
$result = json_decode($resJson, true);

echo "<pre>";
var_dump($result);

if ($result['format_valid']) {
    echo "Format Ok.";
}
if ($result['smtp_check']) {
    echo "Mail  Ok.";
}
die();

$content = '<!DOCTYPE html>
		<html>
		  <head>
		  <style>
		  table, td, th {
		      border: 1px solid #c1c1c1;
		  }
		  table {
		      border-collapse: collapse;
		      width: 100%;
		  }
		  th {
		      text-align: center;
		      height: 40px;
		      color: #fff;
		  }
		  td {
		      height: 35px;
		      text-align: center;
		  }
		  </style>
		  </head>
		  <body>

		  <h2>The text-align Property</h2>
		  <p>This property sets the horizontal alignment (like left, right, or center) of the content in th or td:</p>

		  <table>
		    <tr style="background-color: #4caf50;">
		      <th>Firstname</th>
		      <th>Lastname</th>
		      <th>Savings</th>
		    </tr>
		    <tr>
		      <td>Peter</td>
		      <td>Griffin</td>
		      <td>$100</td>
		    </tr>
		    <tr>
		      <td>Lois</td>
		      <td>Griffin</td>
		      <td>$150</td>
		    </tr>
		    <tr>
		      <td>Joe</td>
		      <td>Swanson</td>
		      <td>$300</td>
		    </tr>
		    <tr>
		      <td>Cleveland</td>
		      <td>Brown</td>
		      <td>$250</td>
		  </tr>
		  </table>

		  <h1>Picture</h1>
		  <img src="http://jasmine.freezesoft.com/mail/sea.jpg" width="100%">

		  </body>
  </html>';

$content2 = '
<!DOCTYPE html>
<html>
<head>
<style>
.size-wrapper {
  width:50vw;
}
@media screen and (max-width: 500px) {
  .size-wrapper {
    width:80vw;
  }
}
</style>
</head>
<body>
<div style="margin:0;padding:25px;" dir="ltr">
  <table border="0" cellspacing="0" cellpadding="0" align="center" class="size-wrapper">
    <tbody>
      <tr>
        <td style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;background:#ffffff">
          <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
            <tbody>
              <tr>
                <td width="15" style="display:block;width:25px">&nbsp;&nbsp;&nbsp;</td>
                <td>
                  <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                    <tbody>
                      <tr>
                        <td width="32" align="left" valign="middle" style="height:32;line-height:0px;">
                          <img src="https://nottdev.com/noobbank.png" width="70" height="70" style="border:0" class="">
                        </td>
                        <td width="100%">
                          <span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:25px;line-height:32px;color:#bebebe;">Noob Bank</span>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td width="15" style="display:block;width:25px">&nbsp;&nbsp;&nbsp;</td>
              </tr>

               <tr>
                <td bgcolor="#89d03b"></td>
                <td bgcolor="#89d03b">
                    <br><h2 style="color:white;font-weight: 500">Registed </h2>
                </td>
                <td bgcolor="#89d03b"></td>
              </tr>

              <tr  style="background-color:#fbfbfbed;border: solid 1px lightgray; border-top:unset;">
                <td width="15" style="display:block;width:25px">&nbsp;&nbsp;&nbsp;</td>
                <td>
                  <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                    <tbody>
                      <tr>
                        <td>
                          <span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:13px;line-height:21px;color:#141823b8">
                            <p></p>
                            <p>สวัสดี Siriphon</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;คุณได้สมัครเป็นสมาชิกกับ Noob Bank เรียบร้อยแล้ว หลังจากที่คุณสมัคร คุณจะได้รับเงินทันทีจำนวน 10,000 บาท ในบัญชี<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;โดยเว็บนี้ผู้สร้างตั้งใจเปิดช่องโหว่งไว้จำนวนมาก เพื่อใช้เป็นกรณีศึกษาเกี่ยวกับ Basic Web Security<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;คุณสามารถลอง Hack เว็บนี้ได้ ด้วยวิธีการหรือเทคนิคต่างๆ เพื่อทดสอบความเข้าใจเกี่ยวกับการทำงานของ Web Application นี้ได้
                             </p>
                            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                              <tbody>
                                <tr>
                                  <td height="2" style="line-height:2px" colspan="3">&nbsp;</td>
                                </tr>
                                <tr>
                                <td width="40%" td>
                                  <td <a href="" style="color:#3b5998;text-decoration:none;text-decoration: none;" target="_blank" data-saferedirecturl="">
                                    <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                                      <tbody>
                                        <tr>
                                          <td style="border-collapse:collapse;border-radius:2px;text-align:center;display:block;border:solid 1px #89d03b;background:#89d03b;padding:7px 16px 11px 16px;">
                                            <a href="https://nottdev.com" target="_blank" data-saferedirecturl="" style="text-decoration: none;">
                                              <center>
                                                <font size="3">
                                                  <span style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;white-space:nowrap;font-weight:bold;vertical-align:middle;color:#ffffff;font-size:14px;line-height:14px">กลับไปที่&nbsp; Noob Bank</span>
                                                </font>
                                              </center>
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    </a>
                                  </td>
                                  <td width="40%" td>
                                </tr>
                                <tr>
                                  <td colspan="3">&nbsp;</td>
                                </tr>
                              </tbody>
                            </table>
                            <p></p>
                          </span>
                          </td>
                      </tr>
                    </tbody>
                  </table>
                  </td>
                  <td width="15" style="display:block;width:25px">&nbsp;&nbsp;&nbsp;</td>
              </tr>
              <tr style="border: solid 1px lightgray;border-bottom:unset; border-top:unset;">
                <td border="0" width="15" style="display:block;width:15px">&nbsp;&nbsp;&nbsp;</td>
                <td>
                  <table border="0" width="100%" cellspacing="0" cellpadding="0" align="left" style="border-collapse:collapse">
                    <tbody>
                      <tr>
                        <td height="16" style="line-height:16px">&nbsp;</td>
                      </tr>
                      <tr>
                        <td style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:11px;color:#aaaaaa;line-height:16px">ข้อความนี้ส่งถึง
                          <a href="mailto:siriphonnot@gmail.com" style="color:#3b5998;text-decoration:none" target="_blank">siriphonnot@gmail.com</a>
                        </td>
                      </tr>
                      <tr>
                        <td style="font-family:Helvetica Neue,Helvetica,Lucida Grande,tahoma,verdana,arial,sans-serif;font-size:11px;color:#aaaaaa;line-height:16px">สร้างโดย
                          <a href="https://nottdev.com" style="color:#3b5998;text-decoration:none" target="_blank">NottDev</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td width="15" style="display:block;width:25px">&nbsp;&nbsp;&nbsp;</td>
              </tr>
              <tr style="border: solid 1px lightgray;border-bottom:unset; border-top:unset;">
                <td height="20" style="line-height:20px" colspan="3">&nbsp;</td>
              </tr>
              <tr style="border: solid 1px lightgray; border-top:unset;">
                <td width="15" style="display:block;width:25px">&nbsp;&nbsp;&nbsp;</td>
                <td>
                  <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse">
                    <tbody>
                      <tr>
                        <td width="100%">
                          <img src="https://nottdev.com/top.png"  width="100%" >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
                <td width="15" style="display:block;width:25px">&nbsp;&nbsp;&nbsp;</td>
              </tr>
              <tr>
                <td height="20" style="line-height:20px" colspan="3">&nbsp;</td>
              </tr>
            </tbody>
          </table>
          </td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>';

$mail = new PHPMailer();
$mail2 = new PHPMailer();

$mail->IsHTML(true);
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
$mail->Port = 465; // set the SMTP port for the GMAIL server
$mail->Username = "nottdev@gmail.com"; // GMAIL username
$mail->Password = "siriphon-9"; // GMAIL password
$mail->From = "Siriphon"; // "name@yourdomain.com";
//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
$mail->FromName = "Noob Bank@nottdev.com"; // set from Name
$mail->Subject = "Welcome to Noob Bank";
$mail->Body = $content2;

$mail->AddAddress("siriphon_not@hotmail.com"); // to Address
// $mail->AddAddress("siriphonnot@gmail.com"); // to Address

// $mail->AddAttachment("thaicreate/myfile.zip");

//$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

if (!$mail->Send()) {
    echo "Error sending: " . $mail->ErrorInfo;
} else {
    echo "E-mail sent";
}

// ----------------------------------------------------------------------------------------------

// $mail2->IsHTML(true);
// $mail2->CharSet = "utf-8";
// $mail2->IsSMTP();
// $mail2->SMTPAuth = true; // enable SMTP authentication
// $mail2->SMTPSecure = "ssl"; // sets the prefix to the servier
// $mail2->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
// $mail2->Port = 465; // set the SMTP port for the GMAIL server
// $mail2->Username = "Kritsana.wansupong@gmail.com"; // GMAIL username
// $mail2->Password = "12012526"; // GMAIL password
// $mail2->From = "Reservation of Samui Jasmine Resort"; // "name@yourdomain.com";
// //$mail2->AddReplyTo = "support@thaicreate.com"; // Reply
// $mail2->FromName = "Freezesoft Thailand";  // set from Name
// $mail2->Subject = "Auto Response from Samui Jasmine Resort";
// $mail2->Body = $content;

// $mail2->AddAddress("siriphonnot@gmail.com"); // to Address

// // $mail2->AddAttachment("thaicreate/myfile.zip");

// //$mail2->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

// $mail2->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

// if($mail2->Send()){
//     echo "Content Send Successfully!";
// }

?>
