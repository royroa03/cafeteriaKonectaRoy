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

        $('#formCreditoCliente').validate({
            rules: {
                totalpago_credito: {required: true},
            },
            messages: {
                
            },
            submitHandler: function(form) {
              if(parseFloat($('#totalpago_credito').val()) > parseFloat($('#deuda_venta').val())){
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
        

      $('#mdlPagoCreditoCliente').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id_creditocliente = button.data('idcreditocliente');
        var modal = $(this);
        $('#id_creditocliente').val(id_creditocliente);
        console.log(id_creditocliente);
        params = {csrfsn: csrfsn, id_creditocliente: id_creditocliente }
        $.post(base_url+'ajax/getcreditocliente/', params, function(data){
            if(data.status > 0){
                console.log(data);
                $('#id_cliente').val(data.creditosclientes.id_cliente);
                $('#nro_doc_cliente').val(data.creditosclientes.nro_doc_cliente);
                $('#cliente').val(data.creditosclientes.cliente);
                $('#fecha_venta').val(data.creditosclientes.feregistro);
                $('#total_venta').val(data.creditosclientes.total);
                $('#deuda_venta').val(data.creditosclientes.deuda);
                $('#lbl_apagado').html((data.creditosclientes.total-data.creditosclientes.deuda).toFixed(2));
                $('#lbl_totalcredito').html(data.creditosclientes.total);
            }else{
                alert('No hay datos disponibles para el mensaje.');
            }
        });
        mostrarCredClienteDetalle(id_creditocliente);
      });

      $('#mdlPagoCreditoCliente').on('hidden.bs.modal', function (e) {
          var modal = $(this);
          $('#id_creditocliente').val('');
          $('#id_cliente').val('');
          $('#nro_doc_cliente').val('');
          $('#cliente').val('');
          $('#fecha_venta').val('');
          $('#total_venta').val('');
          $('#deuda_venta').val('');
          $('#lbl_apagado').html('');
          $('#lbl_totalcredito').html('');
        });

      function mostrarCredClienteDetalle(id_creditocliente){
        params = {csrfsn: csrfsn, id_creditocliente: id_creditocliente }
        $.post(base_url+'ajax/getcreditoclientedetalle/', params, function(data){
            if(data.status > 0){
              var html="";
              console.log(data.creditosclientesdetalles);
              for(var i=0;i<data.creditosclientesdetalles.length;i++){
                console.log(data.creditosclientesdetalles[i].total_credtotal_creditodetalleitodetalle);
                html += "<p >Amortización "+(i+1)+" ("+data.creditosclientesdetalles[i].feregistro_creditoclientedetalle+"):";
                html += " <label style='color: red'>S/ -"+parseFloat(data.creditosclientesdetalles[i].total_creditoclientedetalle).toFixed(2)+"</label>";
                html += "</p>";
              }
            }else{
              $('#div_creditocliente_detalle').html('<p>Sin amortizar.</p>');
            }
        $('#div_creditocliente_detalle').html(html);
        });
      }


    </script>
  </body>
</html>