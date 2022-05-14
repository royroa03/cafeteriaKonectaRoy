<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Unidad extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('unidad_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos la unidad
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('abreviatura', 'Abreviatura', 'trim|required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_unidad'));
        }else {
            #Datos
            $unidad = array(
                'abreviatura'      => $this->security->xss_clean($this->input->post('abreviatura')),
                'nombre'      => $this->security->xss_clean($this->input->post('nombre'))
            );
            #Enviamos los datos 
            $this->unidad_model->save($unidad);

            #Redirecionamos a la lista de unidades
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Unidad REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_unidad'));
        }
    }
    
    #Actualizamos la unidad
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_abreviatura', 'Abreviatura', 'trim|required');
        $this->form_validation->set_rules('edit_nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_unidad'));
        }else {
            #Obtenemos el valor
            $id_unidad = $this->security->xss_clean($this->input->post('id_unidad'));
            #Datos de la unidad 
            $unidad = array(
                'abreviatura' 		=> $this->security->xss_clean($this->input->post('edit_abreviatura')),
                'nombre' 		=> $this->security->xss_clean($this->input->post('edit_nombre'))
            );
            #Enviamos los datos de la unidad para registrar
            $this->unidad_model->update($unidad,$id_unidad);

            #Redirecionamos a la lista de unidades
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Unidad ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_unidad'));
        }
    }

    #Eliminar unidad
    public function eliminar()
    {   
        $id_unidad=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_unidad)){
            #Eliminamos la unidad
            $this->unidad_model->delete($id_unidad);
            $response = array('status' => 1, 'msg' => 'Se eliminó la unidad con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar la unidad.');
        }
        $this->responseJSON($response);
    }
}