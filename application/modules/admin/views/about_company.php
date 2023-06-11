

<?php //print_r($notice);  ?>

<div style="min-height: 916px;" class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Home Main Body Content
<!--            <small>preview of simple tables</small>-->
          </h1>
         
        </section>

            
        
        
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                
                  
               
                
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                
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
                  
                     <textarea  class="ckeditor" id="editor1" name="editor1" >   
                                  <?php echo $home_main['content'] ?>
                     </textarea>
                    
                            <div class="box-footer">
                                <div class="pull-right">
                           
                                    <button  class="btn btn-primary"  onclick="return save()"  ><i class="fa fa-save"></i> Save</button>
                                </div>
                         
                            </div><!-- /.box-footer -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div>
                   
                
                
       
    <script>
        
        function save()
             {
                 
                 
                 var body = CKEDITOR.instances["editor1"].getData();
                 
                    $.post('<?php echo site_url('admin/about_company') ?>',
                 {
                     
                    
                     content: body
                 },
                 function(data){
                     if(data=="success")
                     {
                         
                       window.location.href = '<?php echo site_url('admin/about_company')?>';
                     
                     }
                     
                 });
                 
             }
        
    </script>
                    
        
            


