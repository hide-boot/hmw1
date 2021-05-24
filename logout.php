<?php
include 'DB.php';
session_start();



if(isset($_COOKIE['id'])&&isset($_COOKIE['cookie_id'])&&isset($_COOKIE['token'])){
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    $user=mysqli_real_escape_string($conn,$_COOKIE['id']);
    $cookieid=mysqli_real_escape_string($conn,$_COOKIE['cookie_id']);
    
    $query="SELECT hash FROM cookies WHERE userc='$user'";
    $res=mysqli_query($conn,$query);

    
    $cookie=mysqli_fetch_assoc($res);

    echo $_COOKIE['token'];
   echo $cookie['hash'];
    if($_COOKIE['token']==$cookie['hash']){
        $query="DELETE FROM cookies WHERE hash='".$_COOKIE['token']."'";
       mysqli_query($conn,$query);
       
       
        mysqli_close($conn);
        setcookie('id','',time()-1);
        setcookie('cookie_id','',time()-1);
        setcookie('token','',time()-1);
        header("Location: Hmw_film.php");
     
    }

  
}
if(isset($_SESSION['id'])&&isset($_SESSION['user'])){
    session_destroy();
    header("Location: Hmw_film.php");

}



?>