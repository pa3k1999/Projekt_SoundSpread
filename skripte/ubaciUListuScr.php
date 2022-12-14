<?php
  $musicID = $_GET["musicID"];
  $listID = $_GET["listID"];

  require ('DB.php');
  $sql ="INSERT INTO music_in_albums (music_id_music, albums_lists_id_albums_lists) VALUES ('$musicID', '$listID');";
  createData($sql);
?>
