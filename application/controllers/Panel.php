<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('America/Lima');
set_time_limit(0);
ini_set("memory_limit","1024M");

class Panel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		#Cargamos los modelos
	  
		$this->load->model('empresa_model');
        $this->load->model('cliente_model');
        $this->load->model('perfil_model');
        $this->load->model('personal_model');
        $this->load->model('usuario_model');
		$this->load->model('proveedor_model');
        $this->load->model('comprobante_model');
		$this->load->model('categoria_model');
        $this->load->model('unidad_model');
        $this->load->model('producto_model');
        $this->load->model('moneda_model');
        $this->load->model('caja_model');
        $this->load->model('venta_model');
		$this->load->model('mediopago_model');
		$this->load->model('stock_model');
		$this->load->model('merma_model');
		$this->load->model('kardex_model');
		$this->load->model('creditocliente_model');
		$this->load->model('creditoclientedetalle_model');
		$this->load->model('compra_model');
		$this->load->model('creditoproveedor_model');
		$this->load->model('creditoproveedordetalle_model');
		$this->load->model('reporte_model');
        
        if(!$this->session->id_usuario){ redirect(base_url()); }
	}

	public function index()
	{
		#Título de la página
		$data['titulo'] = "DASHBOARD";
		#Traemos los perfiles
		$data['perfiles'] = $this->perfil_model->getPerfiles();
		$data['perfiles_hacedias'] = $this->perfil_model->getPerfiles(array('perfil.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los usuarios
		$data['usuarios'] = $this->usuario_model->getUsuarios();
		$data['usuarios_hacedias'] = $this->usuario_model->getUsuarios(array('usuario.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los personales
		$data['personales'] = $this->personal_model->getPersonales();
		$data['personales_hacedias'] = $this->personal_model->getPersonales(array('personal.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los clientes
		$data['clientes'] = $this->cliente_model->getClientes();
		$data['clientes_hacedias'] = $this->cliente_model->getClientes(array('cliente.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los proveedores
		$data['proveedores'] = $this->proveedor_model->getProveedores();
		$data['proveedores_hacedias'] = $this->proveedor_model->getProveedores(array('proveedor.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos las categorías
		$data['categorias'] = $this->categoria_model->getCategorias();
		$data['categorias_hacedias'] = $this->categoria_model->getCategorias(array('categoria.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los productos
		$data['productos'] = $this->producto_model->getProductos();
		$data['productos_hacedias'] = $this->producto_model->getProductos(array('producto.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los comprobantes
		$data['comprobantes'] = $this->comprobante_model->getComprobantes();
		$data['comprobantes_hacedias'] = $this->comprobante_model->getComprobantes(array('comprobante.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos las unidades
		$data['unidades'] = $this->unidad_model->getUnidades();
		$data['unidades_hacedias'] = $this->unidad_model->getUnidades(array('unidad.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos las cajas
		$data['cajas'] = $this->caja_model->getCajas();
		$data['cajas_hacedias'] = $this->caja_model->getCajas(array('caja.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los medios de pagos
		$data['mediospagos'] = $this->mediopago_model->getMediospagos();
		$data['mediospagos_hacedias'] = $this->mediopago_model->getMediospagos(array('mediopago.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los créditos de clientes
		$data['creditosclientes'] = $this->creditocliente_model->getCreditosClientes();
		$data['creditosclientes_hacedias'] = $this->creditocliente_model->getCreditosClientes(array('creditocliente.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos los créditos de proveedores
		$data['creditosproveedores'] = $this->creditoproveedor_model->getCreditosProveedores();
		$data['creditosproveedores_hacedias'] = $this->creditoproveedor_model->getCreditosProveedores(array('creditoproveedor.feregistro <=' => Date('Y-m-d', strtotime("-3 days"))));
		#Traemos las ventas 
		if($this->session->id_perfil==1){ //1: Administrador
			$data['ventas'] = $this->venta_model->getVentas();
			$data['ventas_hacedias'] = $this->venta_model->getVentas(array('venta.fecha <=' => Date('Y-m-d', strtotime("-3 days"))));
		}else if($this->session->id_perfil==2){ //2: Caja
			$data['ventas'] = $this->venta_model->getVentas(array('venta.id_usuario' => $this->session->id_usuario));
			$data['ventas_hacedias'] = $this->venta_model->getVentas(array('venta.fecha <=' => Date('Y-m-d', strtotime("-3 days")),'venta.id_usuario' => $this->session->id_usuario));
		}
		
		#Traemos las compras 
		if($this->session->id_perfil==1){ //1: Administrador
			$data['compras'] = $this->compra_model->getCompras();
			$data['compras_hacedias'] = $this->compra_model->getCompras(array('compra.fecha <=' => Date('Y-m-d', strtotime("-3 days"))));
		}else if($this->session->id_perfil==3){ //3: Almacén
			$data['compras'] = $this->compra_model->getCompras(array('compra.id_usuario' => $this->session->id_usuario));
			$data['compras_hacedias'] = $this->compra_model->getCompras(array('compra.fecha <=' => Date('Y-m-d', strtotime("-3 days")),'compra.id_usuario' => $this->session->id_usuario));
		}
		
		#Traemos las stocks 
		$data['stocks'] = $this->stock_model->getStocks(array('stock.cantactual' => 0.00));
		$data['stocks_hacedias'] = $this->stock_model->getStocks(array('stock.cantactual <=' => 5));


		$this->load->view('dashboard/header', $data);
		$this->load->view('dashboard/index');
		$this->load->view('dashboard/footer');
	}

	public function mant_perfil()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "PERFIL";
		    #Traemos los perfiles
	        $data['perfiles'] = $this->perfil_model->getPerfiles();

			$this->load->view('perfil/header', $data);
			$this->load->view('perfil/index');
			$this->load->view('perfil/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_personal()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "PERSONAL";
		    #Traemos los personales
			$data['personales'] = $this->personal_model->getPersonales();
			#Traemos las empresas
	        $data['empresas'] = $this->empresa_model->getEmpresas();

			$this->load->view('personal/header', $data);
			$this->load->view('personal/index');
			$this->load->view('personal/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_usuario()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "USUARIO";
		    #Traemos los usuarios
	        $data['usuarios'] = $this->usuario_model->getUsuarios();
	        #Traemos los perfiles
	        $data['perfiles'] = $this->perfil_model->getPerfiles(array('flestado' => 0));
	        #Traemos los personales
	        $data['personales'] = $this->personal_model->getPersonales(array('flestado' => 0));

			$this->load->view('usuario/header', $data);
			$this->load->view('usuario/index');
			$this->load->view('usuario/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_cliente()
	{
		//Administrador:1
		//Cajero:2
		if($this->session->id_perfil==1 || $this->session->id_perfil==2){
			#Título de la página
			$data['titulo'] = "CLIENTE";
		    #Traemos los clientes
	        $data['clientes'] = $this->cliente_model->getClientes();

			$this->load->view('cliente/header', $data);
			$this->load->view('cliente/index');
			$this->load->view('cliente/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}
	
	public function mant_proveedor()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "PROVEEDOR";
		    #Traemos los proveedores
	        $data['proveedores'] = $this->proveedor_model->getProveedores();

			$this->load->view('proveedor/header', $data);
			$this->load->view('proveedor/index');
			$this->load->view('proveedor/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_comprobante()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "COMPROBANTE";
		    #Traemos los comprobantes
	        $data['comprobantes'] = $this->comprobante_model->getComprobantes();

			$this->load->view('comprobante/header', $data);
			$this->load->view('comprobante/index');
			$this->load->view('comprobante/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_categoria()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "CATEGORÍA";
		    #Traemos los categoria
	        $data['categorias'] = $this->categoria_model->getCategorias();

			$this->load->view('categoria/header', $data);
			$this->load->view('categoria/index');
			$this->load->view('categoria/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}
	
	public function mant_unidad()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "UNIDAD";
		    #Traemos los categoria
	        $data['unidades'] = $this->unidad_model->getUnidades();

			$this->load->view('unidad/header', $data);
			$this->load->view('unidad/index');
			$this->load->view('unidad/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}
	
	public function mant_producto()
	{
		//Administrador:1 -- Almacén:3
		if($this->session->id_perfil==1 || $this->session->id_perfil==3){
			#Título de la página
			$data['titulo'] = "PRODUCTO";
		    #Traemos los productos
	        $data['productos'] = $this->producto_model->getProductos();
	        #Traemos las unidades
	        $data['unidades'] = $this->unidad_model->getUnidades(array('flestado' => 0));
	        #Traemos las monedas
	        $data['monedas'] = $this->moneda_model->getMonedas(array('flestado' => 0));
	        #Traemos las categorías
	        $data['categorias'] = $this->categoria_model->getCategorias(array('flestado' => 0));

			$this->load->view('producto/header', $data);
			$this->load->view('producto/index');
			$this->load->view('producto/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_caja()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "CAJA";
		    #Traemos las cajas
	        $data['cajas'] = $this->caja_model->getCajas();
		    #Traemos los usuarios
	        $data['usuarios'] = $this->usuario_model->getUsuarios(array('usuario.flestado' => 0,'usuario.id_perfil =' => 2));

			$this->load->view('caja/header', $data);
			$this->load->view('caja/index');
			$this->load->view('caja/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_venta()
	{
		//Administrador:1 - Cajero:2
		if($this->session->id_perfil==1 || $this->session->id_perfil==2){
			#Título de la página
			$data['titulo'] = "VENTA";
		    #Traemos las cajas
	        $data['cajas'] = $this->caja_model->getCajas();
		    #Traemos los usuarios
	        $data['usuarios'] = $this->usuario_model->getUsuarios();
		    #Traemos las monedas
	        $data['monedas'] = $this->moneda_model->getMonedas(); 
	        #Traemos los comprobantes
	        $data['comprobantes'] = $this->comprobante_model->getComprobantes(array('comprobante.flestado' => 0));
		    #Traemos las cajas por usuario
	        $data['cajasporusuarios'] = $this->caja_model->getCajas(array('caja.flestado' => 0,'usu.id_usuario' => $this->session->id_usuario));
		    #Traemos las ventas
	        $data['ventas'] = $this->venta_model->getVentas(array('id_usuario' => $this->session->id_usuario));
	        #Traemos los productos
			$data['productos'] = $this->producto_model->getProductos(array('producto.flestado' => 0));
	        #Traemos las categorías de productos
			$data['categorias'] = $this->categoria_model->getCategorias(array('categoria.flestado' => 0));
		    #Traemos los clientes
	        $data['clientes'] = $this->cliente_model->getClientes(array('cliente.flestado' => 0));
	        #Traemos los medios de pagos
	        $data['mediospagos'] = $this->mediopago_model->getMediospagos(array('mediopago.flestado' => 0));
	        
			$this->load->view('venta/header', $data);
			$this->load->view('venta/index');
			$this->load->view('venta/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_mediopago()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "MEDIO DE PAGO";
		    #Traemos los medios de pagos
	        $data['mediospagos'] = $this->mediopago_model->getMediospagos();

			$this->load->view('mediopago/header', $data);
			$this->load->view('mediopago/index');
			$this->load->view('mediopago/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_stock()
	{
		//Administrador:1 - Almacén:3
		if($this->session->id_perfil==1 || $this->session->id_perfil==3){
			#Título de la página
			$data['titulo'] = "STOCK";
		    #Traemos los stocks
	        $data['stocks'] = $this->stock_model->getStocks();

			$this->load->view('stock/header', $data);
			$this->load->view('stock/index');
			$this->load->view('stock/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_merma()
	{
		//Administrador:1 - Almacén:3
		if($this->session->id_perfil==1 || $this->session->id_perfil==3){
			#Título de la página
			$data['titulo'] = "MERMA";
		    #Traemos las mermas
			$data['mermas'] = $this->merma_model->getMermas();
			#Traemos los productos
			$data['productos'] = $this->producto_model->getProductos(array('producto.flestado' => 0));

			$this->load->view('merma/header', $data);
			$this->load->view('merma/index');
			$this->load->view('merma/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}
	
	public function mant_kardex()
	{
		//Administrador:1 - Almacén:3
		if($this->session->id_perfil==1 || $this->session->id_perfil==3){
			#Título de la página
			$data['titulo'] = "KARDEX";
		    #Traemos los Kardex
	        $data['kardexs'] = $this->kardex_model->getKardexs();

			$this->load->view('kardex/header', $data);
			$this->load->view('kardex/index');
			$this->load->view('kardex/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}
	
	public function mant_creditocliente()
	{
		//Administrador:1 - Cajero:2
		if($this->session->id_perfil==1 || $this->session->id_perfil==2){
			#Título de la página
			$data['titulo'] = "CRÉDITO DE CLIENTE";
		    #Traemos los créditos de clientes
	        $data['creditosclientes'] = $this->creditocliente_model->getCreditosClientes();

			$this->load->view('creditocliente/header', $data);
			$this->load->view('creditocliente/index');
			$this->load->view('creditocliente/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_amortizacreditocliente()
	{
		//Administrador:1 - Cajero:2
		if($this->session->id_perfil==1 || $this->session->id_perfil==2){
			#Título de la página
			$data['titulo'] = "AMORTIZAR - CRÉDITO DE CLIENTE";
		    #Traemos los detalles de créditos de clientes
	        $data['creditosclientesdetalles'] = $this->creditoclientedetalle_model->getCreditosClientesDetalles();

			$this->load->view('amortizarcreditocliente/header', $data);
			$this->load->view('amortizarcreditocliente/index');
			$this->load->view('amortizarcreditocliente/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_compra()
	{
		//Administrador:1 - Almacén:3
		if($this->session->id_perfil==1 || $this->session->id_perfil==3){
			#Título de la página
			$data['titulo'] = "COMPRA";
		    #Traemos las monedas
	        $data['monedas'] = $this->moneda_model->getMonedas(); 
	        #Traemos los comprobantes
	        $data['comprobantes'] = $this->comprobante_model->getComprobantes(array('comprobante.flestado' => 0));
		    #Traemos las compras
	        $data['compras'] = $this->compra_model->getCompras(array('id_usuario' => $this->session->id_usuario));
	        #Traemos los productos
			$data['productos'] = $this->producto_model->getProductos(array('producto.flestado' => 0));
	        #Traemos las categorías de productos
			$data['categorias'] = $this->categoria_model->getCategorias(array('categoria.flestado' => 0));
		    #Traemos los proveedores
	        $data['proveedores'] = $this->proveedor_model->getProveedores(array('flestado' => 0));
	        #Traemos los medios de pagos
	        $data['mediospagos'] = $this->mediopago_model->getMediospagos(array('mediopago.flestado' => 0));
	        
			$this->load->view('compra/header', $data);
			$this->load->view('compra/index');
			$this->load->view('compra/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	
	public function mant_creditoproveedor()
	{
		//Administrador:1 - Almacén:3
		if($this->session->id_perfil==1 || $this->session->id_perfil==3){
			#Título de la página
			$data['titulo'] = "CRÉDITO DE PROVEEDOR";
		    #Traemos los créditos de proveedores
	        $data['creditosproveedores'] = $this->creditoproveedor_model->getCreditosProveedores();

			$this->load->view('creditoproveedor/header', $data);
			$this->load->view('creditoproveedor/index');
			$this->load->view('creditoproveedor/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function mant_amortizacreditoproveedor()
	{
		//Administrador:1 - Almacén:3
		if($this->session->id_perfil==1 || $this->session->id_perfil==3){
			#Título de la página
			$data['titulo'] = "AMORTIZAR - CRÉDITO DE PROVEEDOR";
		    #Traemos los detalles de créditos de proveedores
	        $data['creditosproveedoresdetalles'] = $this->creditoproveedordetalle_model->getCreditosProveedoresDetalles();

			$this->load->view('amortizarcreditoproveedor/header', $data);
			$this->load->view('amortizarcreditoproveedor/index');
			$this->load->view('amortizarcreditoproveedor/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	public function reporte_compra()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "REPORTE DE COMPRAS";
			#Traemos los comprobantes
			$data['comprobantes'] = $this->comprobante_model->getComprobantes(array('comprobante.flestado' => 0));
			#Traemos los medios de pagos
			$data['mediospagos'] = $this->mediopago_model->getMediospagos(array('mediopago.flestado' => 0));

			$this->load->view('reporte/compra/header', $data);
			$this->load->view('reporte/compra/index');
			$this->load->view('reporte/compra/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	
	public function reporte_venta()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "REPORTE DE VENTAS";
			#Traemos los comprobantes
	        $data['comprobantes'] = $this->comprobante_model->getComprobantes(array('comprobante.flestado' => 0));
			#Traemos los medios de pagos
			$data['mediospagos'] = $this->mediopago_model->getMediospagos(array('mediopago.flestado' => 0));
			
			$this->load->view('reporte/venta/header', $data);
			$this->load->view('reporte/venta/index');
			$this->load->view('reporte/venta/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

	
	public function mant_empresa()
	{
		//Administrador:1
		if($this->session->id_perfil==1){
			#Título de la página
			$data['titulo'] = "EMPRESA";
			#Traemos las empresas
	        $data['empresas'] = $this->empresa_model->getEmpresas();


			$this->load->view('empresa/header', $data);
			$this->load->view('empresa/index');
			$this->load->view('empresa/footer');
		}else{
			redirect(base_url('login/logout'));
		}
	}

}