<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Creditoproveedor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('creditoproveedor_model');
        $this->load->model('creditoproveedordetalle_model');
        $this->load->model('compra_model');
        
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
        $this->form_validation->set_rules('id_creditoproveedor', 'ID Crédito de Proveedor', 'trim|required');
        $this->form_validation->set_rules('id_proveedor', 'ID Proveedor', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_creditoproveedor'));
        }else {
            
            $id_creditoproveedor = $this->security->xss_clean($this->input->post('id_creditoproveedor'));
            $actualizardeuda= $this->security->xss_clean($this->input->post('deuda_compra'))-$this->security->xss_clean($this->input->post('totalpago_credito'));
                
            #Datos
            $creditoproveedor = array(
                'deuda'      => $actualizardeuda
            );
            #Enviamos los datos 
            $id_creditoproveedor_actualizar=$this->creditoproveedor_model->update($creditoproveedor,$id_creditoproveedor);

            $mostrarcredito_actualizar=$this->creditoproveedor_model->getCreditosProveedores(array('creditoproveedor.id_creditoproveedor' => $id_creditoproveedor));
            
            if($mostrarcredito_actualizar[0]->deuda==0){
                //Actualizo el estado del crédito de la compra a pagado -- 1:Pagado
                $this->creditoproveedor_model->update(array('flestado'=>1),$id_creditoproveedor);
                //Actualizo el estado de la compra a pagado -- 0:Pagado
                $id_compra=$mostrarcredito_actualizar[0]->id_compra;
                $this->compra_model->update(array('flestado'=>0),$id_compra);
            }

            if($id_creditoproveedor_actualizar){
                #Datos
                $creditoproveedordetalle = array(
                    'id_creditoproveedor'      => $this->security->xss_clean($this->input->post('id_creditoproveedor')),
                    'total'      => $this->security->xss_clean($this->input->post('totalpago_credito')),
                    'id_usuario'      => $this->session->id_usuario
                );
                #Enviamos los datos 
                $this->creditoproveedordetalle_model->save($creditoproveedordetalle);

                #Redirecionamos a la lista de creéditos de proveedores
                $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Crédito del Proveedor REGISTRADO con éxito!.</div>');
                redirect(base_url('panel/mant_creditoproveedor'));

            }else{
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"><strong>MENSAJE:</strong><br>- ¡ERROR al registrar el Crédito del Proveedor!.</div>');
                redirect(base_url('panel/mant_creditoproveedor'));
            }
        }
    }
  
}