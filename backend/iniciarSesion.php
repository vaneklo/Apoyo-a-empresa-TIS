<?php
include("conexionBD.php");
// $correoElectronico="pero@gmail.com";
// $contrasena="123123123";

$correoElectronico = $_POST['usuario'];
$contrasena = $_POST['password'];

function esUnEstudiante($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM ESTUDIANTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
     return(isset($filaResultado['CI']));}


function esUnDocente($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM DOCENTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return(isset($filaResultado['CI']));
}

function obtenerContrasenaEstudiante($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM ESTUDIANTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
     return $filaResultado['CONTRASENA_ESTUDIANTE'];
    }

function obtenerContrasenaDocente($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM DOCENTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return $filaResultado['CONTRASENA_DOCENTE'];
}


function iniciarSesion($correoElectronico,$conexionBD,$contrasena){
$contraseĆ±aEncriptada;

if(esUnEstudiante($correoElectronico,$conexionBD))
{
    $contrasenaEncriptada=obtenerContrasenaEstudiante($correoElectronico,$conexionBD); 
    if(password_verify($contrasena,$contrasenaEncriptada)){echo json_encode("contrasena de estudiante correcta");}
    
    else{echo json_encode("contrasena de estudiante incorrecta"); }
}

else
{
    if(esUnDocente($correoElectronico,$conexionBD)){
    $contrasenaEncriptada=obtenerContrasenaDocente($correoElectronico,$conexionBD);
        if(password_verify($contrasena,$contrasenaEncriptada)){echo json_encode("contrasena de docente correcta");}

        else{echo json_encode("contrasena de docente incorrecta");}

     }
     else{echo json_encode("correo no registrado en el sistema");}
}


}


iniciarSesion($correoElectronico,$conexionBD,$contrasena);



?>