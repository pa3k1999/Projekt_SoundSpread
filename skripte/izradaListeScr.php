<?php
    session_start();
    if (isset($_POST['upload'])) {

        $fileI = $_FILES['img'];
        $title = $_POST['title'];

        require ('DB.php');
        require ('provjere.php');

        $fileNameI = $_FILES['img']['name'];
        $fileTpmNameI = $_FILES['img']['tmp_name'];
        $fileSizeI = $_FILES['img']['size'];
        $fileErrorI = $_FILES['img']['error'];
        $fileTypeI = $_FILES['img']['type'];

        $file_partsI = pathinfo($fileNameI);
        $fileActualExtI = $file_partsI['extension'];

        if (fileError($fileErrorI) === false) {
            header("Location: ../izradaListe.php?error=greskauploadaimg");
            exit();
        } 
        if (velicinaDatoteke($fileSizeI, 8000000) === false) {
            header("Location: ../izradaListe.php?error=prevelikadatotekaimg");
            exit();
        }
        if (empty($title)) {
            header("Location: ../izradaListe.php?error=praznapolja");
            exit();
        } 

        $fileNameNewI = uniqid('', 'true').".".$fileActualExtI;
        $fileDestinationI = "../uploads/listaSlike/".$fileNameNewI;
        move_uploaded_file($fileTpmNameI, $fileDestinationI);
        $fileDestinationI = "uploads/listaSlike/".$fileNameNewI;

        $fKey = $_SESSION['user'];

        $sql ="INSERT INTO albums_lists (album_list_title, img_path, users_username) VALUES ('$title', '$fileDestinationI', '$fKey');";
        createData($sql);
        header("Location: ../profil.php?izradalistesuccess"); 
    }
    else   
    {
        header("Location: ../izradaListe.php"); 
        exit();
    }
?>