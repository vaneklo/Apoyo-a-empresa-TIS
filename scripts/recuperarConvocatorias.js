const recuperarConvocatorias=()=>{
fetch('../backend/consultarConvocatorias.php',{method:'GET'})
.then(res=>res.json())
.then(data=>{
const contenedor_tarjetas=document.getElementById('contenedor-tarjetas');
contenedor_tarjetas.innerHTML=data;

})
} 
recuperarConvocatorias();



