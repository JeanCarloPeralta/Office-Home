<?php

  session_start();
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  if (!isset($_SESSION['nombre'])) { //Verificar si alguien esta logueado
    header("Location: login.php");
    return;
  }

  include 'conexion_bd.php';
  $conn = AbrirCon();

    // Variables de sesion
    $_SESSION['prueba']=false;
    $nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
    $correo = $_SESSION["correo"];
  


  if(isset($_POST['btnEnviar'])){//Reconoce el concepto del POST

  //Se almacenan todos los datos que estan en el formulario
  $nombres=$_POST['nombre'];
  $correos=$_POST['correo'];
  $asunto=$_POST['asunto'];
  $mensaje=$_POST['mensaje'];

  //Hace Insert de la cotizacion a la BD
  $proceso= " call 	Contactenos( '$nombres', '$correos' , '$asunto' , '$mensaje')"; 
  $conn -> query($proceso);
  unset($_SESSION['prueba']);
  $_SESSION['prueba'] = TRUE;

  //Dependencias
  require_once 'Phpmailer/Exception.php';
  require_once 'Phpmailer/PHPMailer.php';
  require_once 'Phpmailer/SMTP.php';
  
  //Enviar correo
  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPDebug = 0; 
  $mail->SMTPAuth = true; 
  $mail->SMTPSecure = 'ssl'; 
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 465; 
  $mail->Username = "remodelaciones.hja@gmail.com";
  $mail->Password = "HJA123456789";
  $mail->From = "remodelaciones.hja@gmail.com";
  $mail->Subject = $asunto;
  //$mail->Body =  $mensaje;
  $mail->Body = '<h1>'.$mensaje.'</h1>';
  $mail->IsHTML(true);  
  $mail->CharSet = 'UTF-8';
  $mail->AddAddress("remodelaciones.hja@gmail.com");
  
   if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
   } else {
      echo "Message has been sent";
   }

  //header('Location: //localhost/VerCotizaciones.php');
}

CerrarCon($conn);


?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cont&aacute;ctenos</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"crossorigin="anonymous">
  <link href="css/iconos.css" rel="stylesheet">
  <link href="css/contactenos.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>


</head>

<body>
<form action="" method="post" autocomplete="off">
	
  <div class="d-flex" id="wrapper">

    <!-- Menu desplegable -->
    <div id="sidebar-wrapper">
      <div class="sidebar-heading"><img src="images/logo.png" width="200px"></div>
      <div class="list-group list-group-flush">
        <a href="PaginaPrincipal.php" class="list-group-item list-group-item-action componentes-sidebar"> P&aacute;gina Principal</a>
        <a href="SolicitarCotizacion.php" class="list-group-item list-group-item-action componentes-sidebar">Solicitar cotizaci&oacute;n</a>
        <a href="Contactenos.php" class="list-group-item list-group-item-action componentes-sidebar">Cont&aacute;ctenos</a>
      </div>
    </div>
    
    <!-- Contenido de la Pagina -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light componentes-sidebar border-bottom">

        <button class="btn botones" id="menu-toggle"><i class="fa fa-bars"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active"> 
              <a class="nav-link" href="VerCotizaciones.php">Ver Cotizaciones</a>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $nombre?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="Salir.php">Salir</a>
            </li>
          </ul>
        </div>
      </nav>

      
