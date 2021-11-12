
const campoCodigoClase=document.getElementById('espacio-codigo-clase');
const generarCodigoAleatorio=()=>{
    fetch('../backend/crearClaseConNuevoCodigo.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>console.log(mensaje))
}

const llenarCampoCodigo=()=>{
//comprobar si puede generar un codigo para este semestre, sino recuperar el ya existente
fetch('../backend/consultarCodigoClase.php',{method:'GET'})
.then(res=>res.json())
.then(respuesta=>{
          if(respuesta!=null){
               campoCodigoClase.innerHTML='<h2>ya creo una clase para el semestre actual</h2> <h2>Codigo de la clase:</h2>'+respuesta
    +'<h4>debe compartir el codigo solo con los alumnos inscritos en la materia</h4>';  
                                   }
          else{
          campoCodigoClase.innerHTML='<button id="botonGeneraCodigo" onclick=generarCodigoAleatorio()>generar un codigo para el semestre actual</button>';
              }
})
}
llenarCampoCodigo();
