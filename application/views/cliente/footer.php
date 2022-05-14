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
          $('.chosen-select').chosen({width: "100%"});
          $('.divNumero').on('keydown', '.numero', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

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
              $('#sexo').prop('disabled', false).trigger('chosen:updated');;
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
              $('#sexo').prop('disabled', false).trigger('chosen:updated');;
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

          $("#edit_tipo_doc").change(function () {
            var val_tipo_doc = this.value;
            //Cuando es Persona natural
            if(val_tipo_doc==""){
              $('#edit_nombres').prop('disabled', false);
              $('#edit_apellido_paterno').prop('disabled', false);
              $('#edit_apellido_materno').prop('disabled', false);
              $('#edit_sexo').prop('disabled', false).trigger('chosen:updated');;
              $('#edit_razon_social').prop('disabled', false);
              $('#edit_telefono1').prop('disabled', false);
              $('#edit_telefono2').prop('disabled', false);
              $('#edit_direccion').prop('disabled', false);
              $('#edit_referencia').prop('disabled', false);
              $('#edit_correo').prop('disabled', false);
            }//Cuando es Persona natural - DNI
            if(val_tipo_doc=="1"){
              $('#edit_nombres').prop('disabled', false);
              $('#edit_apellido_paterno').prop('disabled', false);
              $('#edit_apellido_materno').prop('disabled', false);
              $('#edit_sexo').prop('disabled', false).trigger('chosen:updated');;
              $('#edit_razon_social').prop('disabled', true);
              $('#edit_razon_social').val('');
              $('#edit_telefono1').prop('disabled', false);
              $('#edit_telefono2').prop('disabled', false);
              $('#edit_direccion').prop('disabled', false);
              $('#edit_referencia').prop('disabled', false);
              $('#edit_correo').prop('disabled', false);
            }
            //Cuando es Persona jurídica - RUC
            if(val_tipo_doc=="2"){
              $('#edit_nombres').prop('disabled', true);
              $('#edit_apellido_paterno').prop('disabled', true);
              $('#edit_apellido_materno').prop('disabled', true);
              $('#edit_sexo').prop('disabled', true).trigger('chosen:updated');;
              $('#edit_nombres').val('');
              $('#edit_apellido_paterno').val('');
              $('#edit_apellido_materno').val('');
              $('#edit_sexo').val('').trigger('chosen:updated');
              $('#edit_razon_social').prop('disabled', false);
              $('#edit_telefono1').prop('disabled', false);
              $('#edit_telefono2').prop('disabled', false);
              $('#edit_direccion').prop('disabled', false);
              $('#edit_referencia').prop('disabled', false);
              $('#edit_correo').prop('disabled', false);
            }
          });

        });

        $('#datatable-responsive').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });
        
        $('#mdlEditarCliente').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id_cliente = button.data('idcliente');
          var modal = $(this);
          $('.loading').show();
          $('#id_cliente').val(id_cliente);
          console.log(id_cliente);
          params = {csrfsn: csrfsn, id_cliente: id_cliente }
          $.post(base_url+'ajax/getcliente/', params, function(data){
              if(data.status > 0){
                  console.log(data);
                  $('#edit_tipo_doc').val(data.clientes.tipo_doc).trigger('chosen:updated');
                  $('#edit_nro_doc').val(data.clientes.nro_doc);
                  $('#edit_nombres').val(data.clientes.nombres);
                  $('#edit_apellido_paterno').val(data.clientes.apellido_paterno);
                  $('#edit_apellido_materno').val(data.clientes.apellido_materno);
                  $('#edit_sexo').val(data.clientes.sexo).trigger('chosen:updated');
                  $('#edit_telefono1').val(data.clientes.telefono1);
                  $('#edit_telefono2').val(data.clientes.telefono2);
                  $('#edit_direccion').val(data.clientes.direccion);
                  $('#edit_referencia').val(data.clientes.referencia);
                  $('#edit_correo').val(data.clientes.correo);
                  $('#edit_razon_social').val(data.clientes.razon_social);
                  
                  $('.loading').hide();
                  validarFormularioPorDocumento($("#edit_tipo_doc").val());

              }else{
                  alert('No hay datos disponibles para el mensaje.');
                  $('.loading').hide();
              }
          });
        });


        $('#mdlEditarCliente').on('hidden.bs.modal', function (e) {
          var modal = $(this);
          $('#tipo_doc').val('').trigger('chosen:updated');
          $('#nro_doc').val('');
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
        });

        function eliminarCliente(id_cliente){
          swal(
              {
                  title: "¿Está seguro que desea ELIMINAR el CLIENTE?",
                  text: "Eliminando Cliente Seleccionado",
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
                      $.get(base_url + "cliente/eliminar/"+id_cliente, function(data){
                          if(data.status==1){
                              //swal("Correcto", data.msg, "success");
                              location.reload();
                          }else{
                              swal("Error", data.msg, "error");
                          }
                      })
                  } else {
                      swal("Cancelado", "Se canceló la operación", "error");
                  }
              }
          );
      }

      function validarFormularioPorDocumento(val_tipo_doc){
        console.log(val_tipo_doc);
        //Cuando es Persona natural
        if(val_tipo_doc==""){
              $('#edit_nombres').prop('disabled', false);
              $('#edit_apellido_paterno').prop('disabled', false);
              $('#edit_apellido_materno').prop('disabled', false);
              $('#edit_sexo').prop('disabled', false).trigger('chosen:updated');;
              $('#edit_razon_social').prop('disabled', false);
              $('#edit_telefono1').prop('disabled', false);
              $('#edit_telefono2').prop('disabled', false);
              $('#edit_direccion').prop('disabled', false);
              $('#edit_referencia').prop('disabled', false);
              $('#edit_correo').prop('disabled', false);
            }//Cuando es Persona natural - DNI
            if(val_tipo_doc=="1"){
              $('#edit_nombres').prop('disabled', false);
              $('#edit_apellido_paterno').prop('disabled', false);
              $('#edit_apellido_materno').prop('disabled', false);
              $('#edit_sexo').prop('disabled', false).trigger('chosen:updated');;
              $('#edit_razon_social').prop('disabled', true);
              $('#edit_telefono1').prop('disabled', false);
              $('#edit_telefono2').prop('disabled', false);
              $('#edit_direccion').prop('disabled', false);
              $('#edit_referencia').prop('disabled', false);
              $('#edit_correo').prop('disabled', false);
            }
            //Cuando es Persona jurídica - RUC
            if(val_tipo_doc=="2"){
              console.log('holaaa');
              $('#edit_nombres').prop('disabled', true);
              $('#edit_apellido_paterno').prop('disabled', true);
              $('#edit_apellido_materno').prop('disabled', true);
              $('#edit_sexo').prop('disabled', true).trigger('chosen:updated');
              $('#edit_razon_social').prop('disabled', false);
              $('#edit_telefono1').prop('disabled', false);
              $('#edit_telefono2').prop('disabled', false);
              $('#edit_direccion').prop('disabled', false);
              $('#edit_referencia').prop('disabled', false);
              $('#edit_correo').prop('disabled', false);
            }
      }
    </script>
  </body>
</html>