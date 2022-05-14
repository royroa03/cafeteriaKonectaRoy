<?php 
  if($this->session->ruta_foto){
    $ruta_foto=base_url('imagenes/personal/'.$this->session->ruta_foto);
  }else{
    $ruta_foto=base_url('imagenes/personal/personal_default.png');
  }
?>
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
          <!-- top tiles -->

          <div class="row tile_count">
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_perfil'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-group green"></i></div>
                    <div class="count"><?php $total_perfiles=0; if(is_array($perfiles)){ echo $total_perfiles=count($perfiles); } else{ echo $total_perfiles;} ?></div>
                    <h4 style="padding-left:10px">Perfiles</h4>
                    <h6 style="padding-left:10px"><label><?php $total_perfiles_hacedias=0; if(is_array($perfiles_hacedias)){ echo $total_perfiles_hacedias=count($perfiles_hacedias); } else{ echo $total_perfiles_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_usuario'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-user green"></i></div>
                    <div class="count"><?php $total_usuarios=0; if(is_array($usuarios)){ echo $total_usuarios=count($usuarios); } else{ echo $total_usuarios;} ?></div>
                    <h4 style="padding-left:10px">Usuarios</h4>
                    <h6 style="padding-left:10px"><label><?php $total_usuarios_hacedias=0; if(is_array($usuarios_hacedias)){ echo $total_usuarios_hacedias=count($usuarios_hacedias); } else{ echo $total_usuarios_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_personal'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-male green"></i></div>
                    <div class="count"><?php $total_personales=0; if(is_array($personales)){ $total_personales=0;echo $total_personales=count($personales); } else{ echo $total_personales;} ?></div>
                    <h4 style="padding-left:10px">Personales</h4>
                    <h6 style="padding-left:10px"><label><?php $total_personales_hacedias=0; if(is_array($personales_hacedias)){ $total_personales_hacedias=0;echo $total_personales_hacedias=count($personales_hacedias); } else{ echo $total_personales_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1 || $this->session->id_perfil==2){  ?>
              <a href="<?php echo base_url('panel/mant_cliente'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-child green"></i></div>
                    <div class="count"><?php $total_clientes=0; if(is_array($clientes)){ echo $total_clientes=count($clientes); } else{ echo $total_clientes;} ?></div>
                    <h4 style="padding-left:10px">Clientes</h4>
                    <h6 style="padding-left:10px"><label><?php $total_clientes_hacedias=0; if(is_array($clientes_hacedias)){ echo $total_clientes_hacedias=count($clientes_hacedias); } else{ echo $total_clientes_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_proveedor'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-building green"></i></div>
                    <div class="count"><?php $total_proveedores=0; if(is_array($proveedores)){ echo $total_proveedores=count($proveedores); } else{ echo $total_proveedores;} ?></div>
                    <h4 style="padding-left:10px">Proveedores</h4>
                    <h6 style="padding-left:10px"><label><?php $total_proveedores_hacedias=0; if(is_array($proveedores_hacedias)){ echo $total_proveedores_hacedias=count($proveedores_hacedias); } else{ echo $total_proveedores_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_categoria'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-bookmark green"></i></div>
                    <div class="count"><?php $total_categorias=0; if(is_array($categorias)){ echo $total_categorias=count($categorias); } else{ echo $total_categorias;} ?></div>
                    <h4 style="padding-left:10px">Categorias</h4>
                    <h6 style="padding-left:10px"><label><?php $total_categorias_hacedias=0; if(is_array($categorias_hacedias)){ echo $total_categorias_hacedias=count($categorias_hacedias); } else{ echo $total_categorias_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
              <a href="<?php echo base_url('panel/mant_producto'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-barcode green"></i></div>
                    <div class="count"><?php $total_productos=0; if(is_array($productos)){ echo $total_productos=count($productos); } else{ echo $total_productos;} ?></div>
                    <h4 style="padding-left:10px">Productos</h4>
                    <h6 style="padding-left:10px"><label><?php $total_productos_hacedias=0; if(is_array($productos_hacedias)){ echo $total_productos_hacedias=count($productos_hacedias); } else{ echo $total_productos_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_comprobante'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-file-text-o green"></i></div>
                    <div class="count"><?php  $total_comprobantes=0; if(is_array($comprobantes)){ echo $total_comprobantes=count($comprobantes); } else{ echo $total_comprobantes;} ?></div>
                    <h4 style="padding-left:10px">Comprobantes</h4>
                    <h6 style="padding-left:10px"><label><?php  $total_comprobantes_hacedias=0; if(is_array($comprobantes_hacedias)){ echo $total_comprobantes_hacedias=count($comprobantes_hacedias); } else{ echo $total_comprobantes_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_mediopago'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-pencil-square-o green"></i></div>
                    <div class="count"><?php $total_mediospagos=0; if(is_array($mediospagos)){ echo $total_mediospagos=count($mediospagos); } else{ echo $total_mediospagos;} ?></div>
                    <h4 style="padding-left:10px">Medios de Pagos</h4>
                    <h6 style="padding-left:10px"><label><?php $total_mediospagos_hacedias=0; if(is_array($mediospagos_hacedias)){ echo $total_mediospagos_hacedias=count($mediospagos_hacedias); } else{ echo $total_mediospagos_hacedias;} ?> </label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_unidad'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-bars green"></i></div>
                    <div class="count"><?php $total_unidades=0; if(is_array($unidades)){ echo $total_unidades=count($unidades); } else{ echo $total_unidades;} ?></div>
                    <h4 style="padding-left:10px">Unidades</h4>
                    <h6 style="padding-left:10px"><label><?php $total_unidades_hacedias=0; if(is_array($unidades_hacedias)){ echo $total_unidades_hacedias=count($unidades_hacedias); } else{ echo $total_unidades_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1){  ?>
              <a href="<?php echo base_url('panel/mant_caja'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-calculator green"></i></div>
                    <div class="count"><?php $total_cajas=0; if(is_array($cajas)){ echo $total_cajas=count($cajas); } else{ echo $total_cajas;} ?></div>
                    <h4 style="padding-left:10px">Cajas</h4>
                    <h6 style="padding-left:10px"><label><?php $total_cajas_hacedias=0; if(is_array($cajas_hacedias)){ echo $total_cajas_hacedias=count($cajas_hacedias); } else{ echo $total_cajas_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1 || $this->session->id_perfil==2){  ?>
              <a href="<?php echo base_url('panel/mant_creditocliente'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-credit-card green"></i></div>
                    <div class="count"><?php $total_creditosclientes=0; if(is_array($creditosclientes)){ echo $total_creditosclientes=count($creditosclientes); } else{ echo $total_creditosclientes;} ?></div>
                    <h4 style="padding-left:10px">C.(clientes)</h4>
                    <h6 style="padding-left:10px"><label><?php $total_cc_hacedias=0; if(is_array($creditosclientes_hacedias)){ echo $total_cc_hacedias=count($creditosclientes_hacedias); } else{ echo $total_cc_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
              <a href="<?php echo base_url('panel/mant_creditoproveedor'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-credit-card green"></i></div>
                    <div class="count"><?php $total_creditosproveedores=0; if(is_array($creditosproveedores)){ echo $total_creditosproveedores=count($creditosproveedores); } else{ echo $total_creditosproveedores;} ?></div>
                    <h4 style="padding-left:10px">C.(proveedores)</h4>
                    <h6 style="padding-left:10px"><label><?php $total_cp_hacedias=0; if(is_array($creditosproveedores_hacedias)){ echo $total_cp_hacedias=count($creditosproveedores_hacedias); } else{ echo $total_cp_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1 || $this->session->id_perfil==2){  ?>
              <a href="<?php echo base_url('panel/mant_venta'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-line-chart green"></i></div>
                    <div class="count"><?php $total_ventas=0; if(is_array($ventas)){ echo $total_ventas=count($ventas); } else{ echo $total_ventas;} ?></div>
                    <h4 style="padding-left:10px">Ventas</h4>
                    <h6 style="padding-left:10px"><label><?php $total_ventas_hacedias=0; if(is_array($ventas_hacedias)){ echo $total_ventas_hacedias=count($ventas_hacedias); } else{ echo $total_ventas_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
              <a href="<?php echo base_url('panel/mant_compra'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-bar-chart-o green"></i></div>
                    <div class="count"><?php $total_compras=0; if(is_array($compras)){ echo $total_compras=count($compras); } else{ echo $total_compras;} ?></div>
                    <h4 style="padding-left:10px">Compras</h4>
                    <h6 style="padding-left:10px"><label><?php $total_compras_hacedias=0; if(is_array($compras_hacedias)){ echo $total_compras_hacedias=count($compras_hacedias); } else{ echo $total_compras_hacedias;} ?></label> &bull; Hace (3) días</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
            <?php if($this->session->id_perfil==1 || $this->session->id_perfil==3){  ?>
              <a href="<?php echo base_url('panel/mant_stock'); ?>">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-6 col-xs-6">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-tasks green"></i></div>
                    <div class="count"><?php $total_stocks=0; if(is_array($stocks)){ echo $total_stocks=count($stocks); } else{ echo $total_stocks;} ?></div>
                    <h4 style="padding-left:10px">Stocks</h4>
                    <h6 style="padding-left:10px"><label><?php $total_stocks_hacedias=0; if(is_array($stocks_hacedias)){ echo $total_stocks_hacedias=count($stocks_hacedias); } else{ echo $total_stocks_hacedias;} ?></label> &bull; Menor a (5)</h6>
                  </div>
                </div>
              </a>
            <?php }  ?>
           

          </div>
          <!-- /top tiles -->
          <br />
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