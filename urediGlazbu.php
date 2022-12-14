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
        <title>Upload</title>
    </head>

    <body>
        
        <?php
            if(isset($_GET['index']))
                $index = $_GET['index'];
            else
                header("Location: uredjivanje.php");

            include_once 'skripte/DB.php';
            $sql = "SELECT * FROM music WHERE id_music = $index;";
            $rezultat = mysqlUpit($sql);
            $row = mysqli_fetch_assoc($rezultat);

            include_once 'elementi/header.php';
        ?>
        
        <div class="glavno">
            <div class="blok">
                <div class="upload">
                    <form action="skripte/urediGlazbuScr.php" method="post" enctype="multipart/form-data">
                        <div class="forma">
                            <div>
                                <label for="">Naziv glazbe:</label>
                                <input type="text" name="title" value="<?php echo $row['title']; ?>">
                            </div>
                            <div>
                                <label for="">Zanr:</label>
                                <input type="text" name="genre" value="<?php echo $row['genre']; ?>">
                            </div>  
                            <div>
                                <label for="">Bpm:</label>
                                <input type="number" name="bpm" min="60" max="300" value="<?php echo $row['bpm']; ?>">
                            </div> 
                            <div>
                                <label for="">Slika pjesme:</label>
                            </div>
                            <div>
                                <input type="file" name="img" accept="image/*">
                            </div>
                            <div>
                                <input type="hidden" name="brisanjeImg" value="<?php echo $row['img_path']; ?>">
                            </div>
                            <div>
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                            </div>
                        </div>
                        
                        <div class="submit">
                            <input type="submit" name="izmijeni" value="Izmijeni">
                        </div>
                    </form>
                </div>
            </div>  
        </div>

    </body>
</html>