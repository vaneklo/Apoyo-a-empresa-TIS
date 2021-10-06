<?php
include("conexionBD.php");
$titulo_documento=$_POST['titulo'];
$fecha_inicio=$_POST['fechaInicio'];
$fecha_limite=$_POST['fechaFin'];
$carnet_identidad_docente="1231321412";
$descripcion=$_POST['descripcion'];
$semestre_anio='';
$codigo="1234567";

if(isset($_POST['semestre1'])){$semestre_anio=('1-'. date("Y"));}
else{
if(isset($_POST['semestre2'])){$semestre_anio=('2-'. date("Y"));}
}

if($titulo_documento===''||$fecha_inicio==='' || $fecha_limite==='' ||  
$descripcion==='' || $semestre_anio===''){
echo json_encode('debes llenar todos los campos');}

else{
$nomreOriginalArchivo=basename($_FILES['file']['name']);
$extension=strtolower(pathinfo($nomreOriginalArchivo,PATHINFO_EXTENSION));
$nombreNuevoArchivo=$_POST['titulo'].'.'.$extension;
$rutaFinal='../archivos/'.$nombreNuevoArchivo;

if(move_uploaded_file($_FILES["file"]["tmp_name"],$rutaFinal) && ($extension=="jpg" ||  $extension=="pdf"))
{
$query="INSERT INTO invitacion_publica
(FECHA_INICIO,
FECHA_LIMITE,
NUMERO_CARNET_IDENTIDAD_DOCENTE,
TITULO_DOCUMENTO,
SEMESTRE_ANIO,
DESCRIPCION,
CODIGO) VALUES 
(
'$fecha_inicio',
'$fecha_limite',
NULL,
'$titulo_documento',
'$semestre_anio',
'$descripcion',
NULL)";
$result=mysqli_query($conexionBD,$query);
echo json_encode("la convocatoria ha sido publicada exitosamente");
}
else{
    echo json_encode("hubo un problema al subir el archivo o no se encontro el archivo");
    }

}
?>