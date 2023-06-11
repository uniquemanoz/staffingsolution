
<?php


 
    function con_min_days($mins){

            $hours = str_pad(floor($mins /60),2,"0",STR_PAD_LEFT);
            $mins  = str_pad($mins %60,2,"0",STR_PAD_LEFT);
            $days=0;
            if((int)$hours > 24){
            $days = str_pad(floor($hours /24),2,"0",STR_PAD_LEFT);
            $hours = str_pad($hours %24,2,"0",STR_PAD_LEFT);
            }
            if(isset($days)) { $days = $days." d ";}
            
            //return $days.$hours." h ".$mins." m ago";
            $time='';
            if($days==0 && strpos($hours,'00') !== false){
                $time= $mins." m ";
            }elseif ($days==0){
                
                $time= $hours." h ".$mins." m ";
            }else{
                $time=$days.$hours." h ".$mins." m ";
            }
            
            if($days!=0 && strpos($hours,'00')){
                
                $time=$days.$hours." h ".$mins." ";
            }
            
            return $time;

            
    }
    
    function TimeDiff($date_){
        
        $now = new DateTime();
        $now->setTimezone(new DateTimezone('Asia/Kathmandu'));

        $to_time = strtotime($now->format('Y-m-d H:i:s'));
        $from_time = $date_;
        //echo $now->format('Y-m-d H:i:s')."   ";
        
        //$to_time = strtotime("2018-07-15 10:42:00");
        $from_time = strtotime($date_);
        
//        $to_time = strtotime("2018-07-15 10:42:00");
//        $from_time = strtotime("2018-07-14 11:21:00");

        $totalmins=round(abs($to_time - $from_time) / 60,2);

        //echo round(abs($to_time - $from_time) / 60,2). " minute";
        return con_min_days($totalmins);
         
     }
     
     

?>

<div class="right_col" role="main" style="min-height: 801px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Profile</h3>
              </div>


            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Report <small>Activity report</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php if(empty($userProfile[0]->profilepic)) echo  base_url('uploads').'/users/dummyclient.png'; else echo base_url('uploads').'/users/'.$this->session->userdata('id').'/'.$userProfile[0]->profilepic;   ?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?php echo $userProfile[0]->first_name." ".$userProfile[0]->middle_name." ".$userProfile[0]->middle_name;  ?> </h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-home user-profile-icon"></i> &nbsp Lives in:  <?php echo " ".$userProfile[0]->user_street.", ".$userProfile[0]->user_suburb.", ".$userProfile[0]->user_state.",".$userProfile[0]->user_country;   ?>
                        </li>

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> &nbsp <?php echo $userProfile[0]->position   ?>
                          
                        </li>
                        <li><i class="fa fa-building user-profile-icon"></i>&nbsp Company address:  <?php echo " ".$userProfile[0]->companyname.", ".$userProfile[0]->street.", ".$userProfile[0]->suburb.",".$userProfile[0]-> statename.", Australia";   ?>
                        </li>
                        <li><i class="fa fa-phone user-phone-icon"></i> &nbsp Phone:  <?php echo " ".$userProfile[0]->phone;   ?>
                        </li>

                        
                      </ul>

                      
                      <br>
<!--
                       Details 
                      <h4>Skills</h4>
                      <ul class="list-unstyled user_data">
                        <li>
                          <p>Web Applications</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50" aria-valuenow="49" style="width: 50%;"></div>
                          </div>
                        </li>
                        <li>
                          <p>Website Design</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70" aria-valuenow="69" style="width: 70%;"></div>
                          </div>
                        </li>
                        <li>
                          <p>Automation &amp; Testing</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30" aria-valuenow="29" style="width: 30%;"></div>
                          </div>
                        </li>
                        <li>
                          <p>UI / UX</p>
                          <div class="progress progress_sm">
                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50" aria-valuenow="49" style="width: 50%;"></div>
                          </div>
                        </li>
                      </ul>
                       end of skills -->

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">


    
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
<!--                          <li role="presentation" class=""><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="false">Recent Activity</a>
                          </li>-->
                          <?php  if($roleOfUser=="Client" || $roleOfUser=="Employee"){ ?>
                          <li role="presentation" class="active" ><a href="#tab_upcomming" role="tab" id="upcomming-tab" data-toggle="tab" aria-expanded="true">Upcoming Work</a>
                            <li role="presentation" class=""><a href="#tab_past" role="tab" id="past-tab" data-toggle="tab" aria-expanded="false">Past Work History</a>
                          </li>
                          <?php  } ?>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="">Profile</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade" id="tab_content1" aria-labelledby="home-tab">

