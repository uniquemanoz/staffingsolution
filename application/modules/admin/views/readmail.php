<?php  

//echo $to.'/'.$from.'/'.$subject.'/'.$body;
?>

<div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Read Mail</h3>
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3><?php echo $subject;  ?></h3>
                    <h5>From: <?php echo $from;  ?> <span class="mailbox-read-time pull-right"><?php echo $date;  ?></span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Forward"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message">
                    <?php echo $body;  ?>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
                <div class="box-footer">
                  <ul class="mailbox-attachments clearfix">
                      <?php if($atch=="ok"){  
                        foreach ($file as $value) {
         			
         			$filename=str_replace(' ', '_', $value);
       
                          ?>
                    <li>
                      <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                      <div class="mailbox-attachment-info">
                        <a href="<?php echo base_url('download').'/'.$this->session->userdata('id').'/'.$filename; ?>" class="mailbox-attachment-name" download><i class="fa fa-paperclip"></i> <?php echo $value ?></a>
                        <span class="mailbox-attachment-size">
                          <?php
                          $size=filesize('./download/'.$this->session->userdata('id').'/'.$filename)/1024;
                          echo round($size,0).' KB' ?>
                            <a href="<?php echo base_url('download').'/'.$this->session->userdata('id').'/'.$filename; ?>" class="btn btn-default btn-xs pull-right" download><i class="fa fa-cloud-download"></i></a>
                        </span>
                      </div>
                    </li>
                      <?php } }?>
<!--                   <a href="../data/<?php echo $this->session->userdata('id').$file[$key]; ?>" download>  <?php echo $file[$key]; ?> </a>-->
                  
                  </ul>
                </div><!-- /.box-footer -->
                <div class="box-footer">
                  <div class="pull-right">
                    <button class="btn btn-default"><i class="fa fa-reply"></i> Reply</button>
                    <button class="btn btn-default"><i class="fa fa-share"></i> Forward</button>
                  </div>
                  <button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                  <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div>