 fetch('../backend/verificarLogeoDocente.php',{method:'GET'})
    .then(res=>res.json())
    .then(mensaje=>{
        if(!mensaje){window.location.href ='./index.html';}})