<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Perfil extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('perfil_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el perfil
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_perfil'));
        }else {
            #Datos
            $perfil = array(
                'nombre'      => $this->security->xss_clean($this->input->post('nombre'))
            );
            #Enviamos los datos 
            $this->perfil_model->save($perfil);

            #Redirecionamos a la lista de perfiles
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Perfil REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_perfil'));
        }
    }
    
    #Actualizamos el perfil
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_perfil'));
        }else {
            #Obtenemos el valor
            $id_perfil = $this->security->xss_clean($this->input->post('id_perfil'));
            #Datos del perfil 
            $perfil = array(
                'nombre' 		=> $this->security->xss_clean($this->input->post('edit_nombre'))
            );
            #Enviamos los datos del perfil para registrar
            $this->perfil_model->update($perfil,$id_perfil);

            #Redirecionamos a la lista de perfiles
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Perfil ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_perfil'));
        }
    }

    #Eliminar perfil
    public function eliminar()
    {   
        $id_perfil=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_perfil)){
            #Eliminamos el perfil
            $this->perfil_model->delete($id_perfil);
            $response = array('status' => 1, 'msg' => 'Se eliminó el perfil con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar el perfil.');
        }
        $this->responseJSON($response);
    }
}