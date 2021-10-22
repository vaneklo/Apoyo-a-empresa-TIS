const llenarCampoCodigo=()=>{
//comprobar si puede generar un codigo para este semestre, sino recuperar el ya existente
const campoCodigoClase=document.getElementById('espacio-codigo-clase');
fetch('../backend/consultarCodigoClase.php',{method:'GET'})
.then(res=>res.json())
.then(respuestaExisteClase=>{
if(respuestaExisteClase){
    campoCodigoClase.innerHTML='<h2>ya creo una clase para el semestre actual</h2> <h2>Codigo de la clase:</h2>1112342'
    +'<h4>debe compartir el codigo solo con los alumnos inscritos en la materia</h4>';  
}
else{
    campoCodigoClase.innerHTML='<button id="botonGenerarCodigo">generar un codigo para el semestre actual</button>';
    const campoCodigoClase=document.getElementById('botonGenerarCodigo');
    campoCodigoClase.addEventListener('submit',()=>{generarCodigoAleatorio()});
}
})
}
llenarCampoCodigo();
