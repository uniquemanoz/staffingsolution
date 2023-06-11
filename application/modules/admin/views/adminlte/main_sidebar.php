

<?php  

$isAuthorised=TRUE;
$isEmployee=FALSE;

if($this->session->userdata('rolename')=="Client" || $this->session->userdata('rolename')=="Employee" ){
    $isAuthorised=FALSE;
}
if($this->session->userdata('rolename')=="Employee"){
    $isEmployee=TRUE;
}


?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                       <li><a href="<?php echo site_url('user/profile').'/'.$this->session->userdata('id');  ?>">User Profile</a></li>
                       <?php if(!$isEmployee){   ?>
                       <li><a href="<?php echo site_url('invoice')  ?>">Invoice List</a></li>
                       <?php  } ?>
                       
                    </ul>
                  </li>
                  <?php  if($isAuthorised){ ?>
                  <li><a><i class="fa fa-users"></i> User Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="<?php echo site_url('user')  ?>">Users</a></li>
                      <li><a href="<?php echo site_url('user/adduser')  ?>">Add User</a></li>
                      
                    </ul>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Roster Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('roster')  ?>">Manage Roster</a></li>
                       <li><a href="<?php echo site_url('roster/viewroster')  ?>">View Roster</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-newspaper-o"></i> Invoice Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('invoice')  ?>">Invoice Record</a></li>
                       <li><a href="<?php echo site_url('invoice/listwork')  ?>">Generate Invoice</a></li>
                    </ul>
                  </li>
                  
                  <li><a><i class="fa fa-calculator"></i> Account Management <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo site_url('account')  ?>">Report</a></li>
<!--                       <li><a href="<?php echo site_url('a/listwork')  ?>">Generate Invoice</a></li>-->
                    </ul>
                  </li>
                  
                  <?php } ?>
                  
                  
                  
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php if(!$this->session->userdata('profilelink')) echo  base_url('uploads').'/users/dummyclient.png'; else echo base_url('uploads').'/users/'.$this->session->userdata('id').'/'.$this->session->userdata('profilelink');   ?>" alt=""><?php echo $this->session->userdata('name')  ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo site_url('profile');  ?>"> Profile</a></li>
                    <li>
                      <a href="<?php echo site_url('profile/changePassword');  ?>">
                        <span class="badge bg-red pull-right"></span>
                        <span>Change Password</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="<?php echo site_url('admin/logout');  ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
 