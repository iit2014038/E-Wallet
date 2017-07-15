<?php

require("class.phpmailer.php");
$mail = new PHPMailer(true);

//Send mail using gmail
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->SMTPDebug = 2;
    $mail->From = "goplutus@gmail.com";
    $mail->Fromname = "anupam";
    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465; // set the SMTP port for the GMAIL server
    $mail->SMTPAuth = true;
    $mail->Username = "goplutus@gmail.com"; // GMAIL username
    $mail->Password = "plutusewallet"; // GMAIL password


//Typical mail data
$mail->AddAddress("anupamvns@gmail.com", "anupam");
$mail->IsHTML(true);
$mail->Subject = "My Subject";
$mail->Body = "Mail contents";

try{
    $mail->Send();
    echo "Success!";
} catch(Exception $e){
    //Something went bad
    echo "Fail :(";
}

?>