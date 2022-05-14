<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Comprobante extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('comprobante_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el comprobante
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('codigo', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_comprobante'));
        }else {
            #Datos
            $comprobante = array(
                'codigo'      => $this->security->xss_clean($this->input->post('codigo')),
                'descripcion'      => $this->security->xss_clean($this->input->post('descripcion'))
            );
            #Enviamos los datos 
            $this->comprobante_model->save($comprobante);

            #Redirecionamos a la lista de comprobantes
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Comprobante REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_comprobante'));
        }
    }
    
    #Actualizamos el comprobante
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_codigo', 'Código', 'trim|required');
        $this->form_validation->set_rules('edit_descripcion', 'Descripción', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_comprobante'));
        }else {
            #Obtenemos el valor
            $id_comprobante = $this->security->xss_clean($this->input->post('id_comprobante'));
            #Datos del comprobante 
            $comprobante = array(
                'codigo' 		=> $this->security->xss_clean($this->input->post('edit_codigo')),
                'descripcion' 		=> $this->security->xss_clean($this->input->post('edit_descripcion'))
            );
            #Enviamos los datos del comprobante para registrar
            $this->comprobante_model->update($comprobante,$id_comprobante);

            #Redirecionamos a la lista de comprobantes
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Comprobante ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_comprobante'));
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