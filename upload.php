<?php
    session_start();
    if(!isset($_SESSION['user']))   
    {
        header("Location: login.php"); 
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>

        <script type="text/javascript" src="https://rawgithub.com/moment/moment/2.2.1/min/moment.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="dizajn.css">
        <title>Upload</title>
    </head>

    <body>
        
        <?php
            include_once 'elementi/header.php';
        ?>
        
        <div class="glavno">
            <div class="blok">
               
                <div class="upload">
                    <form action="skripte/uploadScr.php" method="post" enctype="multipart/form-data">
                        <div class="forma">
                            <div>
                                <label for="">Naziv glazbe:</label>
                                <input type="text" name="title">
                            </div>
                            <div>
                                <label for="">Zanr:</label>
                                <input type="text" name="genre">
                            </div>  
                            <div>
                                <label for="">Bpm:</label>
                                <input type="number" name="bpm" min="60" max="300">
                            </div>
                            <div>
                                <label for="">MP3 fajl:</label>
                            </div> 
                            <div>
                                <input type="file" name="music" id="music" accept=".mp3"> 
                                <audio id="audio"></audio>
                            </div> 
                            <div>
                                <label for="">Slika pjesme:</label>
                            </div>
                            <div>
                                <input type="file" name="img" accept="image/*">
                            </div>
                            <div>
                                <input type="hidden" name="duration" id="duration" value="">
                            </div>
                        </div>
                        
                        <div class="submit">
                            <input type="submit" name="upload" value="Upload">
                        </div>
                    </form>
                </div>
                <div id = "odgovor"></div>
                <script type="text/javascript">
                    var objectUrl;
                    $("#audio").on("canplaythrough", function(e){
                        var seconds = e.currentTarget.duration;
                        var duration = moment.duration(seconds, "seconds");

                        var time = "";
                        var hours = duration.hours();
                        if (hours > 0) { time = hours + ":" ; }
                        if(duration.seconds() < 10)
                            time = time + duration.minutes() + ":0" + duration.seconds();
                        else
                            time = time + duration.minutes() + ":" + duration.seconds();
                        
                        document.getElementById("duration").value = time;
                        
                        URL.revokeObjectURL(objectUrl);
                    });

                    $("#music").change(function(e){
                        var file = e.currentTarget.files[0];
                        
                        objectUrl = URL.createObjectURL(file);
                        $("#audio").prop("src", objectUrl);
                    });
                </script>
            </div>  
        </div>

    </body>
</html>