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
        $('.divNumero').on('keydown', '.numero', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});

        $('#formCreditoProveedor').validate({
            rules: {
                totalpago_credito: {required: true},
            },
            messages: {
                
            },
            submitHandler: function(form) {
              if(parseFloat($('#totalpago_credito').val()) > parseFloat($('#deuda_compra').val())){
                swal("Cuidado!", "El monto ingresado es mayor a la deuda.", "error")
              }else{
                $('.loading').show();
                form.submit();
              }
            }
        });

      });
      
      $('#datatable-responsive').DataTable({
          language: {
              "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
          },
        });
        

      $('#mdlPagoCreditoProveedor').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id_creditoproveedor = button.data('idcreditoproveedor');
        var modal = $(this);
        $('#id_creditoproveedor').val(id_creditoproveedor);
        console.log(id_creditoproveedor);
        params = {csrfsn: csrfsn, id_creditoproveedor: id_creditoproveedor }
        $.post(base_url+'ajax/getcreditoproveedor/', params, function(data){
            if(data.status > 0){
                console.log(data);
                $('#id_proveedor').val(data.creditosproveedores.id_proveedor);
                $('#nro_doc_proveedor').val(data.creditosproveedores.nro_doc_proveedor);
                $('#proveedor').val(data.creditosproveedores.proveedor);
                $('#fecha_compra').val(data.creditosproveedores.feregistro);
                $('#total_compra').val(data.creditosproveedores.total);
                $('#deuda_compra').val(data.creditosproveedores.deuda);
                $('#lbl_apagado').html((data.creditosproveedores.total-data.creditosproveedores.deuda).toFixed(2));
                $('#lbl_totalcredito').html(data.creditosproveedores.total);
            }else{
                alert('No hay datos disponibles para el mensaje.');
            }
        });
        mostrarCredProveedorDetalle(id_creditoproveedor);
      });

      $('#mdlPagoCreditoProveedor').on('hidden.bs.modal', function (e) {
          var modal = $(this);
          $('#id_creditoproveedor').val('');
          $('#id_proveedor').val('');
          $('#nro_doc_proveedor').val('');
          $('#proveedor').val('');
          $('#fecha_compra').val('');
          $('#total_compra').val('');
          $('#deuda_compra').val('');
          $('#lbl_apagado').html('');
          $('#lbl_totalcredito').html('');
        });

      function mostrarCredProveedorDetalle(id_creditoproveedor){
        params = {csrfsn: csrfsn, id_creditoproveedor: id_creditoproveedor }
        $.post(base_url+'ajax/getcreditoproveedordetalle/', params, function(data){
            if(data.status > 0){
              var html="";
              console.log(data.creditosproveedoresdetalles);
              for(var i=0;i<data.creditosproveedoresdetalles.length;i++){
                html += "<p >Amortización "+(i+1)+" ("+data.creditosproveedoresdetalles[i].feregistro_creditoproveedordetalle+"):";
                html += " <label style='color: red'>S/ -"+parseFloat(data.creditosproveedoresdetalles[i].total_creditoproveedordetalle).toFixed(2)+"</label>";
                html += "</p>";
              }
            }else{
              $('#div_creditoproveedor_detalle').html('<p>Sin amortizar.</p>');
            }
        $('#div_creditoproveedor_detalle').html(html);
        });
      }


    </script>
  </body>
</html>