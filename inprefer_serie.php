<?php
require 'DB.php';
session_start();

if((isset($_COOKIE['id'])&&isset($_COOKIE['cookie_id'])&&isset($_COOKIE['token']))||(isset($_SESSION['id'])&&isset($_SESSION['user'])))
{  
   
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    $escape=mysqli_escape_string($conn,$_POST['title']);
   
    if(isset($_SESSION['id'])){
    $query="INSERT INTO preferiti_serie(userp,post) VALUES('".$_SESSION['id']."',(SELECT id FROM posts_serie WHERE content='$escape'))";
    }
    if(isset($_COOKIE['id'])){
        $query="INSERT INTO preferiti_serie(userp,post) VALUES('".$_COOKIE['id']."',(SELECT id FROM posts_serie WHERE content='$escape'))";
        }
        
    mysqli_query($conn,$query)or die(mysqli_error($conn));
    mysqli_close($conn);
 
        echo 'success';



}
else{header("Location: Hmw_film.php"); exit;}

?>