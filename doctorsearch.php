<!DOCTYPE html>
<?php include("newfunc.php"); ?>
<html lang="en">
<head>
    <title>Doctor Details</title>
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
            max-width: 1000px;
        }
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .card-header {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            color: white;
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
        }
        .btn-primary {
            background-color: #00c6ff;
            border-color: #00c6ff;
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
        }
        .btn-primary:hover {
            background-color: #0099cc;
            border-color: #0099cc;
        }
    </style>
</head>
<body>

<?php
if(isset($_POST['doctor_search_submit']))
{
    $contact=$_POST['doctor_contact'];
    $query = "select * from doctb where email= '$contact'";
    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    
    // If no doctor found
    if(empty($row['username']) && empty($row['email'])){
        echo "<script> 
            alert('No entries found!'); 
            window.location.href = 'admin-panel1.php#list-doc';
        </script>";
    }
    else {
        // If doctor IS found, show this:
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
                                <th scope='col'>Username</th>
                                <th scope='col'>Email</th>
                                <th scope='col'>Password</th>
                                <th scope='col'>Consultancy Fees</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{$row['username']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['password']}</td>
                                <td>{$row['docFees']}</td>
                            </tr>
                        </tbody>
                    </table>
                    <center>
                        <a href='admin-panel1.php' class='btn btn-primary' style='margin-top:20px;'>Back to Dashboard</a>
                    </center>
                </div>
            </div>
        </div>";
    }
}
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</body>
</html>