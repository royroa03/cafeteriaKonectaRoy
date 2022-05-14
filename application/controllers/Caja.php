<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Caja extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('caja_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos la caja
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('id_usuario', 'Usuario', 'trim|required');
        $this->form_validation->set_rules('fecha_apertura', 'Fecha de Apertura', 'trim|required');
        $this->form_validation->set_rules('fecha_cierre', 'Fecha de Cierre', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_caja'));
        }else {
            #Datos
            $caja = array(
                'id_usuario'      => $this->security->xss_clean($this->input->post('id_usuario')),
                'fecha_apertura'      => $this->security->xss_clean($this->input->post('fecha_apertura')),
                'fecha_cierre'      => $this->security->xss_clean($this->input->post('fecha_cierre'))
            );
            #Enviamos los datos 
            $this->caja_model->save($caja);
            #Redirecionamos a la lista de cajas
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Caja REGISTRADA con éxito!.</div>');
            redirect(base_url('panel/mant_caja'));
        }
    }
    
    #Actualizamos la caja
    public function apertura(){
        #Validamos los campos del formulario
          $this->form_validation->set_rules('id_caja', 'Caja', 'trim|required');
        $this->form_validation->set_rules('id_moneda', 'Moneda', 'trim|required');
        $this->form_validation->set_rules('monto_inicial', 'Monto Inicial', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>- Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_venta'));
        }else {
            #Obtenemos el valor
            $id_caja = $this->security->xss_clean($this->input->post('id_caja'));
            #Datos de la caja
            $caja = array(
                'id_caja'      => $this->security->xss_clean($this->input->post('id_caja')),
                'id_moneda'      => $this->security->xss_clean($this->input->post('id_moneda')),
                'monto_inicial'      => $this->security->xss_clean($this->input->post('monto_inicial')),
                'flestado'      => 2, // 2:Aperturada
                'feregistro_apertura' => date('Y-m-d H:i:s')
            );

            $caja_apertura=$this->caja_model->getAperturaPorUsuario(array('flestado' => 2, 'id_usuario' => $this->session->id_usuario));

             if($caja_apertura){
                $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Ya tienes una caja aperturada. Cierre la caja e intente nuevamente.</div>');
                #Redirigimos al formulario y mostramos el mensaje
                redirect(base_url('panel/mant_venta'));
            }else{
                #Enviamos los datos de la caja para registrar
                $this->caja_model->update($caja,$id_caja);
                #Almacenar caja asignada al usuario
                $this->session->set_userdata(array('id_caja' => $id_caja,'estado_caja' => 2));
                #Redirecionamos a la lista de usuarios
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Caja Aperturada con éxito!.</div>');
                redirect(base_url('panel/mant_venta'));
            }
        }
    }

    #Eliminar caja
    public function eliminar()
    {   
        $id_caja=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_caja)){
            #Eliminamos la caja
            $this->caja_model->delete($id_caja);
            $response = array('status' => 1, 'msg' => 'Se eliminó la caja con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede eliminar la caja.');
        }
        $this->responseJSON($response);
    }

    #Cerrar caja
    public function cerrar()
    {   
        $id_caja=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_caja)){
            #Cerrar la caja / Actualizar
            $this->caja_model->update(array('flestado'=>3,'feregistro_cierre'=>date('Y-m-d H:i:s')),$id_caja);

            #Almacenar caja asignada al usuario
            $this->session->set_userdata(array('id_caja' => '','estado_caja' => ''));
            $response = array('status' => 1, 'msg' => 'Se cerró la caja con éxito.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede cerró la caja.');
        }
        $this->responseJSON($response);
    }
}