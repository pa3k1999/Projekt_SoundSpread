<?php
    session_start();
    if (isset($_POST['izmijeni'])) {

        $fileI = $_FILES['img'];
        $title = $_POST['title'];
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
            header("Location: ../urediListu.php?index=".$index."&error=greskauploadaimg".$fileErrorI);
            exit();
        } 
        if (velicinaDatoteke($fileSizeI, 2000000) === false) {
            header("Location: ../urediListu.php?index=".$index."&error=prevelikadatotekaimg");
            exit();
        }
        if (praznaPoljaUpload($title, $bpm, $genre) !== false) {
            header("Location: ../urediListu.php?index=".$index."&error=praznapolja");
            exit();
        }

        if ($fileErrorI === 0) {
            unlink("../".$brisanjeImg);
            $fileNameNewI = uniqid('', 'true').".".$fileActualExtI;
            $fileDestinationI = "../uploads/listaSlike/".$fileNameNewI;
            move_uploaded_file($fileTpmNameI, $fileDestinationI);
            $fileDestinationI = "uploads/listaSlike/".$fileNameNewI;
        }
        else{
            $fileDestinationI = $brisanjeImg;
        }

        $sql ="UPDATE albums_lists SET album_list_title='$title', img_path='$fileDestinationI' WHERE  id_albums_lists = $index;";
        createData($sql);
        header("Location: ../urediListu.php?index=".$index);   
    }
    else   
    {
        header("Location: ../urediListu.php?index=".$index); 
        exit();
    }
?>