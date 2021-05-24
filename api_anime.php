<?php
require 'DB.php';
header('Content-Type: application/json');
$api="https://kitsu.io/api/edge/anime?filter";
$code=urlencode($_GET['q']);
if($_GET['type']=='t'){
$type='[text]=';
$url=$api.$type.$code;
$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($curl);

curl_close($curl);
$json=json_decode($res,true);
$text=array();
for($i=0;$i<count($json['data']);$i++){
    

$sl=addslashes($json['data'][$i]['attributes']['canonicalTitle']);
array_push($text,$sl);

}
$conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
for($i=0;$i<count($text);$i++){
$query="SELECT content FROM posts_anime WHERE content= "."'$text[$i]'";
$r=mysqli_query($conn,$query) or die(mysqli_error($conn));
if(mysqli_num_rows($r)==0){
$query="INSERT INTO posts_anime(comment,content) VALUES(0,"."'$text[$i]'".")";
$r=mysqli_query($conn,$query) or die(mysqli_error($conn));
}
}
mysqli_close($conn);
echo $res;
}
if($_GET['type']=='c'){
    $type='[categories]=';
    $page='&page[limit]=20';
    $url=$api.$type.$code.$page;
    $curl=curl_init();
    curl_setopt($curl,CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    curl_close($curl);
   $json=json_decode($res,true);
    $text=array();
    for($i=0;$i<count($json['data']);$i++){
        $sl=addslashes($json['data'][$i]['attributes']['canonicalTitle']);
        array_push($text,$sl);

}

    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    for($i=0;$i<count($text);$i++){
        $query="SELECT content FROM posts_anime WHERE content= "."'$text[$i]'";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        if(mysqli_num_rows($r)==0){

        $query="INSERT INTO posts_anime(comment,content) VALUES(0,"."'$text[$i]'".")";
        $r=mysqli_query($conn,$query) or die(mysqli_error($conn));
        }
        }
    mysqli_close($conn);
    echo $res;

}

?>