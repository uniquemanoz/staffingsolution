

<?php //print_r($notice);  ?>

<div style="min-height: 916px;" class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Members
<!--            <small>preview of simple tables</small>-->
          </h1>
         
        </section>

            
        
        
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                  <br><br>
                  <form method="post" action="<?php echo site_url('admin/add_member')  ?>" enctype="multipart/form-data">
                  <div class="row">
                      <div class="col-lg-1"></div>
                      <div class="col-lg-3">
                          <label>Name</label>
                          <input type="text"  class="form-control" id="name" name="name" required="">
                      </div>
                        <div class="col-lg-3">
                            <label>Type</label>
                            <select class="form-control" name="type" id="type" required="">
                                        <option value="select_type" class="form-control" >Select Type</option>
                                        <option value="chairman" class="form-control">chairman</option>
                                        <option value="vicechairman" class="form-control">vicechairman</option>
                                        <option value="secretary" class="form-control">secretary</option>
                                        <option value="manager" class="form-control">manager</option>
                                        <option value="hr" class="form-control">Human Resource Manger</option>
                                        <option value="member" class="form-control">member</option>
                                        
                                        

                                    </select>
                      </div>
                        <div class="col-lg-3">
                            <label>Profile Picture</label>
                            <input type="file"  class="form-control" id="profile"name="profile" required="">
                      </div>
                      
                      
                  </div>
                  <br>  
                  
                  <div class="row">
                      <div class="col-lg-1"></div>
                      <div class="col-lg-3">
                          <button class="btn btn-primary" >Add Member </button>
                      </div>
                       
                  </div>
                  </form>
                   <br>  
                   
                   
                
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Member list</h3>
                  <div class="box-tools">
                   
                      
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                            
                      <th>S.N</th>
                      <th>Profile</th>
                      <th>Name</th>  
                      <th>Type</th>
                      <th>Action</th>
                     
                    </tr>
                   
                   <?php if($members){
     
                         foreach ($members as $key => $value) {
         
     
                       ?>
                  
                    <tr>
                         
                      <td><?php   echo $key+1; ?></td>
                      <td><img src="<?php   echo base_url('uploads').'/member/'. $value['profile_pic']; ?>" width="100px" height="100px"></td>
                      <td><?php   echo $value['name'] ?></td>
                      <td><?php   echo $value['type']; ?></td>
                      <input type="text" hidden="" name="member<?php echo $value['mid']  ?>" id="member<?php echo $value['mid']  ?>" value="<?php   echo $value['profile_pic'] ?>" >
                      <td><a href="#" onclick="return delete_member(<?php echo $value['mid']  ?>)"><span class="label label-danger">Delete</span></a> </td>
                      
                    </tr>
                   <?php }} ?>
                    
                  </tbody></table>
                    
                    <div class=box-footer">
                    <div id="pagination" >
                            <?php //echo $pagination;?>
                    </div>
                </div>  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
                   
                
  
         <script>
             
             
             
             function delete_member(id)
             {
                  alert("Do you want to delete");
                  var profile_pic = $("#member"+id).val();
                 $.post('<?php echo site_url('admin/delete_member') ?>',
                 {
                     mid:id,
                     profile_pic : profile_pic 
                 },
                 function(data){
                     if(data=="sucess")
                     {
                       window.location.href = '<?php echo site_url('admin/add_member')?>';
                      // alert("successfuly message deleted!");
                     }
                     
                 });
                 
             }
             
              
             
             
         </script>