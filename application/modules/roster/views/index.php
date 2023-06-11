

<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        
        <div class="row">

            <div class="col-md-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Search Availables <small>Employees</small></h2>

                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <br>


                          <div class="col-md-4 form-group has-feedback">
                            <select id="client" name="roleid" class="form-control"  required="required">
                                  <option value="0">Select Client</option>
                                  <?php  if($client){ foreach ($client as $key => $value) {  ?>
                                        <option value="<?php echo $value['id']  ?>" class="form-control" ><?php echo "Name: ".$value['first_name']." ".$value['last_name']." of Company: ".$value['companyname']?></option>
                                    <?php } } ?>

                            </select>
                          </div>

                          <div class="col-md-3 form-group has-feedback">
                           
                              <input size="16" type="text" class="form-control datetime" id="startdatetime" name="startdatetime" placeholder="Start Date and Time">
            
                              <span class=" glyphicon glyphicon-time form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        <div class="col-md-3 form-group has-feedback">
                           
                              <input size="16" type="text" class="form-control datetime" id="enddatetime" placeholder="End Date and Time" name="enddatetime">
            
                            <span class=" glyphicon glyphicon-time form-control-feedback right" aria-hidden="true"></span>
                          </div>
                        
                         <div class="col-md-3 form-group has-feedback">
                             <button type="button" class="btn btn-primary form-control searchButton">Search Employees</button>
                             <span class=" glyphicon glyphicon-search form-control-feedback right" aria-hidden="true"></span>
                          </div>




                          


                      </div>
                    </div>


                  </div>

           
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Selected <small>Employees</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-bordered" id="selectedEmpTable">
                      <thead>
                        <tr>
                          <th>Employee ID</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Start Date and Time</th>
                          <th>End Date and Time</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                       
                        
                      </tbody>
                    </table>
                      
                      <button class="btn btn-success confirmBtn invisible" > Confirm the Employees</button>

                  </div>
                </div>
              </div>
            
            
        </div>
       
           <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Available <small>Employees</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-bordered" id="avaiEmpTable">
                      <thead>
                        <tr>
                          <th>S.N</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Details</th>
                          <th>Status</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php if(!empty($availEmployee)){ foreach ($availEmployee as $key => $value) {  ?>
                        <tr>
                          <th scope="row"><?php $key++; echo ($key); ?></th>
                          <td><?php echo $value['first_name']; ?></td>
                          <td><?php echo $value['last_name'] ?></td>
                          <td></td>
                          <td><button class="btnSelect btn btn-success" id="btnSelect<?php echo $value['id'] ?>" data-employeeid="<?php echo $value['id'] ?>">Select Employee</button></td>
                          
                          
                        </tr>
                        <?php  }}  ?>
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


$(document).ready(function(){
     $(".searchButton").on('click',function(){
         
         var start =$("#startdatetime").val();
         var end =$("#enddatetime").val();
         // check dates
        
        if(start == '' || end == ''){
            alert("Please Check start and end dates");
            return false;
        }
        
        $('#avaiEmpTable tr').not($('#avaiEmpTable tr:first')).remove();
         
         $.post('<?php echo site_url('roster/getRoster') ?>',
                {
                  start:start,
                  end:end
                },
                function(data) {
                    
                    console.log(data);
                    
                    if(data=="false"){
                        alert("End date and Start date should be greater than todays time!");
                    }
                    var obj = jQuery.parseJSON(data );
                   
                    $.each(obj, function (index, value) {
                        //console.log(value.username);
                      
                        var table = document.getElementById("avaiEmpTable");
                        var countRowSelected = $('#avaiEmpTable tr').length;
                        var row = table.insertRow(countRowSelected);

                        row.insertCell(0).innerHTML=countRowSelected;
                        row.insertCell(1).innerHTML=value.first_name;
                        row.insertCell(2).innerHTML=value.last_name;
                        row.insertCell(3).innerHTML=" ";
                        row.insertCell(4).innerHTML='<button class="btnSelect btn btn-success" id="btnSelect'+value.id+'" data-employeeid="'+value.id+'">Select Employee</button>';

                       
                      });
                   
                });
         
     });
 
});



