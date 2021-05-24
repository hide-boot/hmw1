<?php
require 'DB.php';
if(!isset($_GET['q'])){
    echo "error";
    exit;
}
header('Content-Type: application/json');
$pass= $_GET['q'];
$json= json_encode(array('invalid'=>strlen($pass)<8 ? true :false));
echo $json;
?>