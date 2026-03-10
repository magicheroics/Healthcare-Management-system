<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="images/comp.png" />
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
      body {
        background: -webkit-linear-gradient(left, #3931af, #00c6ff);
        background-size: cover;
        font-family: 'IBM Plex Sans', sans-serif;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        width: 100%;
        max-width: 450px;
        padding: 40px;
        text-align: center;
        animation: fadeInUp 0.8s both;
      }

      h3 {
        color: #3931af;
        font-weight: bold;
        margin-bottom: 20px;
      }

      p {
        color: #6c757d;
        margin-bottom: 30px;
      }

      .btn-primary {
        background-color: #00c6ff;
        border-color: #00c6ff;
        border-radius: 50px;
        padding: 10px 30px;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(0, 198, 255, 0.4);
        transition: all 0.3s ease;
      }

      .btn-primary:hover {
        background-color: #0099cc;
        border-color: #0099cc;
        transform: translateY(-2px);
      }

      .logo-icon {
        font-size: 50px;
        color: #00c6ff;
        margin-bottom: 20px;
      }

      @keyframes fadeInUp {
          from { opacity: 0; transform: translate3d(0, 20px, 0); }
          to { opacity: 1; transform: none; }
      }
    </style>
  </head>
  <body>
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="card">
                <div>
                  <i class="fa fa-heartbeat logo-icon"></i>
                </div>
                
                <h3>Apex Medical Institute</h3>
                
                <p>You have been safely logged out.<br>Thank you for using our system.</p>
                
                <div>
                  <a href="index.php" class="btn btn-primary btn-block">Back to Login Page</a>
                </div>
            </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
  </body>
</html>