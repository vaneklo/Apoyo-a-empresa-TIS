const recuperarDatos=()=>{
    fetch('../backend/consultaPerfil.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
    const seccionDatosPerfil=document.getElementById('datos-perfil');
    seccionDatosPerfil.innerHTML=data;
    })
    } 
    recuperarDatos();
    
    
    