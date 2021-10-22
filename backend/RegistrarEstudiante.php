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
    
    function ejecutarConsultaSubirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase){
       $cifrado=password_hash($contrasena,PASSWORD_DEFAULT,['cost'=>10]);
       $query="INSERT INTO estudiante
        (CODIGO_SIS ,
        NOMBRE,
        APELLIDO_PATERNO,
        APELLIDO_MATERNO,
        CI,
        CARRERA,
        CORREO_ELECTRONICO,
        CONTRASENA, 
        COD_CLASE,      
        NOMBRE_CORTO,
        ESTADO_CIVIL,
        TELEFONO,
        APROBADO
         ) VALUES 
        ('$codigoSis',
        '$nombre',
        '$apellidoPaterno',
        '$apellidoMaterno',
        '$carnetIdentidad',
        '$carrera',
        '$correo',
        '$cifrado',
        null,
        null,
        NULL,
        null,
        null
        )";

        $result=mysqli_query($conexionBD,$query);}
    
    function subirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase){
        if(estudianteRegistrado($conexionBD,$codigoSis)){
            ejecutarConsultaSubirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase) ; 
            echo json_encode("Registro exitoso");}
        else{echo json_encode("el estudiante ya fue registrado en el semestre actual");}
    }
    subirDatos($conexionBD,$nombre,$apellidoPaterno,$apellidoMaterno,$carnetIdentidad,$codigoSis,$correo,$carrera,$contrasena,$codigoClase);
    


?>