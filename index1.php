<?php
include("header.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Patient Login - Apex Medical</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <style>
        /* 1. Global Styles (Matches Contact Page) */
        body {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            font-family: 'IBM Plex Sans', sans-serif;
            background-size: cover;
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

        /* 3. Login Card (Centered & Modern) */
        .login-card {
            background: #fff;
            border-radius: 1.5rem;
            padding: 40px;
            margin-top: 100px; /* Clear the navbar */
            margin-bottom: 50px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            animation: fadeInUp 0.8s both;
        }

        /* 4. Form Elements */
        .form-control {
            border-radius: 50px; /* Pill shape inputs */
            height: 45px;
            border: 1px solid #ced4da;
            padding: 10px 20px;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #00c6ff;
            box-shadow: 0 0 0 0.2rem rgba(0, 198, 255, 0.25);
        }
        label {
            font-weight: 600;
            color: #555;
            margin-left: 10px;
        }

        /* 5. Buttons */
        .btn-primary {
            background-color: #00c6ff;
            border-color: #00c6ff;
            border-radius: 50px;
            padding: 10px 30px;
            font-weight: bold;
            width: 100%; /* Full width button */
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
            transition: all 0.3s ease;
            text-transform: uppercase;
        }
        .btn-primary:hover {
            background-color: #0099cc;
            border-color: #0099cc;
            transform: translateY(-2px);
        }

        /* 6. Icon Styling */
        .card-icon {
            color: #00c6ff;
            margin-bottom: 20px;
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
            <a class="navbar-brand js-scroll-trigger" href="index.php">
                <h4><i class="fa fa-heartbeat" aria-hidden="true"></i>&nbsp Apex Medical Institute</h4>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" style="margin-right: 20px;">
                        <a class="nav-link js-scroll-trigger" href="index.php">Home</a>
                    </li>
                    <li class="nav-item" style="margin-right: 20px;">
                        <a class="nav-link js-scroll-trigger" href="services.html">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="contact.html">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5"> <div class="card login-card">
                    <div class="card-body text-center">
                        <i class="fa fa-user-circle-o fa-4x card-icon" aria-hidden="true"></i>
                        <h3 style="margin-top: 10px; color: #3931af; font-weight: bold;">Patient Login</h3>
                        <br>
                        
                        <form class="form-group" method="POST" action="func.php">
                            <div class="form-group text-left">
                                <label>Email ID</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter your email" required/>
                            </div>
                            
                            <div class="form-group text-left">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password2" placeholder="Enter your password" required/>
                            </div>
                            
                            <br>
                            <input type="submit" id="inputbtn" name="patsub" value="Login" class="btn btn-primary">
                        </form>
                        
                        <div style="margin-top: 15px;">
                            <a href="index.php" style="color: #00c6ff; font-weight: 600;">Don't have an account? Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  </body>
</html>