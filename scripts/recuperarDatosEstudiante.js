const recuperarDatosEstudiante=()=>{
    fetch('../backend/consultaPerfilEstudiante.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
        console.log("asdas")
    const seccionDatosEstudiante=document.getElementById('datos-estudiante');
    seccionDatosEstudiante.innerHTML=data;
    })
    } 
    recuperarDatosEstudiante();
    
    
    