<?php
    $brisanjeID = $_GET['brisanjeid'];
    $element = $_GET['element'];

    require ('DB.php');
    if($element === "glazba"){
        $brisanjeImg = $_GET['brisanjeimg'];
        $glazba = $_GET['brisanjeglazba'];
        $sql ="DELETE FROM music WHERE id_music = '$brisanjeID';";
        unlink("../".$brisanjeImg);
        unlink("../".$glazba);
        createData($sql);
    }
    else if($element === "lista"){
        $brisanjeImg = $_GET['brisanjeimg'];
        $sql ="DELETE FROM albums_lists WHERE id_albums_lists = $brisanjeID;";
        unlink("../".$brisanjeImg);
        createData($sql);
        echo $sql;
    }
    else if($element === "listaglazba"){
        $lista = $_GET['lista'];
        $sql ="DELETE FROM music_in_albums WHERE music_id_music = '$brisanjeID' AND albums_lists_id_albums_lists = '$lista';";
        createData($sql);
    }
    
?>