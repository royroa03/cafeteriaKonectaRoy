  <!-- jQuery -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/build/js/custom.min.js"></script>
    <!-- Alert!-->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/sweetalert/js/sweetalert.min.js"></script>
    <!--Chosen  -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/chosen/chosen.jquery.js"></script>
    <!--Touchspin-->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/touchspin/jquery.bootstrap-touchspin.min.js"></script> 
    <!--Validate-->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/validate/jquery.validate.min.js"></script>

    <script>
        var base_url = '<?php echo base_url(); ?>';
        var <?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
          //document.addEventListener('contextmenu', event => event.preventDefault());
        var timeout;
        document.onmousemove = function(){
            clearTimeout(timeout);
            timeout = setTimeout(function(){window.location.href=base_url+'logout';}, 1200000);
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#btnGrabarProveedor').on("click", function() {
               agregarProveedor();
            });

            $('.chosen-select').chosen({width: "100%"});

            $('#id_proveedor').chosen().on('chosen:showing_dropdown', function () {
                $('#id_proveedor').html('');
                params = {csrfsn: csrfsn}
                $.post(base_url+'ajax/getallproveedor', params, function(data){
                    if(data.status==1){
                        $('#id_proveedor').html('<option value="">---Seleccionar---</option>');
                        for(var i=0; i<data.proveedores.length;i++){
                            var texto_combo=data.proveedores[i].nro_doc +' || '+ data.proveedores[i].razon_social;
                            $('#id_proveedor').append('<option value="'+data.proveedores[i].id_proveedor+'">'+texto_combo+'</option>');
                        }
                        $("#id_proveedor").trigger("chosen:updated");
                    }
                    
                });
            });

            $("#tipo_doc").change(function () {
            var val_tipo_doc = this.value;
              $('#nro_doc').val('').trigger('chosen:updated');
              $('#nombres').val('');
              $('#apellido_paterno').val('');
              $('#apellido_materno').val('');
              $('#sexo').val('').trigger('chosen:updated');
              $('#razon_social').val('');
              $('#telefono1').val('');
              $('#telefono2').val('');
              $('#direccion').val('');
              $('#referencia').val('');
              $('#correo').val('');
            //Cuando es Persona natural
            if(val_tipo_doc==""){
              $('#nombres').prop('disabled', false);
              $('#apellido_paterno').prop('disabled', false);
              $('#apellido_materno').prop('disabled', false);
              $('#sexo').prop('disabled', false).trigger('chosen:updated');
              $('#razon_social').prop('disabled', false);
              $('#telefono1').prop('disabled', false);
              $('#telefono2').prop('disabled', false);
              $('#direccion').prop('disabled', false);
              $('#referencia').prop('disabled', false);
              $('#correo').prop('disabled', false);
            }//Cuando es Persona natural - DNI
            if(val_tipo_doc=="1"){
              $('#nombres').prop('disabled', false);
              $('#apellido_paterno').prop('disabled', false);
              $('#apellido_materno').prop('disabled', false);
              $('#sexo').prop('disabled', false).trigger('chosen:updated');
              $('#razon_social').prop('disabled', true);
              $('#telefono1').prop('disabled', false);
              $('#telefono2').prop('disabled', false);
              $('#direccion').prop('disabled', false);
              $('#referencia').prop('disabled', false);
              $('#correo').prop('disabled', false);
            }
            //Cuando es Persona jurídica - RUC
            if(val_tipo_doc=="2"){
              $('#nombres').prop('disabled', true);
              $('#apellido_paterno').prop('disabled', true);
              $('#apellido_materno').prop('disabled', true);
              $('#sexo').prop('disabled', true).trigger('chosen:updated');
              $('#razon_social').prop('disabled', false);
              $('#telefono1').prop('disabled', false);
              $('#telefono2').prop('disabled', false);
              $('#direccion').prop('disabled', false);
              $('#referencia').prop('disabled', false);
              $('#correo').prop('disabled', false);
            }
          });

            $('#formCompra').validate({
               rules: {
                    id_proveedor: {required: true},
                    id_mediopago: {required: true},
                    id_comprobante: {required: true},
                    id_moneda: {required: true},
                },
                messages: {
                   
                },
                submitHandler: function(form) {
                    id_mediopago=$('#id_mediopago').val();
                    id_moneda=$('#id_moneda').val();
                    conversion=parseFloat($('#txt_conversionmoneda').val());
                    efectivo=parseFloat($('#txt_efectivo').val());
                    total=parseFloat($('#txt_total').val());
                    //Hay producto 
                    if(total>0){
                        //1:Efectivo 
                        if(id_mediopago=='1' && efectivo>=total){
                            console.log("total>0 && id_mediopago=='1' && efectivo>=total");
                            $('.loading').show();
                            form.submit();
                        }
                        //1:Efectivo 
                        if(id_mediopago=='1' && (efectivo*conversion)>=total){
                            console.log("id_mediopago=='1' && (efectivo*conversion)>=total");
                            $('.loading').show();
                            form.submit();
                        }
                        //2:Crédito 
                        if(id_mediopago=='2' && id_moneda!=''){
                            console.log("id_mediopago=='2' && id_moneda!=''");
                            $('.loading').show();
                            form.submit();
                        }
                    }
                    
                    
                }
            });

            loadCart();

            $(".cantidad").TouchSpin({
                buttondown_class: 'btn btn-default',
                buttonup_class: 'btn btn-default',
                decimals: 2,
                forcestepdivisibility: 'none',
                step: 1.0
            });

            $('.chosen-select').chosen({width: "100%"});
            $('.divNumero').on('keydown', '.numero', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

            $('#txt_buscar_producto').keyup(function () {
                var rex = new RegExp($(this).val(), 'i');
                var id_categoria=$('#id_categoria').val();
                console.log(id_categoria);
                $('#tab_prodcat_'+id_categoria+' .nombproducto').hide();
                $('#tab_prodcat_'+id_categoria+' .nombproducto').filter(function () {
                    return rex.test($(this).text());
                }).show();
            });

            $("#id_mediopago").change(function () {
                var val_id_mediopago = this.value;
                var id_moneda=$('#id_moneda').val();
                if(val_id_mediopago==''){ 
                    $('#txt_efectivo').prop('readonly', true);
                    $('#txt_conversionmoneda').prop('readonly', true);
                    $('#txt_efectivo').val('0.00');
                    $('#txt_conversionmoneda').val('0.00');
                    $('#txt_vuelto').val('0.00');
                }else if(val_id_mediopago==1 ){ //1: Efectivo
                    if(id_moneda=='1'){ //1: Soles
                        $('#txt_efectivo').prop('readonly', false);
                        $('#txt_conversionmoneda').prop('readonly', true);
                        $('#txt_efectivo').val('0.00');
                        $('#txt_conversionmoneda').val('0.00');
                        $('#txt_vuelto').val('0.00');
                        $('#id_moneda').val('').trigger('chosen:updated');
                    }else{
                        $('#txt_efectivo').prop('readonly', false);
                        $('#txt_conversionmoneda').prop('readonly', false);
                        $('#txt_efectivo').val('0.00');
                        $('#txt_conversionmoneda').val('0.00');
                        $('#txt_vuelto').val('0.00');
                        $('#id_moneda').val('').trigger('chosen:updated');
                    }
                }else{ //Crédito
                    $('#txt_efectivo').prop('readonly', true);
                    $('#txt_conversionmoneda').prop('readonly', true);
                    $('#txt_efectivo').val('0.00');
                    $('#txt_conversionmoneda').val('0.00');
                    $('#txt_vuelto').val('0.00');
                    $('#id_moneda').val('1').trigger('chosen:updated');
                }
            });

            $("#id_moneda").change(function () {
                var val_id_moneda = this.value;

                if($('#id_mediopago').val()=='1' && val_id_moneda=='1'){ //1: Efectivo -- 1: Soles
                    $('#txt_efectivo').prop('readonly', false);
                    $('#txt_conversionmoneda').prop('readonly', true);
                    $('#txt_efectivo').val('0.00');
                    $('#txt_conversionmoneda').val('0.00');
                    $('#txt_vuelto').val('0.00');
                }
                if($('#id_mediopago').val()=='1' && val_id_moneda=='2'){ //2: Dolar americano
                    $('#txt_efectivo').prop('readonly', false);
                    $('#txt_conversionmoneda').prop('readonly', false);
                    $('#txt_efectivo').val('0.00');
                    $('#txt_conversionmoneda').val('0.00');
                    $('#txt_vuelto').val('0.00');
                }
                if(val_id_moneda==''){ 
                    $('#txt_efectivo').prop('readonly', true);
                    $('#txt_conversionmoneda').prop('readonly', true);
                    $('#txt_efectivo').val('0.00');
                    $('#txt_conversionmoneda').val('0.00');
                    $('#txt_vuelto').val('0.00');
                }
                
            });


            

        });

        $('#datatable-responsive').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });

        $('#txt_descuento').change(function(e) {
            $('#txt_conversionmoneda').val('0.00');
            $('#txt_efectivo').val('0.00');
            $('#txt_vuelto').val('0.00');
            descuento=parseFloat($(this).val());
            subtotal=parseFloat($('#txt_subtotal').val());
            if(descuento>0 && descuento<=subtotal){
                $('#txt_total').val(parseFloat(subtotal-descuento).toFixed(2));
                /*params = {csrfsn: csrfsn,descuento:descuento}
                $.post(base_url+'ajax/totalpagoventa', params, function(data){
                    console.log(data);
                    if(data.status==1){  
                        $('#txt_total').val(data.total_monto);
                    }
                });*/
            }else{
                loadCart();
                $(this).val('0.00');
            }
        });

        $('#txt_conversionmoneda').change(function(e) {
            id_moneda=parseFloat($('#id_moneda').val());
            conversionmoneda=parseFloat($(this).val());
            efectivo=parseFloat($('#txt_efectivo').val());
            calcularVuelto(id_moneda,conversionmoneda,efectivo);
        });

        $('#txt_efectivo').change(function(e) {
            id_moneda=parseFloat($('#id_moneda').val());
            conversionmoneda=parseFloat($('#txt_conversionmoneda').val());
            efectivo=parseFloat($(this).val());
            calcularVuelto(id_moneda,conversionmoneda,efectivo);
        });

        function listarProductoCategoria(id_categoria){  
            console.log(id_categoria);
            //Agregar valor de id de categoría
            $('#id_categoria').val(id_categoria);

            var texto='';
            var imagen_producto='';
            var base_url = '<?php echo base_url(); ?>';

            
            if(id_categoria>0){

                params = {csrfsn: csrfsn, id_categoria: id_categoria }
                $.post(base_url+'ajax/getproductoporcategoria/', params, function(data){
                    if(data.status > 0){
                        console.log(data.productos);
                        texto += '<br><br><br>';
                        for(var i=0;i<data.productos.length;i++){
                            var nomb_producto = data.productos[i].nombre.substring(0,15);

                            if(data.productos[i].ruta_imagen){
                                imagen_producto=base_url+'/imagenes/producto/'+data.productos[i].ruta_imagen;
                            }else{
                                imagen_producto=base_url+'imagenes/producto/producto_default.png';
                            }

                            texto += '<div class="col-md-3 col-sm-3 col-xs-6 nombproducto">';
                            texto += '<br>';

                            texto += '<div class="offer">';

                            texto += '<div class="offer-content divNumero">';

                            texto += '<center><img src="'+imagen_producto+'" alt="Imagen del Producto" style="width: 90px !important; height: 70px !important " title="'+data.productos[i].nombre+'"></center>';
                            texto += '<center><span class="label label-warning"><strong>'+data.productos[i].nombre_categoria+'</strong></span></center>';
                            texto += '<center><h6><strong>'+nomb_producto+'</strong></h6></center>';
                            texto += '<input class="input text-center form-control numero cantidad" type="text" name="cantidad_producto_'+data.productos[i].id_producto+'_cat_'+id_categoria+'" style="display: block;" value="1">';
                            //texto += '<center><h6><strong>'+data.productos[i].simbolo_moneda+" "+data.productos[i].precio_unitario+' / '+data.productos[i].abreviatura_unidad+'</strong></h6></center>';
                            texto += '<center><h6><strong><input class="text-center form-control numero" type="text" name="precio_producto_'+data.productos[i].id_producto+'_cat_'+id_categoria+'" placeholder="('+data.productos[i].simbolo_moneda+') Precio /'+data.productos[i].abreviatura_unidad+'"></strong></h6></center>';
                            texto += '<center><h6><strong>Stock: '+data.productos[i].cantactual_stock+'</strong></h6></center>';
                            texto += '<center><a class="btn btn-primary btn-sm btn-block" onclick="agregarProductoCarrito('+data.productos[i].id_producto+','+id_categoria+')">Agregar</a></center>';

                            texto += '</div>';

                            texto += '</div>';

                            texto += '</div>';

                        }

                        $('#tab_prodcat_'+id_categoria).html(texto);
                        $(".cantidad").TouchSpin({
                            buttondown_class: 'btn btn-default',
                            buttonup_class: 'btn btn-default',
                            decimals: 2,
                            forcestepdivisibility: 'none',
                            step: 1.0
                        });

                    }

                })

                

            }else{

            }
        };

        //Carga los elementos del carrito
        function agregarProductoCarrito(id,id_categoria)
        {
            cnt = $('input[name=cantidad_producto_'+id+'_cat_'+id_categoria+']').val();
            price = $('input[name=precio_producto_'+id+'_cat_'+id_categoria+']').val();
            params = {csrfsn: csrfsn, id: id,cnt: cnt, price:price}
            console.log(params);
            if(price>0 && cnt>0){
                $.post(base_url+'ajax/addcart', params, function(data){
                    console.log(data.status);
                    if(data.status == 3){
                        swal({
                            title:"",
                            text: data.msg,
                            type: "error",
                            timer: 2000,
                            showConfirmButton:false
                        });
                    }
                    loadCart();
                });
            }
            
        }

        //Carga los elementos del carrito
        function loadCart()
        {
            $('#txt_descuento').val('0.00');
            $('#txt_efectivo').val('0.00');
            $('#txt_vuelto').val('0.00');
            params = {csrfsn: csrfsn}
            $.post(base_url+'ajax/getcart', params, function(data){
                console.log(data);
                if(data.cart.length>0){
                    $('.items_producto').html(data.cart);
                    $('#txt_subtotal').val(data.subtotal_venta);
                    $('#txt_total').val(data.subtotal_venta);
                }else{
                    $('.items_producto').html('<center><p>¡No hay productos en el carrito!</p></center>');
                    $('#txt_subtotal').val('0.00');
                    $('#txt_total').val('0.00');
                }
                
            });
        }

        //Eliminamos un elemento del carrito
        function deleteItem(token)
        {
            params = {csrfsn: csrfsn, token: token}
            $.post(base_url+'ajax/delitemcart', params, function(data){
                loadCart();
            })
        }

        //Vaciar los productos del carrito
        function vaciarProductoCarrito()
        {
            params = {csrfsn: csrfsn}
            $.post(base_url+'ajax/cleancart', params, function(data){
                location.reload();
            })
        }

        function calcularVuelto(id_moneda,conversionmoneda,efectivo){
            vuelto=0.0;
            total=$('#txt_total').val();
            
            if(id_moneda=='1'){ //1: Soles
                if(efectivo>=total){
                    vuelto=parseFloat(efectivo-total);
                    $('#txt_vuelto').val(vuelto.toFixed(2));
                }else{
                    $('#txt_efectivo').val('0.00');
                    $('#txt_vuelto').val('0.00');
                }
            }
            if(id_moneda=='2'){ //2: Dolar Americano
                if(conversionmoneda>0.0 && efectivo>0.0){
                    total_convmoneda=parseFloat(conversionmoneda*efectivo);
                    if(total_convmoneda>=total){
                        vuelto=parseFloat(total_convmoneda-total);
                        $('#txt_vuelto').val(vuelto.toFixed(2));
                    }else{
                        $('#txt_conversionmoneda').val('0.00');
                        $('#txt_efectivo').val('0.00');
                        $('#txt_vuelto').val('0.00');
                    }
                }
            }
        }

        function anularCompra(id_compra){
            swal({
                    title: "¿Está seguro que desea ANULAR la COMPRA?",
                    text: "Al anular la compra los productos serán agregados al inventario.",
                    type: "warning",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonColor: "#AEDEF4",
                    confirmButtonText: "SI",
                    cancelButtonText: "NO",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function (isConfirm) {
                    if (isConfirm) {
                        var button = $(event.relatedTarget);
                        $.get(base_url + "compra/anular/"+id_compra, function(data){
                          if(data.status==1){
                              //swal("Correcto", data.msg, "success");
                              location.reload();
                          }else{
                              swal("Error", data.msg, "error");
                          }
                        })
                    } else {
                        swal("Cancelado", "Se canceló la anulación de la compra.", "error");
                    }

                }
            );
        };

        //Agregar un proveedor
        function agregarProveedor()
        {
            tipo_doc=$('#tipo_doc').val();
            nro_doc=$('#nro_doc').val();
            nombres=$('#nombres').val();
            razon_social=$('#razon_social').val();
            telefono1=$('#telefono1').val();
            telefono2=$('#telefono2').val();
            direccion=$('#direccion').val();
            referencia=$('#referencia').val();

            params = {
                    csrfsn: csrfsn,
                    tipo_doc: tipo_doc,
                    nro_doc: nro_doc,
                    razon_social: razon_social,
                    telefono1: telefono1,
                    telefono2: telefono2,
                    direccion: direccion,
                    referencia: referencia
                    }
            $.post(base_url+'proveedor/savemodal/', params, function(data){
                if(data.status==1){
                    $('#mdlNuevoProveedor').modal('hide');
                }else{
                    swal("Error", data.msg, "error");
                }
            })
        }
         
        $('#mdlVerCompra').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id_compra = button.data('idcompra');
          var modal = $(this);
          $('.loading').show();
          $('#id_compra').val(id_compra);
          console.log(id_compra);
          params = {csrfsn: csrfsn, id_compra: id_compra }
          $.post(base_url+'ajax/getcompra/', params, function(data){
              if(data.status > 0){
                  console.log(data);
                  $('#txt_ver_proveedor').val(data.compras.proveedor);
                  $('#txt_ver_mediopago').val(data.compras.mediopago);
                  $('#txt_ver_comprobante').val(data.compras.comprobante);
                  $('#txt_ver_subtotal').val(data.compras.subtotal);
                  $('#txt_ver_descuento').val(data.compras.descuento);
                  $('#txt_ver_total').val(data.compras.total);
                  $('#txt_ver_moneda').val(data.compras.moneda);
                  $('#txt_ver_conversion').val(data.compras.conversion);
                  $('#txt_ver_efectivo').val(data.compras.efectivo);
                  $('#txt_ver_vuelto').val(data.compras.vuelto);
                  $('#txt_ver_cajero').val(data.compras.cajero);
                  
                  $('.loading').hide();
              }else{
                  alert('No hay datos disponibles para el mensaje.');
                  $('.loading').hide();
              }
          });
          $.post(base_url+'ajax/getcompradetalle/', params, function(data){
              if(data.status > 0){
                console.log(data);
                $('.items_ver_producto').html('');
                for(var i=0; i<data.comprasdetalles.length;i++){
                    console.log(data.comprasdetalles[i].cantidad);
                    $('.items_ver_producto').append('<h5 class="text-left m-b-none">'+data.comprasdetalles[i].producto+' | '+data.comprasdetalles[i].cantidad+'('+data.comprasdetalles[i].abreviatura+') x '+data.comprasdetalles[i].simbolo+' '+data.comprasdetalles[i].precio+'<strong class="pull-right">'+data.comprasdetalles[i].simbolo+' '+data.comprasdetalles[i].total+'</strong></h5>');
                }
                $('.loading').hide();
              }else{
                  alert('No hay datos disponibles para el mensaje.');
                  $('.loading').hide();
              }
          });
        });

        $('#mdlVerCompra').on('hidden.bs.modal', function (e) {
            var modal = $(this);
            $('#txt_ver_proveedor').val('');
            $('#txt_ver_mediopago').val('');
            $('#txt_ver_comprobante').val('');
            $('#txt_ver_subtotal').val('');
            $('#txt_ver_descuento').val('');
            $('#txt_ver_total').val('');
            $('#txt_ver_moneda').val('');
            $('#txt_ver_conversion').val('');
            $('#txt_ver_efectivo').val('');
            $('#txt_ver_vuelto').val('');
            $('#txt_ver_cajero').val('');
            $('.items_ver_producto').html('');
        });

        
    </script>
  </body>
</html>