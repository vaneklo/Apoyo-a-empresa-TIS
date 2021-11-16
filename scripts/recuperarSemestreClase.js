let semestreActual=document.getElementById('semestre');
let anioActual=(new Date).getFullYear();
let mesActual=(new Date).getMonth();
const asignarSemestreActual=()=>{
if(mesActual<6){semestreActual.innerHTML="Semestre: 1-"+anioActual;}
else{semestreActual.innerHTML="Semestre: 2-"+anioActual;}
}
asignarSemestreActual();