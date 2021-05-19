<?php

session_start();

  if (!isset($_SESSION['nombre'])) { //Verificar si alguien esta logueado
    header("Location: login.php");
    return;
  }

  $_SESSION['enviarSolicitud']=FALSE; //Se usa para la alerta de Enviar cotizacion exitosamente

  include 'conexion_bd.php';
  $conn = AbrirCon();

  // Variables de sesion
  $nombre = $_SESSION["nombre"];
  $rol = $_SESSION["rol"];
  $cedula= $_SESSION["cedula"];
  
if(isset($_POST['btnAgregar'])){//Agregar a la BD
  
  $numCotizacion=rand(); //Genera num de cotizacion random
  
  //Se almacenan todos los datos que estan en el formulario
  $presupuesto=$_POST['presupuesto'];
  $dimensiones=$_POST['dimensiones'];
  $dia=$_POST['dias'];
  $hora=$_POST['hora'];
  $tiempo = date('h:i', strtotime($hora));
  $direccion=$_POST['ubicacion']; 
  $comentarios=$_POST['comentarios'];

  //Hace Insert de la cotizacion a la BD
  $proceso= " call AgregarSolicitud( $numCotizacion, '$cedula' , '$presupuesto' , '$dimensiones' , '$dia', '$tiempo' , '$direccion' , '$comentarios')"; 

  if($conn -> query($proceso)){ // Ejectua el SP de Insertar a cotizaciones
  }else{
    echo "Error:" . $conn->error;
  }

  if(!empty($_POST['Checkbox'])) { //Se llama y se ejecuta el SP de insert para las secciones
    $checkbox1 = $_POST['Checkbox'] ;
    for ($i=0; $i<sizeof ($checkbox1);$i++) {  
      $query= "call AgregarSecciones($numCotizacion , '$checkbox1[$i]')";

        if($conn -> query($query)){
        } else{
          echo "Error:" . $conn->error;
        }
    } 
  }
  else{
    echo ("Por favor seleccione al menos una opción.");
  }

   if(!empty($_POST['CheckT'])) { //Se llama y se ejecuta el SP de insert para los tipos de trabajo que se va a realizar
    $checkboxT = $_POST['CheckT'] ;
      for ($i=0; $i<sizeof ($checkboxT);$i++) {  
        $ejecutar= "call AgregarTipos($numCotizacion, '$checkboxT[$i]')";

          if($conn -> query($ejecutar)){
            unset($_SESSION['enviarSolicitud']); //Se usa para la alerta de Enviar cotizacion exitosamente
             $_SESSION['enviarSolicitud'] = TRUE; //Se usa para la alerta de Enviar cotizacion exitosamente
          } else{
            echo "Error:" . $conn->error;
          }  
      } //Se hace la previsualizcion de la cotizacion
        //header('Location: //localhost/SCVisualizada.php?num='.$numCotizacion);
        //return;
     }
    else{
      echo ("Por favor seleccione al menos una opción.");
    }
  
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
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>


</head>

<body>
  <form action="" method="post" autocomplete="off" >

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

<div class="container col-12 fondo" style="height: 1410px;">
  <br/>
    <div class="titulos"><!--Titulo de la pagina-->
      <h2 class="letra" style="background-color: #FF6060 ;padding-left: 2%">Completa el formulario</h2>
    </div>

  <div style="margin-left: 35px; height: 550px;  width: 700px; margin:0 auto" class="col-6 bloque"> <!-- Almacena toda la parte de llenar formulario-->
      <div  class="col-12 inline-bloque"><!--Div para los checkbox de de Secciones a Modificar-->
        <div>
          <h5 class="letra espacio" style="margin-left: 25px" background-color: #14BFAC><b>Cúales son las secciones a Modificar:</b></h5>              
        </div>
        <div class="form-check form-check-row divMargin col-2">
          <input class="form-check-input" type="checkbox" id="Checkbox1" name="Checkbox[]" value="Cocina" style="margin-left: 0px">
          <label class="form-check-label letra" for="Checkbox1" style="margin-left: 20px">Cocina</label style="margin-left: 0px">
        </div>
        <div class="form-check form-check-row divMargin col-2">
          <input class="form-check-input" type="checkbox" id="Checkbox2" name="Checkbox[]" value="Sala" style="margin-left: 0px">
          <label class="form-check-label letra" for="Checkbox2" style="margin-left: 20px">Sala</label style="margin-left: 0px">
        </div>
        <div class="form-check form-check-row divMargin col-2">
          <input class="form-check-input" type="checkbox" id="Checkbox3" name="Checkbox[]"value="Baño" style="margin-left: 0px">
          <label class="form-check-label letra" for="Checkbox3" style="margin-left: 20px">Baño</label style="margin-left: 0px">
        </div>   
        <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox4" name="Checkbox[]" value="Dormitorio" style="margin-left: 0px">
          <label class="form-check-label letra" for="Checkbox4" style="margin-left: 20px">Dormitorio</label>
        </div>   
      </div> 
        <br/>
        <br/>

      <div class="col-12 inline-bloque"><!--Div para los checkbox de Trabajo a realizar-->
        <div>
          <h5 class="letra espacio" style="margin-left: 25px" background-color: #FF6060><b>Trabajo a realizar:</b></h5>
        </div>
        <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox5" name=CheckT[] value="Ampliación" style="margin-left: 0px">
          <label class="form-check-label letra" for="Checkbox5" style="margin-left: 20px">Ampliación</label>
        </div>
        <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox6" name=CheckT[] value="Mobiliaro" style="margin-left: 0px">
          <label class="form-check-label letra" for="Checkbox6" style="margin-left: 20px"> Cambiar solo mobiliaro</label>
        </div>
        <div class="form-check form-check-row divMargin">
          <input class="form-check-input" type="checkbox" id="Checkbox7" name=CheckT[] value="RemodelaciónT" style="margin-left: 0px">
          <label class="form-check-label letra" for="Checkbox7" style="margin-left: 20px">Remodelación total</label>
        </div>   
      </div>
         <br/>
         <br/>

      <div style="padding-bottom: 4%"><!--Div para la parte de presupuesto-->
        <h5 class="letra bloque col-9 espacio" style="margin-left: 25px"><b>Presupuesto Estimado para el proyecto:</b></h5>
        <input class="letra_inputs form-control divMargin" style="margin-left: 6%;" type="text" id="presupuesto" name="presupuesto" placeholder="Monto en colones">
      </div>
           
      <div><!--Div para la parte de dimensiones-->
        <h5 class="letra bloque col-8 espacio" style="margin-left: 25px"><b>Dimensiones del Espacio:</b></h5>
        <input class="letra_inputs  form-control divMargin" style="margin-left: 6%;" type="text" id="dimesiones" name="dimensiones" placeholder="Área en m2, o dimensiones de largo y ancho">
      </div>
    </div>

    <div class="espacio"><!--Titulo de agendar cita-->
      <h2 class="letra" style="background-color: #14BFAC; padding-left: 2%;">Agendar Cita</h2>
   `</div>

  <div style="margin-left: 35px; height: 570px;  width: 700px; margin:0 auto" class="col-6 bloque"> <!-- Almacena toda la parte de llenar agendar cita-->
    <div class="titulos"> <!-- Almacena la parte de fecha y hora-->
      <h5 class="letra espacio divMargin" style="margin-left: 38px"><b>Seleccione el día:</b></h5>
    <div class=" titulos"><!-- Almacena el componente de fecha -->
      <input type="date" id="dias" name="dias" class="letra divMargin bloque form-control margin " style="color: black" >
    </div>
      <h5 class="letra espacio divMargin" style="margin-left: 38px"><b>Seleccione la hora:</b></h5> <!-- Componente de hora -->
      <input type="time" id="hora" name="hora"  class="letra divMargin margin bloque form-control"  style="color: black" > 
    </div>

    <div class="titulos"><!-- Almacena la parte de direccion-->
      <h5 class="letra espacio divMargin" style="margin-left: 38px"><b>Ingrese la dirección:</b></h5>
      <input class="letra_inputs  form-control divMargin" style="margin-left: 34px" type="text" id="ubicacion" name="ubicacion" placeholder="Ubicación del proyecto">
    </div>

    <div class="titulos bloque"><!-- Almacena la parte de comentarios-->
      <h5 class="letra espacio divMargin" style="margin-left: 38px"><b>Comentarios:</b></h5>
      <textarea style="height: 200px ; width: 570pxs; margin-left: 34px" id="comentarios" name="comentarios" class="letra_inputs form-control bloque"></textarea>
      <label class="letra" style="font-size: 13px; margin-left: 34px;">(Escriba aquí sus comentarios, dudas o más detalles sobre el proyecto) </label>
    </div>
    <div class="col-5" style="margin-left: 45%">
      <input type="submit" class="btn botones bloque" onclick="return Validar();" id="btnAgregar" name="btnAgregar" style="width: 50%" value="Agregar"/>
    </div>
  </div>
</div>
</div>
 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="js/validarVacios.js"></script> <!--Funcion para validar los campos vacions --> 
  

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    
    function SolicitudEnviadaExistosamen(){ //Funcion para la alerta de enviar exitosamente.
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Su cotización ha sido enviada exitosamente!',
        showConfirmButton: true,
        confirmButtonColor: '#14BFAC'
        
      }).then((result) => {
       if (result.value) {
   
    /*Swal.fire(

      'Eliminado!',
      'Esta cotización ha sido eliminada con éxito.',
      'success',
      
    )*/
    window.location.href = "http://localhost/SCVisualizada.php?num="+<?php echo $numCotizacion ?>;
    
    }
      })
  }

  <?php
    if($_SESSION['enviarSolicitud'] === TRUE){ //Llama la funcion SolicitudEnviadaExistosamen
      echo("SolicitudEnviadaExistosamen();");
    }
  ?>

  </script>
</form>
</body>

</html>
