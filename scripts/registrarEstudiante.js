const subirDatos=()=>{
    let datosFormulario=new FormData(formulario);
    fetch('../backend/RegistrarEstudiante.php',{
                                                method:'POST',
                                                body:datosFormulario
                                                }
                                                )
                .then(res=>res.json())
                .then(data=>{console.log(data);})
        
    }
    
    formulario.addEventListener('submit',(e)=>{
    subirDatos();
    e.preventDefault();                        });
    
    
    
    
    
    
    
    