$(document).ready(function(){
    $(".confirmBtn").on('click',function(){
        
        
        var clientid=$("#client").val();
       
        if(clientid==0){
            alert("Please Select Client to whom you are asssigning Employee!");
            return false;
        }
        var items=[];
        var empArr=[];
        var table=document.getElementById("selectedEmpTable");
        var r=0;
        
        var arrayItem="";
        while(row=table.rows[r++]){ 
            if(r!=1){
            
                var empid=row.cells[0].innerHTML;
                var start=row.cells[3].innerHTML;
                var end=row.cells[4].innerHTML;
                if(start=='' || end==''){
                    alert("Please Check dates");
                    break;
                    return false;
                }

                items=  {"employeeid":empid, "start":start,"end":end};
           
                empArr[r]=items;
            }
        
        }
//        console.log(empArr);
        $.post('<?php echo site_url('roster/addRoster') ?>',
                {
                    employees: JSON.stringify(empArr),
                    clientid:clientid

                },
                function(data) {
                    
                    $('#selectedEmpTable tr').not($('#selectedEmpTable tr:first')).remove();
                    $('#avaiEmpTable tr').not($('#avaiEmpTable tr:first')).remove();
                    $("#client").val('0');
                    $("#startdatetime").val('');
                    $("#enddatetime").val('');
                    //end
                    alert("Sucessfully Employee assigned to Client");
                });

        });
    
});







$(document).ready(function(){

    // code to read selected table row cell data (values).
    $("#avaiEmpTable").on('click','.btnSelect',function(){
      
        // check dates
        var start=$("#startdatetime").val();
        var end=$("#enddatetime").val();
       
        if(start == '' || end == ''){
            alert("Please Check start and end dates");
            return false;
        }
        // get the current row
         var currentRow=$(this).closest("tr"); 
         
         var col1=currentRow.find("td:eq(0)").html(); // get current row 1st table cell TD value
         var col2=currentRow.find("td:eq(1)").html(); // get current row 2nd table cell TD value
         var col3=currentRow.find("td:eq(2)").html(); // get current row 3rd table cell  TD value
         
         var data=col1+"\n"+col2+"\n"+col3;
         
         var employeeid= $(this).data('employeeid');
         
        //$("#btnSelect"+employeeid).val('newButtonValue');
         var btn="btnSelect"+employeeid;
         document.getElementById(btn).innerText = 'Selected';
         $("#"+btn).removeClass("btn-success");
         $("#"+btn).addClass("btn-warning");
         
         console.log(employeeid);
         
         
         
         //check double entry
         if(checkEntry(employeeid)){
             alert("Already added!");
             return false;
         }
         //selected
        var countRowSelected = $('#selectedEmpTable tr').length;
        if(countRowSelected!=0){
            $(".confirmBtn").removeClass("invisible");
        }
       
        //console.log(countRowSelected);


        var table = document.getElementById("selectedEmpTable");
        var row = table.insertRow(1);
        row.insertCell(0).innerHTML=employeeid;
        row.insertCell(1).innerHTML=col2;
        row.insertCell(2).innerHTML=col3;
        row.insertCell(3).innerHTML=$("#startdatetime").val();
        row.insertCell(4).innerHTML=$("#enddatetime").val();
        row.insertCell(5).innerHTML='<button class="btnRemove btn btn-danger" id="btnRemove'+employeeid+'" data-employeeid="'+employeeid+'">Remove</button>';
        
         
    });
});


$(document).ready(function(){

    // code to read selected table row cell data (values).
    $("#selectedEmpTable").on('click','.btnRemove',function(){
         // get the current row
         var currentRow=$(this).closest("tr"); 
         $(this).closest("tr").remove();
         
        var countRowSelected = $('#selectedEmpTable tr').length;
        console.log("L: "+countRowSelected);
        
        //change button color and name in available table
         var employeeid= $(this).data('employeeid');
         var btn="btnSelect"+employeeid;
         document.getElementById(btn).innerText = 'Select Employee';
         $("#"+btn).addClass("btn-success");
         $("#"+btn).removeClass("btn-warning");
        
        if(countRowSelected==1){
            $(".confirmBtn").addClass("invisible");
        }
         
        
         
    });
});

function checkEntry(id){
    var table = document.getElementById("selectedEmpTable");
    
//    if($('#selectedEmpTable tr').length !=1){
//       
////         if(table.cells[0].innerHTML==id){
////            
////             
////         }
//    
//    }

    var table=document.getElementById("selectedEmpTable");
    var r=0;
    while(row=table.rows[r++])
    {
      var c=0;
      while(cell=row.cells[c++])
      {
          console.log(row.cells[0].innerHTML);
        if(cell.innerHTML==id){
            
            return true;
        }
        
      }
    }
    return false;
    //console.log(table.cells[0].innerHTML);
    
}


</script>