<div class="container col-12 fondo" > <!--Toda la pagina del fondo-->
  <br/>
    

    <div class="titulos"><!--Titulo de la pagina-->
      <h2 class="letra" style="background-color: #14BFAC ;padding-left: 2% ">Contáctenos</h2>
    </div>

    <div class="row"><!--Este div almacena ambas partes-->

      <div class="col-5" style="margin-right: 3%; margin-left: 8%; margin-top:2%" ><!--Este div cotiene solo la parte izquierda INFORMACION CLIENTE-->
        <div style="padding-bottom: 2%;"><!--Nombre-->
          <h6 class="letra bloque col-2 espacio" style="margin-left: 25px"><b>Nombre</b></h6>
          <input class="letra-inputs divMargin col-7 form-control"  style="margin-left: 6%; margin-bottom:2%" type="text" id="nombre" readonly name="nombre"  value="<?= ucwords(strtolower($nombre))?>">
        </div>
        <div style="padding-bottom: 2%"><!--email-->
          <h6 class="letra bloque col-8 espacio " style="margin-left: 25px"><b>Correo Electrónico</b></h6>
          <input class="letra-inputs divMargin col-7 form-control"  style="margin-left: 6%;  margin-bottom:2%" type="text" name="correo" readonly value="<?= $correo?>" id="correo">
        </div>
        <div style="padding-bottom: 2%"><!--asutno-->
          <h6 class="letra bloque col-8 espacio" style="margin-left: 25px"><b>Asunto</b></h6>
          <input class="letra-inputs divMargin col-7 form-control"  style="margin-left: 6%;  margin-bottom:2%" name="asunto" type="text"  required="true" id="asunto">
        </div>
        <div style="padding-bottom: 2%"><!--mensaje-->
          <h6 class="letra  col-8 espacio" style="margin-left: 25px"><b>Mensaje</b></h6>
          <textarea rows="5" cols="34" class="letra_inputs bloque divMargin form-control" name="mensaje" id="mensaje" required="true" style="margin-left: 6%; margin-bottom: 5%; width: 290px; font-size:13"></textarea>
        </div>
         <div style="margin-left: 25%" > <!--Boton de Enviar-->
            <input type="submit" class="btn botones inline-bloque col-3 letra" name="btnEnviar"  style="background-color: #14BFAC; font-size:17px;" value="Enviar"/>
          </div>
      </div>


      <div class="col-5" ><!--Este div cotiene solo la parte derecha  --> 
        <br/>
        <br/>
        <br/>
                                   
        <div class="row divMargin titulos"><!--Todo el bloque de la parte de ubicacion --> 
            <div class="row inline-bloque" style="margin-left: 2.5%"><!--Solo icono ubicacion --> 
              <i class="fa fa-map-marker inline-bloque "  style="font-size: 180%; color: #FF6060 ; padding-top: 1%"></i>
            </div>
            <div class="row inline-bloque divMargin"><!--Texto de ubicacion --> 
              <label class="letra inline-bloque col-12 espacio"><b>San José, Costa Rica</b></label>
              <p class="letra bloque   col-12" style="margin-left: -5%">Calle Siles 203, Santa Marta</p>
              <p class="letra bloque  col-12" style="margin-left: -5%; margin-top:-8%"> San José Province, San Pedro,</p>
              <p class="letra bloque  col-12" style="margin-left: -5%; margin-top:-8%"> 11501.</p>
            </div>
        </div>

        <div class="row divMargin titulos "> <!--Este es el bloque de teléfono, imagen y iconos (fb, insta, twitter)-->
          <div class="row inline-bloque " style="margin-left: 2.5%"> <!--Solo icono teléfono --> 
            <i class="fa fa-phone inline-bloque "  style="font-size: 180%; color: #FF6060; padding-top: 1%"></i>
          </div>
          <div class="row inline-bloque divMargin " style="margin-left: 5%;"> <!--Numero de telefono y redes-->
            <label class="letra inline-bloque" style="margin-bottom: 30% "><b>2785-2213</b></label>
              <div class="col-12  " style=" margin-bottom: 8%; margin-left: -15%"> <!--Iconos de redes sociales -->
                <a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook-square col-4 iconos" style="font-size: 180% ;"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram iconos col-4 "  style="font-size: 180%; "></i></a>
                <a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter-square col-3 iconos "  style="font-size: 180%; "></i></a>
              </div>
          </div>
              <div class="row inline-bloque divMargin " style="margin-left: 9%"><!--Imagen -->
                <img src="images/building.jpg" width="200" height="250" class="inline-bloque">
              </div>
        </div>
      </div>
  </div>
</div>
 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    function ValidarMensaje(){

      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Su mensaje ha sido enviado',
        html: 'HJA Remodelaciones pronto le estará contactando',
        showConfirmButton: true,
        
        confirmButtonColor: '#14BFAC'
        
      }).then((result) => {
       if (result.value) {
  
    window.location.href = "http://localhost/PaginaPrincipal.php";
    }
      })



}


  <?php
    if($_SESSION['prueba'] === TRUE){
      echo("ValidarMensaje();");
    }
  ?>


    
  </script>
</form>

</body>

</html>
