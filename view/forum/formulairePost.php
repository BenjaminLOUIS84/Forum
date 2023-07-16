<?php
    $posts = $result["data"]['posts'];
?>

<h2>AJOUTER UN POST</h2>

<div class="topicT">

    <?php
        foreach($posts as $post){}
        // Afficher le nom de la Catégorie sélectionnée
        echo "<div class='titreT'>".$post->getTopic()->getTitle()."</div>";
    ?>

    <h3>Remplir ce formulaire pour ajouter un nouveau Post à la base SQL</h3>

    <form class="formulaireTopic" action="index.php?ctrl=forum&action=addPost" method="post">
                    
        <label class="text" for="text">TEXTE</label>
        <input name="text" type="text" id="text" required>

        <!-- Liaisons du post avec le topic et l'utilisateur -->

        <input type="hidden" name="topic_id" value="<?=$post->getTopic()->getId()?>">
        <input type="hidden" name="user_id" value="<?=$post->getUser()->getId()?>">
                        
        <input id="submit" type="submit" name="addPost" value="AJOUTER">

    </form>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie4.jpg" class="photo" alt="Panna Cotta aux Fruits rouges">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listPosts&id=<?=$post->getTopic()->getId()?>">- RETOUR -</a>