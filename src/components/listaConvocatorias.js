import { useEffect } from "react";
function ListaConvocatorias(){

useEffect(()=>{
fetch('http://localhost:80/backendTIS/listaConvocatorias.php',{method:'GET'})
.then(response=>response.json() )
.then(data=>{
const contenido_tarjetas=document.getElementById('contenedor-tarjetas');
if(data!=null){
contenido_tarjetas.innerHTML=data;}
}
)
  },[]);


return(
  <div id="contenedor-tarjetas">
  
  </div>
  );  
  }
  export default ListaConvocatorias;
  