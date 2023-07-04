<?php
    $topics = $result["data"]['topics'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h1>FORMULAIRE</h1>

<div class="topicT">

    <?php
        foreach($topics as $topic){

        }
        // Afficher le nom de la Catégorie sélectionnée
        echo "<div class='titreT'>".$topic->getCategory()->getName()."</div>";
    ?>

    <h3>Remplir ce formulaire pour ajouter un nouveau Topic à la base SQL</h3>

    <form class="formulaireTopic" action="index.php?ctrl=forum&action=addTopic" method="post">
                    
        <label class="title" for="title">TITRE</label>
        <input name="title" type="text" id="title" required> 

        <label class="textTopic" for="textTopic">DATE&HEURE</label>
        <input name="textTopic" type="date" required="1" id="creationDate"/>

        <label class="pseudoTopic" for="pseudoTopic">PSEUDO</label>
        <input name="pseudoTopic" type="text" required="1" id="pseudo"/>

        <input id="submit" type="submit" name="addTopic" value="AJOUTER">

    </form>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie4.jpg" class="photo" alt="Panna Cotta aux Fruits rouges">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listCategories">Retour</a>