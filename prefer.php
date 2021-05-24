<?php
require 'DB.php';
header('Content-Type: application/json');
session_start();
if((isset($_COOKIE['id'])&&isset($_COOKIE['cookie_id'])&&isset($_COOKIE['token']))||(isset($_SESSION['id'])&&isset($_SESSION['user'])))
{  
   
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    
        if(isset($_SESSION['id'])){
        $query="SELECT content FROM posts JOIN preferiti WHERE posts.id=preferiti.post AND userp='".$_SESSION['id']."'";
        
        }
        if(isset($_COOKIE['id'])){
            $query="SELECT content FROM posts JOIN preferiti WHERE posts.id=preferiti.post AND userp='".$_COOKIE['id']."'";
        
            }
   
    
    $res=mysqli_query($conn,$query)or die(mysqli_error($conn));
   
    $asqli=array();
   
    if(mysqli_num_rows($res)>0){
        for($i=0;$i<mysqli_num_rows($res);$i++){
       array_push($asqli,mysqli_fetch_row($res));
      
        }
        mysqli_close($conn);
       $json=json_encode($asqli);
      
       
        echo $json;
    }
    

        



}
else{header("Location: Hmw_film.php"); exit;}
?>