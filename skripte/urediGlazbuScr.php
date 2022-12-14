<?php
    session_start();
    if (isset($_POST['izmijeni'])) {

        $fileI = $_FILES['img'];
        $title = $_POST['title'];
        $bpm = $_POST['bpm'];
        $genre = $_POST['genre'];
        $brisanjeImg = $_POST['brisanjeImg'];
        $index = $_POST['index'];

        require ('DB.php');
        require ('provjere.php');

        $fileNameI = $_FILES['img']['name'];
        $fileTpmNameI = $_FILES['img']['tmp_name'];
        $fileSizeI = $_FILES['img']['size'];
        $fileErrorI = $_FILES['img']['error'];
        $fileTypeI = $_FILES['img']['type'];

        $file_partsI = pathinfo($fileNameI);
        $fileActualExtI = $file_partsI['extension'];

        if ($fileErrorI !== 0 && $fileErrorI !== 4) {
            header("Location: ../urediGlazbu.php?index=".$index."&error=greskauploadaimg".$fileErrorI);
            exit();
        } 
        if (velicinaDatoteke($fileSizeI, 2000000) === false) {
            header("Location: ../urediGlazbu.php?index=".$index."&error=prevelikadatotekaimg");
            exit();
        }
        if (praznaPoljaUpload($title, $bpm, $genre) !== false) {
            header("Location: ../urediGlazbu.php?index=".$index."&error=praznapolja");
            exit();
        }

        if ($fileErrorI === 0) {
            unlink("../".$brisanjeImg);
            $fileNameNewI = uniqid('', 'true').".".$fileActualExtI;
            $fileDestinationI = "../uploads/glazbaSlike/".$fileNameNewI;
            move_uploaded_file($fileTpmNameI, $fileDestinationI);
            $fileDestinationI = "uploads/glazbaSlike/".$fileNameNewI;
        }
        else{
            $fileDestinationI = $brisanjeImg;
        }

        $sql ="UPDATE music SET title='$title', bpm='$bpm', genre='$genre', img_path='$fileDestinationI' WHERE  id_music = $index;";
        createData($sql);
        header("Location: ../uredjivanje.php?izmjenasuccess");   
    }
    else   
    {
        header("Location: ../urediGlazbu.php?index=".$index); 
        exit();
    }
?>