<?php
// session_start inicia a sessão 
session_start();
if (!isset($_SESSION) || empty($_SESSION)){
    header("location:login.php");
}
//var_dump($_SESSION);
?>
 <div class="container">
 <div class="row">
    <div class="col-sm text-right col-9 col-sm-9 col-md-11 col-lg-11 col-xl-11">
    <?php echo $_SESSION['usuario'];?>
    </div>
    <div class="col-sm text-right col-3 col-sm-3 col-md-1 col-lg-1 col-xl-1">
    <a href="login.php?logout=sim"><i class="far fa-window-close"></i>  Sair</a>
    </div>
  </div>
  
</div> 