<?php 

//print_r($this->session->all_userdata());



?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Invoice <small>List</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-bordered" id="selectedEmpTable">
                      <thead>
                        <tr>
                          <th>Invoice Reference ID</th>
                          <th>Name</th>
                          <th>Amount</th>
                          <th>Issued Date</th>
                          <th>Payment Date</th>
                          <th>Payment Status</th>
                          <th>Due Date</th>
                          <th>Action</th>
                          
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
                              <td>  <div id="<?php echo 'action'.$key;  ?>">
                                  <button class="btn-success btn-sm OpenInvoice" data-invoicerefid="<?php echo $value['invoicerefid']; ?>" data-clientid="<?php echo $value['clientid']; ?>">View Invoice</button>
                                  <a href="<?php echo site_url('invoice/download/').$value['clientid']."/".$value['invoicerefid'] ?>"><button class="btn-success btn-sm " data-invoicerefid="<?php echo $value['invoicerefid']; ?>" data-clientid="<?php echo $value['clientid']; ?>">Download</button></a>
                                  <?php 
                                  
                                    $Adminauthority=true;
                                    $isReceiptUploaded=false;
                                    if($this->session->userdata('rolename')=="Client" || $this->session->userdata('rolename')=="Employee"){
                                        $Adminauthority=false;
                                        
                                    }
                                    if($value['isReceptUploaded']==1 && $value['isPaymentDone']==0){
                                        $isReceiptUploaded=true;
                                        
                                    }
                                  
                                  if($Adminauthority && $isReceiptUploaded) {?>
                                  <button class="btn-danger btn-sm ConfirmPayment" data-invoicerefid="<?php echo $value['invoicerefid']; ?>" data-key="<?php echo $key; ?>" data-clientid="<?php echo $value['clientid']; ?>">Confirm Payment</button>
                                  <?php  } ?>
                                  <?php if($value['isReceptUploaded']==1) {?>
                                  <button class="btn-danger btn-sm viewReceipt"  data-invoicerefid="<?php echo $value['invoicerefid']; ?>" data-clientid="<?php echo $value['clientid']; ?>" data-piclink="<?php echo $value['receiptpic']; ?>">View Receipt</button>
                                  <?php  } ?>
                                   <?php if(($this->session->userdata('rolename')=="Client") && ($value['isReceptUploaded']==0)) {?>
                                  <button class="btn-danger btn-sm openuploadreceipt" onclick="return openReceiptModel('<?php echo $value['invoicerefid']?>','<?php echo $key ?>','<?php echo $value['clientid']; ?>')" data-toggle="modal" data-invoicerefid="<?php echo $value['invoicerefid']; ?>" data-key="<?php echo $key; ?>" data-clientid="<?php echo $value['clientid']; ?>">Upload Receipt</button>
                                  <?php  } ?>
                                  
                                  <div>
                              </td>
                          </tr>
                          <?php  }} ?>
                        
                      </tbody>
                    </table>
              
                  </div>
                </div>
              </div>
            
            
        </div>
       
          
        
            
    </div>
</div>




<div class="DemoModal2">

    <!-- Modal Contents -->
    <div id="ShowInvoice" class="modal fade "> <!-- class modal and fade -->
      
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          
           <div class="modal-header"> <!-- modal header -->
            <button type="button" class="close" 
             data-dismiss="modal" aria-hidden="true">×</button>
			 
                    <h4 class="modal-title">Invoice</h4>
           </div>
		 
     <div class="modalbody" id="modalbody"> <!-- modal body -->
       
     </div>
	 
     <div class="modal-footer"> <!-- modal footer -->
<!--       <button type="button" class="btn btn-default" data-dismiss="modal">Not Now!</button>
-->      <button type="button" id="btnPrint1" class="btn btn-primary">Download</button>
      </div>
				
      </div> <!-- / .modal-content -->
      
    </div> <!-- / .modal-dialog -->
      
 </div><!-- / .modal -->

 

 
