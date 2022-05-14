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
    <!--Moment  -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/moment/min/moment.min.js"></script>
    <!--Daterangepicker  -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!--Databuttons  -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-buttons/js/dataTables.buttons.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/datatables.net-buttons/js/buttons.html5.js"></script>


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
      var fecha_inicio = '';
      var fecha_fin = ''; 
      $(document).ready(function() {
        buscarCompras();
      });

     
      
      $('[data-filter-type="date-range"]').daterangepicker({
          //showDropdowns: true,
          autoUpdateInput: false,
          applyClass: 'btn-sm btn-primary',
          cancelClass: 'btn-sm btn-default',
          monthSelect: 'form-control',
          locale: {
              format: 'YYYY-MM-DD',
              applyLabel: 'Aplicar',
              cancelLabel: 'Limpiar',
              fromLabel: 'Desde',
              toLabel: 'Hasta',
              customRangeLabel: 'Seleccionar rango',
              daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
              monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                  'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                  'Diciembre'],
              firstDay: 1
          }
      });

      $('input[name="fecha"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        fecha_inicio = picker.startDate.format('YYYY-MM-DD');
        fecha_fin = picker.endDate.format('YYYY-MM-DD');
      });

      $('input[name="fecha"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        fecha_inicio='';
        fecha_fin='';
      });

      $('#btn_buscar').click(function(){

        var id_comprobante = $('select[name=id_comprobante]').val();
        var id_mediopago = $('select[name=id_mediopago]').val();
        var flestado = $('select[name=flestado]').val();

        console.log(fecha_inicio);
        console.log(fecha_fin);
        console.log(id_comprobante);
        console.log(id_mediopago);
        console.log(flestado);


        buscarCompras(fecha_inicio,fecha_fin,id_comprobante,id_mediopago,flestado);

      });

      function buscarCompras(fecha_i='',fecha_f='',id_comprobante='',id_mediopago='',flestado=''){
        var texto='';
        params = {csrfsn: csrfsn, fecha_inicio: fecha_i,fecha_fin: fecha_f,id_comprobante:id_comprobante,id_mediopago:id_mediopago,flestado:flestado}
        console.log(params);
        $.post(base_url+'reporte/getFiltroCompras', params, function(data){
            console.log(data.status);

            //var jsonData = [{"userID":"1","userName":"name1"},{"userID":"2","userName":"name2"},{"userID":"3","userName":"name3"}];
            //console.log(jsonData);
            console.log(data.reportescompras);
            console.log(data.status);
            if(data.status == 1){
              $("#tabla_reporte_compra").dataTable().fnDestroy();
              $('#tabla_reporte_compra').DataTable({
                  "data": data.reportescompras,
                  "columns": [
                    { "data": "id_compra" },
                    { "data": "fecha" },
                    { "data": "comprobante" },
                    { "data": "mediopago" },
                    { "data": "subtotal" },
                    { "data": "descuento" },
                    { "data": "total" },
                    { "data": "nro_doc_proveedor" },
                    { "data": "proveedor" },
                    { "data": "flestado" },
                    { "data": "feregistro" }
                  ],
                  language: {
                      "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                  },
                  dom: 'Bfrtip',
                  buttons: [
                    {extend: 'pdf', title: 'Reporte-Compras'},
                    {extend: 'excel', title: 'Reporte-Compras'},
                    {extend: 'print',
                      customize: function (win){
                          $(win.document.body).addClass('white-bg');
                          $(win.document.body).css('font-size', '10px');
                          $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                      }
                    }
                  ]
              });
              
            }else{
              
              $("#tabla_reporte_compra").dataTable().fnDestroy();

              $("#tabla_reporte_compra > tbody").empty(); 
              
            }
           
        });
      }

      

    </script>
  </body>
</html>