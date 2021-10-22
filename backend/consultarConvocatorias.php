<?php
include("conexionBD.php");

$query="SELECT * FROM invitacion_publica";
$result=mysqli_query($conexionBD,$query);

$salida='';
while ($filaInvitacion=mysqli_fetch_array($result)){
$consultaPliegoRespectivo='SELECT * FROM PLIEGO_ESPECIFICACIONES WHERE SEMSTRE_ANIO ="'.$filaInvitacion['SEMESTRE_ANIO'].'"';
$resultadoConsulta=mysqli_query($conexionBD,$consultaPliegoRespectivo);
$filaPliego=mysqli_fetch_array($resultadoConsulta);


$salida.='
    <div class="card">
            
        <div class="card-sa"> 
                             <p> '.$filaInvitacion['SEMESTRE_ANIO'].'</p>
            <div class="card-dates">
                            <p>Fecha de publicación: '.$filaInvitacion['FECHA_INICIO'].'</p>
                            <p>Fecha límite: '.$filaInvitacion['FECHA_LIMITE'].'</p>
            </div>
        </div>


        <div class="main-section-post-info">
                            <div class="main-section-post-info-photo">
                            <img src="../img/profile.png">
                            </div>
            <div class="main-section-post-info-content">
                <div class="main-section-post-info-content-convocatoria">
                    <h3>Invitacion pública</h3>
                    <div class="card-title">
                        <h4> Título: '.$filaInvitacion['TITULO_DOCUMENTO'].'</h4>
                    </div>
                    <p class="card-description">'.$filaInvitacion['DESCRIPCION'].'</p>
                    <a target="_blank" href="../archivos/inv_publicas/'.$filaInvitacion['SEMESTRE_ANIO'].'.pdf"> ver PDF de la invitacion publica</a>
                </div>
            
        


                ';
    if(isset($filaPliego['SEMSTRE_ANIO'])){
    $salida.='
    <div class="main-section-post-info-content-pliego">
        <h3>Pligo de especificaciones</h3>
        <div class="card-title">
            <h4> Título: '.$filaPliego['TITULO_DOCUMENTO'].'</h4>
        </div>
        <p class="card-description">'.$filaPliego['DESCRIPCION'].'</p>
        <a target="_blank" href="../archivos/pliegos_especificaciones/'.$filaPliego['SEMSTRE_ANIO'].'.pdf">ver PDF pliego de especificaciones</a>
    </div>
    </div>
    </div>
    </div>
     ';
     } 
    else{
    $salida.='<div class="mensaje-pliego-no-publicado main-section-post-info-content-pliego">
                <h3>Pliego aun no publicado</h3>      
              </div>
              </div>
    </div>
    </div>';



    }




}

echo json_encode('<h1>Lista de convocatorias</h1>
                 <div class="cards">'.$salida.'</div>');

?>