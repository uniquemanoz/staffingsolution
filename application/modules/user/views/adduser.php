
<?php  
//echo "<pre>";print_r($userProfile);exit;
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-1"> </div>
              <div class="col-md-10">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add User <small> fill the form</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" action="<?php echo site_url('user/adduser') ?>" method="post" m data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="first_name" name="first_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (!empty($userProfile)&&!empty($userProfile[0]->first_name))?$userProfile[0]->first_name:""; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required" >*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" id="last_name" name="last_name" required="required" class="form-control col-md-7 col-xs-12"  value="<?php echo (!empty($userProfile)&&!empty($userProfile[0]->last_name))?$userProfile[0]->last_name:""; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Middle Name / Initial</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="middle_name" name="middle_name" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo (!empty($userProfile)&&!empty($userProfile[0]->middle_name))?$userProfile[0]->middle_name:""; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" name="gender"  class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" id="gender" name="gender" value="male" checked="" <?php echo (!empty($userProfile)&&!empty($userProfile[0]->gender)=="male")?'checked=""':''; ?>> &nbsp; Male &nbsp;
                            </label>
                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" id="gender" name="gender" value="female" <?php echo (!empty($userProfile)&&!empty($userProfile[0]->gender)=="female")?'checked=""':''; ?>> Female
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="birthday" name="birthday" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo (!empty($userProfile)&&!empty($userProfile[0]->birthday))?$userProfile[0]->birthday:""; ?>">
                        </div>
                      </div>
                        
                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" name="email" class=" form-control col-md-7 col-xs-12" required="required" type="email" value="<?php echo (!empty($userProfile)&&!empty($userProfile[0]->email))?$userProfile[0]->email:""; ?>">
                        </div>
                      </div>
                        
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="phone" name="phone" class=" form-control col-md-7 col-xs-12" required="required" type="text" value="<?php echo (!empty($userProfile)&&!empty($userProfile[0]->phone))?$userProfile[0]->phone:""; ?>">
                        </div>
                      </div>
                          <?php 
                      if($msg){ ?>
                        <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> <span class="required"></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-danger btn-xs"><?php echo $msg;  ?></button>
                        </div>
                      </div>
                    

                       <?php } ?>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Role <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
       
                          <select id="roleid" name="roleid" class="form-control validate"  required="required">
                              <option value="0">Select Role</option>
                              <?php  if($role){ foreach ($role as $key => $value) {  ?>
                                    <option value="<?php echo $value['roleid']  ?>" class="form-control" <?php echo (!empty($userProfile)&&!empty($userProfile[0]->roleid)==$value['roleid'])?"selected":""; ?> ><?php echo $value['rolename']?></option>
                                <?php } } ?>
                              
                          </select>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-role">Add New Role</button>
                        </div>
                      </div>
                       
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Invoice Type <span class=""></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
       
                          <select id="invoicetypeid" name="invoicetypeid" class="form-control"  required="">
                              <option value="0">Select Invoice Type</option>
                              <?php  if($invoicetype){ foreach ($invoicetype as $key => $value) {  ?>
                                    <option value="<?php echo $value['invoicetypeid']  ?>" class="form-control" <?php echo (!empty($userProfile)&&!empty($userProfile[0]->invoicetypeid)==$value['invoicetypeid'])?"selected":""; ?> ><?php echo $value['invoicetypename'];?></option>
                                <?php } } ?>
                              
                          </select>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-invoicetype">Add New Invoice Type</button>
                        </div>
                      </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Rate <span class=""></span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
       
                          <select id="rateid" name="rateid" class="form-control"  required="">
                              <option value="0">Select Rate</option>
                              <?php  if($rate){ foreach ($rate as $key => $value) {  ?>
                                    <option value="<?php echo $value['rateid']  ?>" class="form-control"  <?php echo (!empty($userProfile)&&!empty($userProfile[0]->rateid)==$value['rateid'])?"selected":""; ?> ><?php echo "@".$value['rate']." AUD/hrs"?></option>
                                <?php } } ?>
                              
                          </select>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-rate">Add New Rate</button>
                        </div>
                      </div>
                        
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Company Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="companyid"  name="companyid" class="form-control"  required="required">
                              <option value="0">Select Company</option>
                              <?php  if($company){ foreach ($company as $key => $value) {  ?>
                                    <option value="<?php echo $value['companyid']  ?>" class="form-control" <?php echo (!empty($userProfile)&&!empty($userProfile[0]->companyid)==$value['companyid'])?"selected":""; ?>><?php echo $value['companyname']?></option>
                                <?php } } ?>
                              
                          </select>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".new-company">Add New Company</button>
                        </div>
                      </div>
                      
                        <div class="ln_solid">
                            <input type="hidden" id="id" name="id" value="<?php echo (!empty($userProfile)&&!empty($userProfile[0]->id))?$userProfile[0]->id:""; ?>" >
                  
                        </div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          
                            <button type="submit" class="btn btn-success" onclick="return Validate()">Submit</button>
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

        
        
                   <div class="modal fade new-role" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Add New Role</h4>
                        </div>
                        <div class="modal-body">
                          
                            <input id="rolename" placeholder="New Role"  class="form-control" required="required" type="text">
                            
                        </div>
                        <div class="modal-footer">
                          <button  class="btn btn-default" data-dismiss="modal">Close</button>
                          <button  onclick="return addRole()" class="btn btn-primary">Add Role</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
                  
                   <div class="modal fade new-rate" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Add New Rate</h4>
                        </div>
                        <div class="modal-body">
                          
                            <input id="rate" placeholder="New Rate"  class="form-control" required="required" type="text">
                            <input id="currency" placeholder="Currency"  class="form-control" required="required" type="text">
                            
                        </div>
                        <div class="modal-footer">
                          <button  class="btn btn-default" data-dismiss="modal">Close</button>
                          <button  onclick="return addRate()" class="btn btn-primary">Add Rate</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
                  
                                   
                   <div class="modal fade new-invoicetype" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Add New Invoice Type</h4>
                        </div>
                        <div class="modal-body">
                          
                            <input id="invoicetypename" placeholder="New Invoice Type"  class="form-control" required="" type="text">
                            
                        </div>
                        <div class="modal-footer">
                          <button  class="btn btn-default" data-dismiss="modal">Close</button>
                          <button  onclick="return addInvoiceType()" class="btn btn-primary">Add Invoice Type</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
                  
                        
                   <div class="modal fade new-company" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel2">Add New Company</h4>
                        </div>
                        <div class="modal-body">
                          <input id="company_name" placeholder="Company Name"  class="form-control" required="required" type="text">
                          <input id="abn" placeholder="ABN"  class="form-control" required="required" type="number">
                          <input id="street_name" placeholder="Street Name"  class="form-control" required="required" type="text">
                          <input id="suburb" placeholder="Suburb"  class="form-control" required="required" type="text"> 
                          <select id="state" class="form-control"  required="required">
                              
                              <option value="0">Select state</option>
                              <?php  if(!empty($state)){ foreach ($state as $key => $value) {  ?>
                                    <option value="<?php echo $value['stateid']  ?>" class="form-control" ><?php echo $value['statename']?></option>
                                <?php } } ?>
                              
                              
                          </select>
                          
                          <input id="postcode" placeholder="Postcode"  class="form-control" required="required" type="text"> 
                        </div>
                        <div class="modal-footer">
                          <button  class="btn btn-default" data-dismiss="modal">Close</button>
                          <button  onclick="return addCompany()" class="btn btn-primary">Add Company</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->
                  
                  
                  
                  
         <script>
             
          
      function Validate(){
          var logic=true;
          var msg="";
          if($("#roleid").val()==0){
              msg+="ROLE";
              logic= false;
          }
          if($("#invoicetypeid").val()==0){
              msg+="   INVOICETYPE";
               logic= false;
          }
          if($("#rateid").val()==0){
              msg+="   RATE";
               logic= false;
          }
          if($("#companyid").val()==0){
               msg+="   COMPANY";
               logic= false;
          }
          if(!logic){
               alert("Please Select "+msg+"  !");
          }
          
          return logic;
      }
      

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
              
        function addRate(){
              
                var rate=$("#rate").val();
                var currency=$("#currency").val();
              
                  $.post('<?php echo site_url('user/addrate') ?>',
                                {
                                    rate: rate,
                                    currency:currency
                                    
                                },
                        function(data) {
                           $('#rateid').append('<option value="'+data+'">@'+rate+' '+currency+'/hrs</option>');
                           console.log(data+"   "+rate);
                           $('.new-rate').modal('hide');
                    });
              }
              
             function addInvoiceType(){
              
                var invoicetypename=$("#invoicetypename").val();
                
              
                  $.post('<?php echo site_url('user/addInvoiceType') ?>',
                                {
                                    invoicetypename: invoicetypename
                                   
                                },
                        function(data) {
                           $('#invoicetypeid').append('<option value="'+data+'">'+invoicetypename+'</option>');
                           console.log(data+"   "+invoicetypename);
                           $('.new-invoicetype').modal('hide');
                    });
              }
              
              
              function addCompany(){
              
              
              var company_name=$("#company_name").val();
              var abn=$("#abn").val(); 
              var street_name=$("#street_name").val();
              var suburb=$("#suburb").val();
              var stateid=$("#state").val();
              var postcode=$("#postcode").val();
              
              

                  $.post('<?php echo site_url('user/addcompany') ?>',
                                {
                                    companyname: company_name,
                                    abn:abn,
                                    street:street_name,
                                    suburb:suburb,
                                    stateid:stateid,
                                    postcode:postcode
                                },
                        function(data) {
                           $('#companyid').append('<option value="'+data+'">'+company_name+'</option>');
                           $('.new-company').modal('hide');

                    });
              }
          
      </script>