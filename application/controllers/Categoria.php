<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Categoria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('categoria_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos la categoría
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_categoria'));
        }else {
            #Datos
            $categoria = array(
                'nombre'      => $this->security->xss_clean($this->input->post('nombre'))
            );
            #Enviamos los datos 
            $this->categoria_model->save($categoria);

            #Redirecionamos a la lista de categorías
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Categoría REGISTRADA con éxito!.</div>');
            redirect(base_url('panel/mant_categoria'));
        }
    }
    
    #Actualizamos la categoria
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_categoria'));
        }else {
            #Obtenemos el valor
            $id_categoria = $this->security->xss_clean($this->input->post('id_categoria'));
            #Datos de categoría 
            $categoria = array(
                'nombre' 		=> $this->security->xss_clean($this->input->post('edit_nombre'))
            );
            #Enviamos los datos de categoria para registrar
            $this->categoria_model->update($categoria,$id_categoria);

            #Redirecionamos a la lista de categorias
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Categoría ACTUALIZADA con éxito!.</div>');
            redirect(base_url('panel/mant_categoria'));
        }
    }

    #Eliminar categoria
    public function eliminar()
    {   
        $id_categoria=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_categoria)){
            #Eliminamos el categoria
            $this->categoria_model->delete($id_categoria);
            $response = array('status' => 1, 'msg' => 'Se eliminó la categoria con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar la categoria.');
        }
        $this->responseJSON($response);
    }
}