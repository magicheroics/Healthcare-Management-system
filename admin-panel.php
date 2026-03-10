<!DOCTYPE html>
<?php 
include('func.php');  
include('newfunc.php');
$con=mysqli_connect("localhost","root","","myhmsdb");

  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $gender = $_SESSION['gender'];
  $lname = $_SESSION['lname'];
  $contact = $_SESSION['contact'];

if(isset($_POST['app-submit']))
{
  $pid = $_SESSION['pid'];
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $gender = $_SESSION['gender'];
  $contact = $_SESSION['contact'];
  $doctor=$_POST['doctor'];
  $email=$_SESSION['email'];
  $docFees=$_POST['docFees'];

  $appdate=$_POST['appdate'];
  $apptime=$_POST['apptime'];
  $cur_date = date("Y-m-d");
  date_default_timezone_set('Asia/Kolkata');
  $cur_time = date("H:i:s");
  $apptime1 = strtotime($apptime);
  $appdate1 = strtotime($appdate);
  
  if(date("Y-m-d",$appdate1)>=$cur_date){
    if((date("Y-m-d",$appdate1)==$cur_date and date("H:i:s",$apptime1)>$cur_time) or date("Y-m-d",$appdate1)>$cur_date) {
      $check_query = mysqli_query($con,"select apptime from appointmenttb where doctor='$doctor' and appdate='$appdate' and apptime='$apptime'");

        if(mysqli_num_rows($check_query)==0){
          $query=mysqli_query($con,"insert into appointmenttb(pid,fname,lname,gender,email,contact,doctor,docFees,appdate,apptime,userStatus,doctorStatus) values($pid,'$fname','$lname','$gender','$email','$contact','$doctor','$docFees','$appdate','$apptime','1','1')");

          if($query)
          {
            echo "<script>alert('Your appointment successfully booked');</script>";
          }
          else{
            echo "<script>alert('Unable to process your request. Please try again!');</script>";
          }
      }
      else{
        echo "<script>alert('We are sorry to inform that the doctor is not available in this time or date. Please choose different time or date!');</script>";
      }
    }
    else{
      echo "<script>alert('Select a time or date in the future!');</script>";
    }
  }
  else{
      echo "<script>alert('Select a time or date in the future!');</script>";
  }
}

