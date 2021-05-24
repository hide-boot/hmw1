<?php 
require 'DB.php';
session_start();



if(!isset($_COOKIE['id'])&&!isset($_SESSION['id'])){

    header('Location: Hmw_film.php');

}

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
<title>MyAccount</title>
<link rel='stylesheet' href="MyAccount.css">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
<script  src='MyAccount.js' defer=true></script>
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
   </header>
<section>
<div class=article>
<img src='https://lh3.googleusercontent.com/proxy/ALALfKZp45gyOzYQhVIs0TAollcheqdMHszsRKakyRArJKCv7ItYiOP_Xw482Phfy60ux9fdKoJJoBrAigSiX-Y3xSta54yYY3YkyQZ43aG8HQf0DKDYp6ddtNCtkdxn9bzIyZ944Ht_-FOYyDcbhm0_txo' 
class='profileimg'>
<p>Benvenuto</p>
<h3 class='name'>
<?php 
    $conn=mysqli_connect($DB['host'],$DB['user'],$DB['password'],$DB['name']) or die(mysqli_error($conn));
    if(isset($_COOKIE['id'])){
    $query="SELECT username FROM user WHERE id='".$_COOKIE['id']."'";
    }
    if(isset($_SESSION['id'])){
        $query="SELECT username FROM user WHERE id='".$_SESSION['id']."'";
        }
    $res=mysqli_query($conn,$query)or die(mysqli_errno($conn));
    $user=mysqli_fetch_assoc($res);
    echo $user['username'];
?>
</h3>
<h2>Preferiti</h2>
</div>



<div class='prefer'>
    

</div>

</section>
<section class='no-w'>
</section>
<footer>
<div class='footer'>

    <div>Il Cinefilo 2021</div>
<div>Sito web ideato da:Bonadonna Stefano O46002083</div>
    
</div>
</footer>

</body>
</html>