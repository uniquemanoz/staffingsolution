
<?php 
$file= get_filenames('uploads/home_carosel');
//print_r($notice);  ?>

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
                
                <!--carosel upload-->
                <div>
                <form method="post" action="<?php echo site_url('admin/carosel_upload') ?>" enctype="multipart/form-data">
                    <input type="text" value="" id="m" name="k" hidden="" class="form-control" style="display:none">
                    <input type="file"  id="carosel" name="carosel"  class="form-control" value=""><br>
                        <input type="submit" value="Upload Carosel"  class="btn btn-primary">
                     
                </form>
                </div>
                <!--end-->
              <div class="box">
                
                  
                  
                
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Carosel List</h3>
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
                      <th>Carosel Photo</th>

                      <th>Action</th>
                      <th></th>
                    </tr>
                   
                   <?php if($file){
                         foreach ($file as $key => $value) {
         
     
                       ?>
                  
                    <tr>
                         
                      <td><?php   echo $key+1; ?></td>
                      <td><img src="<?php   echo base_url('uploads/home_carosel').'/'.$value ?>" width="300px"height="200px"></td>
                      <input type="text" hidden="" value="<?php echo $value  ?>" id="file<?php echo $key  ?>"name="file<?php echo $key  ?>">
                      <td><a href="#" onclick="return delete_notice(<?php echo $key  ?>)"><span class="label label-danger">Delete</span></a> </td>
                      
                    </tr>
                   <?php }} ?>
                    
                  </tbody></table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
                
                
       
         
    
         


         
         <script>

             
               function delete_notice(key)
             {
               
               
               
                
                    var file=$("#file"+key).val();
                    
                    $.post('<?php echo site_url('admin/delete_file') ?>',
                 {
                     
                     file_name: file
                    
                 },
                 function(data){
                     if(data=="sucess")
                     {
                        
                       window.location.href = '<?php echo site_url('admin/carosel')?>';
                     
                     }
                     
                 });
                    
             }
             
           
             
             
         </script>