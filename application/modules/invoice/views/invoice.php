
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets/gentela');  ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/gentela');  ?>/build/css/custom.min.css" rel="stylesheet">
   
    
    <link href='https://fonts.googleapis.com/css?family=Black+Ops+One' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Fredericka+the+Great' rel='stylesheet' type='text/css'>

        <!-- jQuery -->
    <script src="<?php echo base_url('assets/gentela');  ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
<link href='https://fonts.googleapis.com/css?family=Black+Ops+One' rel='stylesheet' type='text/css'>

    
    <style>
 
 .rubber {
  box-shadow: 0 0 0 3px blue, 0 0 0 2px red inset;  
  border: 2px solid transparent;
  border-radius: 4px;
  display: inline-block;
  padding: 5px 2px;
  line-height: 22px;
  color: red;
  font-size: 24px;
  font-family: 'Black Ops One', cursive;
  text-transform: uppercase;
  text-align: center;
  opacity: 0.4;
  width: 155px;
  transform: rotate(-5deg);
}

</style>

    
<?php   

function calcHrs($date1,$date2){
//    $t1 = StrToTime ( '2006-04-14 11:30:00' );
//    $t2 = StrToTime ( '2006-04-12 12:30:00' );
    $t1 = StrToTime ($date1 );
    $t2 = StrToTime ($date2);
    $diff = abs($t1 - $t2);
    $hours = $diff / ( 60 * 60 );
    
    return round($hours,2);
       
}

function calcTotal($hrs,$rate){
    
    $total = (double)$hrs * (double)$rate;
    return round($total,2);
}

   


?>


<div class="right_col" role="main">
 
        <div class="clearfix"></div>

        
        <div class="col-md-12 " id="printme">
                <div class="x_panel" >

                  <div class="x_content" >
                                   

                    <section class="content invoice">
                    <div >
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          Invoice.
                                          <small class="pull-right">Date:<?php echo " ".date('Y-m-d', strtotime($invoice['createddate'])) ;  ?></small>
                            </h1>
                            
                            <p><span>PAID</span></p>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                                          <strong><?php echo ucfirst($user['first_name'])." ".ucfirst($user['last_name']  )?></strong>
                                          <br><?php echo $user['user_street']   ?>
                                          <br><?php echo $user['user_state'].", ".$user['user_suburb']   ?>
                                          <br><?php echo "Australia"   ?>
                                          <br>Phone: <?php echo $user['phone']  ?>
                                          <br>Email: <?php echo $user['email']  ?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                                          <strong><?php echo ucfirst($client['first_name'])." ".ucfirst($client['last_name']  )?></strong>
                                          <br><?php echo $client['user_street']   ?>
                                          <br><?php echo $client['user_state'].", ".$client['user_suburb']   ?>
                                          <br><?php echo "Australia"   ?>
                                          <br>Phone: <?php echo $client['phone']  ?>
                                          <br>Email: <?php echo $client['email']  ?>
                                      </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice <?php echo " ".$invoice['suffix'].sprintf('%05d',(int)$invoice['invoicerefid']);  ?></b>
                          <br>
                          <br>
                          <b>Payment Due:</b> <?php echo $invoice['duedate']  ?>
                          <br>
<!--                          <b>Account:</b> 968-34567-->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                  <th>S.N</th>
                                  <th>Staff</th>
                                  <th>Hours</th>
                                  <th>Rate</th>
                                  <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if(!empty($work)){ foreach ($work as $key => $value) {  ?>
                              <tr>
                                <td><?php echo ($key+1);   ?></td>
                                <td><?php echo $value['first_name']." ".$value['last_name']   ?></td>
                                <td><?php echo calcHrs($value['startdatetime'], $value['enddatetime'])  ?></td>
                                <td><?php echo $rate['currency']." ".$rate['rate']   ?></td>
                                <td><?php echo $rate['currency']." ".calcTotal(calcHrs($value['startdatetime'], $value['enddatetime']), $rate['rate']);   ?></td>
                              </tr>
                              
                              <?php  }} ?>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row">
                        <!-- accepted payments column -->
                       
                        <!-- /.col -->
                        <div class="col-xs-6">
                            
                          <p class="lead">Amount Due <?php echo date('Y-m-d', strtotime($invoice['createddate'])) ;  ?></p>
                          
                              <?php if($invoice['isPaymentDone']==1){ ?>
                          <div class="rubber">
                                    PAID VERIFIED
                            </div>
                          <?php }  ?>
                          
                          <div class="table-responsive">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <th style="width:50%">Subtotal:</th>
                                  <td><?php echo $rate['currency']." ".$subtotal;   ?></td>
                                </tr>
                                <tr>
                                  <th>Tax (9.3%):</th>
                                  <td><?php  echo $rate['currency']." ".$tax;   ?></td>
                                </tr>
                               
                                <tr>
                                  <th>Total:</th>
                                  <td><?php echo $rate['currency']." ".$total; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                     
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
<!--                            <button class="btn btn-success btn-sm" id="btnPrint">Downlaod</button>-->
<!--                          <button class="btn btn-success" onclick="window.print();"></span> Print</button>-->
<!--                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"></span>Generate PDF</button>-->
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
        
        <button class="btn btn-success btn-sm" id="btnPrint">Downlaod</button>
        <input type="text" hidden="" id="invoicename" value="<?php echo $invoice['suffix'].sprintf('%05d',(int)$invoice['invoicerefid']).'_'.ucfirst($client['first_name'])." ".ucfirst($client['last_name']  );  ?>">
   
</div>
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script type="text/javascript">
       
		$("#btnPrint").on("click", function () {
                   


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