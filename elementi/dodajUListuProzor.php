<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <?php
            include_once 'skripte/DB.php';
            $listeUsera = "SELECT * FROM albums_lists WHERE users_username = '".$_SESSION['user']."';";
            $rezultatLista = mysqlUpit($listeUsera);
            $provjeraLista = mysqli_num_rows($rezultatLista);
            if($provjeraLista > 0){
                echo "<h2>Odaberi listu</h2>\n";
                echo "<div class='tableScrollListe'>\n";
                echo "\t<table class='popisLista' cellpadding='0' cellspacing='0'>\n";
                while($row = mysqli_fetch_assoc($rezultatLista)){
                    echo "\t\t<tr id='".$row['id_albums_lists']."' class='popisR'>\n";
                    echo "\t\t\t<td class='Lslika'>\n";
                    echo "\t\t\t\t<img class='slListe' src='".$row['img_path']."' alt=''></img>\n";
                    echo "\t\t\t</td>\n";
                    echo "\t\t\t<td style='vertical-align: middle'>\n";
                    echo "\t\t\t\t<h4>".$row['album_list_title']."</h4>\n";
                    echo "\t\t\t</td>\n";
                }
                echo "\t</table>\n";
                echo "</div>\n";    
            }
            else{
                echo "\t<h2>Nemate nijednu listu</h2>\n";
            }
        ?>
    </div>
</div>
<script>
    var httpReq = new XMLHttpRequest();
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];
    var listID;
    var musicID;

    $(".plus").click(function() {
        modal.style.display = "block";
        musicID = $(this).parent().parent().parent().attr('id');
        event.stopPropagation();
    });
    
    $(span).click(function() {
        modal.style.display = "none";
    });

    $(window).click(function(e) {
        if (e.target == modal) {
            modal.style.display = "none";
        }
    });

    $(".popisR").click(function() {
        listID = $(this).attr('id');
        httpReq.open("GET","skripte/ubaciUListuScr.php?musicID="+musicID+"&listID="+listID);
        httpReq.send();
        modal.style.display = "none";
    });

</script>