<!-- Modal -->
<div id="uploadreceipt" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Receipt</h4>
        
      </div>
      <form enctype="multipart/form-data" id="modal_form_id"  method="POST" >
      <div class="modal-body">
          <label class="form-control">Browse receipt: </label>
          <input type="file" class="form-control" name="receipt" id="receipt">
          <input type="hidden" class="form-control" name="invoicerefid" id="invoicerefid">
          <input type="hidden" class="form-control" name="keyofaction" id="keyofaction">
          <input type="hidden" class="form-control" name="cid" id="cid">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger UploadReceipt" id="UploadReceipt" class="btn btn-primary">Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="showwreceipt" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Receipt</h4>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
                <img src="" id="receiptID" width="600px" height="700px">
            </div>
        </div>
      </div>
      
    </div>

  </div>
</div>
 
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    
    
<script type="text/javascript">
    
    

   
function openReceiptModel(invoicerefid,key,cid){
    $("#invoicerefid").val(invoicerefid);
    $("#keyofaction").val(key);
    $("#cid").val(cid);
    $("#uploadreceipt").modal(); 
}


$(document).ready(function(){
    $(".viewReceipt").on('click',function(){
       
       var clientid = $(this).data('clientid');
       var piclink =$(this).data('piclink');
       var link ='<?php echo base_url('uploads').'/receipts/users/';?>'+clientid+'/'+piclink;
       document.getElementById("receiptID").src = link;
       $("#showwreceipt").modal(); 
        
    });
});

function viewReceiptG(){
       
       $("#showwreceipt").modal(); 
}


$(document).ready(function(){
    $(".UploadReceipt").on('click',function(){
        
       
        var invoicerefid =$("#invoicerefid").val();
        var keyofaction= $("#keyofaction").val();
        var clientid = $("#cid").val();
        var postData = new FormData($("#modal_form_id")[0]);
        
        
        $.ajax({
            type:'POST',
            url:'<?php echo site_url('invoice/uploadreceipt') ?>',
            processData: false,
            contentType: false,
            data : postData,
            success:function(filename){
               
                var link ="<?php echo base_url('uploads').'/receipts/users/';?>"+clientid+'/'+filename.replace(/"/g, "");
                var method='viewReceiptG("'+link+'");';
                $(this).hide();
                $("#uploadreceipt").modal('hide')
                $("#action"+keyofaction).append('<button class="btn-danger btn-sm viewReceipt"  onclick="return '+method+'" >View Receipt</button>');
                $("#action"+keyofaction).find('button').on('click', viewReceiptG);
                document.getElementById("receiptID").src = link;
                
                
                }

            });

        });
    
});

$(document).ready(function(){
    $(".OpenInvoice").on('click',function(){
        
       
        var invoicerefid =$(this).data('invoicerefid');
        var clientid = $(this).data('clientid');
        
 
        $.post('<?php echo site_url('invoice/generateInvoice') ?>',
                {
                    invoicerefid:invoicerefid,
                    clientid:clientid

                },
                function(data) {
                   
                   document.getElementById("modalbody").innerHTML = data;
                   $("#ShowInvoice").modal(); 
                   $("#btnPrint").hide();
                   //console.log(data);
                });

        });
    
});

$(document).ready(function(){
    $(".ConfirmPayment").on('click',function(){
        
       
        var invoicerefid =$(this).data('invoicerefid');
        var clientid = $(this).data('clientid');
        var key = $(this).data('key');
 
        $.post('<?php echo site_url('invoice/confirmPayment') ?>',
                {
                    invoicerefid:invoicerefid,
                    clientid:clientid

                },
                function(data) {
                   
                  $(".ConfirmPayment").hide();
                  //$("#action"+key).append('<button class="btn-danger btn-sm OpenReceipt" data-invoicerefid="'+invoicerefid+'" data-clientid="'+clientid+'">View Receipt</button>');
                  
                });

        });
    
});


$("#btnPrint1").on("click", function () {
                   


                    var w = document.getElementById("printme").offsetWidth;
                    var h = document.getElementById("printme").offsetHeight;
                    html2canvas(document.getElementById("printme"), {
                      dpi: 300, // Set to 300 DPI
                      scale: 3, // Adjusts your resolution
                      onrendered: function(canvas) {
                        var img = canvas.toDataURL("image/jpeg", 1);
                        var doc = new jsPDF('L', 'px', [w, h]);
                        var invoicename =$("#invoicename").val();
                        doc.addImage(img, 'JPEG', 0, 0, w, h);
                        doc.save(invoicename+'.pdf');
                      }
                    });
		});

</script>