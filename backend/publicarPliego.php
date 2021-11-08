<?php
include("conexionBD.php");
$titulo_documento=$_POST['titulo'];
$fecha_publicacion=date("Y-m-d");
$carnet_identidad_docente="1231321412";
$descripcion=$_POST['descripcion'];
$semestre_anio='';
$codigo="1234567";

if(isset($_POST['semestre1'])){$semestre_anio=('1-'. date("Y"));}
else{
if(isset($_POST['semestre2'])){$semestre_anio=('2-'. date("Y"));}
}

 
function NoExisteUnaInviEnMismoSemestre($conexionBD,$semestre_anio){
    $consultaSQL='SELECT * FROM pliego_especificaciones WHERE SEMSTRE_ANIO="'.$semestre_anio.'"';
    $resultadoConsulta=mysqli_query($conexionBD,$consultaSQL);
    $filaResultado=mysqli_fetch_array($resultadoConsulta);
    return !(isset($filaResultado['SEMSTRE_ANIO']));
    }

function camposNoLlenos($titulo_documento,$semestre_anio,$descripcion){
    return($titulo_documento===''||  $descripcion==='' || $semestre_anio==='');}


function ejecutarConsultaSubirDatos($conexionBD,$titulo_documento,$semestre_anio,$descripcion,$fecha_publicacion){
    $query="INSERT INTO pliego_especificaciones
    (SEMSTRE_ANIO,
    FECHA_PUBLICACION,
    NUMERO_CARNET_IDENTIDAD_DOCENTE,
    TITULO_DOCUMENTO,
    DESCRIPCION,
    CODIGO
    ) VALUES 
    (
    '$semestre_anio',
    '$fecha_publicacion',
    NULL,
    '$titulo_documento',
    '$descripcion',
    NULL)";
    $result=mysqli_query($conexionBD,$query);
}



function subirDatos($conexionBD,$fecha_publicacion,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente){
    if(NoExisteUnaInviEnMismoSemestre($conexionBD,$semestre_anio)){
        if(camposNoLlenos($titulo_documento,$semestre_anio,$descripcion))
         {echo json_encode('Debes llenar todos los campos');}
        else{
        $nomreOriginalArchivo=basename($_FILES['file']['name']);
        $extension=strtolower(pathinfo($nomreOriginalArchivo,PATHINFO_EXTENSION));
        $nombreNuevoArchivo=$semestre_anio.'.'.$extension;
        $rutaFinal='../archivos/pliegos_especificaciones/'.$nombreNuevoArchivo;
        
           

        if($nomreOriginalArchivo!=''){
            if($extension=="pdf"){
                move_uploaded_file($_FILES["file"]["tmp_name"],$rutaFinal);
                ejecutarConsultaSubirDatos($conexionBD,$titulo_documento,$semestre_anio,$descripcion,$fecha_publicacion);
                echo json_encode("el pliego ha sido publicado exitosamente");
                                     }
              else
              {echo json_encode("el documento debe estar en formato pdf");}
        }
         else{
            echo json_encode("debe adjuntar un documento");}
        }
    }
    
    else{echo json_encode("ya se publico el pliego de especificaciones para la invitacion del semestre ingresado");}
}


subirDatos($conexionBD,$fecha_publicacion,$titulo_documento,$semestre_anio,$descripcion,$codigo,$carnet_identidad_docente);

?>