var formulario= document.getElementById('formulario');
formulario.addEventListener('submit',(e)=>{
e.preventDefault();
var datosFormulario=new FormData(formulario);

fetch('../backend/publicarConvocatoria.php',
                                {method:'POST',
                                body:datosFormulario
                                })
.then(res=>res.json())
.then(data=>{})                                
});