<?php 
  $got_date='2019-12-21';
  $created_date=date_create($got_date);
  $sql_date=date_format($created_date, 'd-m-Y');
  echo $got_date. '<br>';
  echo $sql_date;
 ?>