<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css"> -->
        <link rel="stylesheet" href="public/css/style.css">
        <title>Votre réponse</title>
    </head>
<?php

    $reponses = $result["data"]['reponses'];
    $post = $result["data"]['post'];
    
?>

<h2>VOTRE REPONSE</h2>

<div class="topicT">

    <?php
    if($reponses == true){
        foreach($reponses as $reponse){}
        ?>

            <form class="formulaireTopic" action="index.php?ctrl=forum&action=addReponse" method="post">
                            
                <label class="text" for="text">TEXTE</label>
                <input name="text" type="text" id="text" required>
                <input type="hidden" name="post_id" value="<?=$reponse->getPost()->getId()?>">
                <input id="submit" type="submit" name="addReponse" value="AJOUTER">

            </form>

        <?php

    }else{

        echo "Ajouter une première réponse à ce post";  
        ?>
            <form class="formulaireTopic" action="index.php?ctrl=forum&action=addReponse" method="post">
                            
                <label class="text" for="text">TEXTE</label>
                <input name="text" type="text" id="text" required>
                <input type="hidden" name="post_id" value="<?=$post->getId()?>">
                <input id="submit" type="submit" name="addReponse" value="AJOUTER">

            </form>

            <a class="retour" href="index.php?ctrl=forum&action=detailPost&id=<?=$post->getId()?>">RETOUR</a>
        <?php
                
    }

    ?>

</div>


<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/cuisine4.jpg" class="photo" alt="Tartare de boeuf et salade verte">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=detailPost&id=<?=$reponse->getPost()->getId()?><?=$post->getText()?>">RETOUR</a>
</html>