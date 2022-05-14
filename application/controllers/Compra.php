<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Compra extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
        $this->load->model('compra_model');
        $this->load->model('compradetalle_model');
        $this->load->model('stock_model');
        $this->load->model('kardex_model');
        $this->load->model('creditoproveedor_model');
        
        #Cargamos la librería de carrito de compras
        $this->load->library('cart');

        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

    #Registramos la compra
    public function save(){

        
        #Validamos los campos del formulario
        $this->form_validation->set_rules('id_proveedor', 'Proveedor', 'trim|required');
        $this->form_validation->set_rules('id_mediopago', 'Medio de Pago', 'trim|required');
        $this->form_validation->set_rules('id_comprobante', 'Comprobante', 'trim|required');
        $this->form_validation->set_rules('txt_subtotal', 'Subtotal', 'trim|required');
        $this->form_validation->set_rules('txt_descuento', 'Descuento', 'trim|required');
        $this->form_validation->set_rules('txt_total', 'Total', 'trim|required');
        $this->form_validation->set_rules('id_moneda', 'Moneda', 'trim|required');
        $this->form_validation->set_rules('txt_efectivo', 'Efectivo', 'trim|required');
        $this->form_validation->set_rules('txt_vuelto', 'Vuelto', 'trim|required');
        #Validamos el Formulario
        if ($this->form_validation->run() == FALSE){
            #Ocurrio un error en la validación, hay campos que faltan completar
            $this->session->set_flashdata('msg', '<div class="alert alert-warning"><strong>MENSAJE:</strong><br>Debe completar todos los campos obligatorios del formulario.</div>');
            #Redirigimos al formulario y mostramos el mensaje
            redirect(base_url('panel/mant_compra'));
        }else {
            $total_compra=($this->getTotalMontoCarrito()-$this->security->xss_clean($this->input->post('txt_descuento')));
            if($this->security->xss_clean($this->input->post('id_mediopago'))=='1'){ //1: Efectivo
                $flestado=0; //Pagado     
            }else{ //2: Crédito
                $flestado=1; //Pendiente
            }
            #Datos
            $compra = array(
                'id_proveedor'      => $this->security->xss_clean($this->input->post('id_proveedor')),
                'id_mediopago'      => $this->security->xss_clean($this->input->post('id_mediopago')),
                'id_comprobante'      => $this->security->xss_clean($this->input->post('id_comprobante')),
                'id_usuario'      => $this->session->id_usuario,
                'subtotal'      => $this->security->xss_clean($this->input->post('txt_subtotal')),
                'descuento'      => $this->security->xss_clean($this->input->post('txt_descuento')),
                'total'      => $total_compra,
                'id_moneda'      => $this->security->xss_clean($this->input->post('id_moneda')),
                'conversion'      => $this->security->xss_clean($this->input->post('txt_conversionmoneda')),
                'efectivo'      => $this->security->xss_clean($this->input->post('txt_efectivo')),
                'vuelto'      => $this->security->xss_clean($this->input->post('txt_vuelto')),
                'flestado'      => $flestado
            );

            #Enviamos los datos 
            $id_compra=$this->compra_model->save($compra);
            #Obtenemos el detalle de la compra
            $detalle = $this->getDetalleCompra($id_compra);

            #Guardamos el detalle de la compra
            for ($x=0; $x < count($detalle); $x++) { 
                $this->compradetalle_model->save($detalle[$x]);
                
                #Actualizar Stock y registro en Kárdex
                $this->actualizarStock('agregar',$detalle[$x]['id_producto'],$detalle[$x]['cantidad'],'compra',$id_compra);
             
            }

            if($this->security->xss_clean($this->input->post('id_mediopago'))==2){ //Crédito
                #Datos
                $creditoproveedor = array(
                    'id_proveedor'      => $this->security->xss_clean($this->input->post('id_proveedor')),
                    'id_compra'      => $id_compra,
                    'total'      => $total_compra,
                    'deuda'      => $total_compra
                );

                #Enviamos los datos 
                $this->creditoproveedor_model->save($creditoproveedor);
            }


            #Redirecionamos a la lista de usuarios
            $this->session->set_flashdata('msg', '<div class="alert alert-success"><strong>MENSAJE:</strong><br>- ¡Compra REGISTRADA con éxito! Stock y Kárdex actualizado.</div>');
            #Vaciar productos del carrito de compras
            $this->cleancart();
            redirect(base_url('panel/mant_compra'));

        }
    }

    #Obetenemos los productos del carrito
    public function getCarrito()
    {
        $cart = $this->cart->contents(); 
        $carrito = array();
        foreach ($cart as $item) {
            $carrito[] = $item;
        }

        return $carrito;
    }


    #Eliminamos todos los productos del carrito
    public function cleancart()
    {   
        $response = array('status' => $this->cart->destroy());
        $this->responseJSON($response);
    }

    #Detalle de compra
    public function getDetalleCompra($id_compra){
        $detalle_compra = array();

        #Obtenemos productos del carrito
        $cart = $this->getCarrito();
        if(count($cart) > 0){  
            for ($i=0; $i < count($cart); $i++) { 
                #Datos
                $detalle_compra[] = array(
                    'id_compra' => $id_compra,
                    'item' => $i,
                    'id_producto' => $cart[$i]['id'],
                    'id_unidad' => $cart[$i]['id_unidad'],
                    'cantidad' => $cart[$i]['qty'],
                    'precio' => $cart[$i]['price'],
                    'total' => $cart[$i]['subtotal']
                );
            }
        }
        return $detalle_compra;
    }

    #Obtenemos el monto total de los productos en el carrito
    public function getTotalMontoCarrito()
    {
        $total_monto = 0;
        $cart = $this->getCarrito(); 
        for ($i=0; $i < count($cart); $i++) { 
            $total_monto += $cart[$i]['price']*$cart[$i]['qty'];
        }

        return $total_monto;
    }

    
    #Anular
    public function anular()
    {   
        $id_compra=$this->security->xss_clean($this->uri->segment(3));
        if(isset($id_compra)){
            #Anular la Compra / Actualizar
            $this->compra_model->update(array('flestado'=>2,'feregistro_anular'=>date('Y-m-d H:i:s')),$id_compra);

            $compradetalle = $this->compradetalle_model->getComprasDetalles(array('id_compra' => $id_compra));
            for ($i=0; $i < count($compradetalle); $i++) { 
                #Actualizar Stock
                $this->actualizarStock('quitar',$compradetalle[$i]->id_producto,$compradetalle[$i]->cantidad,'anular-compra',$id_compra);
            }

            #Anular el crédito del proveedor
            $this->creditoproveedor_model->anular(array('flestado'=>2),$id_compra);
             
            $response = array('status' => 1, 'msg' => 'Se anuló la compra con éxito. Stock y Kárdex actualizado.');
        }else{
            $response = array('status' => 2, 'msg' => 'Ups! No se puede anular la compra.');
        }
        $this->responseJSON($response);
    }

    function actualizarStock($condicion,$id_producto,$cantidad,$concepto,$id_concepto){
 
        $desc_array_concepto="";
        $kardex_concepto=array();
        $nuevoval_kardex=array();
        $kardex=array();
        switch($concepto) {
            case 'venta':
            $kardex_concepto = array('id_venta' => $id_concepto);
            break;

            case 'compra':
            $kardex_concepto = array('id_compra' => $id_concepto);
            break;
            
            case 'merma':
            $kardex_concepto = array('id_merma' => $id_concepto);
            break;

            case 'anular-venta':
            $kardex_concepto = array('id_venta' => $id_concepto);
            break;

            case 'anular-compra':
            $kardex_concepto = array('id_compra' => $id_concepto);
            break;

            case 'anular-merma':
            $kardex_concepto = array('id_merma' => $id_concepto);
            break;
            
            default:
            $kardex_concepto=array();
            
            }

        if($condicion=='agregar'){
            #Consultamos el Stock actual del producto
            $producto_stock=$this->stock_model->getStocks(array('stock.id_producto' => $id_producto ));
                  
            #Registramos en el Kardex
            $nuevoval_kardex=array(
                'id_producto'      => $id_producto,
                'concepto'      => "Por ".$concepto,
                'observacion'      => "Sin observación",
                'cantentrada'      => $cantidad,
                'cantsaldo'      => $producto_stock[0]->cantactual+$cantidad
            );
            $kardex=array_merge($nuevoval_kardex,$kardex_concepto);
            $this->kardex_model->save($kardex); 

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
            
            #Registramos en el Kardex
            $nuevoval_kardex=array(
                'id_producto'      => $id_producto,
                'concepto'      => "Por ".$concepto,
                'observacion'      => "Sin observación",
                'cantsalida'      => $cantidad,
                'cantsaldo'      => $producto_stock[0]->cantactual-$cantidad,
            );
            $kardex=array_merge($nuevoval_kardex,$kardex_concepto);
            $this->kardex_model->save($kardex); 

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