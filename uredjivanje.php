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

            <?php
                include_once 'skripte/DB.php';
                $sql = "SELECT * FROM albums_lists WHERE users_username = '".$userLogin."';";
                $rezultat = mysqlUpit($sql);
                $provjera = mysqli_num_rows($rezultat);
                $counter = 0;

                if($provjera > 0){
                    echo "<div class='blok'>\n";
                    echo "\t<p class='naslov'>Liste</p>\n";
                    echo "\t<table id='sve' class='prikazLista' cellpadding='0' cellspacing='0'>\n";
                    echo "\t\t<tr class='prikazListaR'>\n";
                    while($row = mysqli_fetch_assoc($rezultat)){
                        echo "\t\t\t<td class='prikazListaS' id='".$row['id_albums_lists']."'>\n";
                        echo "\t\t\t\t<div class='prikazListaSlika'><div><img class='editLista' src='elementi/edit.png' alt=''></div><img class='slListe' src='".$row['img_path']."' alt=''></div>\n";
                        echo "\t\t\t\t<div class='prikazListaNaziv'><p>".$row['album_list_title']."</p></div>\n";
                        echo "\t\t\t</td>\n";
                        $counter++;
                        if($counter === 7){
                            echo "\t\t</tr>\n";
                            echo "\t\t<tr class='prikazListaR'>\n";
                            $counter = 0;
                        }
                    }
                    echo "\t\t</tr>\n";
                    echo "\t</table>\n"; 
                    echo "</div>\n";     
                }
                $sql = "SELECT * FROM music WHERE users_username = '".$userLogin."';";
                $rezultat = mysqlUpit($sql);
                $provjera = mysqli_num_rows($rezultat);

                if($provjera > 0){
                    echo "<div class='blok'>\n";
                    echo "\t<p class='naslov'>Glazba</p>\n";
                    echo "\t<table id='sve' class='lista' cellpadding='0' cellspacing='0'>\n";
                    while($row = mysqli_fetch_assoc($rezultat)){
                        echo "\t\t<tr class='listaR' id='".$row['id_music']."'>\n";
                        echo "\t\t\t<td class='slika'>\n";
                        echo "\t\t\t\t<p class='path' hidden>".$row['music_path']."</p>\n";
                        echo "\t\t\t\t<img class='slGlazbe' src='".$row['img_path']."' alt=''></img>\n";
                        echo "\t\t\t</td>\n";
                        echo "\t\t\t<td style='vertical-align:top'>\n";
                        echo "\t\t\t\t<div class='opis'>\n";
                        echo "\t\t\t\t\t<h3 class='naziv'>".$row['title']."</h3>\n";
                        echo "\t\t\t\t</div>\n";
                        echo "\t\t\t<td class='ikone'>\n";
                        echo "\t\t\t<img class='edit' src='elementi/edit.png' alt=''>\n";
                        echo "\t\t\t<img  class='smece' src='elementi/smece.png' alt=''>\n";
                        echo "\t\t\t</td>\n";
                        echo "\t\t</tr>\n";
                    }
                    echo "\t</table>\n"; 
                    echo "</div>\n";     
                }
            ?>     
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h1 >Brisanje glazbe</h1>
                <p>Jeste li sigurni da zelite obrisati glazbu?</p>
                <div>
                        <button onclick="odustani()">Odustani</button>
                        <button class="obrisi" onclick="obrisi()">Obrisi</button>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            var httpReq = new XMLHttpRequest();
            var modal = document.getElementById("myModal");
            var span = document.getElementsByClassName("close")[0];
            var brisanjeID;
            var brisanjeImg;
            var brisanjeGlazba;
            var red;

            $(".smece").click(function() {
                brisanjeID = $(this).parent().parent().attr('id');
                brisanjeImg = $(this).parent().parent().find(".slGlazbe").attr('src');
                brisanjeGlazba = $(this).parent().parent().find(".path").html();
                red = $(this).parent().parent()[0];
                modal.style.display = "block";
            });
            $(".edit").click(function() {
                var editID = $(this).parent().parent().attr('id');
                window.location = "urediGlazbu.php?index="+editID;
            });
            $(span).click(function() {
                modal.style.display = "none";
            });

            $(window).click(function(e) {
                if (e.target == modal) {
                    modal.style.display = "none";
                }
            });
            $(".prikazListaS").click(function() {
                var editID = $(this).attr('id');
                window.location = "urediListu.php?index="+editID;
            });
            

            function obrisi() {
                red.style.display = "none";
                httpReq.open("GET","skripte/brisanjeScr.php?brisanjeid="+brisanjeID+"&brisanjeimg="+brisanjeImg+"&brisanjeglazba="+brisanjeGlazba+"&element=glazba");
                httpReq.send();
                modal.style.display = "none";
            }
            function odustani() {
                modal.style.display = "none";
            }
            

        </script>
    </body>
</html>