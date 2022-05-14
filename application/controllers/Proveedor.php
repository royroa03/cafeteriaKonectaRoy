<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Proveedor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('proveedor_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el proveedor
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('nro_doc', 'Número de Documento', 'trim|required');
        $this->form_validation->set_rules('razon_social', 'Razón Social', 'trim|required');
        $this->form_validation->set_rules('telefono1', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_proveedor'));
        }else {
            #Datos
            $proveedor = array(
                'tipo_doc'      => $this->security->xss_clean($this->input->post('tipo_doc')),
                'nro_doc'       => $this->security->xss_clean($this->input->post('nro_doc')),
                'razon_social'       => $this->security->xss_clean($this->input->post('razon_social')),
                'telefono1'         => $this->security->xss_clean($this->input->post('telefono1')),
                'telefono2'         => $this->security->xss_clean($this->input->post('telefono2')),
                'direccion'         => $this->security->xss_clean($this->input->post('direccion')),
                'referencia'        => $this->security->xss_clean($this->input->post('referencia'))
            );
            #Enviamos los datos 
            $this->proveedor_model->save($proveedor);

            #Redirecionamos a la lista de proveedores
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Proveedor REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_proveedor'));
        }
    }
    
    #Actualizamos el proveedor
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('edit_nro_doc', 'Número de Documento', 'trim|required');
          $this->form_validation->set_rules('edit_razon_social', 'Razón Social', 'trim|required');
        $this->form_validation->set_rules('edit_telefono1', 'Teléfono', 'trim|required');
        $this->form_validation->set_rules('edit_direccion', 'Dirección', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_proveedor'));
        }else {
            #Obtenemos el valor
            $id_proveedor = $this->security->xss_clean($this->input->post('id_proveedor'));
            #Datos del proveedor 
            $proveedor = array(
                'tipo_doc' 		=> $this->security->xss_clean($this->input->post('edit_tipo_doc')),
                'nro_doc' 		=> $this->security->xss_clean($this->input->post('edit_nro_doc')),
                'razon_social' 		=> $this->security->xss_clean($this->input->post('edit_razon_social')),
                'telefono1' 		=> $this->security->xss_clean($this->input->post('edit_telefono1')),
                'telefono2' 		=> $this->security->xss_clean($this->input->post('edit_telefono2')),
                'direccion' 		=> $this->security->xss_clean($this->input->post('edit_direccion')),
                'referencia' 		=> $this->security->xss_clean($this->input->post('edit_referencia'))
            );
            #Enviamos los datos del personal para registrar
            $this->proveedor_model->update($proveedor,$id_proveedor);

            #Redirecionamos a la lista de proveedores
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Proveedor ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_proveedor'));
        }
    }

    #Eliminar personal
    public function eliminar()
    {   
        $id_personal=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_personal)){
            #Eliminamos el personal
            $this->personal_model->delete($id_personal);
            $response = array('status' => 1, 'msg' => 'Se eliminó el personal con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar el personal.');
        }
        $this->responseJSON($response);
    }

    #Grabar un proveedor
    public function savemodal()
    {   
        $tipo_doc=$this->security->xss_clean($this->input->post('tipo_doc'));
        $nro_doc=$this->security->xss_clean($this->input->post('nro_doc'));

        #Datos del proveedor 
        $proveedor = array(
            'tipo_doc' 		=> $this->security->xss_clean($this->input->post('tipo_doc')),
            'nro_doc' 		=> $this->security->xss_clean($this->input->post('nro_doc')),
            'telefono1' 		=> $this->security->xss_clean($this->input->post('telefono1')),
            'telefono2' 		=> $this->security->xss_clean($this->input->post('telefono2')),
            'direccion' 		=> $this->security->xss_clean($this->input->post('direccion')),
            'referencia' 		=> $this->security->xss_clean($this->input->post('referencia')),
            'razon_social' 		=> $this->security->xss_clean($this->input->post('razon_social'))
        );

        if($tipo_doc != null && $nro_doc  != null){
            #Grabar el proveedor
            $this->proveedor_model->save($proveedor);
            $response = array('status' => 1, 'msg' => 'Proveedor registrado con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Error al registrar el proveedor.');
        }
        $this->responseJSON($response);
    }
}