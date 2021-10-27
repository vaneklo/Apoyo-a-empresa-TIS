<?php
include("conexionBD.php");
$nombre=$_POST['nombreEstudiante'];
$apellidoPaterno=$_POST['apellidoPaternoEstudiante'];
$apellidoMaterno=$_POST['apellidoMaternoEstudiante'];
$carnetIdentidad=$_POST['carnetEstudiante'];
$codigoSis=$_POST['codigoSisEstudiante'];
$correo=$_POST['correoEstudiante'];
$carrera=$_POST['carrera'];
$contrasena=$_POST['contrasenaEstudiante'];
$codigoClase=$_POST['codigoClase'];



function estudianteRegistrado($conexionBD,$codigoSis){
    $consultaSQL='SELECT * FROM estudiante WHERE CODIGO_SIS="'.$codigoSis.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return (!isset($filaResultado['CI']));
    }

function codigoEsValido($conexionBD,$codigoClase){
    $consultaSQL='SELECT * FROM clase WHERE COD_CLASE="'.$codigoClase.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return (isset($filaResultado['SEMESTRE']));
}

function correoRegistrado($conexionBD,$correo){
    $consultaSQL='SELECT * FROM estudiante WHERE CORREO_ELECTRONICO="'.$correo.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return (isset($filaResultado['CI']));
    }

    function ejecutarConsultaSubirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase){
       $cifrado=password_hash($contrasena,PASSWORD_DEFAULT,['cost'=>10]);
       $query="INSERT INTO estudiante
        (CODIGO_SIS ,
        SEMESTRE,
        COD_CLASE,
        NOMBRE_CORTO,
        CI,
        NOMBRE,
        APELLIDO_PATERNO,
        APELLIDO_MATERNO,
        CARRERA,
        CORREO_ELECTRONICO,
        CONTRASENA_ESTUDIANTE, 
        ROL
        )VALUES 
        ('$codigoSis',
          null,
          '$codigoClase',
          NULL,
        '$carnetIdentidad',  
        '$nombre',
        '$apellidoPaterno',
        '$apellidoMaterno',
        '$carrera',
        '$correo',
        '$cifrado',
        NULL
        )";
        $result=mysqli_query($conexionBD,$query);}
    

    function subirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase){
        if(estudianteRegistrado($conexionBD,$codigoSis)){
        if(codigoEsValido($conexionBD,$codigoClase))
            {
                if(!correoRegistrado($conexionBD,$correo))
                {
                    ejecutarConsultaSubirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase) ; 
                    echo json_encode("Registro exitoso");
                }
                else
                {
                    echo json_encode("el correo ingresado ya registrado");
                }

            }
        else{
            echo json_encode("el codigo ingresado es incorrecto");
            }
        
        }
        else{echo json_encode("el estudiante ya fue registrado en el semestre actual");}
    }
    subirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase);
    


?>