<?php
    session_start();
    if(!isset($_SESSION['user']))   
    {
        header("Location: login.php"); 
    }
    else{
        $userLogin = $_SESSION['user'];
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
            include_once 'elementi/header.php'
        ?>
        
        <div class="glavno">
            <div class="blok">
                <table class="profil">
                <?php
                    echo "<td class='profLeft'>";
                    echo "<img class='slProfil' src='".$_SESSION['user_dat']['img_path']."' alt=''>";
                    echo "</td>";
                    echo "<td class='profRight'>";
                    echo "<div class='opis'>";
                    echo "<div class='user'>";
                    echo "<h3>".$_SESSION['user_dat']['username']."</h3>";
                    echo "<b><p class='ime'>".$_SESSION['user_dat']['uname']." ".$_SESSION['user_dat']['last_name']."</p></b>";
                    echo "</div>";
                    echo "<b><p class='bio'>".$_SESSION['user_dat']['bio']."</p></b>";
                    echo "</div>";
                    echo "</td>";
                    echo "<td class='btns'>";
                    echo "<div><form action='upload.php'><input class='glazbaBtn' type='submit' value='Nova glazba'></form>";
                    echo "<form action='izradaListe.php'><input class='listaBtn' type='submit' value='Nova listu'></form></div>";
                    echo "</td>";
                ?>
                </table>
            </div>  
            <?php
                include_once 'skripte/ispisTabliceScr.php';
                $naslov = "Liste od: ".$userLogin;
                $sql = "SELECT * FROM albums_lists WHERE users_username = '".$userLogin."';";
                ispisLista($sql,$naslov);

                $naslov = "Glazba od: ".$userLogin;
                $sql = "SELECT * FROM music WHERE users_username = '".$userLogin."';";
                ispisGlazbe($sql,$naslov,$userLogin);
                include_once 'elementi/dodajUListuProzor.php';
                include_once 'elementi/otvaranjePlayeraJs.php';
            ?>               
        </div>

    </body>
</html>