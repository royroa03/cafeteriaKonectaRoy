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
                <h3>Mantenimientos <small>Productos</small></h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Productos<small>Listado</small></h2>
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
                      <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#mdlNuevoProducto" type="button"><span class="bold">NUEVO PRODUCTO</span></button>
                    </p>
                    <div class="row">
                        <div class="col-md-12"><?php if ($this->session->flashdata('msg')){ echo $this->session->flashdata('msg'); } ?></div>
                    </div>
                    <p>
                      Actualizado el <?php echo date('j'); ?>/<?php echo date('m'); ?>/<?php echo date('Y'); ?> a las <?php echo date('H'); ?>:<?php echo date('i'); ?>:<?php echo date('s'); ?>
                    </p>

                      <div class="modal inmodal" id="mdlNuevoProducto" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Nuevo Producto</h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open_multipart(base_url('producto/save'), array('novalidate'=>'','class' => ' form-horizontal form-label-left', 'id'=>'formProducto', 'style' => 'overflow:hidden'));?>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Categoría</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control input-sm chosen-select" id="id_categoria" name="id_categoria" required>
                                            <option value="">---Seleccionar---</option>
                                            <?php if($categorias): foreach ($categorias as $categoria) { ?>
                                                <option value="<?php echo $categoria->id_categoria; ?>">
                                                  <?php echo $categoria->nombre; ?>
                                                </option>
                                            <?php } endif; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Nombre</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Imagen</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="file" class="form-control-file" id="upload" name="imgprod"  accept="image/x-png,image/jpg,image/jpeg">
                                        </div>
                                      </div>
                                      <div class="form-group divNumero">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Cantidad</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control numero" name="cantidad" id="cantidad" placeholder="Cantidad" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Unidad</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control input-sm chosen-select" id="id_unidad" name="id_unidad" required>
                                            <option value="">---Seleccionar---</option>
                                            <?php if($unidades): foreach ($unidades as $unidad) { ?>
                                                <option value="<?php echo $unidad->id_unidad; ?>">
                                                  <?php echo $unidad->nombre; ?> - <?php echo $unidad->abreviatura; ?>
                                                </option>
                                            <?php } endif; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Moneda</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control input-sm chosen-select" id="id_moneda" name="id_moneda" required>
                                            <option value="">---Seleccionar---</option>
                                            <?php if($monedas): foreach ($monedas as $moneda) { ?>
                                                <option value="<?php echo $moneda->id_moneda; ?>">
                                                  <?php echo $moneda->nombre; ?> (<?php echo $moneda->simbolo; ?>)
                                                </option>
                                            <?php } endif; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group divNumero">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Precio Unitario</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control numero" name="precio_unitario" id="precio_unitario" placeholder="Precio Unitario" required>
                                        </div>
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

                    <div class="modal inmodal" id="mdlEditarProducto" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated bounceInRight">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Editar Producto</h4>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open_multipart(base_url('producto/update'), array('novalidate'=>'','class' => ' form-horizontal form-label-left', 'id'=>'formProducto', 'style' => 'overflow:hidden'));?>
                                      <input type="hidden" id="id_producto" name="id_producto" value="">
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Categoría</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control input-sm chosen-select" id="edit_id_categoria" name="edit_id_categoria" required>
                                            <option value="">---Seleccionar---</option>
                                            <?php if($categorias): foreach ($categorias as $categoria) { ?>
                                                <option value="<?php echo $categoria->id_categoria; ?>">
                                                  <?php echo $categoria->nombre; ?>
                                                </option>
                                            <?php } endif; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Nombre</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="edit_nombre" id="edit_nombre" placeholder="Nombre" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" name="edit_descripcion" id="edit_descripcion" placeholder="Descripción">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Imagen</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="file" class="form-control-file" id="upload" name="editimgprod"  accept="image/x-png,image/jpg,image/jpeg">
                                        </div>
                                      </div>
                                      <div class="form-group divNumero">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Cantidad</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control numero" name="edit_cantidad" id="edit_cantidad" placeholder="Cantidad" required>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Unidad</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control input-sm chosen-select" id="edit_id_unidad" name="edit_id_unidad" required>
                                            <option value="">---Seleccionar---</option>
                                            <?php if($unidades): foreach ($unidades as $unidad) { ?>
                                                <option value="<?php echo $unidad->id_unidad; ?>">
                                                  <?php echo $unidad->nombre; ?> - <?php echo $unidad->abreviatura; ?>
                                                </option>
                                            <?php } endif; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Moneda</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control input-sm chosen-select" id="edit_id_moneda" name="edit_id_moneda" required>
                                            <option value="">---Seleccionar---</option>
                                            <?php if($monedas): foreach ($monedas as $moneda) { ?>
                                                <option value="<?php echo $moneda->id_moneda; ?>">
                                                  <?php echo $moneda->nombre; ?> (<?php echo $moneda->simbolo; ?>)
                                                </option>
                                            <?php } endif; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group divNumero">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">(*)Precio Unitario</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control numero" name="edit_precio_unitario" id="edit_precio_unitario" placeholder="Precio Unitario" required>
                                        </div>
                                      </div>
                                       <div class="row">
                                        <br>
                                        <br>
                                          <div class="col-md-12 col-sm-12 col-xs-12">
                                            <center>
                                              <button class="btn btn-sm btn-success pull-center m-t-n-xs" type="submit"><strong>ACTUALIZAR</strong></button>
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
                          <th>Foto</th>
                          <th>Categoría</th>
                          <th>Nombre</th>
                          <th>Cantidad</th>
                          <th>Unidad</th>
                          <th>Moneda</th>
                          <th>Precio Unit.</th>
                          <th>Estado</th>
                          <th>Registro</th>
                          <th>Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                           if (is_array($productos)):
                                foreach ($productos AS $producto){
                        ?>
                        <tr>
                          <td><?php echo $producto->id_producto; ?></td>
                          <td>
                            <?php 
                                if($producto->ruta_imagen){
                                    $imagen_producto=base_url('imagenes/producto/'.$producto->ruta_imagen);
                                  }else{
                                    $imagen_producto=base_url('imagenes/producto/producto_default.png');
                                  }
                            ?>
                            <img src="<?php echo $imagen_producto ?>" style="width: 90px !important; height: 80px !important">
                          </td>
                          <td><?php echo $producto->nombre_categoria; ?></td>
                          <td><?php echo $producto->nombre; ?></td>
                          <td><?php echo $producto->cantidad; ?></td>
                          <td><?php echo $producto->nombre_unidad; ?></td>
                          <td><?php echo $producto->simbolo_moneda; ?></td>
                          <td><?php echo $producto->precio_unitario; ?></td>
                          <td>
                            <?php if($producto->flestado==0){
                                    echo 'Activo';
                                  }else{
                                    echo 'Inactivo';
                                  }
                            ?>
                          </td>
                          <td><?php echo $producto->feregistro; ?></td>
                          <td>
                              <button type="button" data-toggle="modal" data-target="#mdlEditarProducto" data-idproducto="<?php echo $producto->id_producto; ?>" class="btn edit btn-sm btn-warning m-b-none"><i class="fa fa-edit" data-toggle="tooltip" data-placement="top" title="Editar Producto"></i></button>
                              <button onclick="eliminarProducto('<?php echo $producto->id_producto; ?>')" class="btn btn-sm btn-danger m-b-none" data-toggle="tooltip" data-placement="top" title="Eliminar Producto"><i class="fa fa-ban"></i></button>
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
