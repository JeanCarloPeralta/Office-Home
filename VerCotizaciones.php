<?php

session_start();

  if (!isset($_SESSION['nombre'])) { //Verificar si alguien esta logueado
    header("Location: login.php");
    return;
  }

	include 'conexion_bd.php';
  $conn = AbrirCon();
  
   // Variables de sesion
  	$nombre = $_SESSION["nombre"];
    $rol = $_SESSION["rol"];
    $cedula =	$_SESSION["cedula"];
    $correo = $_SESSION["correo"];

  if($rol=='admin'){ //Depedende del rol llama al SP correcto 
    $cotizaciones = "CALL ObtenerSolicitudesAdmin()"; //SP llama todas las cotizaciones
  }else{
    $cotizaciones= "CALL ObtenerSolicitudesUsuario('$cedula')"; //SP llama todas las cotizaciones pertencientes a la cedula indicada en la variable de sesion
  }
    $listaCotizaciones = $conn -> query($cotizaciones);

    
  if(isset($_GET['num'])){ //Este es el procedimiento para eliminar cotizaciones
    $num= $_GET['num'];
    
    $eliminar="DELETE FROM cotizaciones where numCotizacion=$num";
    $conn -> next_result();
  	if($conn -> query($eliminar))
		{
		header('Location: //localhost/VerCotizaciones.php');
		}
		else		
		{
			echo "Error:" . $conn->error;			
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
  <link href= "css/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>


</head>

<body>

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
            <li class="nav-item active"> <!--Estas las deje por si las podemos ocupar luego-->
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

<div class="container col-12 fondo" style="height:99%" >
  <br/>
    <form>
      <div class="titulos" style="padding-bottom: 6%"> <!--Titulo de la pagina-->
        <h2 class="letra" style="background-color: #FF6060 ;padding-left: 2% ">Cotizaciones</h2>
      </div>

  <div style="width: 70%; margin:0 auto"><!--Almacena la tabla-->
  <table class="table table-bordered" style="text-align: center ;" id="tablaCotizaciones">
    <thead style="background-color: #fff ; font-family: Cambria;" class="letra-inputs" id="tablaCotizaciones">
        <tr>
          <th>Número de cotización</th>
          <?php //Si es rol administrador coloca una columna más que se llama nombre
            if($rol=='admin')
              {   
                echo  '<th>Nombre</th>';
              }
          ?>          
          <th>Cita</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody class="letra">
      <?php
        
        if($listaCotizaciones != false) // Despliega la informacion de los SP
        {
          While($row = mysqli_fetch_array($listaCotizaciones))
          {
              echo '<tr>';
              echo '<td> <a href="SCVisualizada.php?num=' . $row["numCotizacion"] . '" style="background-color:#black; color: white; text-decoration: underline;" >'.$row["numCotizacion"]. '</a>' .  '</td>';
            
            if($rol=='admin') //Si es rol administrador despliega los nombres de cada cotizacion.
            {  
              echo '<td>' . $row["nombre"] . '</td>';
            }
              echo '<td>' . $row["dia"] . "<br />" . $row["hora"]. ' </td>';

            if($rol=='admin') //Si es rol administrador aparece el boton de Responder cotizacion / HJA123456789 /remodelaciones.hja@gmail.com
            {  
              //Armar el correo
              echo '<td><a href="mailto: '.$row["correo"].' ?,
              &subject= Respuesta a cotizacion '.$row["numCotizacion"] .'
              &body=Buenos días '. ucwords(strtolower(($row["nombre"]))).',%0D%0A%0D%0A    Favor ver la cotización adjunta:
              %0D%0A%0D%0AAtt: '.ucwords(strtolower(($nombre))).'"%0D%0A%0D%0A 
              style="background-color:#fff  "  class="btn col-11" type="button">Responder Cotización</a></td>';
              }
            
            else //Si es rol es usuario aparece los botones modificar y eliminar 
            {
            echo '<td><a href="SCVisualizadaMod.php?num=' . $row["numCotizacion"] . '" style="background-color:#fff  "  class="btn" type="button">Modificar</a>
                  <a  style="background-color:#fff; color:#000; "  onclick="Eliminar('.$row["numCotizacion"].');" class="btn btn"  type="button">Eliminar</a></td>';
            }
            echo '</tr>';
          }
        }
      ?>
      </tbody>
    </table>

  </div>  
    
</div>
</div>
 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  



  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $(document).ready(function(){
		
		$("#tablaCotizaciones").DataTable({
			
			"paging" : true,
			"searching" : true,
			"ordering" : true,
			"info" : true,
      
		});
		
	})
    
  function Eliminar(numCotizacion) { //Funcion para mostrar el Warning antes de eliminar

  
  Swal.fire( {
  title: '¿Está seguro que desea eliminarlo?',
  text: "Una vez aceptado no se puede recuperar esta información!",
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#14BFAC',
  cancelButtonColor: '#FF6060',
  confirmButtonText: 'Sí, eliminar',
  cancelButtonText: 'Cancelar'
  } ).then( (result) => {
  if (result.value) {
   
    /*Swal.fire(

      'Eliminado!',
      'Esta cotización ha sido eliminada con éxito.',
      'success'
    )*/
    
  }
    window.location.href = "http://localhost/VerCotizaciones.php?num="+ numCotizacion;

    } )
   
  }
  </script>
</form>
</body>

</html>
