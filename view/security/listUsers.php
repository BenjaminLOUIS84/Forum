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

<figure>
    <img src="./public/img/cuisine5.jpg" class="photo" alt="Foie de veu en persillade, pomme de terre rôties et champignons">
</figure>

<a class="retour" href="index.php">Retour</a>