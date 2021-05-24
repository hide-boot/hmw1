<?php
require 'DB.php';
session_start();
if((isset($_COOKIE['id'])&&isset($_COOKIE['cookie_id'])&&isset($_COOKIE['token']))||(isset($_SESSION['id'])&&isset($_SESSION['user'])))
{  
   
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    $escape=mysqli_escape_string($conn,$_POST['title']);
    
    $query="DELETE FROM preferiti where post=(SELECT id FROM posts WHERE content='$escape')";
        
    mysqli_query($conn,$query)or die(mysqli_error($conn));
    mysqli_close($conn);

        



}
else{header("Location: Hmw_film.php"); exit;}
?>