<!DOCTYPE html>
<?php 
include('func1.php');
$con=mysqli_connect("localhost","root","","myhmsdb");
$doctor = $_SESSION['dname'];

// --- 1. LOGIC: CANCEL APPOINTMENT ---
if(isset($_GET['cancel']))
{
    $query=mysqli_query($con,"update appointmenttb set doctorStatus='0' where ID = '".$_GET['ID']."'");
    if($query)
    {
        echo "<script>alert('Your appointment successfully cancelled');</script>";
    }
}

// --- 2. LOGIC: COMPLETE APPOINTMENT (New Feature) ---
if(isset($_GET['complete']))
{
    $query=mysqli_query($con,"update appointmenttb set doctorStatus='2' where ID = '".$_GET['ID']."'");
    if($query)
    {
        echo "<script>alert('Appointment marked as Completed');</script>";
    }
}

// --- 3. LOGIC: UPDATE PRESCRIPTION ---
if(isset($_POST['update_pres']))
{
    $disease = $_POST['disease'];
    $allergies = $_POST['allergies'];
    $prescription = $_POST['prescription'];
    $presID = $_POST['presID'];

    $query = mysqli_query($con,"UPDATE prestb SET disease='$disease', allergy='$allergies', prescription='$prescription' WHERE ID='$presID'");
    if($query)
    {
        echo "<script>alert('Prescription Updated Successfully');</script>";
    }
    else {
        echo "<script>alert('Unable to update. Please try again.');</script>";
    }
}

// --- 4. LOGIC: TAB MANAGEMENT ---
// Default: Dashboard is active
$tab_dash = "active show";
$tab_app = "";
$tab_pres = "";
$tab_prof = "";

