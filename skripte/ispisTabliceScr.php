<?php

    function ispisGlazbe($sql, $naslov, $id){
        include_once 'skripte/DB.php';
        $rezultat = mysqlUpit($sql);
        $provjera = mysqli_num_rows($rezultat);

        if($provjera > 0){
            echo "<div class='blok'>\n";
            echo "\t<p class='naslov'>".$naslov."</p>\n";
            echo "\t<table id='".$id."' class='lista' cellpadding='0' cellspacing='0'>\n";
            while($row = mysqli_fetch_assoc($rezultat)){
                echo "\t\t<tr class='listaR' id='".$row['id_music']."'>\n";
                echo "\t\t\t<td class='slika'>\n";
                echo "\t\t\t\t<a href='".$row['music_path']."' style='visibility: hidden;'></a>\n";
                echo "\t\t\t\t<img class='slGlazbe' src='".$row['img_path']."' alt=''></img>\n";
                echo "\t\t\t</td>\n";
                echo "\t\t\t<td style='vertical-align:top'>\n";
                echo "\t\t\t\t<div class='opis'>\n";
                echo "\t\t\t\t\t<h3 class='naziv'>".$row['title']."</h3>\n";
                echo "\t\t\t\t\t<h4 class='autor'>".$row['users_username']."</h4>\n";
                echo "\t\t\t\t\t<img class='plus' src='elementi/plus.png' alt=''></img>\n";
                echo "\t\t\t\t</div>\n";
                echo "\t\t\t</td>\n";
                echo "\t\t\t<td class='vrijeme'>\n";
                echo "\t\t\t\t<h4>".$row['duration']."</h4>\n";
                echo "\t\t\t</td>\n";
                echo "\t\t</tr>\n";
            }
            echo "\t</table>\n"; 
            echo "</div>\n";     
        }
        else {
            echo "<div class='blok'>\n";
            echo "\t<p class='naslov'>Nema glazbe!</p>\n";
            echo "</div>\n";
        }
    }

    function ispisLista($sql, $naslov){
        include_once 'skripte/DB.php';
        $rezultat = mysqlUpit($sql);
        $provjera = mysqli_num_rows($rezultat);
        $counter = 0;

        if($provjera > 0){
            echo "<div class='blok'>\n";
            echo "\t<p class='naslov'>".$naslov."</p>\n";
            echo "\t<table id='sve' class='prikazLista' cellpadding='0' cellspacing='0'>\n";
            echo "\t\t<tr class='prikazListaR'>\n";
            while($row = mysqli_fetch_assoc($rezultat)){
                echo "\t\t\t<td class='prikazListaS' id='".$row['id_albums_lists']."'>\n";
                echo "\t\t\t\t<div class='prikazListaSlika'><img class='slListe' src='".$row['img_path']."' alt=''></div>\n";
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
    }
?>