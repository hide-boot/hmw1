<?php
require 'DB.php';
if(!isset($_GET['q'])){
    echo "error";
    exit;
}
header('Content-Type: application/json');
$conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
$email=mysqli_real_escape_string($conn, $_GET['q']);
$query="SELECT email FROM user WHERE email = '$email'";
$res=mysqli_query($conn,$query) or die(mysqli_error($conn));
$json= json_encode(array('exist'=>mysqli_num_rows($res)>0 ? true :false));
echo $json;
mysqli_close($conn);
?>