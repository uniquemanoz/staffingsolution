				
<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Compose New Message</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="form-group">
                      <input class="form-control" placeholder="To:" id="to" name="to" required="">
                  </div>
                  <div class="form-group">
                      <input class="form-control" placeholder="Subject:" id="subject" name="subject" required="">
                  </div>
                  
                    <div class="box-header with-border">
                        <h3 class="box-title">Message</h3>
                    </div><!-- /.box-header -->
                     <div class="form-group">
                            
                         
<!--                          <textarea id="message" name="message"  rows="10" cols="125"  required="">    
                                       
                                 </textarea>-->
                         
                         
                         
                           
                                 <textarea  class="ckeditor" id="editor1" name="editor1" >   
                                  
                                 </textarea>
<!--                                  <script type="text/javascript">
				       CKEDITOR.replace( 'editor1' );
                                         for ( instance in CKEDITOR.instances ){
                                                CKEDITOR.instances[instance].updateElement();
                                               }
                                             CKEDITOR.instances[instance].setData(' ');
                                </script>-->
                                
                         
                                 
                              </div>


                          
                    
                  <div class="form-group">
                    <div class="btn btn-default btn-file">
                      <i class="fa fa-paperclip"></i> Attachment
<!--                      <input name="attachment" type="file">-->
                    </div>
                    <p class="help-block">Max. 2MB</p>

                    <div class="form-group" >

                                       <form id="homework-dropzone" action="<?php echo site_url('admin/start_upload_file') ?>" class="dropzone homework" method="post" enctype="multipart/form-data">
                                                          <input name="photo" type="hidden" value="@{pubConf.awsAccessKey}" id="photo">
                                                          <input name="acl" type="hidden" value="private">
                                                          <p class="dz-message">Drop your assignment files<br/> here to upload them<br>filesize less tha 2mb</p>
                                        </form       


                    </div>
                                
                                  
                            
                         
                    


                  </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                    <button type="submit" class="btn btn-primary"  onclick="return send_mail()"  ><i class="fa fa-envelope-o"></i> Send</button>
                  </div>
                  <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div>



<script>
     function send_mail()
     {
        alert("wait while message is sending");
        var to= $("#to").val();
        var subject = $("#subject").val();
        //var message = $("#editor1").val();
        var message = CKEDITOR.instances["editor1"].getData();
        
       
        
         $.post("<?php echo site_url('admin/email_admin'); ?>",
              {
                to: to ,

                subject:subject,
                
                message:message
              },
              function(data){
                 
                if(data=="success")
                {
                    alert("Successfully message sent");
                }
                else
                {
                    alert("Message sending failed due to internal error");
                }
              });
     }
    
</script>