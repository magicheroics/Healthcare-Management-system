<?php
session_start();
$con=mysqli_connect("localhost","root","","myhmsdb");
if(isset($_POST['search_submit'])){
  $contact=$_POST['contact'];
  $docname = $_SESSION['dname'];
  $query="select * from appointmenttb where contact='$contact' and doctor='$docname';";
  $result=mysqli_query($con,$query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Search Results - Apex Medical</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="images/comp.png" />

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <style>
        /* 1. Global Styles */
        body {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            font-family: 'IBM Plex Sans', sans-serif;
            min-height: 100vh;
        }

        /* 2. Navigation Bar */
        .navbar {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            padding: 15px 20px;
        }
        .navbar-brand h4 {
            color: white;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
            font-size: 1.2rem;
        }
        .nav-link {
            color: #ffffff !important;
            font-weight: 700 !important;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 1 !important;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: #ffdddd !important;
            transform: translateY(-2px);
        }

        /* 3. Result Card */
        .result-card {
            background: #fff;
            border-radius: 1.5rem;
            padding: 40px;
            margin-top: 100px;
            margin-bottom: 50px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            animation: fadeInUp 0.8s both;
        }

        h3 {
            color: #3931af;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 30px;
        }

        /* 4. Table Styling */
        .table thead th {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            color: white;
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 15px;
        }
        .table thead th:first-child { border-top-left-radius: 10px; }
        .table thead th:last-child { border-top-right-radius: 10px; }
        
        .table tbody tr:hover {
            background-color: #f0f8ff;
            transform: scale(1.01);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            z-index: 2;
            position: relative;
            transition: all 0.2s ease;
        }

        /* 5. Buttons */
        .btn-primary {
            background-color: #00c6ff;
            border-color: #00c6ff;
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0099cc;
            border-color: #0099cc;
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
        }

        /* Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 40px, 0); }
            to { opacity: 1; transform: none; }
        }
    </style>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="doctor-panel.php">
                <h4><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp Apex Medical Institute</h4>
            </a>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="logout1.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="result-card">
                    <center><h3>Search Results</h3></center>
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while($row=mysqli_fetch_array($result)){
                                    $fname=$row['fname'];
                                    $lname=$row['lname'];
                                    $email=$row['email'];
                                    $contact=$row['contact'];
                                    $appdate=$row['appdate'];
                                    $apptime=$row['apptime'];
                                    echo "<tr>
                                        <td>$fname</td>
                                        <td>$lname</td>
                                        <td>$email</td>
                                        <td>$contact</td>
                                        <td>$appdate</td>
                                        <td>$apptime</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <br>
                    <center>
                        <a href="doctor-panel.php" class="btn btn-primary">Back to Dashboard</a>
                    </center>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  </body>
</html>
<?php } ?>