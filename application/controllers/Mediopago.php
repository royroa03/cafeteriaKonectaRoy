<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Mediopago extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('mediopago_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el medio de pago
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_mediopago'));
        }else {
            #Datos
            $mediopago = array(
                'nombre'      => $this->security->xss_clean($this->input->post('nombre'))
            );
            #Enviamos los datos 
            $this->mediopago_model->save($mediopago);

            #Redirecionamos a la lista de perfiles
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Medio de Pago REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_mediopago'));
        }
    }
    
    #Actualizamos el medio de pago
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_nombre', 'Nombre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_mediopago'));
        }else {
            #Obtenemos el valor
            $id_mediopago = $this->security->xss_clean($this->input->post('id_mediopago'));
            #Datos del medio de pago 
            $mediopago = array(
                'nombre' 		=> $this->security->xss_clean($this->input->post('edit_nombre'))
            );
            #Enviamos los datos del medio de pago para registrar
            $this->mediopago_model->update($mediopago,$id_mediopago);

            #Redirecionamos a la lista de medios de pagos
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Medio de Pago ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_mediopago'));
        }
    }

    #Eliminar medio de pago
    public function eliminar()
    {   
        $id_mediopago=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_mediopago)){
            #Eliminamos el medio de pago
            $this->mediopago_model->delete($id_mediopago);
            $response = array('status' => 1, 'msg' => 'Se eliminó el medio de pago con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar el medio de pago.');
        }
        $this->responseJSON($response);
    }
}