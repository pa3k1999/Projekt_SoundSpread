<?php
    if(isset($_POST['login']))    
    {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        require ('DB.php');
        require ('provjere.php');

        if (praznaPoljaLogin($username, $password) !== false){
            header("location: ../login.php?error=praznapolja");
            exit();
        }
        
        $luser = postojeciUser($username);

        if($luser === false){
            header("location: ../login.php?error=krivilogin");
            exit();
        }
        $userPass = $luser["upassword"];
        
        if ($userPass !== $password){
            header("location: ../login.php?error=krivilogin");
            exit();
        }
        else if($userPass === $password){
            session_start();
            $_SESSION['user'] = $luser["username"];
            $_SESSION['user_dat'] = $luser;
            header("location: ../profil.php");
            exit();
        }
    }
    else   
    {
        header("Location: login.php"); 
        exit();
    }
?>