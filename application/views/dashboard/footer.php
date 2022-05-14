    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>template/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>template/gentelella-master/build/js/custom.min.js"></script>
	
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
    
  </body>
</html>