// If editing or updating, make Prescription tab active
if(isset($_GET['pres_edit']) || isset($_POST['update_pres'])) {
    $tab_dash = "";
    $tab_pres = "active show";
}
// If cancelling or completing appointment, keep Appointment tab active
if(isset($_GET['cancel']) || isset($_GET['complete'])) {
    $tab_dash = "";
    $tab_app = "active show";
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/comp.png" />
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
            <a class="nav-link" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="#"></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="search.php">
          <input class="form-control mr-sm-2" type="text" placeholder="Enter contact number" aria-label="Search" name="contact">
          <input type="submit" class="btn btn-primary" id="inputbtn" name="search_submit" value="Search" style="border: 1px solid white;">
        </form>
      </div>
    </nav>
  </head>

  <style >
    body { background-color: #f8f9fa; font-family: 'IBM Plex Sans', sans-serif; }
    h3 { font-family: 'IBM Plex Sans', sans-serif; color: #495057; font-weight: bold; text-transform: uppercase; }
    .bg-primary { background: -webkit-linear-gradient(left, #3931af, #00c6ff); }
    .navbar-nav .nav-link { color: #fff !important; opacity: 1 !important; font-weight: 600; font-size: 1.1rem; }
    .navbar-nav .nav-link:hover { color: #ffdddd !important; }
    .list-group-item { border: none; border-radius: 0.5rem !important; margin-bottom: 5px; font-weight: 600; color: #495057; transition: all 0.3s ease; }
    .list-group-item:hover { background-color: #f0f8ff; color: #00c6ff; padding-left: 25px; }
    .list-group-item.active { background-color: #00c6ff !important; border-color: #00c6ff !important; box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4); }
    .panel { border: none; border-radius: 1rem; background: #ffffff; box-shadow: 0 10px 20px rgba(0,0,0,0.05); padding: 30px 10px; margin-bottom: 30px; transition: transform 0.3s ease; animation: fadeInUp 0.8s both; }
    .panel:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0, 198, 255, 0.2); }
    .card { border: none; border-radius: 1rem; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .table thead th { background: -webkit-linear-gradient(left, #3931af, #00c6ff); color: white; border: none; font-weight: 600; text-transform: uppercase; font-size: 0.9rem; padding: 15px; }
    .table thead th:first-child { border-top-left-radius: 10px; }
    .table thead th:last-child { border-top-right-radius: 10px; }
    .table tbody tr:hover { background-color: #f0f8ff; transform: scale(1.01); box-shadow: 0 5px 15px rgba(0,0,0,0.1); z-index: 2; position: relative; }
    .btn-primary { background-color: #00c6ff; border-color: #00c6ff; box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4); border-radius: 20px; }
    .btn-primary:hover { background-color: #0099cc; border-color: #0099cc; }
    .fa-stack-2x { color: #00c6ff !important; }
    .fa-inverse { color: #fff; }
    .links a { color: #00c6ff; font-weight: bold; }
    @keyframes fadeInUp { from { opacity: 0; transform: translate3d(0, 20px, 0); } to { opacity: 1; transform: none; } }
  </style>

  <body style="padding-top:50px;">
   <div class="container-fluid" style="margin-top:50px;">
    <h3 style = "margin-left: 40%; padding-bottom: 20px;"> Welcome &nbsp<?php echo $_SESSION['dname'] ?>  </h3>
    
    <div class="row">
      <div class="col-md-3" style="margin-top: 2%;">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action <?php echo $tab_dash; ?>" href="#list-dash" role="tab" aria-controls="home" data-toggle="list">Dashboard</a>
          <a class="list-group-item list-group-item-action <?php echo $tab_app; ?>" href="#list-app" id="list-app-list" role="tab" data-toggle="list" aria-controls="home">Appointments</a>
          <a class="list-group-item list-group-item-action <?php echo $tab_pres; ?>" href="#list-pres" id="list-pres-list" role="tab" data-toggle="list" aria-controls="home"> Prescription List</a>
          <a class="list-group-item list-group-item-action <?php echo $tab_prof; ?>" href="#list-profile" id="list-profile-list" role="tab" data-toggle="list" aria-controls="home">My Profile</a>
        </div><br>
      </div>

      <div class="col-md-9" style="margin-top: 2%;">
        <div class="tab-content" id="nav-tabContent">
          
          <div class="tab-pane fade <?php echo $tab_dash; ?>" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
              <div class="container-fluid container-fullw bg-white" >
                <div class="row">
                  <div class="col-sm-6">
                      <div class="panel text-center">
                        <div class="panel-body">
                          <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-calendar fa-stack-1x fa-inverse"></i> </span>
                          <h4 class="StepTitle" style="margin-top: 15px; font-weight: bold;"> View Appointments</h4>
                          <script>
                            function clickDiv(id) {
                              document.querySelector(id).click();
                            }
                          </script>                      
                          <p class="links cl-effect-1">
                            <a href="#list-app" onclick="clickDiv('#list-app-list')">
                              View Appointment List <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </p>
                        </div>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="panel text-center">
                        <div class="panel-body">
                          <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-list-ul fa-stack-1x fa-inverse"></i> </span>
                          <h4 class="StepTitle" style="margin-top: 15px; font-weight: bold;"> Prescriptions</h4>
                          <p class="links cl-effect-1">
                            <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                              View Prescription List <i class="fa fa-arrow-circle-right"></i>
                            </a>
                          </p>
                        </div>
                      </div>
                  </div>    
               </div>
             </div>
          </div>
    
          <div class="tab-pane fade <?php echo $tab_app; ?>" id="list-app" role="tabpanel" aria-labelledby="list-home-list">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Patient ID</th>
                    <th scope="col">Appt ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col">Prescribe</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $con=mysqli_connect("localhost","root","","myhmsdb");
                    global $con;
                    $dname = $_SESSION['dname'];
                    $query = "select pid,ID,fname,lname,gender,email,contact,appdate,apptime,userStatus,doctorStatus from appointmenttb where doctor='$dname';";
                    $result = mysqli_query($con,$query);
                    while ($row = mysqli_fetch_array($result)){
                      ?>
                      <tr>
                        <td><?php echo $row['pid'];?></td>
                        <td><?php echo $row['ID'];?></td>
                        <td><?php echo $row['fname'];?></td>
                        <td><?php echo $row['lname'];?></td>
                        <td><?php echo $row['gender'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['contact'];?></td>
                        <td><?php echo $row['appdate'];?></td>
                        <td><?php echo $row['apptime'];?></td>
                        <td>
                          <?php 
                            if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { echo "Active"; }
                            if(($row['userStatus']==0) && ($row['doctorStatus']==1)) { echo "Cancelled by Patient"; }
                            if(($row['userStatus']==1) && ($row['doctorStatus']==0)) { echo "Cancelled by You"; }
                            // NEW STATUS FOR COMPLETE
                            if(($row['userStatus']==1) && ($row['doctorStatus']==2)) { echo "Completed"; }
                          ?>
                        </td>

                        <td>
                          <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                            <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&cancel=update" 
                                onClick="return confirm('Are you sure you want to cancel this appointment ?')"
                                title="Cancel Appointment" tooltip-placement="top" tooltip="Remove">
                                <button class="btn btn-danger btn-sm">Cancel</button>
                            </a>
                            <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&complete=update" 
                                onClick="return confirm('Are you sure you want to mark this appointment as complete?')"
                                title="Complete Appointment" tooltip-placement="top" tooltip="Remove">
                                <button class="btn btn-success btn-sm">Complete</button>
                            </a>
                          <?php } elseif (($row['userStatus']==1) && ($row['doctorStatus']==2)) {
                              echo "Completed";
                          } else { 
                              echo "Cancelled"; 
                          } ?>
                        </td>

                        <td>
                          <?php if(($row['userStatus']==1) && ($row['doctorStatus']==1)) { ?>
                            <a href="prescribe.php?pid=<?php echo $row['pid']?>&ID=<?php echo $row['ID']?>&fname=<?php echo $row['fname']?>&lname=<?php echo $row['lname']?>&appdate=<?php echo $row['appdate']?>&apptime=<?php echo $row['apptime']?>"
                            tooltip-placement="top" tooltip="Remove" title="prescribe">
                            <button class="btn btn-primary btn-sm">Prescribe</button>
                            </a>
                          <?php } else { echo "-"; } ?>
                        </td>
                      </tr>
                    <?php } ?>
                </tbody>
              </table>
            <br>
          </div>

          <div class="tab-pane fade <?php echo $tab_pres; ?>" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
            
            <?php if(isset($_GET['pres_edit'])) { 
                // --- EDIT MODE ---
                $presID = $_GET['ID'];
                $query = mysqli_query($con, "SELECT * FROM prestb WHERE ID='$presID'");
                $row = mysqli_fetch_array($query);
            ?>
                <div class="card">
                    <div class="card-body">
                        <center><h4 style="color:#00c6ff;">Edit Prescription</h4></center>
                        <form method="post" action="doctor-panel.php">
                            <input type="hidden" name="presID" value="<?php echo $row['ID']; ?>">
                            <div class="form-group">
                                <label>Disease</label>
                                <input type="text" class="form-control" name="disease" value="<?php echo $row['disease']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Allergies</label>
                                <input type="text" class="form-control" name="allergies" value="<?php echo $row['allergy']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Prescription</label>
                                <textarea class="form-control" name="prescription" rows="4" required><?php echo $row['prescription']; ?></textarea>
                            </div>
                            <input type="submit" name="update_pres" value="Update Prescription" class="btn btn-primary">
                            <a href="doctor-panel.php?pres_list=back" class="btn btn-light" style="margin-left: 10px;">Cancel</a>
                        </form>
                    </div>
                </div>

            <?php } else { 
                // --- TABLE LIST MODE ---
            ?>
            
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Patient ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Appt ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Disease</th>
                        <th scope="col">Allergy</th>
                        <th scope="col">Prescription</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $con=mysqli_connect("localhost","root","","myhmsdb");
                        global $con;
                        $query = "select pid,fname,lname,ID,appdate,apptime,disease,allergy,prescription from prestb where doctor='$doctor';";
                        $result = mysqli_query($con,$query);
                        if(!$result){ echo mysqli_error($con); }
                        while ($row = mysqli_fetch_array($result)){
                      ?>
                          <tr>
                            <td><?php echo $row['pid'];?></td>
                            <td><?php echo $row['fname'];?></td>
                            <td><?php echo $row['lname'];?></td>
                            <td><?php echo $row['ID'];?></td>
                            <td><?php echo $row['appdate'];?></td>
                            <td><?php echo $row['apptime'];?></td>
                            <td><?php echo $row['disease'];?></td>
                            <td><?php echo $row['allergy'];?></td>
                            <td><?php echo $row['prescription'];?></td>
                            <td>
                              <a href="doctor-panel.php?ID=<?php echo $row['ID']?>&pres_edit=true" 
                                  title="Edit Prescription" tooltip-placement="top" tooltip="Edit">
                                  <button class="btn btn-primary btn-sm">Update</button>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                    </tbody>
                  </table>
            <?php } ?>
          </div>

          <div class="tab-pane fade <?php echo $tab_prof; ?>" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
            <div class="container-fluid">
              <div class="card">
                <div class="card-body">
                  <center><h4 style="color:#00c6ff; margin-bottom: 30px;">My Profile</h4></center>
                  <?php
                    // Fetch Doctor Details
                    $doctor = $_SESSION['dname'];
                    $query = "select * from doctb where username='$doctor';";
                    $result = mysqli_query($con, $query);
                    $spec = "";
                    $email = "";
                    $docFees = "";
                    
                    if($row=mysqli_fetch_array($result)){
                      $spec = $row['spec'];
                      $email = $row['email'];
                      $docFees = $row['docFees'];
                    }
                  ?>
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <label style="font-weight: bold;">Doctor Name</label>
                              <input type="text" class="form-control" value="<?php echo $doctor; ?>" readonly>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label style="font-weight: bold;">Specialization</label>
                              <input type="text" class="form-control" value="<?php echo $spec; ?>" readonly>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label style="font-weight: bold;">Email</label>
                              <input type="text" class="form-control" value="<?php echo $email; ?>" readonly>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <label style="font-weight: bold;">Consultancy Fees</label>
                              <input type="text" class="form-control" value="<?php echo $docFees; ?>" readonly>
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
   </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js"></script>
  </body>
</html>