if(isset($_GET['cancel']))
  {
    $query=mysqli_query($con,"update appointmenttb set userStatus='0' where ID = '".$_GET['ID']."'");
    if($query)
    {
      echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
  }

// --- START OF IMPROVED BILL GENERATION ---
function generate_bill(){
  $con=mysqli_connect("localhost","root","","myhmsdb");
  $pid = $_SESSION['pid'];
  $output='';
  
  $query=mysqli_query($con,"select p.pid, p.ID, p.fname, p.lname, p.doctor, p.appdate, p.apptime, p.disease, p.allergy, p.prescription, a.docFees 
                            from prestb p 
                            inner join appointmenttb a on p.ID=a.ID 
                            where p.pid = '$pid' and p.ID = '".$_GET['ID']."'");
  
  while($row = mysqli_fetch_array($query)){
    
    // Format fees
    $fees = number_format($row['docFees'], 2);
    
    // Professional Invoice Layout
    $output .= '
    <style>
      table {
        width: 100%;
        border-collapse: collapse;
      }
      .header-title {
        font-size: 24px;
        font-weight: bold;
        color: #00c6ff;
      }
      .invoice-info {
        font-size: 12px;
        color: #555;
      }
      .table-header {
        background-color: #00c6ff;
        color: #fff;
        font-weight: bold;
        text-align: center;
      }
      .table-row td {
        border-bottom: 1px solid #ddd;
        padding: 10px;
        font-size: 12px;
      }
      .total-row {
        font-weight: bold;
        font-size: 14px;
        background-color: #f9f9f9;
      }
    </style>

    <table cellpadding="5">
      <tr>
        <td width="60%">
          <span class="header-title">Apex Medical Institute</span><br>
          <span class="invoice-info">
            Nairobi, Kenya<br>
            Phone: +254 712 345678<br>
            Email: billing@apexmedical.com
          </span>
        </td>
        <td width="40%" align="right">
          <span style="font-weight: bold; font-size: 16px;">INVOICE</span><br>
          Invoice #: INV-'.$row["ID"].'<br>
          Date: '.date("d-m-Y").'
        </td>
      </tr>
    </table>
    
    <hr color="#00c6ff" size="1">
    <br><br>

    <table cellpadding="5">
      <tr>
        <td width="50%">
          <strong>Patient Details:</strong><br>
          Name: '.$row["fname"].' '.$row["lname"].'<br>
          Patient ID: '.$row["pid"].'<br>
          Appointment Date: '.$row["appdate"].'
        </td>
        <td width="50%" align="right">
          <strong>Doctor Details:</strong><br>
          Dr. '.$row["doctor"].'<br>
          Time: '.$row["apptime"].'
        </td>
      </tr>
    </table>

    <br><br>

    <table border="1" cellpadding="8">
      <thead>
        <tr class="table-header">
          <th width="10%">#</th>
          <th width="60%">Description</th>
          <th width="30%">Amount (Ksh)</th>
        </tr>
      </thead>
      <tbody>
        <tr class="table-row">
          <td align="center">1</td>
          <td>Professional Consultancy Fees</td>
          <td align="right">'.$fees.'</td>
        </tr>
        <tr class="total-row">
          <td colspan="2" align="right"><strong>TOTAL AMOUNT:</strong></td>
          <td align="right"><strong>'.$fees.'</strong></td>
        </tr>
      </tbody>
    </table>

    <br><br>
    
    <h4>Medical Notes:</h4>
    <p style="font-size:12px;">
      <strong>Condition:</strong> '.$row["disease"].'<br>
      <strong>Prescription:</strong> '.$row["prescription"].'
    </p>

    <br><br><br>
    <hr>
    <p align="center" style="font-size:10px; color:#777;">This is a computer-generated receipt and does not require a physical signature.</p>
    ';
  }
  return $output;
}

if(isset($_GET["generate_bill"])){
  require_once("TCPDF/tcpdf.php");
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $obj_pdf->SetCreator(PDF_CREATOR);
  $obj_pdf->SetTitle("Apex Medical - Invoice");
  $obj_pdf->setPrintHeader(false);
  $obj_pdf->setPrintFooter(false);
  $obj_pdf->SetMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
  $obj_pdf->SetAutoPageBreak(TRUE, 10);
  $obj_pdf->SetFont('helvetica', '', 12);
  $obj_pdf->AddPage();
  $content = generate_bill();
  $obj_pdf->writeHTML($content);
  ob_end_clean();
  $obj_pdf->Output("Invoice_ApexMedical.pdf", 'I');
}
// --- END OF IMPROVED BILL GENERATION ---

function get_specs(){
  $con=mysqli_connect("localhost","root","","myhmsdb");
  $query=mysqli_query($con,"select username,spec from doctb");
  $docarray = array();
    while($row =mysqli_fetch_assoc($query))
    {
        $docarray[] = $row;
    }
    return json_encode($docarray);
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/comp.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <a class="navbar-brand" href="#"><i class="fa fa-heartbeat" aria-hidden="true"></i> Apex Medical Institute </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
           <li class="nav-item">
            <a class="nav-link" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
        </ul>
      </div>
    </nav>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'IBM Plex Sans', sans-serif;
        }
        .bg-primary {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            opacity: 1 !important;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .navbar-nav .nav-link:hover {
            color: #ffdddd !important;
        }
        h3 {
            font-family: 'IBM Plex Sans', sans-serif; 
            color: #495057; 
            font-weight: bold;
            text-transform: uppercase;
        }
        .list-group-item {
            border: none;
            border-radius: 0.5rem !important;
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
            transition: all 0.3s ease;
        }
        .list-group-item:hover {
            background-color: #f0f8ff;
            color: #00c6ff;
            padding-left: 25px;
        }
        .list-group-item.active {
            background-color: #00c6ff !important;
            border-color: #00c6ff !important;
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
        }
        .panel {
            border: none;
            border-radius: 1rem;
            background: #ffffff;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            padding: 30px 10px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        .panel:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 198, 255, 0.2);
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .table thead th {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            color: white;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            padding: 15px;
            font-size: 0.9rem;
        }
        .table thead th:first-child { border-top-left-radius: 10px; }
        .table thead th:last-child { border-top-right-radius: 10px; }
        .table tbody tr:hover {
            background-color: #f0f8ff;
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            z-index: 2;
            position: relative;
        }
        .form-control {
            border-radius: 0.5rem;
            height: 45px;
            border: 1px solid #e3e3e3;
            box-shadow: none;
        }
        .form-control:focus {
            border-color: #00c6ff;
            box-shadow: 0 0 0 0.2rem rgba(0, 198, 255, 0.25);
        }
        .btn-primary {
            background-color: #00c6ff;
            border-color: #00c6ff;
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
            border-radius: 20px;
            padding: 10px 30px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #0099cc;
            border-color: #0099cc;
        }
        .fa-stack-2x { color: #00c6ff !important; }
        .fa-inverse { color: #fff !important; }
        .cl-effect-1 a {
            color: #00c6ff;
            font-weight: bold;
            text-decoration: none;
        }
        .cl-effect-1 a:hover {
            text-decoration: underline;
        }
    </style>
  </head>

  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Welcome &nbsp<?php echo $username ?> </h3>
    
    <div class="row">
      <div class="col-md-3" style="margin-top: 2%;">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list" href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
          <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Book Appointment</a>
          <a class="list-group-item list-group-item-action" href="#app-hist" id="list-pat-list" role="tab" data-toggle="list" aria-controls="home">Appointment History</a>
          <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home">Prescriptions</a>
        </div><br>
      </div>

      <div class="col-md-9" style="margin-top: 2%;">
        <div class="tab-content" id="nav-tabContent">

          <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
            <div class="container-fluid container-fullw bg-white" >
              <div class="row">
               <div class="col-sm-4">
                  <div class="panel text-center">
                    <div class="panel-body">
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 15px; font-weight: bold;">Book Appointment</h4>
                      <script>
                        function clickDiv(id) {
                          document.querySelector(id).click();
                        }
                      </script>                      
                      <p class="links cl-effect-1">
                        <a href="#list-home" onclick="clickDiv('#list-home-list')">
                          Book Now <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="panel text-center">
                    <div class="panel-body" >
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 15px; font-weight: bold;">My History</h4>
                      <p class="cl-effect-1">
                        <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                          View History <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="panel text-center">
                    <div class="panel-body" >
                      <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                      <h4 class="StepTitle" style="margin-top: 15px; font-weight: bold;">Prescriptions</h4>
                      <p class="cl-effect-1">
                        <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                          View List <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </p>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

      <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <center><h4 style="color:#00c6ff; margin-bottom: 30px;">Create an Appointment</h4></center>
              <form class="form-group" method="post" action="admin-panel.php">
                <div class="row">
                    <div class="col-md-4"><label for="spec">Specialization:</label></div>
                    <div class="col-md-8">
                      <select name="spec" class="form-control" id="spec">
                          <option value="" disabled selected>Select Specialization</option>
                          <?php display_specs(); ?>
                      </select>
                    </div>
                    <br><br>

                    <script>
                      document.getElementById('spec').onchange = function foo() {
                        let spec = this.value;   
                        console.log(spec)
                        let docs = [...document.getElementById('doctor').options];
                        docs.forEach((el, ind, arr)=>{
                          arr[ind].setAttribute("style","");
                          if (el.getAttribute("data-spec") != spec ) {
                            arr[ind].setAttribute("style","display: none");
                          }
                        });
                      };
                    </script>

                    <div class="col-md-4"><label for="doctor">Doctors:</label></div>
                    <div class="col-md-8">
                        <select name="doctor" class="form-control" id="doctor" required="required">
                          <option value="" disabled selected>Select Doctor</option>
                          <?php display_docs(); ?>
                        </select>
                    </div><br/><br/> 

                    <script>
                      document.getElementById('doctor').onchange = function updateFees(e) {
                        var selection = document.querySelector(`[value=${this.value}]`).getAttribute('data-value');
                        document.getElementById('docFees').value = selection;
                      };
                    </script>
                  
                    <div class="col-md-4"><label for="consultancyfees">Consultancy Fees</label></div>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="docFees" id="docFees" readonly="readonly" placeholder="Fees will appear here"/>
                    </div><br><br>

                    <div class="col-md-4"><label>Appointment Date</label></div>
                    <div class="col-md-8"><input type="date" class="form-control datepicker" name="appdate"></div><br><br>

                    <div class="col-md-4"><label>Appointment Time</label></div>
                    <div class="col-md-8">
                      <select name="apptime" class="form-control" id="apptime" required="required">
                        <option value="" disabled selected>Select Time</option>
                        <option value="08:00:00">8:00 AM</option>
                        <option value="10:00:00">10:00 AM</option>
                        <option value="12:00:00">12:00 PM</option>
                        <option value="14:00:00">2:00 PM</option>
                        <option value="16:00:00">4:00 PM</option>
                      </select>
                    </div><br><br>

                    <div class="col-md-12 text-center" style="margin-top: 20px;">
                      <input type="submit" name="app-submit" value="Book Appointment" class="btn btn-primary" id="inputbtn">
                    </div>              
                </div>
              </form>
            </div>
          </div>
        </div><br>
      </div>
      
      <div class="tab-pane fade" id="app-hist" role="tabpanel" aria-labelledby="list-pat-list">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Doctor Name</th>
              <th scope="col">Consultancy Fees</th>
              <th scope="col">Appointment Date</th>
              <th scope="col">Appointment Time</th>
              <th scope="col">Current Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $con=mysqli_connect("localhost","root","","myhmsdb");
              global $con;
              $query = "select ID,doctor,docFees,appdate,apptime,userStatus,doctorStatus from appointmenttb where fname ='$fname' and lname='$lname';";
              $result = mysqli_query($con,$query);
              while ($row = mysqli_fetch_array($result)){
            ?>
                <tr>
                  <td><?php echo $row['doctor'];?></td>
                  <td><?php echo $row['docFees'];?></td>
                  <td><?php echo $row['appdate'];?></td>
                  <td><?php echo $row['apptime'];?></td>
                  <td>
                    <?php 
                    if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { echo "Active"; }
                    if(($row['userStatus']==0) && ($row['doctorStatus']==1)) { echo "Cancelled by You"; }
                    if(($row['userStatus']==1) && ($row['doctorStatus']==0)) { echo "Cancelled by Doctor"; }
                    ?>
                  </td>
                  <td>
                    <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                      <a href="admin-panel.php?ID=<?php echo $row['ID']?>&cancel=update" 
                        onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                        title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">
                        <button class="btn btn-danger">Cancel</button>
                      </a>
                    <?php } else { echo "Cancelled"; } ?>
                  </td>
                </tr>
              <?php } ?>
          </tbody>
        </table>
        <br>
      </div>

      <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Doctor Name</th>
              <th scope="col">Appt ID</th>
              <th scope="col">Date</th>
              <th scope="col">Time</th>
              <th scope="col">Diseases</th>
              <th scope="col">Allergies</th>
              <th scope="col">Prescriptions</th>
              <th scope="col">Bill Payment</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $con=mysqli_connect("localhost","root","","myhmsdb");
              global $con;
              $query = "select doctor,ID,appdate,apptime,disease,allergy,prescription from prestb where pid='$pid';";
              $result = mysqli_query($con,$query);
              if(!$result){ echo mysqli_error($con); }
              while ($row = mysqli_fetch_array($result)){
            ?>
                <tr>
                  <td><?php echo $row['doctor'];?></td>
                  <td><?php echo $row['ID'];?></td>
                  <td><?php echo $row['appdate'];?></td>
                  <td><?php echo $row['apptime'];?></td>
                  <td><?php echo $row['disease'];?></td>
                  <td><?php echo $row['allergy'];?></td>
                  <td><?php echo $row['prescription'];?></td>
                  <td>
                    <form method="get">
                      <a href="admin-panel.php?ID=<?php echo $row['ID']?>">
                        <input type ="hidden" name="ID" value="<?php echo $row['ID']?>"/>
                        <input type = "submit" onclick="alert('Bill Paid Successfully');" name ="generate_bill" class = "btn btn-success" value="Pay Bill"/>
                      </a>
                    </form>
                  </td>
                </tr>
              <?php } ?>
          </tbody>
        </table>
        <br>
      </div>

    </div>
  </div>
</div>
   </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
  </body>
</html>