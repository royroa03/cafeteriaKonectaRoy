<?php 
  if($this->session->ruta_foto){
    $ruta_foto=base_url('imagenes/personal/'.$this->session->ruta_foto);
  }else{
    $ruta_foto=base_url('imagenes/personal/personal_default.png');
  }
?>
<body class="nav-md">
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
                <h3>Créditos de Proveedores <small>Créditos</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Créditos<small>Listado</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                        <div class="col-md-12"><?php if ($this->session->flashdata('msg')){ echo $this->session->flashdata('msg'); } ?></div>
                    </div>
                    <p>
                      Actualizado el <?php echo date('j'); ?>/<?php echo date('m'); ?>/<?php echo date('Y'); ?> a las <?php echo date('H'); ?>:<?php echo date('i'); ?>:<?php echo date('s'); ?>
                    </p>

                    <div class="modal inmodal" id="mdlPagoCreditoProveedor" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Pago de Crédito</h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open(base_url('creditoproveedor/pagar'), array('class' => ' form-horizontal form-label-left', 'id'=>'formCreditoProveedor', 'style' => 'overflow:hidden'));?>
                                      
                                      <input type="hidden" id="id_creditoproveedor" name="id_creditoproveedor" value="">
                                      <input type="hidden" id="id_proveedor" name="id_proveedor" value="">
                                      
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label">Nro Documento:</label>
                                        <input type="text" class="form-control" name="nro_doc_proveedor" id="nro_doc_proveedor" placeholder="Nro documento" readonly>
                                      </div>
                                      <div class="form-group col-md-8 col-sm-8 col-xs-12">
                                        <label class="control-label">Proveedor:</label>
                                        <input type="text" class="form-control" name="proveedor" id="proveedor" placeholder="Razón social" readonly>
                                      </div>
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label">Fecha de Compra:</label>
                                        <input type="text" class="form-control" name="fecha_compra" id="fecha_compra" placeholder="Fecha de la Compra" readonly>
                                      </div>
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label">Total de Compra:</label>
                                        <input type="text" class="form-control" name="total_compra" id="total_compra" placeholder="Total de la Compra" readonly>
                                      </div>
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12">
                                        <label class="control-label">Deuda:</label>
                                        <input type="text" class="form-control" name="deuda_compra" id="deuda_compra" placeholder="Deuda de la Compra" readonly>
                                      </div>

                                      <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <hr>
                                        <label>Amortizaciones de la Deuda:</label>
                                        <div id="div_creditoproveedor_detalle"></div>
                                        <hr>
                                      </div>

                                      <div class="form-group col-md-8 col-sm-8 col-xs-12">
                                        <h5>Usted a Pagado 
                                          S/ <strong><label id="lbl_apagado"></label></strong>
                                          de 
                                          S/ <strong><label id="lbl_totalcredito"></label></strong>
                                        </h5>
                                      </div>
                                      <div class="form-group col-md-4 col-sm-4 col-xs-12 divNumero">
                                        <label>Monto a pagar:</label>
                                        <input type="text" class="form-control numero" name="totalpago_credito" id="totalpago_credito" placeholder="Total de Pago">
                                      </div>

                                      <div class="row">
                                        <br>
                                        <br>
                                          <div class="col-md-12 col-sm-12 col-xs-12">
                                            <center>
                                              <button class="btn btn-sm btn-success pull-center m-t-n-xs" type="submit"><strong>GRABAR</strong></button>
                                              <button class="btn btn-sm btn-danger pull-center m-t-n-xs" data-dismiss="modal"><strong>CANCELAR</strong></button>
                                            </center>
                                          </div>
                                      </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Tipo Doc</th>
                          <th>Nro. Doc</th>
                          <th>Proveedor</th>
                          <th>Compra</th>
                          <th>Fecha</th>
                          <th>Moneda</th>
                          <th>Total</th>
                          <th>Deuda</th>
                          <th>Estado</th>
                          <th>Registro</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           if (is_array($creditosproveedores)):
                                foreach ($creditosproveedores AS $creditoproveedor){
                        ?>
                        <tr>
                          <td><?php echo $creditoproveedor->id_creditoproveedor; ?></td>
                          <td>
                            <?php if($creditoproveedor->tipo_doc_proveedor==1){
                                    echo 'DNI';
                                  }else{
                                    echo 'RUC';
                                  }
                            ?>
                          </td>
                          <td><?php echo $creditoproveedor->nro_doc_proveedor; ?></td>
                          <td><?php echo $creditoproveedor->proveedor; ?></td>
                          <td><?php echo $creditoproveedor->id_compra; ?></td>
                          <td><?php echo $creditoproveedor->feregistro_compra; ?></td>
                          <td><?php echo $creditoproveedor->simbolo_moneda; ?></td>
                          <td><?php echo $creditoproveedor->total; ?></td>
                          <td style="color: red"><?php echo $creditoproveedor->deuda; ?></td>
                          <td>
                            <?php if($creditoproveedor->flestado==1){
                                    echo 'Pagado';
                                  }else if($creditoproveedor->flestado==2){
                                    echo 'Anulado';
                                  }else{
                                    echo 'Pendiente';
                                  }
                            ?>
                          </td>
                          <td><?php echo $creditoproveedor->feregistro; ?></td>
                          <td>
                            <?php //Si está pagado o anulado el crédito y venta, desactivar boton pagar
                              $estado_boton_pagar='';
                              if($creditoproveedor->flestado==1 || $creditoproveedor->flestado==2){  
                              $estado_boton_pagar='disabled';
                            } ?>
                            <button class="btn btn-sm btn-success m-b-none" data-toggle="modal" data-target="#mdlPagoCreditoProveedor" data-idcreditoproveedor="<?php echo $creditoproveedor->id_creditoproveedor; ?>" title="Pagar Crédito" <?php echo 
                              $estado_boton_pagar ?>><i class="fa fa-shopping-cart"></i></button>
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
