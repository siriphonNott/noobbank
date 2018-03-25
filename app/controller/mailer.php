
<?php
require_once __DIR__ . '/../../vendor/phpmailer/class.phpmailer.php';

function set_mail($name, $email)
{
    $mail = new PHPMailer();

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
    $mail->Body = content_email($name, $email);

    $mail->AddAddress($email); // to Address

    $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

    if (!$mail->Send()) {
        return "Error sending: " . $mail->ErrorInfo;
    } else {
        return true;
    }

}

function content_email($name, $email)
{
    $content = '<!DOCTYPE html>
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
                            <img src="https://noobbank.nottdev.com/img/logo.png" width="70" height="70" style="border:0" class="">
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
                      <br><h2 style="color:white;font-weight: 500">Completed Registration </h2>
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
                              <p>สวัสดี คุณ ' . $name . '</p>
                              <p>&nbsp;&nbsp;&nbsp;&nbsp;คุณได้สมัครเป็นสมาชิกกับ Noob Bank เรียบร้อยแล้ว หลังจากที่คุณสมัคร คุณจะได้รับเงินทันทีจำนวน 10,000 บาท ในบัญชี<br>
                              &nbsp;&nbsp;&nbsp;&nbsp;โดยเว็บนี้ผู้สร้างตั้งใจเปิดช่องโหว่งไว้จำนวนมาก เพื่อใช้เป็นกรณีศึกษาเกี่ยวกับ Basic Web Security<br>
                              &nbsp;&nbsp;&nbsp;&nbsp;คุณสามารถลอง Hack เว็บนี้ได้ ด้วยวิธีการหรือเทคนิคต่างๆ เพื่อทดสอบความเข้าใจเกี่ยวกับการทำงานของ Web Application<br><br>
                              &nbsp;&nbsp;&nbsp;&nbsp;Hint: หากสามารถเข้าระบบเป็น Admin หรือเพิ่มเงินในบัญชีได้ ถือว่าคุณเข้าใจการทำงานของ Web Application และ Basic Web Security
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
                                              <a href="https://noobbank.nottdev.com" target="_blank" data-saferedirecturl="" style="text-decoration: none;">
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
                            <a href="mailto:' . $email . '" style="color:#3b5998;text-decoration:none" target="_blank">' . $email . '</a>
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
                            <img src="https://noobbank.nottdev.com/img/banner-email.png"  width="100%" >
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
    return $content;
}

?>
