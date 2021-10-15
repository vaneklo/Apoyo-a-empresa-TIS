let formulario=document.getElementById('formulario');
let semestre1=document.getElementById('1erSemestre');
let semestre2=document.getElementById('2doSemestre');
let anio=(new Date).getFullYear();
let espacioMensaje=document.getElementById('espacio-mensaje');

const asignarSemestresAnio=()=>{
semestre1.innerHTML="1-"+anio;
semestre2.innerHTML="2-"+anio;  }


const mensaje=(val)=>{
let opcion1semestre=document.getElementById('opcion1');
let opcion2semestre=document.getElementById('opcion2');
if(val===1){opcion2semestre.checked=false;}
else{
    if(val===2){opcion1semestre.checked=false;}}
                      }


const validarTitulo=(titulo)=>{
    let patron = new RegExp("^[a-zA-Zñáéíóú]+ ?");
    return !!patron.test(titulo);}


const validarDescripcion=(descripcion)=>{
    let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z\t\h\r\n\<br />]+"); 
    return !!patron.test(descripcion);}


const validarFechaLimite=(fechaL)=>{
let fechaHoy=new Date();
let fechaLimite=new Date(fechaL);
let milisegundosDia=86400000;
let milisegundosTranscurridos=Math.abs(fechaHoy.getTime()-fechaLimite.getTime());
let diasTrancurridos=Math.round(milisegundosTranscurridos/milisegundosDia);
return (diasTrancurridos<21);
}


const subirDatos=()=>{
let datosFormulario=new FormData(formulario);
espacioMensaje.innerHTML="";
if(validarTitulo(datosFormulario.get('titulo'))){
   if(validarDescripcion(datosFormulario.get('descripcion'))){
        if(validarFechaLimite(datosFormulario.get('fechaFin'))){
             
            fetch('../backend/publicarConvocatoria.php',{
                method:'POST',
                body:datosFormulario
                                                        }
                 )
                .then(res=>res.json())
                .then(data=>{alert(data)})
                 
        }
        else
        {espacioMensaje.innerHTML+='<p class=mensaje-rojo>la fecha limite no debe ser mayor a las 3 semanas de la publicacion</p>';}}
   else
   {espacioMensaje.innerHTML+='<p class=mensaje-rojo>la decripcion no puede contener caracteres especiales</p>';}
}
else
{espacioMensaje.innerHTML+='<p class=mensaje-rojo>el titulo no puede contener caracteres especiales, ni numeros</p>' }

}

asignarSemestresAnio();

formulario.addEventListener('submit',(e)=>{
e.preventDefault();
subirDatos();
}
);











