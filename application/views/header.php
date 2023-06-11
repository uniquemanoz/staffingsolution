
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Staffing Solution </title>

   
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/gentela');  ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/gentela');  ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

     
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
      
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
     
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
      
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/animate.css/animate.min.css" rel="stylesheet">

     
    <link href="<?php echo base_url('assets/gentela');  ?>/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login" style="background:#003465">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo site_url('home/login_check') ?>" method="post">
                <h1 style="text-shadow:none;color: white">Login Form</h1>

              <div>
                <input type="text" class="form-control" placeholder="Username" name="form-username"  id="form-username"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="form-password"  id="form-password" />
              </div>
              <?php if(!empty($msg)){ ?>
                 
                <div>
                    <button type="button" class="btn btn-danger btn-xs"><?php echo $msg; ?></button>
                </div>
                
               <?php } ?>
              <div>
                <button type="submit" class="btn btn-default submit">Log in</button>

                <a data-toggle="modal" href=".losspassword"  class="reset_pass" style="text-shadow:none;color: white">Lost your password?</a>


              </div>

              <div class="clearfix"></div>

              <div class="separator">
<!--                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>-->

                <div class="clearfix"></div>
                <br />

                <div>
<!--                  <h1><i class="fa fa-paw"></i> Staffing Solution</h1>-->
                    <img src="<?php echo base_url('uploads/logo').'/logo.png' ?>">
                    <br><br><br><br><br><br>
                  <p style="text-shadow:none;color: white">©2016 All Rights Reserved. Specialised Staffing Solution Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Staffing Solution!</h1>
                  <p>©2016 All Rights Reserved. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
      
      
      <div class="modal fade losspassword" id="losspassword"  tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Enter Your Email</h4>
                        </div>
                        <div class="modal-body">
                          
                            <input id="email" placeholder="Email"  class="form-control" required="required" type="email">
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button"  class="btn btn-primary btn_getlost" onclick="return getLostPassword()">Send</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
      
  </body>
</html>

                 
<script>
    
    function getLostPassword(){
        var email= $("#email").val();
        $(".btn_getlost").hide();
        
        
        
        $.post('<?php echo site_url('user/lostpassword') ?>',
                {
                    email:email
                    
                },
                function(data) {
                    $("#losspassword").modal("hide");
                    alert(data);
                                
                });

    }
    
</script>