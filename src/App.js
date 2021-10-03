import React, { Component } from 'react';

import Select from 'react-select';
import {
  Button,
  Col,
  Form,
  FormFeedback,
  FormGroup,
  Input,
  Label,
  Row,
} from 'reactstrap';

const options = [
  { value: '1', label: 'Primer Semestre' },
  { value: '2', label: 'Segundo Semestre' },
]
class App extends Component {
  constructor(props){
    super(props);

    this.state = {
      titulo: '',
      fechai: '',
      fechal: '',
      semestre: '',
      descripcion: '',
      mensajeTitulo: '',
      mensajeFechai: '',
      mensajeFechal: '',
      mensajeSemestre: '',
      mensajeDescripcion: '',
      invalidTitulo: false,
      invalidFechai: false,
      invalidFechal: false,
      invalidSemestre: false,
      invalidDescripcion: false,
    }
    this.onChange = this.onChange.bind(this);
    this.enviarAlaBD = this.enviarAlaBD.bind(this);
  }

  
  onChange = and =>{
    const {name, value} = and.target;
    this.setState({
      [name]: value,
    });
  }
  enviarAlaBD = and  => {
    and.preventDefault();
    let valido = true;
    if(this.state.titulo === ''){
      this.setState({
        invalidTitulo: true,
        mensajeTitulo: 'El campo titulo es obligatorio.',
      });
      valido = false;
    }
    if(this.state.fechai === ''){
      this.setState({
        invalidFechai: true,
        mensajeFechai: 'Indica tu dirección de correo',
      });
      valido = false;
    }
    if(this.state.fechal === ''){
      this.setState({
        invalidFechal: true,
        mensajeFechal: 'Indica tu edad',
      });
      valido = false;
    }
    if(this.state.semestre === ''){
      this.setState({
        invalidSemestre: true,
        mensajeSemestre: 'Indica tu edad',
      });
      valido = false;
    }
    if(this.state.descripcion === ''){
      this.setState({
        invalidDescripcion: true,
        mensajeDescripcion: 'Indica tu edad',
      });
      valido = false;
    }
    if(valido){
      //Enviarlo a la base de datos o a otro componente
      console.log("Se envian los datos " + JSON.stringify(this.state));
    }
  }
  render(){
    return (
      <div>
        <Row>
          <Col xs="3"></Col>
          <Col xs="6">
            <h2>Registro de Participantes</h2>
            <Form onSubmit={this.enviarAlaBD}>
              <FormGroup>
                <Label>Titulo</Label>
                <Input type="text" placeholder="Titulo"name="titulo" value={this.state.titulo} onChange={this.onChange} invalid={this.state.invalidTitulo} maxlength="35" />
                <FormFeedback>{this.state.mensajeTitulo}</FormFeedback>
              </FormGroup>
              <FormGroup>
                <Label>Fecha de Inicio</Label>
                <Input type="date" name="fechai" value={this.state.fechai} onChange={this.onChange} invalid={this.state.invalidFechai}/>
                <FormFeedback>{this.state.mensajeFechai}</FormFeedback>
              </FormGroup>
              <FormGroup>
                <Label>Fecha Limite</Label>
                <Input type="date" name="fechal" className="col-2" value={this.state.fechal} onChange={this.onChange} invalid={this.state.invalidFechal} />
                <FormFeedback>{this.state.mensajeFechal}</FormFeedback>
              </FormGroup>
              <FormGroup>
                <Label>Semestre</Label>
                <Select name="semestre" placeholder="Semestre"className="col-2" options={options} value={this.state.semestre} onChange={this.onChange} invalid={this.state.invalidSemestre}/>
                <FormFeedback>{this.state.mensajeSemestre}</FormFeedback>
              </FormGroup>
              <FormGroup>
                <Label>Descripcion</Label>
                <Input type="textarea" name="descripcion" className="col-2" value={this.state.descripcion} onChange={this.onChange} invalid={this.state.invalidDescripcion} maxlength="500"/>
                <FormFeedback>{this.state.mensajeDescripcion}</FormFeedback>
              </FormGroup>
              <FormGroup>
                <Button color="success">Enviar</Button>
              </FormGroup>
            </Form>
          </Col>
        </Row>
      </div>
    );
  }
}

export default App;