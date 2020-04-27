<?php
session_start();
$response=new stdClass();
if (!isset($_SESSION['codusu'])) {
	$response->state=false;
	$response->detail="No esta logeado";
	$response->open_login=true;
}else{
	$response->state=true;
	$response->detail="Esta logeado";
}

//mysqli_close($con);
header('Content-Type: application/json');
echo json_encode($response);