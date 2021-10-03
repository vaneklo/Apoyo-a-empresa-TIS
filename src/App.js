import React, { Component } from 'react';
import CuerpoFormulario from './components/cuerpoFormulario';
import ListaConvocatorias from './components/listaConvocatorias';

class App extends Component {

  render(){
    return (
      <div>
       <CuerpoFormulario></CuerpoFormulario>
      <ListaConvocatorias></ListaConvocatorias>

      </div>
    );
  }
}

export default App;