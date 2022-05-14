<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Merma extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('merma_model');
        $this->load->model('stock_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

	#Registramos la merma
    public function save(){
        #Validamos los campos del formulario
        $this->form_validation->set_rules('id_producto', 'Producto', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_merma'));
        }else {
            #Datos
            $merma = array(
                'id_producto'      => $this->security->xss_clean($this->input->post('id_producto')),
                'cantidad'      => $this->security->xss_clean($this->input->post('cantidad')),
                'observacion'      => $this->security->xss_clean($this->input->post('observacion')),
                'id_usuario' => $this->session->id_usuario
            );
            #Enviamos los datos 
            $this->merma_model->save($merma);

            $this->actualizarStock(
                                'quitar',
                                $this->security->xss_clean($this->input->post('id_producto')),
                                $this->security->xss_clean($this->input->post('cantidad'))
                                );


            #Redirecionamos a la lista de mermas
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Merma REGISTRADO con éxito!.</div>');
            redirect(base_url('panel/mant_merma'));
        }
    }

    function actualizarStock($condicion,$id_producto,$cantidad){
        if($condicion=='agregar'){
            #Consultamos el Stock actual del producto
            $producto_stock=$this->stock_model->getStocks(array('stock.id_producto' => $id_producto ));
            #Datos
            $stock = array(
                'id_producto'      => $id_producto,
                'cantactual'      => $producto_stock[0]->cantactual+$cantidad,
                'cantdisponible'      => $producto_stock[0]->cantdisponible+$cantidad
            );
            #Actualizamos el stock del producto
            $this->stock_model->update($stock,$producto_stock[0]->id_stock);
        }
        
        if($condicion=='quitar'){
             #Consultamos el Stock actual del producto
             $producto_stock=$this->stock_model->getStocks(array('stock.id_producto' => $id_producto ));
             #Datos
             $stock = array(
                 'id_producto'      => $id_producto,
                 'cantactual'      => $producto_stock[0]->cantactual-$cantidad,
                 'cantdisponible'      => $producto_stock[0]->cantdisponible-$cantidad
             );
             #Actualizamos el stock del producto
             $this->stock_model->update($stock,$producto_stock[0]->id_stock);
        }
        
    }

}