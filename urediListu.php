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
            if(isset($_GET['index']))
                $index = $_GET['index'];
            else
                header("Location: uredjivanje.php");

            include_once 'skripte/DB.php';
            $sql = "SELECT * FROM albums_lists WHERE id_albums_lists = $index;";
            $rezultat = mysqlUpit($sql);
            $row = mysqli_fetch_assoc($rezultat);
            $imgPath = $row['img_path'];

            include_once 'elementi/header.php';
        ?>
        
        <div class="glavno">
            <div class="blokUrediListu">
            <table class="urediListu" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="ljevo">
                        <img class="imgUrediL" src="<?php echo $row['img_path']; ?>" alt="">
                        <h3><?php echo $row['album_list_title']; ?></h3>
                    </td>
                    <td class="centar">
                        <div class="upload">
                            <form action="skripte/urediListuScr.php" method="post" enctype="multipart/form-data">
                                <div class="forma">
                                    <div>
                                        <label for="">Naziv liste:</label>
                                        <input type="text" name="title" value="<?php echo $row['album_list_title']; ?>">
                                    </div>  
                                    <div>
                                        <label for="">Promjeni sliku:</label>
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
                    </td>
                    <td class="desno">
                        <img class="smece" src="elementi/smece.png" alt="">
                    </td>
                </tr>
            </table>
                
            </div> 
            <?php 
                $sql = "SELECT * FROM music WHERE id_music IN (SELECT music_id_music FROM music_in_albums WHERE albums_lists_id_albums_lists = '$index');";
                $rezultat = mysqlUpit($sql);
                $provjera = mysqli_num_rows($rezultat);

                if($provjera > 0){
                    echo "<div class='blok'>\n";
                    echo "\t<p class='naslov'>Glazba u listi</p>\n";
                    echo "\t<table id='sve' class='lista' cellpadding='0' cellspacing='0'>\n";
                    while($row = mysqli_fetch_assoc($rezultat)){
                        echo "\t\t<tr class='listaR' id='".$row['id_music']."'>\n";
                        echo "\t\t\t<td class='slika'>\n";
                        echo "\t\t\t\t<img class='slGlazbe' src='".$row['img_path']."' alt=''></img>\n";
                        echo "\t\t\t</td>\n";
                        echo "\t\t\t<td style='vertical-align:top'>\n";
                        echo "\t\t\t\t<div class='opis'>\n";
                        echo "\t\t\t\t\t<h3 class='naziv'>".$row['title']."</h3>\n";
                        echo "\t\t\t\t</div>\n";
                        echo "\t\t\t<td class='ikone'>\n";
                        echo "\t\t\t<img class='minus' src='elementi/minus.png' alt=''>\n";
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
                <h1>Brisanje liste</h1>
                <p>Jeste li sigurni da zelite obrisati listu?</p>
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
            var brisanjeImg = "<?php echo $imgPath; ?>";
            var listaID = <?php echo $index; ?>;
            var brisanjeID;
            var red;

            $(".minus").click(function() {
                brisanjeID = $(this).parent().parent().attr('id');
                var red = $(this).parent().parent()[0];
                red.style.display = "none";
                httpReq.open("GET","skripte/brisanjeScr.php?brisanjeid="+brisanjeID+"&lista="+listaID+"&element=listaglazba");
                httpReq.send();
            });
            $(".smece").click(function() {
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

            function obrisi() {
                httpReq.open("GET","skripte/brisanjeScr.php?brisanjeid="+listaID+"&brisanjeimg="+brisanjeImg+"&element=lista");
                httpReq.send();
                window.location = "uredjivanje.php";
            }
            function odustani() {
                modal.style.display = "none";
            }

        </script>        
    </body>
</html>