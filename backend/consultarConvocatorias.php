<?php
include("conexionBD.php");

$query="SELECT * FROM invitacion_publica";
$result=mysqli_query($conexionBD,$query);

$salida='';
while ($row=mysqli_fetch_array($result)){
$salida.='
    
    <div class="card">
            
        <div class="card-sa">

            <p> '.$row['SEMESTRE_ANIO'].'</p>

            <div class="card-dates">
                <p>Fecha de publicación: '.$row['FECHA_INICIO'].'</p>
                <p>Fecha límite: '.$row['FECHA_LIMITE'].'</p>
            </div>

        </div>

        <div class="main-section-post-info">

            <div class="main-section-post-info-photo">
                <img src="../img/profile.png">
            </div>

            <div class="main-section-post-info-content">

                <div class="main-section-post-info-content-convocatoria">
                    <h3>Convocatoria</h3>
                    <div class="card-title">
                        <h4> Título: '.$row['TITULO_DOCUMENTO'].'</h4>
                    </div>
                    <p class="card-description">'.$row['DESCRIPCION'].'</p>
                    <a target="_blank" href="../archivos/'.$row['TITULO_DOCUMENTO'].'.pdf">PDF convocatoria</a>
                </div>

                <div class="main-section-post-info-content-pliego">
                    <h3>Pliego de especificaciones</h3>
                    <div class="card-title">
                        <h4></h4>
                    </div>
                    <p class="card-description"></p>
                    <a href="">PDF pliego de especificaciones</a>
                </div>

            </div>
        </div>
    </div>';
}

echo json_encode('
    <h1>Lista de convocatorias</h1>
    <div class="cards">'.$salida.'</div>
');

?>