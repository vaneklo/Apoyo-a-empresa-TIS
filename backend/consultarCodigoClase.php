<?php
include("conexionBD.php");
$semestre;
$mes=date("m");
$anio=date("Y");

if($mes<7){$semestre='1-'.$anio;}
else{$semestre='2-'.$anio;}


function verificarCodigosRegistrados($conexionBD,$semestre){
     $consultaSQL='SELECT * FROM clase WHERE SEMESTRE="'.$semestre.'"';
     $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
     $filaResultado=mysqli_fetch_array($resultadoConsulta);

     //no hay ningun codigo creado para la clase
     if (isset($filaResultado['COD_CLASE'])){echo json_encode($filaResultado['COD_CLASE']);}
     else{ echo json_encode(null);}
    }
    
    verificarCodigosRegistrados($conexionBD,$semestre)


?>