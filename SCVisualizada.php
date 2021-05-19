  <?php

  include 'conexion_bd.php';
  $conn = AbrirCon();

  session_start();
  $nombre = $_SESSION["nombre"];
  $rol = $_SESSION["rol"];

  if(isset($_GET['num'])){
    $num= $_GET['num'];

    $secciones = "SELECT * FROM unionsecciones WHERE numCotizacion = $num";
    $listaSecciones = $conn -> query($secciones);

    $tipoTrabajo= "SELECT * FROM uniontipotrabajo WHERE numCotizacion = $num";
    $listaTipo = $conn -> query($tipoTrabajo);
  
    
    $cotizaciones = "CALL ObtenerCotizacion($num)";
    $listaCotizaciones = $conn -> query($cotizaciones);
    $row = mysqli_fetch_array($listaCotizaciones);

       
  }
  else{
    echo 'No hay numero';
    die;
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

  <title>Remodelaciones</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


</head>

<body>
<form method="post" action"">

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

<div class="container col-12 fondo" style="height: 107%; ">
  <br/>

      <div class="titulos"> <!--Titulo de la pagina-->
         <h2 class="letra" style="background-color: #FF6060 ;padding-left: 2%">Completa el formulario</h2>
      </div>
      <div class="row titulos"> <!--TNumero de Cotizacion-->
        <h5 class="letra" style="padding-left: 2%"><b>Número de Cotización</b></h5>
        <input class="letra_inputs"  style="margin-left: 3%;" type="text" id="numCotizacion" value="<?= $row['numCotizacion']?>" disabled="true">
      </div>

    <div style="margin-left: 35px; height: 36%;  width: 700px; margin:0 auto;" class="col-6 bloque "><!-- Almacena toda la parte de llenar formulario-->
    
      <div  class="col-12 inline-bloque"><!--Div para los checkbox de de Secciones a Modificar-->
        <div>
          <h5 class="letra espacio" style="margin-left: 25px" background-color: #14BFAC><b>Cúales son las secciones a Modificar:</b></h5>              
        </div>
        <?php include 'verSecciones.php'?>
        
      </div> 
        <br/>
        <br/>

      <div class="col-12 inline-bloque "><!--Div para los checkbox de Trabajo a realizar-->
        <div>
            <h5 class="letra espacio" style="margin-left: 25px" background-color: #FF6060><b>Trabajo a realizar:</b></h5>
          <?php include 'verTipos.php'?>
               
        </div>  
      </div>    
        <br/>
        <br/>

      <div style="padding-bottom: 4%"><!--Div para la parte de presupuesto-->
        <h5 class="letra bloque col-8 espacio" style="margin-left: 25px"><b>Presupuesto Estimado para el proyecto:</b></h5>
        <input class="letra_inputs divMargin espacio col-12"  style="margin-left: 6%;" type="text" id="presupuesto" value="<?= $row['presupuesto']?>" disabled="true">
      </div>
      <div>
        <h5 class="letra bloque col-8 espacio" style="margin-left: 25px"><b>Dimensiones del Espacio:</b></h5><!--Div para la parte de dimensiones-->
        <input class="letra_inputs divMargin espacio col-12" style="margin-left: 6%;" type="text" id="dimesiones" value="<?= htmlentities($row['dimensiones'])?>" disabled="true">
      </div>
    </div>

    <div class="espacio"> <!--Titulo de agendar cita-->
      <h2 class="letra" style="background-color: #14BFAC; padding-left: 2%">Agendar Cita</h2>
    </div>

  <div style="margin-left: 35px; height: 40%;  width: 700px; margin:0 auto" class="col-6 bloque "> <!-- Almacena toda la parte de llenar agendar cita-->
    <div class="titulos"> <!-- Almacena la parte de fecha y hora-->
      <h5 class="letra espacio divMargin" style="margin-left: 38px"><b>Seleccione el día:</b></h5>
        <div class=" titulos"><!-- Almacena el componente de fecha -->
          <input type="date" id="dias" class="letra divMargin bloque margin" style="color: black" value="<?= $row['dia']?>" disabled="true">
        </div>
      <h5 class="letra espacio divMargin" style="margin-left: 38px"><b>Seleccione la hora:</b></h5><!-- Componente de hora -->
          <input type="time" id="hora" class="letra divMargin margin  bloque" style="color: black" value="<?= $row['hora']?>" disabled="true"> 
    </div>

    <div class="titulos "><!-- Almacena la parte de direccion-->
      <h5 class="letra espacio divMargin" style="margin-left: 38px"><b>Ingrese la dirección:</b></h5>
      <input class="letra_inputs divMargin espacio col-12" style="margin-left: 40px" type="text" id="ubicacion" value="<?= $row['direccion']?>" disabled="true">
    </div>

    <div class="titulos bloque"><!-- Almacena la parte de comentarios-->
      <h5 class="letra espacio divMargin"  style="margin-left: 38px"><b>Comentarios:</b></h5>
        <input type="textArea" style="height: 200px ; width: 595px; margin-left: 42px" class="letra_inputs " disabled="true" value="<?= $row['comentarios']?>"/>
        <label class="letra" style="font-size: 12px; margin-left: 42px">(Escriba aquí sus comentarios, dudas o más detalles sobre el proyecto) </label>
    </div>

    <div  class="col-12" style="margin-left: 58px"><!-- Almacena los botones-->
      <a href="SolicitarCotizacion.php" style="background-color: #FF6060 " class="btn  botones col-5 divMargin">Crear nueva Cotizacion</a>
      <a href="VerCotizaciones.php" class="btn  botones col-5 margin">Ver Cotizaciones</a>
      <!--button class="btn botones inline-bloque col-5 margin">Cancelar</button-->
    </div>
  </div>
  
</div>
</div>
 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    function Redirigir(){
      window.location.href="http://localhost/SolicitarCotizacion.php"
    }

  </script>
</form>
</body>

</html>
