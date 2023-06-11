<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        
        <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> View Rosters <small>According to Clients Name</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        <?php if(!empty($Clients)){
                            foreach ($Clients as $key =>$value) {   ?>

                        <li class="<?php echo ($key==0)?"active":"";   ?>"><a href="#link<?php echo $value->id  ?>" data-toggle="tab" aria-expanded="true"><?php echo $value->first_name." ".$value->last_name; ?>
                             <p>company:<?php echo $value->companyname;  ?></p>
                            </a>
                           
                        </li>
                        
                        <?php }} ?>
                        
                      </ul>
                    </div>

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content ">
                          <?php if(!empty($Clients)){ 
                            foreach ($Clients as $key =>$Cli) {   ?>
                        <div class="tab-pane <?php echo ($key==0)?"active":"";   ?>" id="link<?php echo $Cli->id ?>">
                            <p class="lead"><?php echo $Cli->first_name." ".$Cli->last_name ?></p>
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="x_panel">
                                    <div class="x_title">
                                      <h2>Employees <small>Roster</small></h2>

                                      <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">

                                      <table class="table table-bordered" id="selectedEmpTable">
                                        <thead>
                                          <tr>
                                              <th><h6>Employee ID</h6></th>
                                            <th><h6>First Name</h6></th>
                                            <th><h6>Last Name</h6></th>
                                            <th><h6>Start Date and Time</h6></th>
                                            <th><h6>End Date and Time</h6></th>
                                            <th><h6>Action</th>

                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $count_clients= count($Clients);
                                            
                                            if(!empty($rosters)){ 
                                                foreach ($rosters as $key =>$value) {  if($Cli->id==$value->clientid){ ?>
                                           
                                            <tr>
                                                <td><h6><?php echo $value->e_id; ?></h6></td>
                                                <td><h6><?php echo $value->e_first_name ?></h6></td>
                                                <td><h6><?php echo $value->e_last_name ?></h6></td>
                                                <td><h6><?php echo $value->startdatetime ?></h6></td>
                                                <td><h6><?php echo $value->enddatetime ?></h6></td>
                                                <td><button class="btn <?php echo ($value->isCancelled==0)?"btn-success":"btn-danger" ?> btn-sm cancelRoster" id="cancelRoster<?php echo $value->rosterid; ?>"    data-iscancelled="<?php echo $value->isCancelled; ?>" data-rosterid="<?php echo $value->rosterid; ?>"> <?php echo ($value->isCancelled==0)?"Cancel":"Cancalled"  ?> </button>
                                                    <button class="btn btn-success btn-sm  editButton" id="edit<?php echo $value->rosterid; ?>" data-start="<?php echo $value->startdatetime ?>" data-end="<?php echo $value->enddatetime ?>" data-rosterid="<?php echo $value->rosterid; ?>"  data-target=".edit-roster"> Edit</button>
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php  
                                                }
                                                
                                                }
                                                } ?>


                                        </tbody>
                                      </table>

                                        <button class="btn btn-success confirmBtn invisible" > Confirm the Employees</button>

                                    </div>
                                  </div>
                                </div>


                          </div>
                        </div>
                          <?php }} ?>
                        
                      </div>
                    </div>

                    <div class="clearfix"></div>

                  </div>
                </div>
              </div>
    </div>
</div>


                   <div class="modal fade edit-roster" tabindex="-1" role="dialog" aria-hidden="true">
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
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" onclick="return addRole()" class="btn btn-primary">Add Role</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  <!-- /modals -->


<script>
    
    
    $(document).ready(function(){
     $(".editButton").on('click',function(){
         var rosterid=$(this).data('rosterid');
         var start=$(this).data('start');
         var end=$(this).data('end');
         console.log(rosterid+"   "+start+"   "+end);

//         $.post('<?php echo site_url('roster/cancelRoster') ?>',
//                {
//                  rosterid:rosterid,
//                  isCancelled:isCancelled
//                },
//                function(data) {
//                    
//                
//                   
//        });
         
     });
 
});
    
    
    
    $(document).ready(function(){
     $(".cancelRoster").on('click',function(){
         var rosterid=$(this).data('rosterid');
         var isCancelled=$(this).data('iscancelled');
         console.log(rosterid+"   "+isCancelled);

         $.post('<?php echo site_url('roster/cancelRoster') ?>',
                {
                  rosterid:rosterid,
                  isCancelled:isCancelled
                },
                function(data) {
                    if(isCancelled==0){
                        $("#cancelRoster"+rosterid).removeClass("btn-success");
                        $("#cancelRoster"+rosterid).addClass("btn-danger");
                        $("#cancelRoster"+rosterid).data('iscancelled',1);
                        document.getElementById("cancelRoster"+rosterid).innerText = 'Cancelled';
                    }else{
                        $("#cancelRoster"+rosterid).removeClass("btn-danger");
                        $("#cancelRoster"+rosterid).addClass("btn-success");
                        $("#cancelRoster"+rosterid).data('iscancelled',0);
                        document.getElementById("cancelRoster"+rosterid).innerText = 'Cancel';
                    }
                
                   
        });
         
     });
 
});
    
</script>