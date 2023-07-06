<?php
    $categories = $result["data"]['categories'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h1>AJOUTER UNE CATEGORIE</h1>

<div class="topicT">

    <h3>Remplir ce champs pour ajouter une nouvelle Catégorie à la base SQL</h3>

    <form class="formulaireTopic" action="index.php?ctrl=forum&action=add" method="post">
                    
        <label class="name" for="name">NOM</label>
        <input name="name" type="text" id="name" required> 

        <input id="submit" type="submit" name="add" value="AJOUTER">

    </form>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie4.jpg" class="photo" alt="Panna Cotta aux Fruits rouges">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listCategories">Retour</a>