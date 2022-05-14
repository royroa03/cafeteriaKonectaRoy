<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Tienda POS | <?php echo $titulo; ?></title>
    <meta property="og:title" content="Tienda POS" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://bitlogy-tiendapos.000webhostapp.com/" />
    <meta property="og:image" content="https://scontent.flim16-3.fna.fbcdn.net/v/t1.0-9/56905007_1082095261994520_4103860604450635776_n.png?_nc_cat=101&_nc_oc=AQn6ft_LIwoq1M868aPApXox6-Z53B_mqTf1zgh4v2TbisB_yTzFehJbQrUB-ObpPkQ&_nc_ht=scontent.flim16-3.fna&oh=f5a16d90afeac920dea8aaae9a179f39&oe=5E1CD2B1" />

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>template/gentelella-master/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>template/gentelella-master/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>template/gentelella-master/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url(); ?>template/gentelella-master/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>template/gentelella-master/build/css/custom.min.css" rel="stylesheet">
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
  </head>