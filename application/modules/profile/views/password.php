

<div class="right_col" role="main" style="background:#003465">
    <div class="">

        <div class="clearfix"></div>
        
        <div class="row">
            <div class="col-lg-2"> </div>
            <div class="col-lg-5">
                <div class="animate form login_form" >
                    <section class="login_content">
                      <form>
                        <h1>Change Login Credentials</h1>
                        <div>
                          <input type="text" class="form-control" placeholder="Username" value="<?php echo $this->session->userdata('username');  ?>"id="username">
                          <input type="hidden" class="form-control"  value="<?php echo $this->session->userdata('id');  ?>" id="userid">
                            
                        </div>
                        <div>
                          <input type="password" class="form-control" placeholder="new passord" id="password">
                          
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Retype password" id="retypepassword">
                            <span  id="msg"></span>
                            
                        </div>
                         </form>
                        <div>

                            <button  class="btn btn-primary btn-block btn-flat"  onclick="return change()">Change Password</button>
                          
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                          

                          <div class="clearfix"></div>
                          <br>

                          <div>
<!--                            <h1><i class="fa fa-paw"></i> Staffing Solution</h1>-->
                              <img src="<?php echo base_url('uploads/logo').'/logo.png' ?>">
                           
                          </div>
                        </div>
                     
                        
                    </section>
                  </div>
                
            </div>
        </div>
            
    </div>
</div>



         


 <script src="<?php echo base_url('assets/gentela');  ?>/vendors/jquery/dist/jquery.min.js"></script> 
      
      <script>
          


          function change(){
               
              var userid=$("#userid").val();
              var username= $("#username").val();
              var password= $("#password").val();
              var retypepassword= $("#retypepassword").val();
             
             

            if(password=='' || retypepassword==''){
                $("#msg").after('<span id="error" style="color:red;font-weight:bold">Password Fields shouldnot be empty!</span>');
                return false;
                  
            }
              if(password!=retypepassword){
                  if(!document.getElementById("error")){
                      $("#msg").after('<span id="error" style="color:red;font-weight:bold">Password Mis-Match!!!</span>');
                  }
                 
                return false;
              }else{
                  if(document.getElementById("error")){
                      
                      $("#error").hide();
                  }
                  console.log("userid");
                  $.post('<?php echo site_url('profile/changePassword') ?>',
                                {
                                    id: userid,
                                    username:username,
                                    password:password
                                    
                                },
                        function(data) {

                            $("#username").val("");
                            $("#password").val("");
                            $("#retypepassword").val("");
              
                            alert(data);

                    });
              }
              
          }
      </script>
