<?php
$host='localhost';
$user ='root';
$dbname = 'callcenter';
$dbpassword='';
$conn=mysqli_connect($host,$user,$dbpassword,$dbname);
if(!$conn){
    echo "Error in connection".mysqli_error($conn);
}


$username   = "sandbox";
$apikey     = "MyApp_APIKey";
?>