
<?php //print_r($notice);  ?>

<div style="min-height: 916px;" class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Notice Zone
<!--            <small>preview of simple tables</small>-->
          </h1>
         
        </section>

            
        
        
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                
                  
                  <button class="btn btn-primary" onclick="return add_notice_open()">Add New Notice </button>  
                </br>  
                
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Notice list</h3>
                  <div class="box-tools">
                    <div class="input-group">
                      <input name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" type="text">
                      <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tbody><tr>
                            
                      <th>S.N</th>
                      <th>Notice</th>
                      <th>Content</th>  
                      <th>Action</th>
                      <th></th>
                    </tr>
                   
                   <?php if($notice){
                         foreach ($notice as $key => $value) {
         
     
                       ?>
                  
                    <tr>
                         
                      <td><?php   echo $key+1; ?></td>
                      <td><?php   echo $value['topic']; ?></td>
                      <td><?php   echo substr($value['content'], 0, 100).'   ---'; ?></td>
                      <input type="text" hidden="" value="<?php echo $value['notices_id']  ?>" id="notice<?php echo $value['notices_id']  ?>"name="notice<?php echo $value['notices_id']  ?>">
                      <input type="text" hidden="" value="<?php echo $value['topic']  ?>" id="topic<?php echo $value['notices_id']  ?>"name="topic<?php echo $value['notices_id']  ?>">
                      <input type="text" hidden="" value="<?php echo $value['content']  ?>" id="content<?php echo $value['notices_id']  ?>"name="content<?php echo $value['notices_id']  ?>">
                      <td><a href="#" onclick="return edit_modal_open(<?php echo $value['notices_id']  ?>)"><span class="label label-success">Edit</span></a> </td>
                      <td><a href="#" onclick="return delete_notice(<?php echo $value['notices_id']  ?>)"><span class="label label-danger">Delete</span></a> </td>
                      
                    </tr>
                   <?php }} ?>
                    
                  </tbody></table>
                    
                    <div class=box-footer">
                    <div id="pagination" >
                            <?php echo $pagination;?>
                    </div>
                </div>  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
                   
                
                
         <!---modal-->       
                <div class="modal" id="edit_modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Notice</h4>
                  </div>
                  <div class="modal-body">
                    
                      <div class="form-group">
                      <label>Notice Title</label>
                      <input class="form-control"  type="text" id="notice_title" name="notice_title">
                      </div>
                      <div class="form-group">
                            <label>Notice Body</label>
                            <textarea class="form-control" rows="3" id="notice_body" name="notice_body" ></textarea>
                      </div>
                      <input type="text" value="" hidden  id="store_id" name="store_id"> 
                  </div>
                  <div class="modal-footer">
                    
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="return edit_notice() ">Save changes</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
         
         <!---modal-->       
                <div class="modal" id="add_modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add Notice</h4>
                  </div>
                  <div class="modal-body">
                    
                      <div class="form-group">
                      <label>Notice Title</label>
                      <input class="form-control"  type="text" id="add_notice" name="add_notice">
                      </div>
                      <div class="form-group">
                            <label>Notice Body</label>
                            <textarea class="form-control" rows="3" id="add_body" name="add_body" ></textarea>
                      </div>
                      
                  </div>
                  <div class="modal-footer">
                    
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="return add_notice() ">Add Notice</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
         
         
         


         
         <script>
             
               function add_notice_open()
             {
               
                 $("#add_modal").modal('show');
             }
             
             function edit_modal_open(id)
             {
                
                 $("#store_id").val($("#notice"+id).val());
                 $("#notice_title").val($("#topic"+id).val());
                 $("#notice_body").val($("#content"+id).val());
                 $("#edit_modal").modal('show');
             }
             
             function edit_notice()
             {
                 
                 var notice_id=   $("#store_id").val();
                    $.post('<?php echo site_url('admin/edit_notice') ?>',
                 {
                     notices_id:notice_id,
                     topic: $("#notice_title").val(),
                     content:  $("#notice_body").val()
                 },
                 function(data){
                     if(data=="sucess")
                     {
                       window.location.href = '<?php echo site_url('admin/notices')?>';
                      // alert("successfuly message deleted!");
                     }
                     
                 });
                 
             }
             
             function delete_notice(id)
             {
                  alert("Do you want to delete");
                 $.post('<?php echo site_url('admin/delete_notice') ?>',
                 {
                     notices_id:id
                 },
                 function(data){
                     if(data=="sucess")
                     {
                       window.location.href = '<?php echo site_url('admin/notices')?>';
                      // alert("successfuly message deleted!");
                     }
                     
                 });
                 
             }
             
              function add_notice()
             {
                 
               
                    $.post('<?php echo site_url('admin/add_notice') ?>',
                 {
                     
                     topic: $("#add_notice").val(),
                     content:  $("#add_body").val()
                 },
                 function(data){
                     if(data=="sucess")
                     {
                       window.location.href = '<?php echo site_url('admin/notices')?>';
                     
                     }
                     
                 });
                 
             }
             
             
         </script>