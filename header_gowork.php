<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #FFFFFF;">
  <a class="navbar-brand" href="home.php"><img src="logo.png" width="50%" class="img-fluid"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?php 
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  function addActiveClass ($link, $check_link){
    if (preg_match($link,$check_link)) {
      echo 'active';
    }
  }
  function addConfirmation ($check_link){
    if (preg_match('/insert_bestilling/i',$check_link)) {
      echo 'confirmation';
    }
  }
 ?>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php addActiveClass('/view_bestillinger_gowork/i', $actual_link); ?>">
        <a class="nav-link <?php addConfirmation($actual_link); ?>" href="view_bestillinger_gowork.php" >Se aktive ordrer</a>
      </li>
      <li class="nav-item <?php addActiveClass('/view_completed_bestillinger_gowork/i', $actual_link); ?>">
        <a class="nav-link <?php addConfirmation($actual_link); ?>" href="view_completed_bestillinger_gowork.php">Gennemførte vagter</a>
      </li>
    </ul>
    <a class="nav-link logout <?php addConfirmation($actual_link); ?>" href="admin_logout.php"><i class="fas fa-sign-out-alt"></i>Log ud</a>
  </div>
</nav>
