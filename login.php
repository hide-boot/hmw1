<?php
require 'DB.php';
session_start();
if(isset($_COOKIE['id'])&&isset($_COOKIE['cookie_id'])&&isset($_COOKIE['token'])||isset($_SESSION['id']))
{    
     header("Location: Hmw_film.php");
     exit;
}


if(!empty($_POST['password'])&&
!empty($_POST['user'])){
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $user=mysqli_real_escape_string($conn,$_POST['user']);
    
    $query="SELECT id,username,password FROM user WHERE username='$user';";
    $res=mysqli_query($conn,$query) or die(mysqli_error($conn));
    
    if(mysqli_num_rows($res)>0){
        $ass=mysqli_fetch_assoc($res);
       if( password_verify($_POST['password'],$ass['password']))
       {
       
        if(!isset($_POST['check'])){
            session_start();
            $_SESSION["user"]=$ass["username"];
            $_SESSION["id"]=$ass['id'];
        }
        else{
          
            $token=random_bytes(12);
            
            $hash=password_hash($token,PASSWORD_BCRYPT);
            $time_cookie=strtotime("+7 day");
             $time_cookie;
            $query="INSERT INTO cookies (hash,userc,date) VALUES('$hash','".$ass['id']."','$time_cookie')";
            mysqli_query($conn,$query);
            setcookie("id",$ass['id'],$time_cookie);
            setcookie('cookie_id',mysqli_insert_id($conn),$time_cookie);
            setcookie("token",$hash,$time_cookie);
          
        }
       header("Location: Hmw_film.php");
        mysqli_close($conn);
        exit;
       }
    }
    $error="Username o password errati";
    
}



?>




<html>
<head>
<title>Login</title>
<link rel="stylesheet" href='login.css'/>
<script src='login.js' defer='true'></script>
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
        <a href='login.php' class='login'>Login</a>
        <a href='singup.php' class='singup'>Singup</a>
        </div>
        </nav>
<header>
    <div class='overlay'></div>
    <h1 id='title'>NomeSito</h1>
    <p class='subtitle'>Movie Comunity</p>
   </header>
<section>
<div class='log'>
    <div class='bord'>
<img class='utente' src='https://cdn.pixabay.com/photo/2017/07/18/23/23/user-2517433__340.png'/>
<form class='accesso' method="post" >
<label class='username'>Username <div class='alert'> <input type='text' name='user'></div></label>
<label class='pass'>Password <div class='alert'> <input type='password' name='password'></div></label>
<label><input type='checkbox' name='check' >Ricorda Utente</label>
<input type='submit' class='buttom' value='Login'>
</form>
</div>
<p>Non sei iscritto? <a href='singup.php' class='singupnow'>Iscriviti adesso</a></p>
</div>
</section>
<footer>
    <div class='footer'>

        <p>nomesito 2021</p>
    <p>Sito web ideato da:Bonadonna Stefano O46002083</p>
        
    </div>
</footer>

</body>
</html>