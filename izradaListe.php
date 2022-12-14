<?php
    session_start();
    if(!isset($_SESSION['user']))   
    {
        header("Location: login.php"); 
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>

        <script type="text/javascript" src="https://rawgithub.com/moment/moment/2.2.1/min/moment.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="dizajn.css">
        <title>Izrada liste</title>
    </head>

    <body>
        
        <?php
            include_once 'elementi/header.php';
        ?>
        
        <div class="glavno">
            <div class="blok">
               
                <div class="upload">
                    <form action="skripte/izradaListeScr.php" method="post" enctype="multipart/form-data">
                        <div class="forma">
                            <div>
                                <label for="">Naziv liste:</label>
                                <input type="text" name="title">
                            </div>  
                            <div>
                                <label for="">Slika liste:</label>
                            </div>
                            <div>
                                <input type="file" name="img" accept="image/*">
                            </div>
                        </div>
                        <div class="submit">
                            <input type="submit" name="upload" value="Upload">
                        </div>
                    </form>
                </div>
                
            </div>  
        </div>

    </body>
</html>