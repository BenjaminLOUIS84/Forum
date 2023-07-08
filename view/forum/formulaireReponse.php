<?php
   // $posts = $result["data"]['posts'];
?>

<h2>VOTRE REPONSE</h2>

<div class="topicT">

    <?php
       // foreach($posts as $post){}
    ?>

    <form class="formulaireTopic" action="index.php?ctrl=forum&action=addReponse" method="post">
                    
        <label class="text" for="text">TEXTE</label>
        <input name="text" type="text" id="text" required>
           
        <input id="submit" type="submit" name="addReponse" value="AJOUTER">

    </form>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/cuisine4.jpg" class="photo" alt="Tartare de boeuf et salade verte">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=1">- TOPICS CUISINE -</a>
<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=2">- TOPICS PATISSERIE -</a>
