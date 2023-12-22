<?php
    $users = $result["data"]['users'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
    
?>

<h2>LES MEMBRES</h2>

<div class="users">

    <?php
        foreach($users as $user){

            ?>
                <?=$user->getPseudo()?><br>

            <?php

        }
       
    ?>

</div>

<h3>Utilisateur connecté</h3>

<div class="users">

    <?php echo $_SESSION['user']; ?>

</div>

<figure>
    <img src="./public/img/patisserie3.jpg" class="photo" alt="Nougat glacé, chantilly et crème anglaise">
</figure>

<a class="retour" href="index.php">Retour</a>