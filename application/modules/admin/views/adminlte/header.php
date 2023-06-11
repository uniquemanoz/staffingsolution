
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	
    <title>Staffing Solution </title>

<!--    $this->session->userdata('username')-->


    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/gentela');  ?>/build/css/custom.min.css" rel="stylesheet">
    
<!--    datetime-->


    <!-- jQuery -->
    <script src="<?php echo base_url('assets/gentela');  ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/datetime')  ?>/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <script src="<?php echo base_url('assets/datetime')  ?>/js/bootstrap-datetimepicker.min.js"></script>
     
  </head>


  <body class="nav-md">
    <div class="container body">
      <div class="main_container login">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
<!--              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Staffing Solution</span></a>-->
                <img src="<?php echo base_url('uploads/logo').'/logo.png' ?>" width="220px" height="50px">
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">  
              <div class="profile_pic">
                  <img src="<?php if(!$this->session->userdata('profilelink')) echo  base_url('uploads').'/users/dummyclient.png'; else echo base_url('uploads').'/users/'.$this->session->userdata('id').'/'.$this->session->userdata('profilelink');   ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome, </span>
                <h2><?php echo $this->session->userdata('name')  ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
