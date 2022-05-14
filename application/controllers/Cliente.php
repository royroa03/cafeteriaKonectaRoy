<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Cliente extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('cliente_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el cliente
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('nro_doc', 'Número de Documento', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_cliente'));
        }else {
            #Datos
            $sexo_val=null;
            if ($this->security->xss_clean($this->input->post('sexo')) === '') {
                $sexo_val = null;
            }
            $cliente = array(
                'tipo_doc'      => $this->security->xss_clean($this->input->post('tipo_doc')),
                'nro_doc'       => $this->security->xss_clean($this->input->post('nro_doc')),
                'nombres'       => $this->security->xss_clean($this->input->post('nombres')),
                'apellido_paterno'      => $this->security->xss_clean($this->input->post('apellido_paterno')),
                'apellido_materno'      => $this->security->xss_clean($this->input->post('apellido_materno')),
                'sexo'      => $sexo_val,
                'telefono1'         => $this->security->xss_clean($this->input->post('telefono1')),
                'telefono2'         => $this->security->xss_clean($this->input->post('telefono2')),
                'direccion'         => $this->security->xss_clean($this->input->post('direccion')),
                'referencia'        => $this->security->xss_clean($this->input->post('referencia')),
                'correo'        => $this->security->xss_clean($this->input->post('correo')),
                'razon_social'      => $this->security->xss_clean($this->input->post('razon_social'))
            );
            #Enviamos los datos 
            $this->cliente_model->save($cliente);

            #Redirecionamos a la lista de clientes
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Cliente REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_cliente'));
        }
    }
    
    #Actualizamos el cliente
    public function update(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('edit_tipo_doc', 'Tipo de Documento', 'trim|required');
        $this->form_validation->set_rules('edit_nro_doc', 'Número de Documento', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_cliente'));
        }else {
            #Obtenemos el valor
            $id_cliente = $this->security->xss_clean($this->input->post('id_cliente'));
            #Datos del cliente 
            $edit_sexo_val=null;
            if ($this->security->xss_clean($this->input->post('edit_sexo')) === '') {
                $edit_sexo_val = null;
            }
            $cliente = array(
                'tipo_doc' 		=> $this->security->xss_clean($this->input->post('edit_tipo_doc')),
                'nro_doc' 		=> $this->security->xss_clean($this->input->post('edit_nro_doc')),
                'nombres' 		=> $this->security->xss_clean($this->input->post('edit_nombres')),
                'apellido_paterno' 		=> $this->security->xss_clean($this->input->post('edit_apellido_paterno')),
                'apellido_materno' 		=> $this->security->xss_clean($this->input->post('edit_apellido_materno')),
                'sexo'      => $edit_sexo_val,
                'telefono1' 		=> $this->security->xss_clean($this->input->post('edit_telefono1')),
                'telefono2' 		=> $this->security->xss_clean($this->input->post('edit_telefono2')),
                'direccion' 		=> $this->security->xss_clean($this->input->post('edit_direccion')),
                'referencia' 		=> $this->security->xss_clean($this->input->post('edit_referencia')),
                'correo' 		=> $this->security->xss_clean($this->input->post('edit_correo')),
                'razon_social' 		=> $this->security->xss_clean($this->input->post('edit_razon_social'))
            );
            #Enviamos los datos del cliente para registrar
            $this->cliente_model->update($cliente,$id_cliente);

            #Redirecionamos a la lista de clientes
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Cliente ACTUALIZADO con éxito!.</div>');
            redirect(base_url('panel/mant_cliente'));
        }
    }

    #Eliminar cliente
    public function eliminar()
    {   
        $id_cliente=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_cliente)){
            #Eliminamos el cliente
            $this->cliente_model->delete($id_cliente);
            $response = array('status' => 1, 'msg' => 'Se eliminó el cliente con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar el cliente.');
        }
        $this->responseJSON($response);
    }

    #Grabar un cliente
    public function savemodal()
    {   
        $tipo_doc=$this->security->xss_clean($this->input->post('tipo_doc'));
        $nro_doc=$this->security->xss_clean($this->input->post('nro_doc'));

        #Datos del cliente 
        $cliente = array(
            'tipo_doc' 		=> $this->security->xss_clean($this->input->post('tipo_doc')),
            'nro_doc' 		=> $this->security->xss_clean($this->input->post('nro_doc')),
            'nombres' 		=> $this->security->xss_clean($this->input->post('nombres')),
            'apellido_paterno' 		=> $this->security->xss_clean($this->input->post('apellido_paterno')),
            'apellido_materno' 		=> $this->security->xss_clean($this->input->post('apellido_materno')),
            'sexo'      => $this->security->xss_clean($this->input->post('sexo')),
            'telefono1' 		=> $this->security->xss_clean($this->input->post('telefono1')),
            'telefono2' 		=> $this->security->xss_clean($this->input->post('telefono2')),
            'direccion' 		=> $this->security->xss_clean($this->input->post('direccion')),
            'referencia' 		=> $this->security->xss_clean($this->input->post('referencia')),
            'correo' 		=> $this->security->xss_clean($this->input->post('correo')),
            'razon_social' 		=> $this->security->xss_clean($this->input->post('razon_social'))
        );

        if($tipo_doc != null && $nro_doc  != null){
            #Grabar el cliente
            $this->cliente_model->save($cliente);
            $response = array('status' => 1, 'msg' => 'Cliente registrado con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Error al registrar el cliente.');
        }
        $this->responseJSON($response);
    }
}