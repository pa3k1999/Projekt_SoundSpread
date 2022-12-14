<header>
    <a class="logo" href="./index.php">SoundSpread</a>
    <nav>
        <a href="./index.php">Početna</a>
        <?php
            if(isset($_SESSION['user'])){
                echo "<a href='profil.php'>Profil</a>";
                echo "<a href='uredjivanje.php'>Uredi glazbu</a>";
                echo "<a href='skripte/logOutScr.php'>LogOut</a>";
            }
            else{
                echo "<a href='login.php'>Login</a>";
            }
        ?>    
    </nav>
</header>