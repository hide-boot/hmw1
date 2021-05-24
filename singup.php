<?php
//controllo accesso oltre al javascript
session_start();
if(isset($_COOKIE["id"])||isset($_SESSION['id']))
{
     header("Location: Hmw_film.php");
     exit;
}
require 'DB.php';
if(!empty($_POST['name'])&&!empty($_POST['surname'])&&
!empty($_POST['email'])&&!empty($_POST['password'])&&
!empty($_POST['user'])&&!empty($_POST['confpass'])){
        $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $query="SELECT email FROM user WHERE email='$email';";
        $res=mysqli_query($conn,$query);
        if(mysqli_num_rows($res)>0){
                $error[]="Email già utilizzata";

            }
        if(strlen($_POST['password'])<8){
                $error[]="Password minore di 8 caratteri";
            }
        if(strcmp($_POST['password'],$_POST['confpass'])!=0){
                $error[]="La password non corrisponde";
            }
        if(count($error)==0){
            $name=mysqli_real_escape_string($conn,$_POST['name']);
            $surname=mysqli_real_escape_string($conn,$_POST['surname']);
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);
            $user=mysqli_real_escape_string($conn,$_POST['user']);
            $password=password_hash($password,PASSWORD_BCRYPT);
                
            $query="INSERT INTO user(username,password,email,name,surname) VALUE('$user','$password','$email','$name','$surname');";
                
            if(mysqli_query($conn,$query)==1){
                $_SESSION['user']=$_POST['username'];
                $_SESSION['id']=mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: Hmw_film.php");
        
                }
                else{
                    $error[]="Errore di connessione al DB";
                    
                }
            }mysqli_close($conn);
        }


?>
<html>
<head>
<title>SingUp</title>

<script src='singup.js' defer='true'></script>
<link rel="stylesheet" href='singup.css'/>
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

<div class='table'>
<h3>Iscrizione</h3>
<form class='form' method='post'  >
<label >Nome <div class='alert'><input type='text' name='name'></div></label>
<label >Cognome <div class='alert'><input type='text' name='surname'></div></label>
<label >email <div class='alert'><input type='text' name='email'></div></label>
<label >Username<div class='alert'><input type='text' name='user'></div></label>
<label >Password<div class='alert'><input type='password' name='password'></div></label>
<label >Conferma Password<div class='alert'><input type='password' name='confpass'></div></label>
<div class='label'><input type='checkbox' class='confirm'>Confermo al trattamento dati personali</div>
<input type='submit'class='sinbutton' value='Singup'>
</form>
<p>
    Sei già iscritto?<a href='login.php' class='loginnow'>Login now</a>
</p>
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