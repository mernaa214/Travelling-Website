<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Travelling Website" />
    <meta name="keywords" content="turkey,bali,travel,thailand,morroco,france" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>welcome</title>
    <link rel="stylesheet" href="error_404.css" />
    <!--google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        .btn{
        background-color:black;
        color: beige;
        font-size: 16px;
        font-style: normal;
        cursor: pointer;
        padding: 10px 20px;
        border: none;
        border-radius: 999px;

        }
    </style>


</head>
<body>

<div class="cont">
<?php
require ("Connection.php");

if (isset($_POST['signIn'])) { //name of button that used to submit data,isset checks if data is sent or not
    
    $Email=  $_POST['email']  ;
    $Password = $_POST['password'];
    $RepeatPassword = $_POST['repeatpassword'];
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    if (strlen($Password) < 6) {
                 echo '<script> 
                          alert("Password must be at least 6 characters long");
                        </script>';       
                 exit();
    }
    if ($Password !== $RepeatPassword) {
              echo '<script> 
                          alert("Password doesnot match");
                        </script>';
                  exit();
     }

    $checkemail = "SELECT*From users_data where Email='$Email' ";
    $result = $conn->query($checkemail);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        if (password_verify($Password,$row['Password'])){ 
           session_start();
           $_SESSION['Email'] = $row['Email'];
           $_SESSION['Password'] = $row['Password'];
            echo ' <h2 style="text-align:center;">welcome ' . $Firstname . ' ' . $Lastname . '
                       </h2>';
            echo ' <a href="index.html">
                           <button type="button"class="btn">Go to Home Page</button>
                          </a>';
            exit();
        }
    }
    else {//                              columns in DB
            echo "<script> alert('Not Found! Check if the email or password is correct...');</script>";        
    }                                        
}
?>
  </div>      
</body>
</html>