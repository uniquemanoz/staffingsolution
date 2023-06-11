<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        
        <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class=""></i> Send Invoice <small>According to Clients Name</small></h2>
                    
                    <div class="clearfix">
                       
                    </div>
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

                                      <div class="clearfix">
                                          
                                      </div> 
                                    </div>
                                      <button class="btn btn-success Confirm" id="Confirm<?php echo $Cli->id ?>" data-clientid="<?php echo $Cli->id ?>">Make Invoice Of Selected Work</button>
                                    <div class="x_content">

                                      <table class="table table-bordered" id="selectedEmpTable<?php echo $Cli->id ?>">
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
                                            $row=0;
                                            if(!empty($rosters)){ 
                                                foreach ($rosters as $key =>$value) {  if($Cli->id==$value->clientid){ 
                                                     $row=$row+1;
                                                    ?>
                                               
                                            <tr>
                                                <td><?php echo $value->e_id; ?></td>
                                                <td><?php echo $value->e_first_name ?></td>
                                                <td><?php echo $value->e_last_name ?></td>
                                                <td><?php echo $value->startdatetime ?></td>
                                                <td><?php echo $value->enddatetime ?></td>
                                                <td >
                                                    <div id="<?php echo $value->rosterid; ?>">
                                                    <button class="btn cancelInvoice <?php echo ($value->isInvoiceSent==0)?"btn-success":"btn-danger" ?> btn-sm cancelInvoice" id="cancelInvoice<?php echo $value->rosterid; ?>"    data-isinvoicesent="<?php echo $value->isInvoiceSent; ?>" data-rosterid="<?php echo $value->rosterid; ?>"> <?php echo ($value->isInvoiceSent==0)?"Invoice Not Sent":"Invoice Sent"  ?> </button>
                                                    <?php  if($value->isInvoiceSent==0){  ?>
                                                    <button class="btn selectInvoice <?php echo ($value->isInvoiceSent==0)?"btn-success":"btn-danger" ?> btn-sm selectInvoice  selectClient<?php echo $value->clientid."row". $row; ?>" id="selectInvoice<?php echo $value->rosterid; ?>"    data-isselected="0" data-rosterid="<?php echo $value->rosterid; ?>"> Select</button>
                                                    <?php  } ?>
                                                    
                                                    <?php  if($value->isInvoiceSent==1){  ?>
                                                    <a href="<?php echo site_url('invoice/download/').$value->clientid."/".$value->invoicerefid ?>"><button class="btn btn-danger btn-sm" data-invoicerefid="<?php echo $value->invoicerefid;  ?>">View Invoice</button></a>
                                                    <?php  } ?>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                            
                                            <?php  
                                                }
                                                
                                                }
                                                } ?>


                                        </tbody>
                                      </table>

                                       

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




<script>
    
    
$(document).ready(function(){
     $(".selectInvoice").on('click',function(){
         var rosterid=$(this).data('rosterid');
         var isselected=$(this).data('isselected');
        
         if(isselected==0){
            
            $("#selectInvoice"+rosterid).removeClass("btn-success");
            $("#selectInvoice"+rosterid).addClass("btn-danger");
            $("#selectInvoice"+rosterid).data('isselected',1);
            document.getElementById("selectInvoice"+rosterid).innerText = 'Selected';
         }else{
            $("#selectInvoice"+rosterid).removeClass("btn-danger");
            $("#selectInvoice"+rosterid).addClass("btn-success");
            ("#selectInvoice"+rosterid).data('isselected',0);
            document.getElementById("selectInvoice"+rosterid).innerText = 'Not Selected';
        }
         
         
     });
 
});
    
    
    
 $(document).ready(function(){
     $(".Confirm").on('click',function(){
        var clientid=$(this).data('clientid');
        
        
        //console.log(clientid);
        
        var items=[];
        var empArr=[];
        var rosteridonly=[];
        var indexOfrosteridonly=0;
        var table=document.getElementById("selectedEmpTable"+clientid);
        var r=0;
        
        var arrayItem="";
        var rowOftable=0;
        var flag=false;
        while(row=table.rows[r++]){ 
            if(r!=1)
            {
               
                var empid=row.cells[0].innerHTML;
                var rosterid=$("."+"selectClient"+clientid+"row"+(r-1)).data('rosterid');
                var isSelected=$("."+"selectClient"+clientid+"row"+(r-1)).data('isselected');
                if(isSelected==1)
                {
                    items=  {"employeeid":empid, "rosterid":rosterid};
                    
                    empArr[r]=items;
                    rosteridonly[indexOfrosteridonly]=rosterid;
                    indexOfrosteridonly=indexOfrosteridonly+1;
                    flag=true;
                    //console.log(empid);
                    
                }
                
                
                
            }
           
        
        }
        
       
        
         if(!flag){
                alert("Please select the work to make invoice!");
            }
        
         $.post('<?php echo site_url('invoice/makeinvoice') ?>',
                {
                  rosterids:JSON.stringify(empArr),
                  clientid:clientid
                  
                },
                function(data) {
                    for(var i=0;i<rosteridonly.length;i++){
                        
                        $("#cancelInvoice"+rosteridonly[i]).removeClass("btn-success");
                        $("#cancelInvoice"+rosteridonly[i]).addClass("btn-danger");
                        $("#cancelInvoice"+rosteridonly[i]).data('iscancelled',0);
                        document.getElementById("cancelInvoice"+rosteridonly[i]).innerText = 'Invoice Sent';
                        //remove buton select
                        document.getElementById("selectInvoice"+rosteridonly[i]).innerText = 'View Invoice';
                        $("#selectInvoice"+rosteridonly[i]).hide();
                        $("#"+rosteridonly[i]).append('<a href="<?php echo site_url('invoice/download/'); ?>'+clientid+'/'+rosteridonly[i]+'"><button class="btn btn-danger btn-sm">View Invoice</button></a>');
                        
                        
                    }
                 
                        
                
                   
        });
         
     });
 
});


   
 $(document).ready(function(){
     $(".viewInvoice").on('click',function(){
        var rosterid=$(this).data('rosterid');
        var clientid=$(this).data('clientid');
        console.log(clientid+" "+rosterid);
        
         
     });
 
});



    
</script>