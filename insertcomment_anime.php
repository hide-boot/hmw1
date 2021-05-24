<?php 
require 'DB.php';
session_start();
if((isset($_COOKIE['id'])&&isset($_COOKIE['cookie_id'])&&isset($_COOKIE['token']))||(isset($_SESSION['id'])&&isset($_SESSION['user'])))
{    

    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
 
   
    $escape=mysqli_escape_string($conn,$_POST['comment']);
    $squery="SELECT id FROM posts_anime WHERE content='".$_POST['hidden']."'";
   
    $sres=mysqli_query($conn,$squery) or die(mysqli_error($conn));
    
    $value=mysqli_fetch_row($sres);
    
    if(isset($_COOKIE['id'])){
    $query="INSERT INTO comments_anime(userc,post,text) VALUES('".$_COOKIE['id']."','".$value['0']."','$escape')";
    }
    if(isset($_SESSION['id'])){
        $query="INSERT INTO comments_anime(userc,post,text) VALUES('".$_SESSION['id']."','".$value['0']."','".$escape."')";
    }

  
    $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
    echo "success";
}
else{
    echo "non sei loggato";
    header("Location: Hmw_film.php");

}


?>