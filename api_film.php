<?php 
header('Content-Type: application/json');
require 'DB.php';
if($_GET['type']=='f'){
    $type='&type=movie';
    $code=urlencode($_GET['q']);
    if($_GET['m']=='t'){
       
        $url="http://www.omdbapi.com/?apikey=7726c6dc&t=".$code.$type;
   


    }
    else{
        $url="http://www.omdbapi.com/?apikey=7726c6dc&s=".$code.$type;
    }
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);
    $json=json_decode($res,true);
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    if($_GET['m']=='t'){
        $text=addslashes($json['Title']);
        $query="SELECT content FROM posts WHERE content='$text'";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if(mysqli_num_rows($r)==0){

        $query="INSERT INTO posts(comment,content) VALUES(0,'$text')";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        }
        
        mysqli_close($conn);    

    }
    if($_GET['m']=='s'){
        $text=array();
        for($i=0;$i<count($json['Search']);$i++){
            $sl=addslashes($json['Search'][$i]['Title']);
            array_push($text,$sl);
    }
    for($i=0;$i<count($text);$i++){
        $query="SELECT content FROM posts WHERE content= "."'$text[$i]'";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if(mysqli_num_rows($r)==0){

        $query="INSERT INTO posts(comment,content) VALUES(0,"."'$text[$i]'".")";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        }
        }
    mysqli_close($conn);

    }
    
    


    echo $res;
}


if($_GET['type']=='s'){
    $type='&type=series';
   
    $code=urlencode($_GET['q']);
   
    if($_GET['m']=='t'){
       
        $url="http://www.omdbapi.com/?apikey=7726c6dc&t=".$code.$type;
        

    }
    else{
        $url="http://www.omdbapi.com/?apikey=7726c6dc&s=".$code.$type;
        
    }
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);
    $json=json_decode($res,true);
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    if($_GET['m']=='t'){
        $text=addslashes($json['Title']);
        $query="SELECT content FROM posts_serie WHERE content='$text'";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if(mysqli_num_rows($r)==0){

        $query="INSERT INTO posts_serie(comment,content) VALUES(0,'$text')";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        }
        
        mysqli_close($conn);    

    }
    if($_GET['m']=='s'){
        $text=array();
        for($i=0;$i<count($json['Search']);$i++){
            $sl=addslashes($json['Search'][$i]['Title']);
            array_push($text,$sl);
    }
    for($i=0;$i<count($text);$i++){
        $query="SELECT content FROM posts_serie WHERE content= "."'$text[$i]'";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if(mysqli_num_rows($r)==0){

        $query="INSERT INTO posts_serie(comment,content) VALUES(0,"."'$text[$i]'".")";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        }
        }
    mysqli_close($conn);

    }
    
        
  
    
    echo $res;
        
}
?>