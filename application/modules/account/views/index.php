<?php 

$amtcollected=0.0;
$amtdue=0.0;
$total=0.0;

if(!empty($InvoiceList)){ 
    foreach ($InvoiceList as $key=> $value) { 
        if(($value['isPaymentDone']==1)){
            $amtcollected +=(double)$value['total'];
        }else{
            $amtdue +=(double)$value['total'];
        }
        $total+=(double)$value['total'];
    }

}



?>

  
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('assets')  ?>/xls/FileSaver.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('assets')  ?>/xls/tableExport.js"></script>
  <script type="text/javascript" src="<?php echo base_url('assets')  ?>/xls/xlsx.core.min.js"></script>
  

<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title ">
                      <div>
                          <h2>Account <small>List</small></h2>
                      </div>
<!--                      <div class="float-right">
                          <button class="btn btn-success float-right" onclick="exportTableToExcel('tblData', 'Report')">Export To Excel File</button>
                    
                      </div>-->

                     <div id="datatable-buttons_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                         <div class="dt-buttons btn-group">
                             
                             
                             <a class="btn btn-default buttons-print btn-sm" tabindex="0" aria-controls="datatable-buttons" href="#"><span onclick="exportTableToExcel('tblData', 'Report')">Export To Excel File</span></a>
                         </div>
                         <div id="datatable-buttons_filter" class="dataTables_filter">
                             
                             <form method="post" action="account"> 
                                 <input type="date" name="start" class="form-control input-sm floatLeft datetime" placeholder="Start Date" aria-controls="datatable-buttons">
                                <input type="date" name="end"  class="form-control input-sm floatLeft datetime" placeholder="End Date" aria-controls="datatable-buttons">
                                <input type="submit" value="Search" class="form-control input-sm bg-blue" placeholder="" aria-controls="datatable-buttons">
                            </form>
                         </div>
                         
                         
                    
                    <div class="clearfix"></div>
                    
                  </div>
                  <div class="x_content">
                      
                      <table class="table table-bordered" id="tblData" >
                      <thead>
                        <tr>
                          <th>Invoice Reference ID</th>
                          <th>Name</th>
                          <th>Amount</th>
                          <th>Issued Date</th>
                          <th>Payment Date</th>
                          <th>Payment Status</th>
                          <th>Due Date</th>
                         
                          
                        </tr>
                      </thead>
                      <tbody>
                          <?php if(!empty($InvoiceList)){ foreach ($InvoiceList as $key=> $value) { ?>
                          <tr>
                              <td>  <?php echo $value['suffix'].sprintf('%05d',(int)$value['invoicerefid']); ?> </td>
                              <td>  <?php echo $value['first_name']." ".$value['last_name'];  ?> </td>
                              <td>  <?php echo "AUD ".$value['total'] ?> </td>
                              <td>  <?php echo $value['createddate'] ?> </td>
                              <td>  <?php echo ($value['isPaymentDone']==1)?$value['paymentdate']:"Not Paid Yet";  ?> </td>
                              <td>  <?php echo ($value['isPaymentDone']==1)?"Yes":"No"; ?> </td>
                              <td>  <?php echo $value['duedate'] ?> </td>
         
                          </tr>
                          <?php  }} ?>
                          
                          <tr>
                              <td>Amount Collected</td>
                              <td>AUD<?php echo " ". round($amtcollected,2) ?></td>
                          </tr>
                          <tr>
                              <td>Due Amount</td>
                              <td>AUD<?php echo " ". round($amtdue,2) ?></td>
                          </tr>
                          <tr>
                              <td>Total Collection</td>
                              <td>AUD<?php echo " ". round($total,2) ?></td>
                          </tr>
                        
                      </tbody>
                    </table>
              
                  </div>
                </div>
              </div>
            
            
        </div>
       
       
            
    </div>
</div>
        
<script type="text/javascript">
$(".datetime").datetimepicker({
    format: 'yyyy-mm-dd hh:ii'
});
 </script>

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