<?php

    function connection(){
      $server ="localhost";
      $username = "epiz_27784619";
      $password = "nikolpatrik1";
      $database ="epiz_27784619_soundspread";

      $conn = mysqli_connect($server, $username, $password, $database);
      return $conn;
    }

    function createData($sql){
      $conn = connection();
      $res = mysqli_query($conn, $sql);
      mysqli_close($conn);   
    }

    function mysqlUpit($sql){
      $conn = connection();
      $rezultat = mysqli_query($conn, $sql);
      return $rezultat;
    }

?>