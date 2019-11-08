<?php
	session_start(); 
	include("db.php");
	if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('admin_login.php','_self')</script>";
  }
?>
<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor\autoload.php';
 ?>
<?php 
	if (isset($_POST['submit'])) {
		$order_unformatted_date=$_POST['order_date'];
		$created_date=date_create($order_unformatted_date);
		$order_date=date_format($created_date, 'Y-m-d');


		$order_uge_nummer= date("W", strtotime($order_date));
		$order_address=$_POST['order_address'];
		$order_meeting=$_POST['order_meeting'];
		$order_lokale=$_POST['order_lokale'];
		$order_start_time=$_POST['order_start_time'];
		$order_stop_time=$_POST['order_stop_time'];
		$order_shifts=$_POST['order_shifts'];
		$order_fag=$_POST['order_fag'];
		$order_fakultet=$_POST['order_fakultet'];
		$order_kontakt=$_POST['order_kontakt'];
		$order_form=$_POST['order_form'];
		$school_code=$_SESSION['account_code'];
		$school_title=$_SESSION['school_name'];

		$order_dokument=$_FILES['order_dokument']['name'];
		$temp_order_document=$_FILES['order_dokument']['tmp_name'];
		move_uploaded_file($temp_order_document, "dokumenter/$order_dokument");


		$stmt=$con->prepare('INSERT INTO orders (order_date, order_uge_nummer, order_send_date, order_address, order_meeting, order_lokale, order_start_time, order_stop_time, order_shifts, order_fag, order_fakultet, order_kontakt, order_form, order_dokument, order_school, school_code) VALUES (:order_date, :order_uge_nummer, NOW(),  :order_address, :order_meeting, :order_lokale, :order_start_time, :order_stop_time, :order_shifts, :order_fag, :order_fakultet, :order_kontakt, :order_form, :order_dokument, :order_school, :school_code)');
		$stmt->execute([
			'order_date'=>$order_date,
			'order_uge_nummer'=>$order_uge_nummer,
			'order_address'=>$order_address,
			'order_meeting'=>$order_meeting,
			'order_lokale'=>$order_lokale,
			'order_start_time'=>$order_start_time,
			'order_stop_time'=>$order_stop_time,
			'order_shifts'=>$order_shifts,
			'order_fag'=>$order_fag,
			'order_fakultet'=>$order_fakultet,
			'order_kontakt'=>$order_kontakt,
			'order_form'=>$order_form,
			'order_dokument'=>$order_dokument,
			'order_school'=>$school_title,
			'school_code'=>$school_code
		]);

		$count=$stmt->rowCount();

	if ($count>0) {
 		echo "<script>alert('Order has been sent')</script>";
 		$mail=new PHPMailer;
		$mail->SMTPDebug = 0;                               
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();
		$mail->CharSet = 'UTF-8';            
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
		$mail->Subject = "A new order has been sent from $school_title.";
		$mail->Body = "$school_title has sent a new order <br>";
		$mail->Body.="Dato: $order_unformatted_date <br>";
		$mail->Body.="Ugenummer: $order_uge_nummer <br>";
		$mail->Body.="Amount of people needed: $order_shifts";
		$mail->Body.="<a href='https://go-work.dk/'><h4>Check it out<h4></a>";

		if(!$mail->send()) 
		{
		    echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
		    echo "Message has been sent successfully";
		}
 		echo "<script>window.open('view_bestillinger_gowork.php','_self')</script>";
 	}
 	else{
 		echo "<script>alert('Could not send order. Try again!')</script>";
 	}
 	}
 ?>
