<?php 
require 'DB.php';

session_start();
if(isset($_COOKIE['id'])&&isset($_COOKIE['cookie_id'])&&isset($_COOKIE['token'])){
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    $query="SELECT date FROM cookies WHERE userc='".$_COOKIE['id']."'";
    $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
            $data=mysqli_fetch_assoc($res);
            
            if(time()>$data['date']){
                $delete="DELETE FROM cookies WHERE userc='".$_COOKIE['id']."'";
                mysqli_query($conn,$delete);
                header("Location: login.php");
            }
        }
    }


?>



<!DOCTYPE html>
<html>
<head>
<title>PageAnime</title>
<link rel='stylesheet' href="Hmw_Anime.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
<script  src='Hmw_Anime.js' defer=true></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav>
<div class='link'>
<a href='Hmw_film.php' class='film'>Film</a>
<a href='Hmw_SerieTv.php' class='tv'>Serie-TV</a>
<a href='Hmw_Anime.php' class='anime'>Anime</a>
</div>
<div class='access'>
<a href='<?php if(isset($_COOKIE['id'])||isset($_SESSION['id'])){ echo 'MyAccount.php';}
         else{
             echo 'login.php';
        }  ?> 'class='login'><?php if(isset($_COOKIE['id'])||isset($_SESSION['id'])){ echo 'MyAccount';}
         else{
             echo 'Login';
        }  ?></a>
        <a href='<?php if(isset($_COOKIE['id'])||isset($_SESSION['id'])){ echo 'logout.php';}
         else{
             echo 'singup.php';
        }  ?> ' class='singup'><?php if(isset($_COOKIE['id'])||isset($_SESSION['id'])){ echo 'Logout';}
         else{
             echo 'Singup';
        }  ?></a>
</div>
</nav>
<header>
    <div class='overlay'></div>
    <h1 id='title'>NomeSito</h1>
    <p class='subtitle'>Movie Comunity</p>
   </header>
<section>

    <div class=menu>
        <p>Generi</p>
        <span class='action'>Action</span>
        <span class='thriller'>Thriller</span>
        <span class='horror'>Horror</span>
        <span class='comedy'>Comedy</span>
        <span class='adventure'>Adventure</span>
       
    </div>
    <div class='form'>
    <form >
    <input type='text'>
    <input type='submit' value='Search' class='search'>
    </form>
    <p class='pfilm'>Anime</p>
    </div>
    <div class='article'>
        
        <div class='contents'></div>
</div>


</section>
<section class='no-w'>
</section>
<footer>
<div class='footer'>

    <p>nomesito 2021</p>
<p>Sito web ideato da:Bonadonna Stefano O46002083</p>
    
</div>
</footer>

</body>
</html>