<?php
    session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="dizajn.css">
        <title>Početna</title>
    </head>

    <body>
        <?php
            include_once 'elementi/header.php';
        ?>
        <div class="glavno">

            <?php
                include_once 'skripte/ispisTabliceScr.php';
                $naslov = "Sve liste";
                $sql = "SELECT * FROM albums_lists;";
                ispisLista($sql,$naslov);
                $naslov = "Sve pjesme";
                $sql = "SELECT * FROM music;";
                ispisGlazbe($sql,$naslov,"sve");
                include_once 'elementi/dodajUListuProzor.php';
                include_once 'elementi/otvaranjePlayeraJs.php';
            ?>   
        </div>

    </body>
</html>