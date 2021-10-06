<?php
include("conexionBD.php");

$query="SELECT * FROM invitacion_publica";
$result=mysqli_query($conexionBD,$query);

$salida='';
while ($row=mysqli_fetch_array($result)){
$salida.='
    <div class="card">
      <div class="card-header">
            <div class="card-title">
                <h2> titulo: '.$row['TITULO_DOCUMENTO'].'</h2>
            </div>

            <div class="card-sa">
                <h3> '.$row['SEMESTRE_ANIO'].'</h3>
            </div>
      </div>  
            <div class="card-dates">
                 <p>fecha de publicacion: '.$row['FECHA_INICIO'].'</p>
                 <p>fecha limite: '.$row['FECHA_LIMITE'].'</p>
            </div>
            
            <div class="card-description">
                    <p>'.$row['DESCRIPCION'].'</p>
            </div>

         <a target="_blank" href="../archivos/'.$row['TITULO_DOCUMENTO'].'.pdf">revisar documento adjunto</a>
    </div>';
}

echo json_encode('<div class="cards">'.$salida.'</div>');

?>