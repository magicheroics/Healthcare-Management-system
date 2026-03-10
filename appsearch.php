<!DOCTYPE html>
<?php include("newfunc.php"); ?>
<html lang="en">
<head>
    <title>Appointment Details</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/comp.png" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa; /* Light grey background */
            font-family: 'IBM Plex Sans', sans-serif;
        }
        .container-fluid {
            margin-top: 80px;
            max-width: 1100px; /* Slightly wider for the large table */
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            animation: fadeInUp 0.8s both;
        }
        .card-header {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff); /* Your Theme Gradient */
            color: white;
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1.2rem;
        }
        .btn-primary {
            background-color: #00c6ff;
            border-color: #00c6ff;
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
            color: white;
        }
        .btn-primary:hover {
            background-color: #0099cc;
            border-color: #0099cc;
        }
        
        /* Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 20px, 0); }
            to { opacity: 1; transform: none; }
        }
    </style>
</head>
<body>

<?php
if(isset($_POST['app_search_submit']))
{
	$contact=$_POST['app_contact'];
	$query = "select * from appointmenttb where contact= '$contact';";
    $result = mysqli_query($con,$query);
    
    // We check if any row exists first
    if(mysqli_num_rows($result) == 0){
        echo "<script> 
            alert('No entries found! Please enter valid details'); 
            window.location.href = 'admin-panel1.php#list-app';
        </script>";
    }
    else {
        echo "
        <div class='container-fluid'>
            <div class='card'>
                <div class='card-header'>
                    Search Results
                </div>
                <div class='card-body'>
                    <table class='table table-hover'>
                        <thead class='thead-light'>
                            <tr>
                                <th scope='col'>First Name</th>
                                <th scope='col'>Last Name</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>Contact</th>
                                <th scope='col'>Doctor Name</th>
                                <th scope='col'>Fees</th>
                                <th scope='col'>Date</th>
                                <th scope='col'>Time</th>
                                <th scope='col'>Status</th>
                            </tr>
                        </thead>
                        <tbody>";
    
        // Loop through results (in case a patient has multiple appointments)
        while ($row=mysqli_fetch_array($result)){
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $contact = $row['contact'];
            $doctor = $row['doctor'];
            $docFees= $row['docFees'];
            $appdate= $row['appdate'];
            $apptime = $row['apptime'];
            
            // Logic for Status
            if(($row['userStatus']==1) && ($row['doctorStatus']==1)) {
                $appstatus = "<span style='color:green'>Active</span>";
            }
            if(($row['userStatus']==0) && ($row['doctorStatus']==1)) {
                $appstatus = "<span style='color:red'>Cancelled by Patient</span>";
            }
            if(($row['userStatus']==1) && ($row['doctorStatus']==0)) {
                $appstatus = "<span style='color:red'>Cancelled by Doctor</span>";
            }

            echo "<tr>
                <td>$fname</td>
                <td>$lname</td>
                <td>$email</td>
                <td>$contact</td>
                <td>$doctor</td>
                <td>$docFees</td>
                <td>$appdate</td>
                <td>$apptime</td>
                <td>$appstatus</td>
            </tr>";
        }
        
        echo "</tbody></table>
            <center>
                <a href='admin-panel1.php' class='btn btn-primary' style='margin-top:20px;'>Back to Dashboard</a>
            </center>
            </div></div></div>";
    }
}
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>