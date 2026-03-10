<!DOCTYPE html>
<html lang="en">
<head>
    <title>Apex Medical Institute - Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="shortcut icon" type="image/x-icon" href="images/comp.png" />

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">

    <style>
        /* 1. Global Styles */
        body {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff);
            font-family: 'IBM Plex Sans', sans-serif;
            background-size: cover;
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
        /* Active Page Highlight */
        .navbar-nav .active .nav-link {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }

        /* 3. Main Form Container (The Card) */
        .register {
            background: #ffffff;
            margin-top: 100px;
            padding: 40px;
            border-radius: 1.5rem;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 900px;
            animation: fadeInUp 0.8s both;
            margin-bottom: 50px;
        }

        /* 4. TAB BUTTONS (Patient/Doctor/Secretary) - IMPROVED VISIBILITY */
        .nav-tabs {
            border-bottom: none;
            margin-bottom: 30px;
        }
        
        .nav-tabs .nav-link {
            border: 2px solid #f0f0f0; /* Light border for visibility */
            background-color: #f8f9fa; /* Light grey background for inactive tabs */
            border-radius: 50px;
            color: #6c757d; /* Dark grey text */
            font-weight: 700; /* Bold text */
            font-size: 16px; /* Larger font */
            padding: 12px 25px;
            margin: 0 5px; /* Space between buttons */
            transition: all 0.3s ease;
            text-align: center;
        }

        /* Active State (Selected Tab) */
        .nav-tabs .nav-link.active {
            background: -webkit-linear-gradient(left, #3931af, #00c6ff); /* Gradient background */
            color: #fff !important; /* White text */
            border: none;
            box-shadow: 0 5px 15px rgba(0, 198, 255, 0.4); /* Glowing shadow */
            transform: translateY(-2px); /* Slight pop-up effect */
        }

        /* Hover State */
        .nav-tabs .nav-link:hover {
            border-color: #00c6ff;
            color: #00c6ff;
            background-color: #fff;
        }

        /* 5. Headings & Forms */
        .register-heading {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 30px;
            color: #3931af;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1.5rem;
        }
        .register-form {
            padding: 20px;
        }
        
        /* Input Fields */
        .form-control {
            border-radius: 0.75rem;
            height: 50px;
            border: 1px solid #ced4da;
            margin-bottom: 20px;
            font-size: 15px;
        }
        .form-control:focus {
            border-color: #00c6ff;
            box-shadow: 0 0 0 0.2rem rgba(0, 198, 255, 0.25);
        }

        /* 6. Action Buttons (Register/Login) */
        .btnRegister {
            border: none;
            border-radius: 50px;
            padding: 12px 40px;
            background: #00c6ff;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
            width: 100%;
            margin-top: 10px;
            text-transform: uppercase;
        }
        .btnRegister:hover {
            background: #0099cc;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 198, 255, 0.5);
        }

        /* Radio Buttons */
        .maxl {
            margin: 15px 0;
            color: #555;
            font-weight: 500;
        }
        .inline {
            display: inline-block;
            margin-right: 20px;
        }

        /* Animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translate3d(0, 40px, 0); }
            to { opacity: 1; transform: none; }
        }
    </style>

    <script>
        var check = function() {
            if (document.getElementById('password').value ==
                document.getElementById('cpassword').value) {
                document.getElementById('message').style.color = '#5dd05d';
                document.getElementById('message').innerHTML = 'Matched';
            } else {
                document.getElementById('message').style.color = '#f55252';
                document.getElementById('message').innerHTML = 'Not Matching';
            }
        }

        function alphaOnly(event) {
            var key = event.keyCode;
            return ((key >= 65 && key <= 90) || key == 8 || key == 32);
        };

        function checklen() {
            var pass1 = document.getElementById("password");
            if (pass1.value.length < 6) {
                alert("Password must be at least 6 characters long. Try again!");
                return false;
            }
        }
    </script>
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
                <li class="nav-item active">
                    <a class="nav-link js-scroll-trigger" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="services.html">ABOUT US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="contact.html">CONTACT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 register">
            
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Doctor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Secretary</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <h3 class="register-heading">Register as Patient</h3>
                    <form method="post" action="func2.php">
                        <div class="row register-form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="First Name *" name="fname" onkeydown="return alphaOnly(event);" required/>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" name="email" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" id="password" name="password" onkeyup='check();' required/>
                                </div>
                                <div class="form-group">
                                    <div class="maxl">
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="Male" checked>
                                            <span> Male </span>
                                        </label>
                                        <label class="radio inline">
                                            <input type="radio" name="gender" value="Female">
                                            <span> Female </span>
                                        </label>
                                    </div>
                                    <a href="index1.php" style="color: #00c6ff; font-weight: bold;">Already have an account?</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last Name *" name="lname" onkeydown="return alphaOnly(event);" required/>
                                </div>
                                <div class="form-group">
                                    <input type="tel" minlength="10" maxlength="10" name="contact" class="form-control" placeholder="Your Phone *" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password *" name="cpassword" onkeyup='check();' required/><span id='message'></span>
                                </div>
                                <input type="submit" class="btnRegister" name="patsub1" onclick="return checklen();" value="Register"/>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <h3 class="register-heading">Login as Doctor</h3>
                    <form method="post" action="func1.php">
                        <div class="row register-form justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="User Name *" name="username3" onkeydown="return alphaOnly(event);" required/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password3" required/>
                                </div>
                                <input type="submit" class="btnRegister" name="docsub1" value="Login"/>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">
                    <h3 class="register-heading">Login as Secretary</h3>
                    <form method="post" action="func3.php">
                        <div class="row register-form justify-content-center">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="User Name *" name="username1" onkeydown="return alphaOnly(event);" required/>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password *" name="password2" required/>
                                </div>
                                <input type="submit" class="btnRegister" name="adsub" value="Login"/>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>