<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registre d'inscritption</title>
</head>

<body>

    <div class="topicINSC">

        <h2>INSCRIPTION</h2>

        <form action="index.php?ctrl=security&action=addUser" method="post">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>

            <label for="mail">Mail</label>
            <input type="email" name="mail" id="mail" required><br>

            <label for="pass1">Mot de passe</label>
            <input type="password" name="pass1" id="pass1" required><br>

            <label for="pass2">Confirmation du mot de passe</label>
            <input type="password" name="pass2" id="pass2" required><br>

            <input id="submit" type="submit" name="addUser" value="ENREGISTRER">
        </form>

    </div>

    <video id="background-video" autoplay loop muted>
        <source src="public/videos/demo.mp4" type="video/mp4">
    </video>

</body>
</html>


