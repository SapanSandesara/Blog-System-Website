<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
        <link rel="stylesheet"
        type="text/css"
        href="readstyle.css" >
    
    </head>

<body>
    <header>
            <h1 onclick="refreshfunction()">MSwDev Students Blog!
            <img src = "vuw.png" alt = "vuw" id="img">
            <script>
                function refreshfunction(){
                    window.location.href='http://localhost/index.php'
                }
                </script>

            </h1>
            
        </header>
    <?php
$conn = mysqli_connect("localhost", "root", "", "blog");
$target='false';
?>

<?php
        echo '<br><br>DEV NOTE:<br> Passwords have been removed for now to make it easy to check and debug.Unique username will result
        in a new user. <br> A complete implementation would include storing passwords in a secure way and a way to sign up new users';
    ?>

<div id="loginform">
    <p> Login / Signup </p>

<form action="login.php" method="post">
      <input type="text" maxlength="20" name="username" placeholder="Enter a username" required>
      
      <input type="submit" value="Log in">
    </form>
            </div>

    
   
</body>

<?php

session_start();
if(isset($_REQUEST['username'])){

$username = $_REQUEST['username'];
}

$result = $conn->query("SELECT * FROM `users`;");

foreach($result as $row){
   
    if(isset($username)){
    if(strtolower($row['username']) == strtolower($username)){
        $target='true';
        $username = $row['username'];
    }
}
}

if(isset($username)){
if ($target =='true') {
        $_SESSION['name'] = $username;
        
        header("Location: http://localhost/index.php");
        exit();
    }

else
{
    $conn->query("INSERT INTO `users` VALUES(DEFAULT,'$username')");
    $_SESSION['name'] = $username;
        
    header("Location: http://localhost/index.php");
    exit();
    
    
}
}
?>

</html>