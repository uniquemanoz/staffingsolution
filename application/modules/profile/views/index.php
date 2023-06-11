


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-1"> </div>
              <div class="col-md-10">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Set Profile <small> fill the form</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" action="<?php echo site_url('profile') ?>" method="post" m data-parsley-validate class="form-horizontal form-label-left" enctype='multipart/form-data'>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="first_name" name="first_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->first_name))?$ProfileInfo[0]->first_name:""  ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="last_name" name="last_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->last_name))?$ProfileInfo[0]->last_name:""  ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle_name" name="middle_name" class="form-control col-md-7 col-xs-12" type="text" name="middle-name" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->middle_name))?$ProfileInfo[0]->middle_name:""  ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" name="gender"  class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" id="gender" name="gender" value="male" checked="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->gender)&& $ProfileInfo[0]->gender =="female")?"TRUE":"FALSE"  ?>"> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                <input type="radio" id="gender" name="gender" value="female" checked="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->gender)&& $ProfileInfo[0]->gender =="female")?"TRUE":"FALSE"  ?>"> Female
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="birthday" name="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->birthday))?$ProfileInfo[0]->birthday:""  ?>">
                        </div>
                      </div>
                        
                        <div class="form-group">
                          <label for="street" class="control-label col-md-3 col-sm-3 col-xs-12">Position in Company  </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="position" name="position" class="form-control col-md-7 col-xs-12" type="text"  value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->position))?$ProfileInfo[0]->position:""  ?>">
                        </div>
                      </div>
                        
                       <div class="form-group">
                          <label for="phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone  </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="phone" name="phone" class="form-control col-md-7 col-xs-12" type="text"  value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->phone))?$ProfileInfo[0]->phone:""  ?>">
                        </div>
                      </div>
                        
                       <div class="form-group">
                          <label for="street" class="control-label col-md-3 col-sm-3 col-xs-12">Street Address  </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="street" name="user_street" class="form-control col-md-7 col-xs-12" type="text" name="user_street" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->user_street))?$ProfileInfo[0]->user_street:""  ?>">
                        </div>
                      </div>
                      
                       <div class="form-group">
                          <label for="state" class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="user_state" class="form-control col-md-7 col-xs-12" type="text" name="user_state" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->user_state))?$ProfileInfo[0]->user_state:""  ?>">
                        </div>
                      </div>
                        
                       <div class="form-group">
                          <label for="suburb" class="control-label col-md-3 col-sm-3 col-xs-12">Suburb</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="user_suburb" class="form-control col-md-7 col-xs-12" type="text" name="user_suburb" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->user_suburb))?$ProfileInfo[0]->user_suburb:""  ?>">
                        </div>
                      </div>
                        
                        <div class="form-group">
                          <label for="user_country" class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="user_country" class="form-control col-md-7 col-xs-12" type="text" name="user_country" value="<?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->user_country))?$ProfileInfo[0]->user_country:""  ?>">
                        </div>
                      </div>
                        
                        <div class="form-group">
                          <label for="company_profile" class="control-label col-md-3 col-sm-3 col-xs-12">Company Profile</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
<!--                              <textarea id="company_profile" class="form-control col-md-7 col-xs-12" type="text" name="company_profile">
                                    
                              </textarea>-->
                              <textarea id="company_profile" name="company_profile" class="resizable_textarea form-control" placeholder="">
                                  <?php echo (!empty($ProfileInfo)&& !empty($ProfileInfo[0]->company_profile))?$ProfileInfo[0]->company_profile:""  ?>
                                 
                              </textarea>

                        </div>
                      </div>

                        
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Profile Picture <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="profilepic" name="profilepic" class=" form-control col-md-7 col-xs-12"  type="file">
                            <img src="<?php if(empty($ProfileInfo[0]->profilepic)) echo  base_url('uploads').'/users/dummyclient.png'; else echo base_url('uploads').'/users/'.$this->session->userdata('id').'/'.$ProfileInfo[0]->profilepic;   ?>" width="100px" height="100px">
                              
                                
                         </div>


                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Save Changes</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

          
          </div>
        </div>
        <!-- /page content -->

        
           
                  
                  
        <script src="<?php echo base_url('assets/gentela');  ?>/vendors/jquery/dist/jquery.min.js"></script> 
         <script>
           
           $("#company_profile").text($("#company_profile").text().trim());
           
          function addRole(){
              
                var rolename=$("#rolename").val();
              
                  $.post('<?php echo site_url('user/addrole') ?>',
                                {
                                    rolename: rolename
                                    
                                },
                        function(data) {
                           $('#roleid').append('<option value="'+data+'">'+rolename+'</option>');
                           console.log(data+"   "+rolename);
                           $('.new-role').modal('hide');
                    });
              }
              
  
          
      </script>