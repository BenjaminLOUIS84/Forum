<?php
    $categories = $result["data"]['categories'];
?>

<h2>MODIFIER UNE CATEGORIE</h2>

<div class="topicT">

    <?php
        foreach($categories as $category){}
        // Afficher le nom de la Catégorie sélectionnée
        //echo "<div class='titreT'>".$category->getId()->getName()."</div>";
    ?>

    <h3>Remplir ce champs pour modifier cette Catégorie</h3>

    <!-- L'action du formulaire exécute majCategory -->
    
    <form class="formulaireTopic" action="index.php?ctrl=forum&action=majCategory&id=<?=$category->getId()?>" method="post">

        <label class="name" for="name">NOM</label>
        <input name="name" type="text" id="name" required> 

        <input id="submit" type="submit" name="majCategory" value="MODIFIER">

    </form>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie4.jpg" class="photo" alt="Panna Cotta aux Fruits rouges">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listCategories">Retour</a>