<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" /> -->
        
        <!-- <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css"> -->
        <link rel="stylesheet" href="public/css/style.css">
        
        <title>Réponse</title>
    </head>
<?php

    $reponses = $result["data"]['reponses'];
    $post = $result["data"]['post'];
    // $posts = $result["data"]['posts'];
    
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

        // foreach($posts as $post){}
        echo "<div class='titreT'>".$post->getText()."</div>";
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