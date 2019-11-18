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
		$order_mail_dates=array();
        $order_mail_uge_nummer=array();
        $order_mail_shifts=array();

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $_FILES['order_dokument']['tmp_name']);

		$order_unformatted_date=$_POST['order_date'];
		$created_date=date_create($order_unformatted_date);
		$order_date=date_format($created_date, 'Y-m-d');
		
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
		$order_uge_nummer= date("W", strtotime($order_date));
		$account_code=$_SESSION['account_code'];
		$school_name=$_SESSION['school_name'];
		$account_email=$_SESSION['account_email'];

		// Send client mail
		$order_mail_dates[]= $order_unformatted_date;
        $order_mail_uge_nummer[]= $order_uge_nummer;
        $order_mail_shifts[]= $order_shifts;

		$order_dokument=$_FILES['order_dokument']['name'];
		$temp_order_document=$_FILES['order_dokument']['tmp_name'];
		if(!empty($order_dokument)){
			if ($mime!=='application/pdf') {
			       die("<script>alert('Man må kun uploade .pdf filer!');
			       	window.open('insert_bestilling_gowork.php','_self');</script>");   
			}
		}

		$actual_name=pathinfo($order_dokument, PATHINFO_FILENAME);
		$extension=pathinfo($order_dokument, PATHINFO_EXTENSION);
		$i=1;

		if(!empty($order_dokument)){
		while (file_exists('dokumenter/' . $order_dokument)) {
			$order_dokument=$actual_name .'('.$i. ').' .$extension;
			$i++;
		}}

		move_uploaded_file($temp_order_document, "dokumenter/$order_dokument");


		$stmt=$con->prepare('INSERT INTO orders (order_date, order_uge_nummer, order_send_date, order_address, order_meeting, order_lokale, order_start_time, order_stop_time, order_shifts, order_fag, order_fakultet, order_kontakt, order_form, order_dokument, order_school, school_code) VALUES (:order_date, :order_uge_nummer, NOW(),  :order_address, :order_meeting, :order_lokale, :order_start_time, :order_stop_time, :order_shifts, :order_fag, :order_fakultet, :order_kontakt, :order_form, :order_dokument, :order_school, :school_code)');
		@$stmt->execute([
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
			'order_school'=>$school_name,
			'school_code'=>$account_code
		]);

		

		$count=$stmt->rowCount();

	if ($count>0) {
 		sendMailClient($account_email, $order_mail_dates, $order_mail_uge_nummer, $order_mail_shifts);
        sendMail($school_name,$order_mail_dates, $order_mail_uge_nummer, $order_mail_shifts);
        echo "<script>alert('Bestilling Sendt Til Booking.')</script>";
 		echo "<script>window.open('view_bestillinger_gowork.php','_self')</script>";
 	}
 	else{
 		echo "<script>alert('Could not send order. Try again!')</script>";
 	}
 	}
 ?>
