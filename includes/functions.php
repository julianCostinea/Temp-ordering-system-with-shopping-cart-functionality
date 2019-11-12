<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'vendor\autoload.php';

  function sendMail($order_school,$order_mail_dates=array(), $order_uge_nummer=array(), $order_shifts=array()){
  	$mail=new PHPMailer;
    $mail->SMTPDebug = 0;                               
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;                           
    $mail->Username = "julian.costinea@gmail.com";                 
    $mail->Password = "epqwzohchbmspgld";                           
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "TLS";                           
    //Set TCP port to connect to 
    $mail->Port = 587;          
    $mail->From="julian.costinea@gmail.com";
    $mail->FromName="GO:WORK Order System";
    $mail->addAddress("job@go-work.dk");
    $mail->isHTML(true);
    $mail->Subject = "A new order has been sent from $order_school.";
    $mail->Body = "$order_school has sent new orders <br> <br>";

    for ($i=0; $i < count($order_mail_dates); $i++) { 
      $mail->Body.="Dato: $order_mail_dates[$i] <br>";
      $mail->Body.="Ugenummer: $order_uge_nummer[$i] <br>";
      $mail->Body.="Amount of people needed: $order_shifts[$i] <br><br>";
    }

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
  
  function book_kladde(){
    if (!empty($_POST['selected_orders'])) {
        foreach($_POST['selected_orders'] as $klade_id){
              $statement = $con->prepare('SELECT * FROM klader WHERE klade_id = :klade_id');
              $statement->bindParam(':klade_id', $klade_id);
              $statement->execute();

              $row = $statement->fetch(PDO::FETCH_ASSOC);

          $order_date=$row['order_date'];
          $created_date=date_create($order_date);
          $order_mail_date=date_format($created_date, 'd-m-Y');

          $order_send_date = $row['order_send_date'];
            $order_address = htmlspecialchars($row['order_address']);
          $order_meeting = htmlspecialchars($row['order_meeting']);
            $order_lokale = htmlspecialchars($row['order_lokale']);
          $order_start_time = $row['order_start_time'];
          $order_stop_time = $row['order_stop_time'];
          $order_uge_nummer = $row['order_uge_nummer'];
          $order_shifts = $row['order_shifts'];
          $order_fag = htmlspecialchars($row['order_fag']);
          $order_fakultet = htmlspecialchars($row['order_fakultet']);
          $order_kontakt = htmlspecialchars($row['order_kontakt']);
          $order_dokument = htmlspecialchars($row['order_dokument']);
          $order_form = $row['order_form'];
          $order_school = $row['order_school'];
          $school_code = $row['school_code'];

          //Check if date is more than 30 days ahead
          $futureDate= time()+(28*24*60*60);
          $enteredDate=strtotime($order_date);
          $checkDate= $enteredDate-$futureDate;

          if ($checkDate<0) {
            echo "<script>alert('Order ID:$klade_id is less than 30 days ahead.')</script>";
            echo "<script>window.open('view_kladder.php','_self')</script>";
            exit();
          }

          $statement=$con->prepare('INSERT INTO orders (order_date, order_uge_nummer, order_send_date, order_address, order_meeting, order_lokale, order_start_time, order_stop_time, order_shifts, order_fag, order_fakultet, order_kontakt, order_form, order_dokument, order_school, school_code) VALUES (:order_date, :order_uge_nummer, NOW(),  :order_address, :order_meeting, :order_lokale, :order_start_time, :order_stop_time, :order_shifts, :order_fag, :order_fakultet, :order_kontakt, :order_form, :order_dokument, :order_school, :school_code)');
          @$statement->execute([
          'order_date'=>$order_date,
          'order_address'=>$order_address,
          'order_meeting'=>$order_meeting,
          'order_uge_nummer'=>$order_uge_nummer,
          'order_lokale'=>$order_lokale,
          'order_start_time'=>$order_start_time,
          'order_stop_time'=>$order_stop_time,
          'order_shifts'=>$order_shifts,
          'order_fag'=>$order_fag,
          'order_fakultet'=>$order_fakultet,
          'order_kontakt'=>$order_kontakt,
          'order_form'=>$order_form,
          'order_dokument'=>$order_dokument,
          'order_school'=>$order_school,
          'school_code'=>$school_code
        ]);
      }
      $count=$statement->rowCount();  
      if ($count>0) {
        foreach($_POST['selected_orders'] as $order_id){
        $statement = $con->prepare('DELETE FROM klader WHERE klade_id = :klade_id');
        $statement->bindParam(':klade_id', $klade_id);
        $statement->execute();
        }
        $countDelete=$statement->rowCount();
      }
      if ($countDelete>0) {
        sendMail($order_school,$order_mail_date, $order_uge_nummer, $order_shifts);
        echo "<script>alert('Bestilling Sendt Til Booking.')</script>";
        echo "<script>window.open('view_aktive_bestillinger.php','_self')</script>";

      }
      else{
        echo "<script>alert('Kladde Kunne Ikke Slettes.')</script>";
        echo "<script>window.open('view_kladder.php','_self')</script>";
      }
  }
        echo "<script>alert('Vælg en kladde!')</script>";
        echo "<script>window.open('view_kladder.php','_self')</script>";
  }
 ?>