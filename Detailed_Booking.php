<?php
require ("Connection.php");

if (isset($_POST['submit'])) { //name of button that used to submit data,isset checks if data is sent or not
    // storing the data sent in form  in DBBB 
    $Name = $_POST['name'];
    $Email = $_POST['email'];
    $Phone = $_POST['phone'];
    $Destination = $_POST['destination'];
    $Yourcountry = $_POST['fromCountry'];
    $Num_travelers = $_POST['numTravelers'];
    $Trip_date = $_POST['travelDate'];
    $Trip_time = $_POST['travelTime'];
    $Payment_method = $_POST['paymentMethod'];

    $insert = "INSERT INTO detailed_booking (Name,Email, Phone,Destination,Yourcountry, Num_travelers,Trip_date,Trip_time,Payment_method) VALUES
                                           ('$Name', '$Email', '$Phone','$Destination', '$Yourcountry', '$Num_travelers','$Trip_date','$Trip_time',
                                            '$Payment_method')";

    if ($conn->query($insert) == true) //check if data sent to DB
    {
        header("location: $Destination.html");//user will be directed to this page if data stored in DB
    } 
    else {
        echo "ERROR : " . $conn->connect_error;
    }
}

?>