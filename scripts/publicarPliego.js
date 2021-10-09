let anio=(new Date).getFullYear();
let semestre1=document.getElementById('1erSemestre');
let semestre2=document.getElementById('2doSemestre');

const asignarSemestresAnio=()=>{
semestre1.innerHTML="1-"+anio;
semestre2.innerHTML="2-"+anio;
}
asignarSemestresAnio();

const mensaje=(val)=>{
let opcion1semestre=document.getElementById('opcion1');
let opcion2semestre=document.getElementById('opcion2');
if(val===1){opcion2semestre.checked=false;}
else{
    if(val===2){opcion1semestre.checked=false;}
    }
}

var formulario=document.getElementById('formulario');
formulario.addEventListener('submit',(e)=>{
e.preventDefault();
var datosFormulario=new FormData(formulario);

fetch('../backend/publicarPliego.php',{
method:'POST',
body:datosFormulario
})
.then(res=>res.json())
.then(data=>{console.log(data)})
}
);








