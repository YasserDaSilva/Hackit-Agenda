<?php
/**
 * Created by PhpStorm.
 * User: Noureddine Metourni
 * Date: 20/02/2017
 * Time: 01:15
 */
require_once 'PHPMailerAutoload.php';
function mailTo($mailTO , $fname,$lname)
{

    $mail = new  PHPMailer;
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ssl://smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'hackitcse.dz@gmail.com';                 // SMTP username
    $mail->Password = 'cseesi2017';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('hackitcse.dz@gmail.com', 'HackIT');
    //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($mailTO);               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
   // $mail->addBCC('bcc@example.com');

   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
   // $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'HackIT';
    $mail->Body    = 'Thank you '.$fname.' '.$lname.' for your registration to ESI\'s first Hackathoon, HackIT 2K17';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        return 'Message could not be sent.';
    } else {
        return 'Message has been sent';
    }







/*

    $to = $mail;

// Subject
    $subject = 'HackIT';

// Message
    $message = '
<html>
<head>
  <title>HackIT 2K17</title>
</head>
<body>
  <p>holla msg</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
    $headers[] = 'To: '.$fname.' '.$lname.' <'.$to.'>,';
    $headers[] = 'From: CSE <cse@esi.dz>';
    $headers[] = 'Cc: meto@example.com';
    $headers[] = 'Bcc: aghilaze@example.com';


    //$from = "from@from.com";

// Mail it
   // $ok = @mail($to, $subject, $message, implode("\r\n", $headers));


    $mail = new PHPMailer;



    return $ok;
*/
//$ok = @mail($to, $subject, $message, $headers, "-f " . $from);

}
