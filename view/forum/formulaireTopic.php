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

    <?php
    
    ?>
</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie4.jpg" class="photo" alt="Panna Cotta aux Fruits rouges">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listCategories">Retour</a>