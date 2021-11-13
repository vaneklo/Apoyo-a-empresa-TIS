<?php
include("conexionBD.php");
session_start(); 

$semestre;
$mes=date("m");
$anio=date("Y");
$docente=$_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
if($mes<7){$semestre='1-'.$anio;}
else{$semestre='2-'.$anio;}

function generarCodigo($semestre){
return ($semestre."".rand(1,9)."".rand(3,8)."".rand(0,5));}

//el numero de carnet se recupera de la sesion activa

function crearClase($semestre,$conexionBD,$docente){
    $nuevoCodigo=generarCodigo($semestre);
    $query="INSERT INTO CLASE
    (COD_CLASE,
    SEMESTRE,
    NUMERO_CARNET_IDENTIDAD_DOCENTE
    )VALUES(
    '$nuevoCodigo',
    '$semestre',
    '$docente'
    )";
    $result=mysqli_query($conexionBD,$query);
    echo json_encode("clase creada con exito");
}
crearClase($semestre,$conexionBD,$docente);

?>