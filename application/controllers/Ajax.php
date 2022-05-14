<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

set_time_limit(0);
ini_set("memory_limit","1024M");

class Ajax extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        #Cargamos los modelos
        $this->load->model('cliente_model');
        $this->load->model('perfil_model');
        $this->load->model('personal_model');
        $this->load->model('usuario_model');
        $this->load->model('proveedor_model');
        $this->load->model('comprobante_model');
        $this->load->model('categoria_model');
        $this->load->model('unidad_model');
        $this->load->model('producto_model');
        $this->load->model('venta_model');
        $this->load->model('ventadetalle_model');
        $this->load->model('mediopago_model');
        $this->load->model('creditocliente_model');
        $this->load->model('creditoclientedetalle_model');
        $this->load->model('creditoproveedor_model');
        $this->load->model('creditoproveedordetalle_model');
        $this->load->model('empresa_model');
        $this->load->model('compra_model');
        $this->load->model('compradetalle_model');
        

        #Cargamos la librería de carrito de compras
        $this->load->library('cart');

        #Detectamos el envío por Ajax
        if (!$this->input->is_ajax_request()) { exit('No direct script access allowed'); }
    }

    #Responde en JSON
    public function responseJSON($datos)
    {
        $this->output->set_content_type('application/json')->set_output(json_encode($datos));
    }

    #Obtenemos los datos del cliente
    public function getcliente()
    {
        $id_cliente = $this->security->xss_clean($this->input->post('id_cliente'));
        $response = array('status' => 0);
        $where = array('cliente.id_cliente' => $id_cliente);
        $clientes = $this->cliente_model->getClientes($where);
        if($clientes){
            $response = array('status' => 1, 'clientes' => $clientes[0] );
        }

        $this->responseJSON($response);
    }  

    #Obtenemos los datos del perfil
    public function getperfil()
    {
        $id_perfil = $this->security->xss_clean($this->input->post('id_perfil'));
        $response = array('status' => 0);
        $where = array('perfil.id_perfil' => $id_perfil);
        $perfiles = $this->perfil_model->getPerfiles($where);
        if($perfiles){
            $response = array('status' => 1, 'perfiles' => $perfiles[0] );
        }

        $this->responseJSON($response);
    } 

    #Obtenemos los datos del personal
    public function getpersonal()
    {
        $id_personal = $this->security->xss_clean($this->input->post('id_personal'));
        $response = array('status' => 0);
        $where = array('personal.id_personal' => $id_personal);
        $personales = $this->personal_model->getPersonales($where);
        if($personales){
            $response = array('status' => 1, 'personales' => $personales[0] );
        }

        $this->responseJSON($response);
    } 

    #Obtenemos los datos del usuario
    public function getusuario()
    {
        $id_usuario = $this->security->xss_clean($this->input->post('id_usuario'));
        $response = array('status' => 0);
        $where = array('usuario.id_usuario' => $id_usuario);
        $usuarios = $this->usuario_model->getUsuarios($where);
        if($usuarios){
            $response = array('status' => 1, 'usuarios' => $usuarios[0] );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos del proveedor
    public function getproveedor()
    {
        $id_proveedor = $this->security->xss_clean($this->input->post('id_proveedor'));
        $response = array('status' => 0);
        $where = array('proveedor.id_proveedor' => $id_proveedor);
        $proveedores = $this->proveedor_model->getProveedores($where);
        if($proveedores){
            $response = array('status' => 1, 'proveedores' => $proveedores[0] );
        }

        $this->responseJSON($response);
    } 

    #Obtenemos los datos del comprobante
    public function getcomprobante()
    {
        $id_comprobante = $this->security->xss_clean($this->input->post('id_comprobante'));
        $response = array('status' => 0);
        $where = array('comprobante.id_comprobante' => $id_comprobante);
        $comprobantes = $this->comprobante_model->getComprobantes($where);
        if($comprobantes){
            $response = array('status' => 1, 'comprobantes' => $comprobantes[0] );
        }

        $this->responseJSON($response);
    } 

    #Obtenemos los datos de la categoria
    public function getcategoria()
    {
        $id_categoria = $this->security->xss_clean($this->input->post('id_categoria'));
        $response = array('status' => 0);
        $where = array('categoria.id_categoria' => $id_categoria);
        $categorias = $this->categoria_model->getcategorias($where);
        if($categorias){
            $response = array('status' => 1, 'categorias' => $categorias[0] );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos de la unidad
    public function getunidad()
    {
        $id_unidad = $this->security->xss_clean($this->input->post('id_unidad'));
        $response = array('status' => 0);
        $where = array('unidad.id_unidad' => $id_unidad);
        $unidades = $this->unidad_model->getUnidades($where);
        if($unidades){
            $response = array('status' => 1, 'unidades' => $unidades[0] );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos del producto
    public function getproducto()
    {
        $id_producto = $this->security->xss_clean($this->input->post('id_producto'));
        $response = array('status' => 0);
        $where = array('producto.id_producto' => $id_producto);
        $productos = $this->producto_model->getProductos($where);
        if($productos){
            $response = array('status' => 1, 'productos' => $productos[0] );
        }

        $this->responseJSON($response);
    }


    #Obtenemos los datos del producto
    public function getproductoporcategoria()
    {
        $id_categoria = $this->security->xss_clean($this->input->post('id_categoria'));
        $response = array('status' => 0);
        $where = array('producto.id_categoria' => $id_categoria,'producto.flestado' => 0);
        $productos = $this->producto_model->getProductos($where);
        if($productos){
            $response = array('status' => 1, 'productos' => $productos );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos del medio de pago
    public function getmediopago()
    {
        $id_mediopago = $this->security->xss_clean($this->input->post('id_mediopago'));
        $response = array('status' => 0);
        $where = array('mediopago.id_mediopago' => $id_mediopago);
        $mediospagos = $this->mediopago_model->getMediosPagos($where);
        if($mediospagos){
            $response = array('status' => 1, 'mediospagos' => $mediospagos[0] );
        }

        $this->responseJSON($response);
    } 

    #Añadimos el producto al carrito
    public function addcart()
    {
        #Obtenemos los datos enviados por POST
        $dataProd = $this->security->xss_clean($this->input->post());
        #Obtenemos los datos del producto
        $where = array('producto.id_producto' => $dataProd['id']);
        $prod = $this->producto_model->getProductos($where);
        #Verificamos que el producto exista
        if($prod){

            #Grabamos los parametros del producto en el carrito
            $data = array(
                'id'            =>  $dataProd['id'],
                'qty'           => $dataProd['cnt'],
                //'price'         => $prod[0]->precio_unitario,
                'price'         => $dataProd['price'],
                'name'          => str_replace(",", "", $prod[0]->nombre),
                'id_unidad'        => $prod[0]->id_unidad,
                'abreviatura_unidad'        => $prod[0]->abreviatura_unidad,
                'subtotal'      => $dataProd['cnt']*$prod[0]->precio_unitario,
                'simbolo_moneda'        => $prod[0]->simbolo_moneda
            );

            $this->cart->insert($data);

            $response = array('status'=> 1, 'cart' => $this->getCarrito(), 'total_monto' => $this->getTotalMontoCarrito());
        
        }else{
            $response = array('status' => 2, 'msg' => 'El producto en consulta no existe.', 'post' => $dataProd, 'sql' => $this->db->last_query());
        }

        $this->responseJSON($response);
    }

    #Obtenemos los productos del carrito
    public function getCarrito()
    {
        $cart = $this->cart->contents(); 
        $carrito = array();
        foreach ($cart as $item) {
            $carrito[] = $item;
        }

        return $carrito;
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

    #Eliminamos todos los productos del carrito
    public function cleancart()
    {   
        $response = array('status' => $this->cart->destroy());
        $this->responseJSON($response);
    }

    #Eliminamos un elemento del carrito
    public function delitemcart()
    {
        #Obtenemos el rowid del item del carrito
        $item = $this->security->xss_clean($this->input->post('token'));
        $status = $this->cart->remove($item);
        $rows = count($this->cart->contents());

        $response = array('status' => $status, 'subtotal_venta' => $rows);
        $this->responseJSON($response);
    }

    #Precargamos los elementos del carrito
    public function getcart()
    {
        #Items del carrito
        $items_cart = "";
        $subtotal_venta = 0.00;

        #Carrito
        $cart = $this->getCarrito();

        for ($i=0; $i < count($cart); $i++) {  

            #Nombre del producto
            $nombre_producto = $cart[$i]['name'];

            if(strlen($nombre_producto) > 20){ $nombre_producto = substr($nombre_producto, 0, 20)."..."; }

            #Cantidad de items
            $cantidad = $cart[$i]['qty'];

            #Abreviatura Unidad de items
            $abreviatura_unidad = $cart[$i]['abreviatura_unidad'];

            #Simbolo de moneda de items
            $simbolo_moneda = $cart[$i]['simbolo_moneda'];

            #Subtotal
            $subTotal = $cart[$i]['subtotal'];

            $subtotal_venta = $subtotal_venta+$subTotal;

            #Añadimos items del carrito para mostrar
            $items_cart .= '<h5 class="text-left m-b-none">'.$nombre_producto.' x '.$cantidad.'('.$abreviatura_unidad.')<strong class="pull-right">'.$simbolo_moneda.' '.number_format($subTotal,2,'.', '').'  <a href="javascript:deleteItem(\''.$cart[$i]['rowid'].'\')" class="icon-delete deleteItemCart"><i class="fa fa-times" style="color: #000"></i></a></strong></h5>';
        }

        $response = array('cart' => $items_cart, 'subtotal_venta' => number_format($subtotal_venta,2,'.', ''));
        $this->responseJSON($response);
    }


    #Calcular el total del pago de venta
    public function totalpagoventa()
    {   
        $descuento = $this->security->xss_clean($this->input->post('descuento'));
        $response = array('status' => 0);
        $response = array('status' => 1, 'total_monto' => number_format(($this->getTotalMontoCarrito()-$descuento),2,'.',''));

        $this->responseJSON($response);
    }

    #Obtenemos los datos de los clientes
    public function getallcliente()
    {
        $response = array('status' => 0);
        $where = array('cliente.flestado' => 0);
        $clientes = $this->cliente_model->getClientes($where);
        if($clientes){
            $response = array('status' => 1, 'clientes' => $clientes );
        }

        $this->responseJSON($response);
    }  

    #Obtenemos los datos del credito del cliente
    public function getcreditocliente()
    {
        $id_creditocliente = $this->security->xss_clean($this->input->post('id_creditocliente'));
        $response = array('status' => 0);
        $where = array('creditocliente.id_creditocliente' => $id_creditocliente);
        $creditosclientes = $this->creditocliente_model->getCreditosClientes($where);
        if($creditosclientes){
            $response = array('status' => 1, 'creditosclientes' => $creditosclientes[0] );
        }

        $this->responseJSON($response);
    }

    
    #Obtenemos los datos del credito del cliente
    public function getcreditoclientedetalle()
    {
        $id_creditocliente = $this->security->xss_clean($this->input->post('id_creditocliente'));
        $response = array('status' => 0);
        $where = array('creditoclientedetalle.id_creditocliente' => $id_creditocliente);
        $creditosclientesdetalles = $this->creditoclientedetalle_model->getCreditosClientesDetalles($where);
        if($creditosclientesdetalles){
            $response = array('status' => 1, 'creditosclientesdetalles' => $creditosclientesdetalles );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos de los proveedores
    public function getallproveedor()
    {
        $response = array('status' => 0);
        $where = array('proveedor.flestado' => 0);
        $proveedores = $this->proveedor_model->getProveedores($where);
        if($proveedores){
            $response = array('status' => 1, 'proveedores' => $proveedores );
        }

        $this->responseJSON($response);
    }  
    
    #Obtenemos los datos del credito del proveedor
    public function getcreditoproveedor()
    {
        $id_creditoproveedor = $this->security->xss_clean($this->input->post('id_creditoproveedor'));
        $response = array('status' => 0);
        $where = array('creditoproveedor.id_creditoproveedor' => $id_creditoproveedor);
        $creditosproveedores = $this->creditoproveedor_model->getCreditosProveedores($where);
        if($creditosproveedores){
            $response = array('status' => 1, 'creditosproveedores' => $creditosproveedores[0] );
        }

        $this->responseJSON($response);
    }

    
    #Obtenemos los datos del credito del proveedor
    public function getcreditoproveedordetalle()
    {
        $id_creditoproveedor = $this->security->xss_clean($this->input->post('id_creditoproveedor'));
        $response = array('status' => 0);
        $where = array('creditoproveedordetalle.id_creditoproveedor' => $id_creditoproveedor);
        $creditosproveedoresdetalles = $this->creditoproveedordetalle_model->getCreditosProveedoresDetalles($where);
        if($creditosproveedoresdetalles){
            $response = array('status' => 1, 'creditosproveedoresdetalles' => $creditosproveedoresdetalles );
        }

        $this->responseJSON($response);
    }

    
    #Obtenemos los datos de la empresa
    public function getempresa()
    {
        $id_empresa = $this->security->xss_clean($this->input->post('id_empresa'));
        $response = array('status' => 0);
        $where = array('empresa.id_empresa' => $id_empresa);
        $empresas = $this->empresa_model->getEmpresas($where);
        if($empresas){
            $response = array('status' => 1, 'empresas' => $empresas[0] );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos de la venta
    public function getventa()
    {
        $id_venta = $this->security->xss_clean($this->input->post('id_venta'));
        $response = array('status' => 0);
        $where = array('venta.id_venta' => $id_venta);
        $ventas = $this->venta_model->getVentas($where);
        if($ventas){
            $response = array('status' => 1, 'ventas' => $ventas[0] );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos de la venta detalle
    public function getventadetalle()
    {
        $id_venta = $this->security->xss_clean($this->input->post('id_venta'));
        $response = array('status' => 0);
        $where = array('ventadetalle.id_venta' => $id_venta);
        $ventasdetalles = $this->ventadetalle_model->getVentasDetalles($where);
        if($ventasdetalles){
            $response = array('status' => 1, 'ventasdetalles' => $ventasdetalles );
        }

        $this->responseJSON($response);
    }
  
    #Obtenemos los datos de la compra
    public function getcompra()
    {
        $id_compra = $this->security->xss_clean($this->input->post('id_compra'));
        $response = array('status' => 0);
        $where = array('compra.id_compra' => $id_compra);
        $compras = $this->compra_model->getCompras($where);
        if($compras){
            $response = array('status' => 1, 'compras' => $compras[0] );
        }

        $this->responseJSON($response);
    }

    #Obtenemos los datos de la compra detalle
    public function getcompradetalle()
    {
        $id_compra = $this->security->xss_clean($this->input->post('id_compra'));
        $response = array('status' => 0);
        $where = array('compradetalle.id_compra' => $id_compra);
        $comprasdetalles = $this->compradetalle_model->getComprasDetalles($where);
        if($comprasdetalles){
            $response = array('status' => 1, 'comprasdetalles' => $comprasdetalles );
        }

        $this->responseJSON($response);
    }


    /*#Validar aperturar de caja
    public function validaraperturarcajaventa()
    {
        $fecha_venta = $this->security->xss_clean($this->input->post('fecha_venta'));
        $response = array('status' => 0);
        $where = array('date(fecha)' => $fecha_venta);
        $ventasxfecha=$this->venta_model->getVentas($where);
        //Hay ventas en el día ingresado
        if($ventasxfecha){
            $response = array('status' => 1, 'respuesta' => 'nueva_venta' );
        }else{
            $response = array('status' => 1, 'respuesta' => 'aperturar_caja' );
        }
        $this->responseJSON($response);
    }*/
}