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

        $('#datatable-responsive').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });

        $('#mdlEditarUnidad').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget);
          var id_unidad = button.data('idunidad');
          var modal = $(this);
          $('.loading').show();
          $('#id_unidad').val(id_unidad);
          console.log(id_unidad);
          params = {csrfsn: csrfsn, id_unidad: id_unidad }
          $.post(base_url+'ajax/getunidad/', params, function(data){
              if(data.status > 0){
                  console.log(data);
                  $('#edit_abreviatura').val(data.unidades.abreviatura);
                  $('#edit_nombre').val(data.unidades.nombre);
                  
                  $('.loading').hide();
              }else{
                  alert('No hay datos disponibles para el mensaje.');
                  $('.loading').hide();
              }
          });
        });


        $('#mdlEditarUnidad').on('hidden.bs.modal', function (e) {
          var modal = $(this);
          $('#abreviatura').val('');
          $('#nombre').val('');
        });

        function eliminarUnidad(id_unidad){
          swal(
              {
                  title: "¿Está seguro que desea ELIMINAR la UNIDAD?",
                  text: "Eliminando Unidad Seleccionada",
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
                      $.get(base_url + "unidad/eliminar/"+id_unidad, function(data){
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
    </script>
  </body>
</html>