<?php
    session_start();
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="dizajn.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Početna</title>
    </head>

    <body>
        <?php
            include_once 'elementi/header.php';
        ?>
        <div class="glavno">
            <div class="blokPlayer">
                <table class="player">
                    <tr>
                        <td class="playerLijevo">
                            <img class="playerSlika" src="uploads/glazbaSlike/5ff742e1178160.13390891.jpg" alt=""></img>
                        </td>
                        <td class="playerDesno">
                            <div class="playerUpper">
                                <img src="elementi/ljevo.png" alt="" class="prews">
                                <div class="playerNaslov">
                                    <h2 class="playerNaziv">Naslov</h2>
                                    <h3 class="playerAutor">Autor</h3>
                                </div>
                                <img src="elementi/desno.png" alt="" class="next">
                            </div>
                                
                            <div class="player">
                                <audio src="" controls id="audioPlayer" autoplay>
                                    </audio>
                            </div>       
                        </td>
                    </tr>
                </table>
            </div>

            <?php
                 include_once 'skripte/ispisTabliceScr.php';
                 $naslov = "Sve pjesme.";
                 if(!isset($_GET['iduser'])){
                     if(isset($_GET['lista'])){
                        $sql = "SELECT * FROM music WHERE id_music IN (SELECT music_id_music FROM music_in_albums WHERE albums_lists_id_albums_lists = '".$_GET['lista']."');";
                        $id = $_GET['lista'];
                     }
                 }
                 else if($_GET['iduser'] === "sve"){
                    $sql = "SELECT * FROM music;";
                    $id = "sve";
                 }
                 else{
                    $sql = "SELECT * FROM music WHERE users_username = '".$_GET['iduser']."';";
                    $id = $_GET['iduser'];
                 }
                 
                 ispisGlazbe($sql,$naslov,$id);
                 include_once 'elementi/dodajUListuProzor.php';
            ?> 
            <script>
               
                var lista = "<?php echo $id; ?>";
                if(<?php if(!isset($_GET['iduser'])){echo "false";} else{echo "true";} ?> === true){
                    var index = $("#"+lista+" #<?php if(isset($_GET['iduser'])){echo $_GET['idglazbe'];} ?>").index();
                }
                else{
                    var index = 0;
                }

                promjeniGlazbu(lista, index);
                
                $(".listaR").click(function(){
                    index = $(this).index();
                    lista = $(this).parent().parent().attr('id');
                    promjeniGlazbu(lista, index);
                });

                $(".prews").click(function(){
                    index --;
                    if(index < 0)
                        index = document.getElementById(lista).rows.length - 1;

                    promjeniGlazbu(lista, index);
                });

                $(".next").click(function(){
                    index++;
                    if(index == document.getElementById(lista).rows.length)
                        index = 0;
                    
                    promjeniGlazbu(lista, index);;
                });

                $("#audioPlayer")[0].addEventListener("ended", function(){
                    index++;
                    if(index == document.getElementById(lista).rows.length)
                        index = 0;
                    
                    promjeniGlazbu(lista, index);
                });
                
                function promjeniGlazbu(aLista, aIndex){     
                    $("#audioPlayer")[0].src = $("#"+aLista+" tr").eq(aIndex).find("a")[0];
                    $(".playerNaziv")[0].innerHTML = $("#"+aLista+" tr").eq(aIndex).find(".naziv").text();
                    $(".playerAutor")[0].innerHTML = $("#"+aLista+" tr").eq(aIndex).find(".autor").text();
                    $(".playerSlika")[0].src = $("#"+aLista+" tr").eq(aIndex).find(".slGlazbe").attr('src');
                    $("table tr").removeClass("playing");
                    $("#"+aLista+" tr").eq(aIndex).addClass("playing");
                }
            </script>  
        </div>
    </body>
</html>