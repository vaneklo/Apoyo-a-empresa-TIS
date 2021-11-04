<?php
include("conexionBD.php");
$correoElectronico = $_POST['correo'];
$contrasena = $_POST['password'];
session_start(); 

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
$contraseñaEncriptada;
if(esUnEstudiante($correoElectronico,$conexionBD))
{
    $contrasenaEncriptada=obtenerContrasenaEstudiante($correoElectronico,$conexionBD); 
    if(password_verify($contrasena,$contrasenaEncriptada)){
         iniciarSesionEstudiante($correoElectronico,$conexionBD);
        echo json_encode("contrasena de estudiante correcta");
    }
    
    else{echo json_encode("contrasena de estudiante incorrecta"); }
}
else
{
    if(esUnDocente($correoElectronico,$conexionBD)){
    $contrasenaEncriptada=obtenerContrasenaDocente($correoElectronico,$conexionBD);
        if(password_verify($contrasena,$contrasenaEncriptada)){
            iniciarSesionDocente($correoElectronico,$conexionBD);
            echo json_encode("contrasena de docente correcta");}

        else{echo json_encode("contrasena de docente incorrecta");}

     }
     else{echo json_encode("correo no registrado en el sistema");}
}
}

function iniciarSesionEstudiante($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM ESTUDIANTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    $_SESSION['CODIGO_SIS']=$filaResultado['CODIGO_SIS'];
    $_SESSION['COD_CLASE']=$filaResultado['COD_CLASE'];
    $_SESSION['CI']=$filaResultado['CI'];
    $_SESSION['NOMBRE']=$filaResultado['NOMBRE'];
    $_SESSION['APELLIDO_PATERNO']=$filaResultado['APELLIDO_PATERNO'];
    $_SESSION['APELLIDO_MATERNO']=$filaResultado['APELLIDO_MATERNO'];
    $_SESSION['CARRERA']=$filaResultado['CARRERA'];
    $_SESSION['CORREO_ELECTRONICO']=$filaResultado['CORREO_ELECTRONICO'];
    $_SESSION['ROL']=$filaResultado['ROL'];
}
  
function iniciarSesionDocente($correoElectronico,$conexionBD){
    $consultaSQL='SELECT * FROM DOCENTE WHERE CORREO_ELECTRONICO="'.$correoElectronico.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    $_SESSION['NUMERO_CARNET_IDENTIDAD_DOCENTE']=$filaResultado['NUMERO_CARNET_IDENTIDAD_DOCENTE'];
    $_SESSION['NOMBRE']=$filaResultado['NOMBRE'];
    $_SESSION['APELLIDO_PATERNO']=$filaResultado['APELLIDO_PATERNO'];
    $_SESSION['APELLIDO_MATERNO']=$filaResultado['APELLIDO_MATERNO'];
    $_SESSION['CORREO_ELECTRONICO']=$filaResultado['CORREO_ELECTRONICO'];
    $_SESSION['TELEFONO']=$filaResultado['TELEFONO'];
}



iniciarSesion($correoElectronico,$conexionBD,$contrasena);



?>