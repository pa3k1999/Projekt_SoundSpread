<?php
    if(isset($_POST['signup'])){

        $fileI = $_FILES['img'];
        $username = $_POST["username"];
        $name = $_POST["name"];
        $lastName = $_POST["lastname"];
        $password = $_POST["password"];
        $passwordRpt = $_POST["passwordrpt"];
        $bio = $_POST["bio"];

        require ('DB.php');
        require ('provjere.php');

        $fileNameI = $_FILES['img']['name'];
        $fileTpmNameI = $_FILES['img']['tmp_name'];
        $fileSizeI = $_FILES['img']['size'];
        $fileErrorI = $_FILES['img']['error'];
        $fileTypeI = $_FILES['img']['type'];

        $file_partsI = pathinfo($fileNameI);
        $fileActualExtI = $file_partsI['extension'];

        if (praznaPoljaSignup($username, $name, $lastName, $password, $passwordRpt, $bio) !== false){
            header("location: ../signUp.php?error=praznapolja");
            exit();
        }

        if (ispravanUsername($username) !== false){
            header("location: ../signUp.php?error=neispravanusername");
            exit();
        }

        if (ispravanPassword($password, $passwordRpt) !== false){
            header("location: ../signUp.php?error=neispravanpassword");
            exit();
        }

        if (postojeciUser($username) !== false){
            header("location: ../signUp.php?error=postojiuser");
            exit();
        }
        if (fileError($fileErrorI) === false) {
            header("Location: ../signUp.php?error=greskauploadaimg");
            exit();
        } 
        if (velicinaDatoteke($fileSizeI, 8000000) === false) {
            header("Location: ../signUp.php?error=prevelikadatotekaimg");
            exit();
        }

        $fileNameNewI = uniqid('', 'true').".".$fileActualExtI;
        $fileDestinationI = "../uploads/profilSlike/".$fileNameNewI;
        move_uploaded_file($fileTpmNameI, $fileDestinationI);
        $fileDestinationI = "uploads/profilSlike/".$fileNameNewI;

        $sql ="INSERT INTO users (username, uname, last_name, bio, upassword, img_path) VALUES 
        ('$username', '$name', '$lastName', '$bio', '$password', '$fileDestinationI');";
        createData($sql);
        header("Location: ../login.php");
    }
    else   
    {
        header("Location: signUp.php"); 
        exit();
    }
?>