<?php
    function praznaPoljaSignup($username, $name, $lastName, $password, $passwordRpt, $bio){
        $result;
        if(empty($username) || empty($name) || empty($lastName) || empty($password) || empty($passwordRpt || empty($bio))){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function ispravanUsername($username){
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function ispravanPassword($password, $passwordRpt){
        $result;
        if($password !== $passwordRpt){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function postojeciUser($username){
        include_once "DB.php";
        $conn = connection();
        $sql = "SELECT * FROM users WHERE username = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../signUp.php?error=stmtgreska");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $data = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($data)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function praznaPoljaLogin($username, $password){
        $result;
        if(empty($username) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function ispravanFormatDatoteke($fileActualExt, $extension){
        $result;
        if($fileActualExt === $extension){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function fileError($fileError){
        $result;
        if($fileError === 0){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function velicinaDatoteke($fileSize, $max){
        $result;
        if($fileSize < $max){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function praznaPoljaUpload($title, $bpm, $genre){
        $result;
        if(empty($title) || empty($bpm || empty($genre))){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }
?>