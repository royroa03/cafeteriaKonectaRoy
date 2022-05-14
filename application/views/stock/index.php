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
                <h3>Almacén <small>Stocks</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Stocks<small>Listado</small></h2>
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

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Producto</th>
                          <th>Unidad</th>
                          <th>Cantidad Actual</th>
                          <th>Cantidad Reserva</th>
                          <th>Cantidad Disponible</th>
                          <th>Registro</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           if (is_array($stocks)):
                                foreach ($stocks AS $stock){
                        ?>
                        <tr>
                          <td><?php echo $stock->id_stock; ?></td>
                          <td><?php echo $stock->nombre_producto; ?></td>
                          <td><?php echo $stock->nombre_unidad; ?></td>
                          <td><?php echo $stock->cantactual; ?></td>
                          <td><?php echo $stock->cantreserva; ?></td>
                          <td><?php echo $stock->cantdisponible; ?></td>
                          <td><?php echo $stock->feregistro; ?></td>
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
