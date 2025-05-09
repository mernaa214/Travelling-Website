<?php

session_start();
session_unset();
session_destroy();
header('Location: sign_in&up.html');
exit();
//$key = '8dwH3uKb4YqGnPz7kTf5rWs2vXxL8Jp9';
// Function to generate deterministic HMAC hash
/*function generateHash($Password, $key) //will create the same encryption to the same password
{
    return hash_hmac('sha256', $Password, $key);
}*/
?>