<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'vendor\autoload.php';

  function sendMail($order_school,$order_mail_date, $order_uge_nummer, $order_shifts){
  	$mail=new PHPMailer;
    $mail->SMTPDebug = 0;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;                           
    $mail->Username = "julian.costinea@gmail.com";                 
    $mail->Password = "kingstone";                           
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "TLS";                           
    //Set TCP port to connect to 
    $mail->Port = 587;          
    $mail->From="julian.costinea@gmail.com";
    $mail->FromName="GO:WORK Order System";
    $mail->addAddress("job@go-work.dk");
    $mail->isHTML(true);
    $mail->Subject = "A new order has been sent from $order_school.";
    $mail->Body = "$order_school has sent a new order <br>";
    $mail->Body.="Dato: $order_mail_date <br>";
    $mail->Body.="Ugenummer: $order_uge_nummer <br>";
    $mail->Body.="Amount of people needed: $order_shifts";
    $mail->Body.="<a href='https://go-work.dk/'><h4>Check it out<h4></a>";

    if(!$mail->send()) 
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
        exit();
    }
  }

  function shortenText($input){
    $short_input=substr($input,0,10);
    $long_input=substr($input,10);

    if (!empty($long_input)) {
        $output="<span class='showMore'><span class='short_text'>$short_input</span><span class='hidden'>$long_input</span></span>";
    }

    else{
    $output="<span class='short_text'>$short_input</span><span class='hidden'>$long_input</span>";
    }

    echo $output;
  }
 ?>