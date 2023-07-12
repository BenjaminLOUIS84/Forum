<?php
    $users = $result["data"]['users'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h2>LES MEMBRES</h2>

<div class="topic">

    <?php
        foreach($users as $user){

            ?>
                <?=$user->getId()?><?=$user->getPseudo()?>
            <?php
        }
    ?>

</div>

<figure>
    <img src="./public/img/cuisine5.jpg" class="images" alt="Foie de veu en persillade, pomme de terre rôties et champignons">
</figure>

<a class="retour" href="index.php">Retour</a>