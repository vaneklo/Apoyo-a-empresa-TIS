let formulario=document.getElementById('formulario');
let semestre1=document.getElementById('1erSemestre');
let semestre2=document.getElementById('2doSemestre');
let anio=(new Date).getFullYear();
let espacioMensaje=document.getElementById('espacio-mensaje');

const asignarSemestresAnio=()=>{
semestre1.innerHTML="1-"+anio;
semestre2.innerHTML="2-"+anio;
}


const mensaje=(val)=>{
let opcion1semestre=document.getElementById('opcion1');
let opcion2semestre=document.getElementById('opcion2');
if(val===1){opcion2semestre.checked=false;}
else{
    if(val===2){opcion1semestre.checked=false;}
    }
}

const validarTitulo=(titulo)=>{
    let patron = new RegExp("^[a-zA-Zñáéíóú ]+$ ?");
    return !!patron.test(titulo);}

const semestreValido=(estado1Semestre,estado2semestre)=>{return(estado1Semestre=='on'||estado2semestre=='on');}


const validarDescripcion=(descripcion)=>{
    let patron = new RegExp("^[a-z||A-Z||0-9][a-zA-Z_.,:;\t\h\r\n\<br />]+"); 
    return !!patron.test(descripcion);}


const validarTamanioTitulo=(titulo)=>{return (titulo.length>4 && titulo.length<36);}

const validarTamanioDescripcion=(descripcion)=>{return (descripcion.length>99 && descripcion.length<501);}



const subirDatos=()=>{

    let datosFormulario=new FormData(formulario);
    let validoParaSubir=true;
    espacioMensaje.innerHTML="";
    let fecha=document.getElementById('');


    if(datosFormulario.get('titulo')=='')
    {validoParaSubir=false;
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Llenar todos los campos</p>';
    }

    if(datosFormulario.get('descripcion')=='')
    {validoParaSubir=false;
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*La decripcion no puede estar vacia</p>';
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

    if(!semestreValido(datosFormulario.get('semestre1'),datosFormulario.get('semestre2'))){
    validoParaSubir=false;    
    espacioMensaje.innerHTML+='<p class=mensaje-rojo>*Debe seleccionar un semestre </p>';}


    if(validoParaSubir){
            fetch('../backend/publicarPliego.php',{
            method:'POST',
            body:datosFormulario
            })
            .then(res=>res.json())
            .then(data=>{
         if(data=="El pliego ha sido publicado exitosamente"){espacioMensaje.innerHTML+='<p class=mensaje-verde>*'+data+'</p>';}
         else{espacioMensaje.innerHTML+='<p class=mensaje-rojo>*'+data+'</p>';}

        })
    }


}

asignarSemestresAnio();

formulario.addEventListener('submit',(e)=>{
subirDatos();
e.preventDefault();
}
);







