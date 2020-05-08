<?php
	session_start();
	if (!isset($_SESSION['codusu'])) {
		header('location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mi sistema E-Commerce</title>
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
	<header>
		<div class="logo-place"><a href="index.php"><img src="assets/logo.png"></a></div>
		<div class="search-place">
			<input type="text" id="idbusqueda" placeholder="Encuenta todo lo que necesitas...">
			<button class="btn-main btn-search"><i class="fa fa-search" aria-hidden="true"></i></button>
		</div>
		<div class="options-place">
			<?php
			if (isset($_SESSION['codusu'])) {
				echo
				'<div class="item-option"><i class="fa fa-user-circle-o" aria-hidden="true"></i><p>'.$_SESSION['nomusu'].'</p></div>';
			}else{
			?>
			<div class="item-option" title="Registrate"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
			<div class="item-option" title="Ingresar"><i class="fa fa-sign-in" aria-hidden="true"></i></div>
			<?php
			}
			?>
			<div class="item-option" title="Mis compras">
				<a href="carrito.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
			</div>
		</div>
	</header>
	<div class="main-content">
		<div class="content-page">
			<h3>Mis pedidos</h3>
			<div class="body-pedidos" id="space-list">
			</div>
			<h3>Datos de pago</h3>
			<div class="p-line"><div>MONTO TOTAL:</div>S/.&nbsp;<span id="montototal"></span></div>
			<div class="p-line"><div>Banco:</div>BCP</div>
			<div class="p-line"><div>N° de Cuenta:</div>191-45678945-006</div>
			<div class="p-line"><div>Representante:</div>Encargado de ventas</div>
			<p><b>NOTA:</b> Para confirmar la compra debe realizar el deposito por le monto total, y enviar el comprobante al siguiente correo example@example.com o al número de whatsapp 999 666 333</p>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url:'servicios/pedido/get_procesados.php',
				type:'POST',
				data:{},
				success:function(data){
					console.log(data);
					let html='';
					let monto=0;
					for (var i = 0; i < data.datos.length; i++) {
						html+=
						'<div class="item-pedido">'+
							'<div class="pedido-img">'+
								'<img src="assets/products/'+data.datos[i].rutimapro+'">'+
							'</div>'+
							'<div class="pedido-detalle">'+
								'<h3>'+data.datos[i].nompro+'</h3>'+
								'<p><b>Precio:</b> S/.'+data.datos[i].prepro+'</p>'+
								'<p><b>Fecha:</b> '+data.datos[i].fecped+'</p>'+
								'<p><b>Estado:</b> '+data.datos[i].estadotext+'</p>'+
								'<p><b>Dirección:</b> '+data.datos[i].dirusuped+'</p>'+
								'<p><b>Celular:</b> '+data.datos[i].telusuped+'</p>'+
							'</div>'+
						'</div>';
						if (data.datos[i].estado=="2") {
							monto+=parseFloat(data.datos[i].prepro);
						}
					}
					document.getElementById("montototal").innerHTML=monto;
					document.getElementById("space-list").innerHTML=html;
				},
				error:function(err){
					console.error(err);
				}
			});
		});
	</script>
</body>
</html>