<?php
    // $categories = $result["data"]['categories'];
    // Pas besoin de cette variable pour accéder à la page du formulaire
?>

<h1>AJOUTER UNE CATEGORIE</h1>

<div class="topicT">

    <h3>Remplir ce champs pour ajouter une nouvelle Catégorie à la base SQL</h3>

    <!-- L'action du formulaire exécute addCategory -->
    <form class="formulaireTopic" action="index.php?ctrl=forum&action=addCategory" method="post">
                    
        <label class="name" for="name">NOM</label>
        <input name="name" type="text" id="name" required> 

        <input id="submit" type="submit" name="formulaireCategory" value="AJOUTER">

    </form>

    <h3>Sélectionner la Catégorie à Supprimer</h3>

    <!-- L'action du formulaire exécute delCategory -->
    <form class="formulaireTopic" action="index.php?ctrl=forum&action=delCategory" method="post">
           
        <!-- Afficher la liste des Catégories à supprimer dans une liste déroulante -->
        <select class="listCat" name="id_category" required>                                               
            <option selected>Catégories</option> 
                
            <?php
               
                foreach($categories as $category){

                    echo "<option value=".$category->getId().">".$category->getName()."</option>";              // La value permet de récupérer l'id_genre et d'afficher le nom du genre (type)
                   // echo "<option value=".$category['id'].">".$category['name']."</option>";
                }
            ?>

        </select> 

        <input id="submit" type="submit" name="formulaireCat" value="SUPPRIMER">

    </form>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie4.jpg" class="photo" alt="Panna Cotta aux Fruits rouges">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listCategories">Retour</a>