<!--                             start recent activity 
                            <ul class="messages">
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br>
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br>
                                  <p class="url">
                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                    <a href="#" data-original-title="">Download</a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-info">24</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Desmond Davison</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br>
                                  <p class="url">
                                    <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                    <a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>
                                  </p>
                                </div>
                              </li>
                              <li>
                                <img src="images/img.jpg" class="avatar" alt="Avatar">
                                <div class="message_date">
                                  <h3 class="date text-error">21</h3>
                                  <p class="month">May</p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">Brian Michaels</h4>
                                  <blockquote class="message">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</blockquote>
                                  <br>
                                  <p class="url">
                                    <span class="fs1" aria-hidden="true" data-icon=""></span>
                                    <a href="#" data-original-title="">Download</a>
                                  </p>
                                </div>
                              </li>

                            </ul>
                             end recent activity -->

                          </div>
                          
                             <?php  if($roleOfUser=="Client" || $roleOfUser=="Employee"){ ?>
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_upcomming" aria-labelledby="upcomming-tab">

                          <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span onclick="exportTableToExcel('upcomingtable', 'Work')">Export To Excel File</span></a>
                         
                            <!-- start user projects -->
                            <table class="data table table-striped no-margin" id="upcomingtable">
                              <thead>
                                <tr>
                                  <th>S.N</th>
                                  <th>  <?php if($roleOfUser=="Client"){ echo "Client Name";}elseif($roleOfUser=="Employee"){ echo "Employee Name";} ?></th>
                                  <th>Start Date</th>
                                  <th>End Date</td>
                                  <th>Time</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                               <?php //if(!empty($UpcommingRoster))
                                   {   
                                foreach ($UpcommingRoster as $key => $value) {  ?>
                                <tr>
                                  <td><?php  echo ($key= $key+1); ?></td>
                                  <td><?php if($roleOfUser=="Client"){ echo $value->c_first_name." ".$value->c_last_name;}elseif($roleOfUser=="Employee"){ echo $value->e_first_name." ".$value->e_last_name;} ?></</td>
                                  <td><?php  echo $value->startdatetime; ?></td>
                                  <td ><?php  echo $value->enddatetime; ?></td>
                                 <td ><?php  echo TimeDiff($value->startdatetime)." to go"; ?></td>
                                </tr>
                                <?php }}  ?>
                             
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                            
                             <?php  } ?>
                            
                             <?php  if($roleOfUser=="Client" || $roleOfUser=="Employee"){ ?>
                        <div role="tabpanel" class="tab-pane fade" id="tab_past" aria-labelledby="past-tab">
                         
                            <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span onclick="exportTableToExcel('pasttable', 'PastWork')">Export To Excel File</span></a>
                         
              
                            <!-- start user projects -->
                            <table class="data table table-striped no-margin" id="pasttable">
                              <thead>
                                <tr>
                                  <th>S.N</th>
                                  <th>  <?php if($roleOfUser=="Client"){ echo "Client Name";}elseif($roleOfUser=="Employee"){ echo "Employee Name";} ?></th>
                                  <th>Start Date</th>
                                  <th>End Date</td>
                                  <th>Time</th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                               <?php //if(!empty($UpcommingRoster))
                                   {   
                                foreach ($PastRoster as $key => $value) {  ?>
                                <tr>
                                  <td><?php  echo ($key= $key+1); ?></td>
                                  <td><?php if($roleOfUser=="Client"){ echo $value->c_first_name." ".$value->c_last_name;}elseif($roleOfUser=="Employee"){ echo $value->e_first_name." ".$value->e_last_name;} ?></</td>
                                  <td><?php  echo $value->startdatetime; ?></td>
                                  <td ><?php  echo $value->enddatetime; ?></td>
                                 <td ><?php  echo TimeDiff($value->enddatetime)." ago"; ?></td>
                                </tr>
                                <?php }}  ?>
                             
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                             <?php } ?>
                            
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content3" aria-labelledby="profile-tab">
                              <p>
                                  <?php echo $userProfile[0]->company_profile   ?>
                              </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>





<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
       
<script>

   
 
 
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>