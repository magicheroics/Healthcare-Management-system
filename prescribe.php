<!DOCTYPE html>
<?php
include('func1.php');
$pid='';
$ID='';
$appdate='';
$apptime='';
$fname = '';
$lname= '';
$doctor = $_SESSION['dname'];

if(isset($_GET['pid']) && isset($_GET['ID']) && ($_GET['appdate']) && isset($_GET['apptime']) && isset($_GET['fname']) && isset($_GET['lname'])) {
  $pid = $_GET['pid'];
  $ID = $_GET['ID'];
  $fname = $_GET['fname'];
  $lname = $_GET['lname'];
  $appdate = $_GET['appdate'];
  $apptime = $_GET['apptime'];
}

if(isset($_POST['prescribe']) && isset($_POST['pid']) && isset($_POST['ID']) && isset($_POST['appdate']) && isset($_POST['apptime']) && isset($_POST['lname']) && isset($_POST['fname'])){
  $appdate = $_POST['appdate'];
  $apptime = $_POST['apptime'];
  $disease = $_POST['disease'];
  $allergy = $_POST['allergy'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $pid = $_POST['pid'];
  $ID = $_POST['ID'];
  $prescription = $_POST['prescription'];
  
  $query=mysqli_query($con,"insert into prestb(doctor,pid,ID,fname,lname,appdate,apptime,disease,allergy,prescription) values ('$doctor','$pid','$ID','$fname','$lname','$appdate','$apptime','$disease','$allergy','$prescription')");
    if($query)
    {
      echo "<script>alert('Prescribed successfully!'); window.location.href = 'doctor-panel.php';</script>";
    }
    else{
      echo "<script>alert('Unable to process your request. Try again!');</script>";
    }
}
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/comp.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'IBM Plex Sans', sans-serif;
            padding-top: 50px;
        }
        
        /* Navbar */
        .bg-primary {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        }
        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 600;
        }
        .navbar-nav .nav-link:hover {
            color: #ffdddd !important;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            animation: fadeInUp 0.8s both;
        }
        .card-header {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            color: white;
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            text-transform: uppercase;
        }

        /* Form Controls */
        label {
            font-weight: 600;
            color: #495057;
        }
        .form-control {
            border-radius: 0.5rem;
            border: 1px solid #ced4da;
            padding: 10px;
        }
        .form-control:focus {
            border-color: #00c6ff;
            box-shadow: 0 0 0 0.2rem rgba(0, 198, 255, 0.25);
        }

        /* Button */
        .btn-primary {
            background-color: #00c6ff;
            border-color: #00c6ff;
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
            border-radius: 50px;
            padding: 10px 40px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0099cc;
            border-color: #0099cc;
            transform: translateY(-2px);
        }
        
        /* Patient Info Box */
        .patient-info {
            background: #f1f8ff;
            border-left: 5px solid #00c6ff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .patient-info p {
            margin-bottom: 5px;
            color: #555;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 20px, 0); }
            to { opacity: 1; transform: none; }
        }
    </style>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <a class="navbar-brand" href="#"><i class="fa fa-heartbeat" aria-hidden="true"></i> Apex Medical Institute </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="doctor-panel.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout1.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
            </li>
        </ul>
      </div>
    </nav>
</head>

<body>
   <div class="container" style="margin-top:50px; max-width: 800px;">
        <div class="card">
            <div class="card-header">
                Prescribe Medication
            </div>
            <div class="card-body">
                
                <div class="patient-info">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Patient:</strong> <?php echo $fname . " " . $lname; ?></p>
                            <p><strong>ID:</strong> <?php echo $pid; ?></p>
                        </div>
                        <div class="col-md-6">
                             <p><strong>Appointment ID:</strong> <?php echo $ID; ?></p>
                             <p><strong>Date:</strong> <?php echo $appdate . " (" . $apptime . ")"; ?></p>
                        </div>
                    </div>
                </div>

                <form class="form-group" name="prescribeform" method="post" action="prescribe.php">
                    
                    <div class="form-group">
                        <label for="disease">Disease / Condition:</label>
                        <textarea class="form-control" id="disease" rows="3" name="disease" required placeholder="Diagnosed condition..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="allergy">Allergies:</label>
                        <textarea class="form-control" id="allergy" rows="3" name="allergy" required placeholder="Any known allergies..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="prescription">Prescription:</label>
                        <textarea class="form-control" id="prescription" rows="6" name="prescription" required placeholder="Medication details, dosage, and instructions..."></textarea>
                    </div>

                    <input type="hidden" name="fname" value="<?php echo $fname ?>" />
                    <input type="hidden" name="lname" value="<?php echo $lname ?>" />
                    <input type="hidden" name="appdate" value="<?php echo $appdate ?>" />
                    <input type="hidden" name="apptime" value="<?php echo $apptime ?>" />
                    <input type="hidden" name="pid" value="<?php echo $pid ?>" />
                    <input type="hidden" name="ID" value="<?php echo $ID ?>" />

                    <br>
                    <center>
                        <input type="submit" name="prescribe" value="Submit Prescription" class="btn btn-primary">
                    </center>
                </form>
            </div>
        </div>
   </div>
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>