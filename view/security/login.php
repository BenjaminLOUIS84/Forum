<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Connexion</title>
</head>
<body>

    <div class="topicINSC">

    <h2>CONNEXION</h2>

    <form action="index.php?ctrl=security&action=addUser" method="post">
       
        <label for="mail">Mail</label>
        <input type="email" name="mail" id="mail" required><br>

        <label for="pass1">Mot de passe</label>
        <input type="password" name="pass1" id="pass1" minlength="8" required><br>

        <input id="submit" type="submit" name="addUser" value="CONNEXION">
    </form>

    </div>

    <video id="background-video" autoplay loop muted>
        <source src="public/videos/demo.mp4" type="video/mp4">
    </video>

    
</body>
</html>