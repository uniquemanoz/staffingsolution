

<?php //print_r($users);
?>
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Users <small>List</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">

                    

                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="check-all" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                            </th>
                            <th class="column-title">S.N </th>
                            <th class="column-title">Name</th>
                            
                            <th class="column-title">Username </th>
                            <th class="column-title">Comapany Name </th>
                            <th class="column-title">Role</th>
                            <th class="column-title">User Type</th>
                            <th class="column-title">Is Active</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                       <?php  if($users){ foreach ($users as $key => $value) { 
                           if($value['isDeleted']==0){
                           ?>
                           <tr class="<?php  echo ($key%2==0)? "even":"odd"   ?> pointer">
                            <td class="a-center ">
                              <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                            </td>
                            <td class=" "><?php  echo $key+1;   ?></td>
                            <td class=" "><?php  echo $value['first_name']." ".$value['middle_name']." ".$value['last_name'];   ?></td>
                            
                            <td class=" "><?php  echo $value['username'];   ?></td>
                            <td class=" "><?php  echo $value['companyname'];   ?></td>
                            <td class=""><?php  echo $value['rolename'];   ?></td>
                            <td class=""><?php  echo $value['user_type_name'];   ?></td>
                            <td class=""><?php  echo ($value['isActive']==1)? "YES":"NO"; ;   ?></td>
                            <td class=" last">
                                <a href="<?php echo site_url('user/profile').'/'.$value['id'];  ?>"><button class="btn btn-sm btn-success">View</button></a>
                                <a href="<?php echo site_url('user/adduser').'/'.$value['id'];  ?>"><button class="btn btn-sm btn-success">Edit</button></a>
                                <button class="btn btn-sm <?php if ($value['block_status']==1)echo "btn-warning"; else echo "btn-success"; ?>" id="block<?php echo $value['id'] ?>" onclick="return change_status(<?php echo $value['id'] ?>,'<?php  if ($value['block_status']==1)echo "unblock"; else echo "block"; ?>')"><?php  if ($value['block_status']==1)echo "Unblock"; else echo "Block"; ?> </button>
                                <button class="btn btn-sm <?php if ($value['isActive']==1)echo "btn-success"; else echo "btn-warning"; ?>" id="active<?php echo $value['id'] ?>" onclick="return change_status(<?php echo $value['id'] ?>,'<?php  if ($value['isActive']==1)echo "inactive"; else echo "active"; ?>' )"><?php  if ($value['isActive']==1)echo "Inactive"; else echo "Active"; ?> </button>
                                <button class="btn btn-sm btn-danger " id="block<?php echo $value['id'] ?>" onclick="return change_status(<?php echo $value['id'] ?>,'delete')">Delete </button>
                            </td>
                          </tr>
                       <?php } }} ?>

                        </tbody>
                      </table>
                    </div>
							
						
                  </div>
                </div>
              </div>
            
    </div>
</div>





<script>


                        

                          function change_status(id,status)
                          {
                              //status="";
                              var con = confirm("Do you want to "+status+" this user?");
                                if (con == false) {

                                    return false;
                                }
                                
                              
                              $.post('<?php echo site_url('user/change_status') ?>',
                                      {
                                          id: id,
                                          status: status
                                      },
                              function(data) {
                                  
                                  window.location.href = '<?php echo site_url('user') ?>';
                                
                              });

                          }




                </script>