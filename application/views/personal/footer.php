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
        });

        $('#datatable-responsive').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });

        //Validamos el archivo que se carga
        $('#upload').on('change', function () { readFile(this); });

        $('#mdlEditarPersonal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id_personal = button.data('idpersonal');
          var modal = $(this);
          $('.loading').show();
          $('#id_personal').val(id_personal);
          console.log(id_personal);
          params = {csrfsn: csrfsn, id_personal: id_personal }
          $.post(base_url+'ajax/getpersonal/', params, function(data){
              if(data.status > 0){
                  console.log(data);
                  $('#edit_tipo_doc').val(data.personales.tipo_doc).trigger('chosen:updated');
                  $('#edit_nro_doc').val(data.personales.nro_doc);
                  $('#edit_id_empresa').val(data.personales.id_empresa).trigger('chosen:updated');
                  $('#edit_nombres').val(data.personales.nombres);
                  $('#edit_apellido_paterno').val(data.personales.apellido_paterno);
                  $('#edit_apellido_materno').val(data.personales.apellido_materno);
                  $('#edit_sexo').val(data.personales.sexo).trigger('chosen:updated');
                  $('#edit_telefono1').val(data.personales.telefono1);
                  $('#edit_telefono2').val(data.personales.telefono2);
                  $('#edit_direccion').val(data.personales.direccion);
                  $('#edit_referencia').val(data.personales.referencia);
                  
                  $('.loading').hide();
              }else{
                  alert('No hay datos disponibles para el mensaje.');
                  $('.loading').hide();
              }
          });
        });


        $('#mdlEditarPersonal').on('hidden.bs.modal', function (e) {
          var modal = $(this);
          $('#tipo_doc').val('').trigger('chosen:updated');
          $('#nro_doc').val('');
          $('#id_empresa').val('').trigger('chosen:updated');
          $('#nombres').val('');
          $('#apellido_paterno').val('');
          $('#apellido_materno').val('');
          $('#sexo').val('').trigger('chosen:updated');
          $('#telefono1').val('');
          $('#telefono2').val('');
          $('#direccion').val('');
          $('#referencia').val('');
        });

        function eliminarPersonal(id_personal){
          swal(
              {
                  title: "¿Está seguro que desea ELIMINAR el PERSONAL?",
                  text: "Eliminando Personal Seleccionado",
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
                      $.get(base_url + "personal/eliminar/"+id_personal, function(data){
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

      function readFile(input) {
          console.log('holaaa');
          console.log(input);
        if (input.files && input.files[0]) {
            var ext = input.files[0].name.substring(input.files[0].name.lastIndexOf(".")).toLowerCase();
            if(ext != ".jpg" && ext != ".png" && ext != ".gif" && ext != ".jpeg"){
                swal({
                    title:"",
                    text: "Solo se permite imágenes",
                    type: "error",
                    timer: 2000,
                    showConfirmButton:false
                });
                $('#upload').replaceWith($('#upload').val('').clone(true));
            }else{
                //Validamos que no sea mayor a 5MB
                if(input.files[0].size > 5242880){
                    swal({
                        title:"",
                        text: "La imagen debe ser menor a 5MB",
                        type: "error",
                        timer: 2000,
                        showConfirmButton:false
                    });
                    //$('#upload').fileinput('clear');
                    $('#upload').replaceWith($('#upload').val('').clone(true));
                }
            }
        }else{
            swal({
                title:"",
                text: "Por favor, escoger una imagen o su navegador no es compatible",
                type: "error",
                timer: 2000,
                showConfirmButton:false
            });
            $('#upload').replaceWith($('#upload').val('').clone(true));
        }
      }
    </script>
  </body>
</html>