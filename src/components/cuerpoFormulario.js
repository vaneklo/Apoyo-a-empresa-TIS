const EnvioDatos=()=>{
let formulario=document.getElementById('formulario');
formulario.addEventListener('submit',(e)=>{
e.preventDefault();
let datosFormulario=new FormData(formulario);
fetch('http://localhost:80/backendTIS/publicarConvocatoria.php',{
method:'POST',
body:datosFormulario})
}
);
}

function CuerpoFormulario() {
return(
<div class="div-formulario">
  <form id="formulario">
   <h2>ingrese el titulo del documento</h2>
   <input name="titulo" type="text" placeholder="titulo"></input>

   <h2>ingrese el semestre-año</h2>
   <input name="semestre" type="text" placeholder="semestre-año"></input>

   <h2>ingrese la descripcion del documento</h2>
   <textarea name="descripcion" cols="30" row="10"></textarea>

   <h2>seleccione la fecha de incio</h2>
    <input name="fechaInicio" type="date"></input>
 
   <h2>seleccione la fecha limite de respuestas para la convocatoria</h2>
    <input name="fechaFin" type="date"></input>

    <h2>adjuente el documento</h2>
    <input name="pdf" type="file"></input>


   <br></br>
   <br></br>
   <br></br>
    <button name="botonFormulario" type="submit" onClick={()=>{EnvioDatos()}}>publicar convocatoria</button>
   <br></br>
   <br></br>
   <br></br>
   <br></br>
  </form>
</div>
);  
}
export default CuerpoFormulario;
