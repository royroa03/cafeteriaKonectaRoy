<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Creditocliente extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('creditocliente_model');
        $this->load->model('creditoclientedetalle_model');
        $this->load->model('venta_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos el pago
    public function pagar(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('id_creditocliente', 'ID Crédito de Cliente', 'trim|required');
        $this->form_validation->set_rules('id_cliente', 'ID Cliente', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_creditocliente'));
        }else {
            
            $id_creditocliente = $this->security->xss_clean($this->input->post('id_creditocliente'));
            $actualizardeuda= $this->security->xss_clean($this->input->post('deuda_venta'))-$this->security->xss_clean($this->input->post('totalpago_credito'));
                
            #Datos
            $creditocliente = array(
                'deuda'      => $actualizardeuda
            );
            #Enviamos los datos 
            $id_creditocliente_actualizar=$this->creditocliente_model->update($creditocliente,$id_creditocliente);

            $mostrarcredito_actualizar=$this->creditocliente_model->getCreditosClientes(array('creditocliente.id_creditocliente' => $id_creditocliente));
            
            if($mostrarcredito_actualizar[0]->deuda==0){
                //Actualizo el estado del crédito de la venta a pagado -- 1:Pagado
                $this->creditocliente_model->update(array('flestado'=>1),$id_creditocliente);
                //Actualizo el estado de la venta a pagado -- 0:Pagado
                $id_venta=$mostrarcredito_actualizar[0]->id_venta;
                $this->venta_model->update(array('flestado'=>0),$id_venta);
            }

            if($id_creditocliente_actualizar){
                #Datos
                $creditoclientedetalle = array(
                    'id_creditocliente'      => $this->security->xss_clean($this->input->post('id_creditocliente')),
                    'total'      => $this->security->xss_clean($this->input->post('totalpago_credito')),
                    'id_usuario'      => $this->session->id_usuario
                );
                #Enviamos los datos 
                $this->creditoclientedetalle_model->save($creditoclientedetalle);

                #Redirecionamos a la lista de creéditos de cliente
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Crédito del Cliente REGISTRADO con éxito!.</div>');
                redirect(base_url('panel/mant_creditocliente'));

            }else{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>MENSAJE:</strong><br>- ¡ERROR al registrar el Crédito del Cliente!.</div>');
                redirect(base_url('panel/mant_creditocliente'));
            }
        }
    }
  
}