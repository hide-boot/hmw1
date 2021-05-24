<?php
require 'DB.php';
header('Content-Type: application/json');
session_start();
if(isset($_COOKIE['id'])||isset($_SESSION['id'])){
  
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    $get=mysqli_real_escape_string($conn,$_GET['title']);
    $query="SELECT userc,time,text FROM comments_serie WHERE post=(SELECT id FROM posts_serie WHERE content='$get')";
    
    $res=mysqli_query($conn,$query)or die(mysqli_error($conn));
    
    $asqli=array();
    if(mysqli_num_rows($res)>0){
        for($i=0;$i<mysqli_num_rows($res);$i++){
       array_push($asqli,mysqli_fetch_row($res));
       
       
        }
        
        for($i=0;$i<count($asqli);$i++){
        $query="SELECT username FROM user WHERE id='".$asqli[$i]['0']."'";
        $res=mysqli_query($conn,$query)or die(mysqli_error($conn));
        $as=mysqli_fetch_row($res);
       
        $asqli[$i]['0']=$as['0'];

        }
      
       $json=json_encode($asqli);
       echo $json;
       mysqli_close($conn);
    }
    else{print_r('not found comment');
    mysqli_close($conn);}
    
}

?>