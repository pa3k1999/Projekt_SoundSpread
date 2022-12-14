<?php 
    session_start();
    if(isset($_SESSION['user']))   
    {
        header("Location:profil.php"); 
    }
 ?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="dizajn.css">

        <title>Profilna</title>
    </head>

    <body>
        
        <?php
            include_once 'elementi/header.php';
        ?>
        
        <div class="glavno">
            <div class="blok">
               
                <div class="login">
                    <form action="skripte/loginScr.php" method="post">
                        <div class="forma">
                            <div>
                                <label for="">Username:</label>
                                <input type="text" name="user">
                            </div>
                            <div>
                                <label for="">Password:</label>
                                <input type="password" name="pass">
                            </div>
                        </div>
                        
                        <div class="submit">
                            <input type="submit" name="login" value="Login">
                        </div>
                    </form>    
                    <p>Don't have an account? <a href="signUp.php">Sign up now</a>.</p>
                </div>

            </div>  
        </div>

    </body>
</html>

