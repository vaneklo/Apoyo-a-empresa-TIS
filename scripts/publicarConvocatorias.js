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
    let patron = new RegExp("^[a-zA-Zñáéíóú ]+$ ?");
    return !!patron.test(titulo);}


const validarDescripcion=(descripcion)=>{
    let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z_.,:;\t\h\r\n\<br />]+$"); 
    return !!patron.test(descripcion);}

const validarTamanioTitulo=(titulo)=>{return (titulo.length>4 && titulo.length<36);}

const validarTamanioDescripcion=(descripcion)=>{return (descripcion.length>99 && descripcion.length<501);}


const validarMinimaFechaLimite=(fechaL)=>{
    let fechaHoy=new Date();
    let fechaLimite=new Date(fechaL);
    let milisegundosDia=86400000;
    let milisegundosTranscurridos=(fechaHoy.getTime()-fechaLimite.getTime())*-1;
    let diasTrancurridos=Math.round(milisegundosTranscurridos/milisegundosDia);
    console.log(diasTrancurridos)
    return (diasTrancurridos<0);
    }




const semestreValido=(estado1Semestre,estado2semestre)=>{
return(estado1Semestre=='on'||estado2semestre=='on');
}

const validarFechaLimite=(fechaL)=>{
return (fechaL!='');}



const subirDatos=()=>{
let datosFormulario=new FormData(formulario);
espacioMensaje.innerHTML="";
let validoParaSubir=true;


if(datosFormulario.get('titulo')=='')
{validoParaSubir=false;
espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Llenar todos los campos</p>';
}

if(datosFormulario.get('descripcion')=='')
{validoParaSubir=false;
espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Debe incluir una descripción</p>';
}

if(!validarTitulo(datosFormulario.get('titulo')))
{validoParaSubir=false; 
espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El titulo no puede contener caracteres especiales, ni numeros</p>' }    

if(!validarDescripcion(datosFormulario.get('descripcion')))
{validoParaSubir=false;
 espacioMensaje.innerHTML+='<p class=mensaje-rojo>*La decripcion no puede contener caracteres especiales</p>';}
   
if(!validarTamanioTitulo(datosFormulario.get('titulo')))
{validoParaSubir=false;
 espacioMensaje.innerHTML+='<p class=mensaje-rojo>*El titulo debe contener entre 5 y 35 caracteres</p>';}

if(!validarTamanioDescripcion(datosFormulario.get('descripcion')))
{validoParaSubir=false;    
 espacioMensaje.innerHTML+='<p class=mensaje-rojo>*La descripcion debe contener entre 100 y 500 caracteres</p>';}

 if(!validarFechaLimite(datosFormulario.get('fechaFin'))){
    validoParaSubir=false;    
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Debe incluir una fecha límite</p>';}




if(validarMinimaFechaLimite(datosFormulario.get('fechaFin'))){
    console.log('asdasdasdas')
    validoParaSubir=false;    
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*La fecha limite debe ser mayor a la actual </p>';}

if(!semestreValido(datosFormulario.get('semestre1'),datosFormulario.get('semestre2'))){
  validoParaSubir=false;    
   espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Debe seleccionar un semestre </p>';}


if(validoParaSubir){
    fetch('../backend/publicarConvocatoria.php',{
        method:'POST',
        body:datosFormulario
                                                }
         )
        .then(res=>res.json())
        .then(data=>{
            if(data=="La convocatoria ha sido publicada exitosamente"){espacioMensaje.innerHTML+='<p class=mensaje-verde>*'+data+'</p>';}
            else{espacioMensaje.innerHTML+='<p class=mensaje-rojo>*'+data+'</p>';}
                    })
    }

}

asignarSemestresAnio();

formulario.addEventListener('submit',(e)=>{
e.preventDefault();
subirDatos();
}
);











