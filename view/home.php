<?php
    if(App\Session::getUser()){
?>
    <h1>BIENVENUE<br>
        <?php echo $_SESSION['user']; ?>
    </h1>
<?php
    }else{
?>
        <h1>BIENVENUE</h1>
<?php

    }
?>

<video id="background-video" autoplay loop muted>
    <source src="public/videos/demo.mp4" type="video/mp4">
</video>