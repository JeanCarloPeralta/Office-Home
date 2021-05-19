<?php

if(isset($_POST['btnCrear'])){//Reconoce el concepto del POST

	include 'conexion_bd.php';
	$conn = AbrirCon();

  //Se almacenan todos los datos que estan en el formulario
  $ced=$_POST['cedula'];
  echo($ced);
  $nombre=$_POST['nombre'];
  $correo=$_POST['correo'];
  $usuario=$_POST['usuario'];
  $pass=$_POST['pass'];
  $tel=$_POST['telefono'];

  //Hace Insert de la cotizacion a la BD
  $proceso= " call 	AgregarUsuarios( '$ced', '$nombre', '$correo' , '$usuario' , '$pass', '$tel')"; 
 

  if($conn -> query($proceso))
		{
				
			header('Location: //localhost/login.php');
		}
		else		
		{
			echo "Error:" . $conn->error;			
		}
  //header('Location: //localhost/VerCotizaciones.php');

  CerrarCon($conn);
}




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
<form action="" method="post" autocomplete="off">


<div class="container col-12">
	<form method="post" action="">
			
			<div  style="padding-bottom: 2% ; padding-top: 5%; text-align: center;">
				<img src="images/logo.png" width="20%">	
			</div>		
			    
				<div class="col-6 registro fondo" style="height: 70%">
					<!--label><h2 class="letra">Bienvendio</h2></label-->
					<br/>

				<div style="margin-left: 9%">

					<div class="form-row col-12 espacio">
						<div class="col-5 ">
							<label class="letra">Número de Cédula</label>
						</div>
						<div>
							<label class="letra">Nombre</label>
						</div>
					</div>

					<div class="form-row col-12 espacio">
						<div class="col-4" style="margin-right: 7%">
							<input type="text" id="cedula" name="cedula" class="form-control"  required=true onblur="BuscarPersona();" placeholder="X-XXXX-XXXX">
						</div>
						<div class="col-6">
							<input type="text" name="nombre" id="nombre" class="form-control" readonly="true">
						</div>
					</div>
					<br/>

					<div class="form-row col-12 espacio">
						<div class="col-4" style="margin-right: 7%">
							<label class="letra">Correo electrónico</label>
						</div>
						<div class="col-6">
							<input type="text" name="correo" class="form-control" required=true placeholder="@ejemplo.com">
						</div>
					</div>
					<br/>

					<div class="form-row col-12 espacio">
						<div class="col-4" style="margin-right: 7%">
							<label class="letra">Usuario</label>
						</div>
						<div class="col-6">
							<input type="text" name="usuario"  required=true  class="form-control">
						</div>
					</div>
					<br/>
					
					<div class="form-row col-12 espacio">
						<div class="col-4" style="margin-right: 7%">
							<label class="letra">Contraseña</label>
						</div>
						<div class="col-6">
							<input type="password" name="pass" required=true  class="form-control" placeholder="*********">
						</div>
					</div>

					<br/>

					<div class="form-row col-12" style="margin-bottom: 5%">
						<div class="col-4" style="margin-right: 7%">
							<label class="letra">Teléfono</label>
						</div>
						<div class="col-6">
							<input type="text" name="telefono" required=true   class="form-control" placeholder="2222-2222">
						</div>
					</div>

				</div>

						
			</form>
			<div class="form-group" style="margin-left: 11%">
			<input type="submit" class="btn col-2 botonNaranja" name="btnCrear" value="Crear"/>
			</div>
					
		</div> 
</div>

<script src="vendor/jquery/jquery.min.js"></script>

<script>

	function BuscarPersona(){
		var requests=new XMLHttpRequest();
		var cedula =document.getElementById('cedula').value.replace(/-/g,"");

		requests.open('GET', 'https://api.hacienda.go.cr/fe/ae?identificacion=' + cedula, true );

		requests.onload=function(){

			if(requests.status>=200 && requests.status<400){
				var data=JSON.parse(this.response);
				$('#nombre').val(data.nombre);
				$('#txtNombres').val(data.nombre);
			}
			else
				alert(requests.status);
		}
		requests.send();
}

</script>
</form>
</body>
</html>
