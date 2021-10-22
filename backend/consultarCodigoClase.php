<?php
include("conexionBD.php");
$semestre;
$mes=date("m");
$anio=date("Y");
if($mes<7){
$semestre='1-'.$anio;}
else{$semestre='2-'.$anio;}

function verificarCodigosRegistrados($conexionBD,$semestre){
    $consultaSQL='SELECT * FROM clase WHERE SEMESTRE="'.$semestre.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);

     if (isset($filaResultado['COD_CLASE'])){echo json_encode(true);}
    else{echo json_encode(false);}
    }

    verificarCodigosRegistrados($conexionBD,$semestre)


?>