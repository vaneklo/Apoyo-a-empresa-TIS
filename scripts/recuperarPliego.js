const recuperarPliego=()=>{
    fetch('../backend/consultarPliego.php',{method:'GET'})
    .then(res=>res.json())
    .then(data=>{
    const contenedor_tarjetas=document.getElementById('contenedor-tarjetas');
    contenedor_tarjetas.innerHTML=data;
    console.log(data);
    })
    } 
    recuperarPliego();