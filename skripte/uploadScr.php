<?php
    session_start();
    if (isset($_POST['upload'])) {

        $fileM = $_FILES['music'];
        $fileI = $_FILES['img'];
        $title = $_POST['title'];
        $bpm = $_POST['bpm'];
        $genre = $_POST['genre'];
        $duration = $_POST['duration'];

        require ('DB.php');
        require ('provjere.php');

        $fileNameM = $_FILES['music']['name'];
        $fileTpmNameM = $_FILES['music']['tmp_name'];
        $fileSizeM = $_FILES['music']['size'];
        $fileErrorM = $_FILES['music']['error'];
        $fileTypeM = $_FILES['music']['type'];

        $fileNameI = $_FILES['img']['name'];
        $fileTpmNameI = $_FILES['img']['tmp_name'];
        $fileSizeI = $_FILES['img']['size'];
        $fileErrorI = $_FILES['img']['error'];
        $fileTypeI = $_FILES['img']['type'];

        $file_partsM = pathinfo($fileNameM);
        $fileActualExtM = $file_partsM['extension'];

        $file_partsI = pathinfo($fileNameI);
        $fileActualExtI = $file_partsI['extension'];

        if (ispravanFormatDatoteke($fileActualExtM, "mp3") === false) {
            header("Location: ../upload.php?error=kriviformatmp3");
            exit();
        } 
        if (fileError($fileErrorM) === false) {
            header("Location: ../upload.php?error=greskauploadamp3");
            exit();
        } 
        if (velicinaDatoteke($fileSizeM, 20000000) === false) {
            header("Location: ../upload.php?error=prevelikadatotekamp3");
            exit();
        } 
        if (fileError($fileErrorI) === false) {
            header("Location: ../upload.php?error=greskauploadaimg");
            exit();
        } 
        if (velicinaDatoteke($fileSizeI, 2000000) === false) {
            header("Location: ../upload.php?error=prevelikadatotekaimg");
            exit();
        }
        if (praznaPoljaUpload($title, $bpm, $genre) !== false) {
            header("Location: ../upload.php?error=praznapolja");
            exit();
        } 

        $fileNameNewM = uniqid('', 'true').".".$fileActualExtM;
        $fileDestinationM = "../uploads/glazba/".$fileNameNewM;
        move_uploaded_file($fileTpmNameM, $fileDestinationM);
        $fileDestinationM = "uploads/glazba/".$fileNameNewM;

        $fileNameNewI = uniqid('', 'true').".".$fileActualExtI;
        $fileDestinationI = "../uploads/glazbaSlike/".$fileNameNewI;
        move_uploaded_file($fileTpmNameI, $fileDestinationI);
        $fileDestinationI = "uploads/glazbaSlike/".$fileNameNewI;

        $fKey = $_SESSION['user'];

        $sql ="INSERT INTO music (title, bpm, genre, duration, img_path, music_path, users_username) 
        VALUES ('$title', '$bpm', '$genre', '$duration', '$fileDestinationI', '$fileDestinationM', '$fKey');";
        createData($sql);
        header("Location: ../profil.php?uploadsuccess");   
    }
    else   
    {
        header("Location: ../upload.php"); 
        exit();
    }
?>