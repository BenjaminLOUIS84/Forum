<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Connexion</title>
</head>
<body>

    <div class="topicINSC">

        <!-- Logo en arrière plan -->
        <figure>
            <img src="./public/img/logo.png" class="logo" alt="Logo Dev Cook">
        </figure>

        <p>Renseigner votre adresse mail et votre mot de passe pour vous connecter<p>

        <form class="connexion" action="index.php?ctrl=security&action=login" method="post">
        
            <label for="mail">Mail</label>
            <input type="email" name="mail" id="mail" required><br>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" minlength="8" required><br>

            <input id="submitLog" type="submit" name="login" value="CONNEXION">
        </form>

    </div>

    <!-- Vidéo en arrière plan -->
    <video id="background-video" autoplay loop muted>
        <source src="public/videos/demo.mp4" type="video/mp4">
    </video>

    
</body>
</html>