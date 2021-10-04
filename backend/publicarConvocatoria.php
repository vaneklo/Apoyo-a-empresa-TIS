1<?php
include("conexionBD.php");

$titulo_documento=$_POST['titulo'];
$fecha_inicio=$_POST['fechaInicio'];
$fecha_limite=$_POST['fechaFin'];
$carnet_identidad_docente="1112223";
$descripcion=$_POST['descripcion'];
$semestre_anio=$_POST['semestre'];
$codigo="12345";

$query="INSERT INTO invitacion_publica
(FECHA_INICIO,
FECHA_LIMITE,
NUMERO_CARNET_IDENTIDAD_DOCENTE,
TITULO_DOCUMENTO,
SEMESTRE_ANIO,
DESCRIPCION,
CODIGO)
 VALUES(
'$fecha_inicio',
'$fecha_limite',
NULL,
'$titulo_documento',
'$semestre_anio',
'$descripcion',
NULL)";

$result=mysqli_query($conexionBD,$query);

?>