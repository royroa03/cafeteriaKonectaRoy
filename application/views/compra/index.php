<?php 
  if($this->session->ruta_foto){
    $ruta_foto=base_url('imagenes/personal/'.$this->session->ruta_foto);
  }else{
    $ruta_foto=base_url('imagenes/personal/personal_default.png');
  }
?>
<body class="nav-md">
  <div class="loading">
    <div class="load">
        <div class="sk-spinner sk-spinner-three-bounce">
      <div class="sk-bounce1"></div>
      <div class="sk-bounce2"></div>
      <div class="sk-bounce3"></div>
    </div>
        <div>Cargando...</div>
    </div>
  </div>
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-pencil-square-o"></i> <span>Tienda POS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo $ruta_foto; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido,</span>
                <h2><?php echo $this->session->nombres; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

             <!-- sidebar menu -->
             <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Menú de Opciones</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url('panel'); ?>"><i class="fa fa-bar-chart-o"></i> Mi Dashboard </a></li>
                  <li><a><i class="fa fa-desktop"></i> Mantenimientos <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if($this->session->id_perfil==1){  ?>
                        <li><a href="<?php echo base_url('panel/mant_empresa'); ?>">Empresa</a></li>
                        <li><a href="<?php echo base_url('panel/mant_perfil'); ?>">Perfiles</a></li>
                        <li><a href="<?php echo base_url('panel/mant_usuario'); ?>">Usuarios</a></li>
                        <li><a href="<?php echo base_url('panel/mant_personal'); ?>">Personal</a></li>
                      <?php }  ?>
                      <?php if($this->session->id_perfil==1 || $this->session->id_perfil==2 ){  ?>
                        <li><a href="<?php echo base_url('panel/mant_cliente'); ?>">Clientes</a></li>
                      <?php }  ?>
                      <?php if($this->session->id_perfil==1){  ?>
                        <li><a href="<?php echo base_url('panel/mant_proveedor'); ?>">Proveedores</a></li>
                        <li><a href="<?php echo base_url('panel/mant_categoria'); ?>">Categorías</a></li>
                      <?php }  ?>
                      <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
                        <li><a href="<?php echo base_url('panel/mant_producto'); ?>">Productos</a></li>
                      <?php }  ?>
                      <?php if($this->session->id_perfil==1){  ?>
                        <li><a href="<?php echo base_url('panel/mant_comprobante'); ?>">Comprobantes</a></li>
                        <li><a href="<?php echo base_url('panel/mant_mediopago'); ?>">Medios de Pagos</a></li>
                        <li><a href="<?php echo base_url('panel/mant_unidad'); ?>">Unidades</a></li>
                        <li><a href="<?php echo base_url('panel/mant_caja'); ?>">Cajas</a></li>
                      <?php }  ?>
                    </ul>
                  </li>
                  <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
                    <li><a><i class="fa fa-bar-chart-o"></i> Compras <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('panel/mant_compra'); ?>">Compras</a></li>
                      </ul>
                    </li>
                  <?php }  ?>
                  <?php if($this->session->id_perfil==1 || $this->session->id_perfil==2){  ?>
                  <li><a><i class="fa fa-line-chart"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('panel/mant_venta'); ?>">Ventas</a></li>
                    </ul>
                  </li>
                  <?php }  ?>
                  <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
                    <li><a><i class="fa fa-building"></i> Almacén <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('panel/mant_stock'); ?>">Stocks</a></li>
                        <li><a href="<?php echo base_url('panel/mant_merma'); ?>">Mermas</a></li>
                        <li><a href="<?php echo base_url('panel/mant_kardex'); ?>">Kárdex</a></li>
                      </ul>
                    </li>
                  <?php }  ?>
                  <?php if($this->session->id_perfil==1 || $this->session->id_perfil==2){  ?>
                  <li><a><i class="fa fa-credit-card"></i> Créditos (Clientes) <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url('panel/mant_creditocliente'); ?>">Créditos</a></li>
                      <li><a href="<?php echo base_url('panel/mant_amortizacreditocliente'); ?>">Amortizaciones</a></li>
                    </ul>
                  </li>
                  <?php }  ?>
                  <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
                    <li><a><i class="fa fa-credit-card"></i> Créditos (Proveedores) <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('panel/mant_creditoproveedor'); ?>">Créditos</a></li>
                        <li><a href="<?php echo base_url('panel/mant_amortizacreditoproveedor'); ?>">Amortizaciones</a></li>
                      </ul>
                    </li>
                  <?php }  ?>
                  <?php if($this->session->id_perfil==1){  ?>
                    <li><a><i class="fa fa-clone"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo base_url('panel/reporte_compra'); ?>">Compras</a></li>
                        <li><a href="<?php echo base_url('panel/reporte_venta'); ?>">Ventas</a></li>
                      </ul>
                    </li>
                  <?php }  ?>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

             <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Salir del Sistema" href="<?php echo base_url('login/logout'); ?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $ruta_foto; ?>" alt=""><?php echo $this->session->nombres; ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url('panel/perfil'); ?>"><i class="fa fa-user pull-right"></i>Mi Perfil</a></li>
                    <li><a href="#"><i class="fa fa-home pull-right"></i><?php echo $this->session->razon_social_empresa;?></a></li>
                    <li><a href="<?php echo base_url('login/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Salir del Sistema</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Compras <small>Compras</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Compras<small>Listado</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#mdlNuevoCompra" type="button" data-backdrop="static" data-keyboard="false" ><span class="bold">NUEVA COMPRA</span></button>
                    </p>
                    
                    <div class="row">
                        <div class="col-md-12"><?php if ($this->session->flashdata('msg')){ echo $this->session->flashdata('msg'); } ?></div>
                        <!--<h2><?php print_r($this->session); ?></h2>-->
                    </div>
                    <p>
                      Actualizado el <?php echo date('j'); ?>/<?php echo date('m'); ?>/<?php echo date('Y'); ?> a las <?php echo date('H'); ?>:<?php echo date('i'); ?>:<?php echo date('s'); ?>
                    </p>

                      <div class="modal inmodal" id="mdlNuevoCompra" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-x: hidden; overflow-y: auto;">
                        <div class="modal-dialog" style="width: 95%">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <h4 class="modal-title">Nueva Compra</h4>
                                </div>
                                <div class="modal-body">
                                    
                                      <div class="row">
                                        <div class="col-md-8" >
                                          <div style="border: 1px solid #ddd; ">
                                          <!--Buscador de Productos-->
                                            <div class="form-group" style="padding: 10px;">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Buscar Producto: </label>
                                              <div class="input-group">
                                                  <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                                  <input type="text" name="txt_buscar_producto" placeholder="Producto" class="input-sm form-control" id="txt_buscar_producto">
                                              </div>
                                            </div>

                                            
                                            <div class="x_panel" style="max-height: 650px !important; overflow: auto">
                                              
                                              <div class="x_content">

                                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                                    <li role="presentation" class="active"><a href="#tab_prodcat_0" id="categoria_0-tab" role="tab" data-toggle="tab" aria-expanded="true" onclick="listarProductoCategoria(0)">Todo</a>
                                                    </li>
                                                    <?php if($categorias): foreach ($categorias as $categoria) { ?>
                                                      <li role="presentation" class=""><a href="#tab_prodcat_<?php echo $categoria->id_categoria; ?>" role="tab" id="categoria_<?php echo $categoria->id_categoria; ?>-tab" data-toggle="tab" aria-expanded="false" onclick="listarProductoCategoria(<?php echo $categoria->id_categoria; ?>)"><?php echo $categoria->nombre; ?></a>
                                                      </li>
                                                    <?php } endif; ?>
                                                  </ul>

                                                  <div id="myTabContent" class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_prodcat_0" aria-labelledby="home-tab">
                                                      <input type="hidden" id="id_categoria" name="id_categoria" value="0">
                                                      <br>
                                                      <br>
                                                      <?php if($productos): foreach ($productos as $producto){ 
                                                       $nomb_producto = substr($producto->nombre, 0,15); 
                                                        if($producto->ruta_imagen){
                                                          $imagen_producto=base_url('imagenes/producto/'.$producto->ruta_imagen);
                                                        }else{
                                                          $imagen_producto=base_url('imagenes/producto/producto_default.png');
                                                        }
                                                      ?>

                                                        <div class="col-md-3 col-sm-3 col-xs-6 nombproducto" >
                                                          <br>
                                                          <div class="offer">
                                                            <div class="offer-content divNumero">
                                                              <center><img src="<?php echo $imagen_producto ?>" alt="Imagen del Producto" style="width: 90px !important; height: 70px !important " title="<?php echo $producto->nombre; ?>"></center>
                                                              <center><span class="label label-warning"><strong><?php echo $producto->nombre_categoria; ?></strong></span></center>
                                                              <center><h6><strong><?php echo $nomb_producto?></strong></h6></center>
                                                              <input class="input text-center form-control numero cantidad" type="text" name="cantidad_producto_<?php echo $producto->id_producto; ?>_cat_0" style="display: block;" value="1">
                                                              <center><h6><strong><input class="text-center form-control numero" type="text" name="precio_producto_<?php echo $producto->id_producto; ?>_cat_0" placeholder="(<?php echo $producto->simbolo_moneda; ?>) Precio /<?php echo $producto->abreviatura_unidad;?>"></strong></h6></center>
                                                              <center><h6><strong>Stock:<?php echo $producto->cantactual_stock;?> </strong></h6></center>
                                                              <center><a class="btn btn-primary btn-sm btn-block"  onclick="agregarProductoCarrito('<?php echo $producto->id_producto; ?>',0)">Agregar</a></center>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      <?php } endif; ?>
                                                    </div>
                                                    <?php if($categorias): foreach ($categorias as $categoria) { ?>
                                                    <div role="tabpanel" class="tab-pane fade" id="tab_prodcat_<?php echo $categoria->id_categoria; ?>" aria-labelledby="profile-tab">
                                                    </div>
                                                    <?php } endif; ?>
                                                    
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      
                                        <div class="col-md-4">
                                          <?php echo form_open(base_url('compra/save'), array('class' => ' form-horizontal form-label-left', 'id'=>'formCompra', 'style' => 'overflow:hidden'));?>
                                          <h3><strong>Información de la Compra</strong></h3>
                                          <div style="border: 1px solid #ddd; max-height: 690px !important; height: 690px !important; overflow: auto; padding: 10px">
                                           <div class="row">
                                              <!--<div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                                <label class="control-label">(*)Cliente: </label>
                                                <select class="form-control input-sm chosen-select" id="id_cliente" name="id_cliente">
                                                  <option value="">---Seleccionar---</option>
                                                  <?php if($proveedores): foreach ($proveedores as $proveedor) { ?>
                                                      <option value="<?php echo $proveedor->id_proveedor; ?>">
                                                        <?php echo $proveedor->nro_doc; ?>
                                                        || <?php echo $proveedor->razon_social; ?>
                                                        
                                                      </option>
                                                  <?php } endif; ?>
                                                </select>
                                                <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#mdlNuevoCliente" type="button"><span class="bold">+Agregar</span></button>
                                              </div>-->

                                              <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                                <label class="control-label">(*)Proveedor: </label>
                                                <select class="form-control input-sm chosen-select" id="id_proveedor" name="id_proveedor">
                                                  
                                                </select>
                                                <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#mdlNuevoProveedor" type="button"><span class="bold">+Agregar</span></button>
                                              </div>
                                            </div>
                                            
                                            <div class="row">
                                              <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                                <label class="control-label">(*)Medio de Pago: </label>
                                                <select class="form-control input-sm chosen-select" id="id_mediopago" name="id_mediopago" >
                                                  <option value="">---Seleccionar---</option>
                                                  <?php if($mediospagos): foreach ($mediospagos as $mediopago) { ?>
                                                      <option value="<?php echo $mediopago->id_mediopago; ?>">
                                                        <?php echo $mediopago->nombre; ?>
                                                      </option>
                                                  <?php } endif; ?>
                                                </select>
                                              </div>
                                              <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                                <label class="control-label">(*)Comprobante: </label>
                                                <select class="form-control input-sm chosen-select" id="id_comprobante" name="id_comprobante" >
                                                  <option value="">---Seleccionar---</option>
                                                  <?php if($comprobantes): foreach ($comprobantes as $comprobante) { ?>
                                                      <option value="<?php echo $comprobante->id_comprobante; ?>">
                                                        <?php echo $comprobante->codigo; ?> - <?php echo $comprobante->descripcion; ?>
                                                      </option>
                                                  <?php } endif; ?>
                                                </select>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                <hr>
                                                  <div class="items_producto"></div>
                                                <hr>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="form-group col-md-4 col-sm-12 col-xs-12" >
                                                <label class="control-label">Subtotal: </label>
                                                <input type="text" class="form-control" name="txt_subtotal" id="txt_subtotal" placeholder="Subtotal" value="0.00" readonly>
                                              </div>
                                              <div class="form-group col-md-4 col-sm-12 col-xs-12 divNumero" >
                                                <label class="control-label">Descuento: </label>
                                                <input type="text" class="form-control numero" name="txt_descuento" id="txt_descuento" placeholder="Descuento" value="0.00">
                                              </div>
                                              <div class="form-group col-md-4 col-sm-12 col-xs-12" >
                                                <label class="control-label">Total a pagar: </label>
                                                <input type="text" class="form-control" name="txt_total" id="txt_total" placeholder="Total" value="0.00" readonly>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                                <label class="control-label">(*)Moneda: </label>
                                                <select class="form-control input-sm chosen-select" id="id_moneda" name="id_moneda">
                                                  <option value="">---Seleccionar---</option>
                                                  <?php if($monedas): foreach ($monedas as $moneda) { ?>
                                                      <option value="<?php echo $moneda->id_moneda; ?>">
                                                        <?php echo $moneda->nombre; ?> (<?php echo $moneda->simbolo; ?>)
                                                      </option>
                                                  <?php } endif; ?>
                                                </select>
                                              </div>
                                              <div class="form-group col-md-6 col-sm-12 col-xs-12 divNumero" >
                                                <label class="control-label">Conversión de Moneda: </label>
                                                <input type="text" class="form-control numero" name="txt_conversionmoneda" id="txt_conversionmoneda" placeholder="Efectivo" value="0.00" readonly>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="form-group col-md-6 col-sm-12 col-xs-12 divNumero" >
                                                <label class="control-label">Efectivo: </label>
                                                <input type="text" class="form-control numero" name="txt_efectivo" id="txt_efectivo" placeholder="Efectivo" value="0.00" readonly>
                                              </div>
                                              <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                                <label class="control-label">Vuelto: </label>
                                                <input type="text" class="form-control" name="txt_vuelto" id="txt_vuelto" placeholder="Vuelto" value="0.00" readonly>
                                              </div>
                                            </div>
                                            <br>
                                            <br>
                                            <div class="row">
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                <label class="pull-right">Atendido: <?php echo $this->session->apellido_paterno; ?> <?php echo $this->session->apellido_materno; ?>, <?php echo $this->session->nombres; ?></label>
                                              </div>
                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                <center>
                                                  <button class="btn btn-block btn-primary pull-center m-t-n-xs" type="submit"><strong>GRABAR COMPRA</strong></button>
                                                  <button class="btn btn-block btn-danger pull-center m-t-n-xs" data-dismiss="modal"  onclick="vaciarProductoCarrito()"><strong>CANCELAR COMPRA</strong></button>
                                                </center>
                                              </div>
                                            </div>

                                          </div>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal inmodal" id="mdlNuevoProveedor" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Nuevo Proveedor</h4>
                                </div>
                                <div class="modal-body form-horizontal form-label-left">
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Documento</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control input-sm chosen-select" id="tipo_doc" name="tipo_doc" required>
                                            <option value="">---Seleccionar---</option>
                                            <option value="2">RUC</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group divNumero">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Nro Documento</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control numero" name="nro_doc" id="nro_doc" placeholder="Número de documento" required>
                                        </div>
                                      </div>
                                     
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Razón Social</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="razon_social" id="razon_social" placeholder="Razón Social" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Teléfono</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="telefono1" id="telefono1" placeholder="Teléfono" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Teléfono adicional</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="telefono2" id="telefono2" placeholder="Teléfono adicional">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Dirección</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Referencia</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="referencia" id="referencia" placeholder="Referencia">
                                        </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12 col-sm-12 col-xs-12">
                                            <center>
                                              <button class="btn btn-sm btn-success pull-center m-t-n-xs" id="btnGrabarProveedor"><strong>GRABAR</strong></button>
                                              <button class="btn btn-sm btn-danger pull-center m-t-n-xs" data-dismiss="modal"><strong>CANCELAR</strong></button>
                                            </center>
                                          </div>
                                      </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal inmodal" id="mdlVerCompra" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Información de Compra</h4>
                                </div>
                                <div class="modal-body form-horizontal form-label-left">
                                  <div style="border: 1px solid #ddd; padding: 10px">
                                    <div class="row">
                                      <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                        <label class="control-label">Proveedor: </label>
                                        <input type="text" class="form-control" name="txt_ver_proveedor" id="txt_ver_proveedor" placeholder="Proveedor">
                                      </div>
                                    </div>
                                    
                                    <div class="row">
                                      <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                        <label class="control-label">Medio de Pago: </label>
                                        <input type="text" class="form-control" name="txt_ver_mediopago" id="txt_ver_mediopago" placeholder="Medio de Pago">
                                      </div>
                                      <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                        <label class="control-label">Comprobante: </label>
                                        <input type="text" class="form-control" name="txt_ver_comprobante" id="txt_ver_comprobante" placeholder="Comprobante">
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <hr>
                                          <div class="items_ver_producto"></div>
                                        <hr>
                                      </div>
                                    </div>

                                    <div class="row">
                                      <div class="form-group col-md-4 col-sm-12 col-xs-12" >
                                        <label class="control-label">Subtotal: </label>
                                        <input type="text" class="form-control" name="txt_ver_subtotal" id="txt_ver_subtotal" placeholder="Subtotal">
                                      </div>
                                      <div class="form-group col-md-4 col-sm-12 col-xs-12 divNumero" >
                                        <label class="control-label">Descuento: </label>
                                        <input type="text" class="form-control numero" name="txt_ver_descuento" id="txt_ver_descuento" placeholder="Descuento">
                                      </div>
                                      <div class="form-group col-md-4 col-sm-12 col-xs-12" >
                                        <label class="control-label">Total: </label>
                                        <input type="text" class="form-control" name="txt_ver_total" id="txt_ver_total" placeholder="Total">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                        <label class="control-label">Moneda: </label>
                                        <input type="text" class="form-control" name="txt_ver_moneda" id="txt_ver_moneda" placeholder="Moneda">
                                      </div>
                                      <div class="form-group col-md-6 col-sm-12 col-xs-12 divNumero" >
                                        <label class="control-label">Conversión de Moneda: </label>
                                        <input type="text" class="form-control numero" name="txt_ver_conversion" id="txt_ver_conversion" placeholder="Conversión">
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="form-group col-md-6 col-sm-12 col-xs-12 divNumero" >
                                        <label class="control-label">Efectivo: </label>
                                        <input type="text" class="form-control numero" name="txt_ver_efectivo" id="txt_ver_efectivo" placeholder="Efectivo">
                                      </div>
                                      <div class="form-group col-md-6 col-sm-12 col-xs-12" >
                                        <label class="control-label">Vuelto: </label>
                                        <input type="text" class="form-control" name="txt_ver_vuelto" id="txt_ver_vuelto" placeholder="Vuelto">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Comprobante</th>
                          <th>Medio</th>
                          <th>Subtotal (S/)</th>
                          <th>Descuento (S/)</th>
                          <th>Total (S/)</th>
                          <th>Nro. Doc</th>
                          <th>Cliente</th>
                          <th>Estado</th>
                          <th>Registro</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           if (is_array($compras)):
                                foreach ($compras AS $compra){
                        ?>
                        <tr>
                          <td><?php echo $compra->id_compra; ?></td>
                          <td><?php echo $compra->fecha; ?></td>
                          <td><?php echo $compra->comprobante; ?></td>
                          <td><?php echo $compra->mediopago; ?></td>
                          <td><?php echo $compra->subtotal; ?></td>
                          <td>- <?php echo $compra->descuento; ?></td>
                          <td><?php echo $compra->total; ?></td>
                          <td><?php echo $compra->nrodoc_proveedor; ?></td>
                          <td><?php echo $compra->proveedor; ?></td>
                          <td>
                            <?php if($compra->flestado==0){
                                    echo 'Pagado';
                                  }else if($compra->flestado==1){
                                    echo 'Pendiente';
                                  }else{
                                    echo 'Anulado';
                                  }
                            ?>
                          </td>
                          <td><?php echo $compra->feregistro; ?></td>
                          <td>
                          <?php if($compra->flestado!=2){ //2:Anulado ?>
                            <button onclick="anularCompra('<?php echo $compra->id_compra; ?>')" class="btn btn-sm btn-danger m-b-none" data-toggle="tooltip" data-placement="top" title="Anular Compra"><i class="fa fa-minus"></i></button>
                          <?php } ?>
                          <button type="button" data-toggle="modal" data-target="#mdlVerCompra" data-idcompra="<?php echo $compra->id_compra; ?>" class="btn edit btn-sm btn-warning m-b-none"><i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Ver"></i></button>
                          </td>
                        </tr>
                        <?php } endif;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            ©2022 All Rights Reserved. Privacy and Terms. Tienda POS <i class="fa fa-heart"></i> Roy Roa
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->      
      </div>
    </div>
