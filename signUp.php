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
               
                <div class="signup">
                    <form action="skripte/signupScr.php" method="post" enctype="multipart/form-data">
                        <div class="forma">
                            <div>
                                <label for="">Username:</label>
                                <input type="text" name="username">
                            </div>
                            <div>
                                <label for="">Name:</label>
                                <input type="text" name="name">
                            </div>
                            <div>
                                <label for="">Last name:</label>
                                <input type="text" name="lastname">
                            </div>
                            <div>
                                <label for="">Password:</label>
                                <input type="password" name="password">
                            </div> 
                            <div>
                                <label for="">Password:</label>
                                <input type="password" name="passwordrpt">
                            </div>
                            <div>
                                <label for="">Bio:</label>
                            </div>
                            <div>
                                <textarea name="bio" rows="5" cols="40"></textarea>
                            </div>
                            <div>
                                <label for="">Slika profila:</label>
                            </div>
                            <div>
                                <input type="file" name="img" accept="image/*">
                            </div>
                        </div>
                            
                        <div class="submit">
                            <input type="submit" name="signup" value="Signup">
                        </div>
                    </form>
                </div>
                <div id = "odgovor"></div>

            </div>  
        </div>

    </body>
</html>