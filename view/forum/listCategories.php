<?php
    $categories = $result["data"]['categories'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h2>LES CATEGORIES</h2>

<p>Le Forum DEV COOK est un lieu de discussion francophone consacré aux arts culinaires. Choisissez une catégorie et entrez dans le topic qui vous convient.
    Pour les nouveaux contributeurs, merci de lire les conditions d'utilisation avant de poster votre premier message.
</p>

<div class="topicC">

    <!-- Pour accéder au formulaire pour ajouter une catégorie -->
    <a href="index.php?ctrl=forum&action=formulaireCategory">AJOUTER</a> 
     
</div>

<div class="topic">
    
    <?php
        foreach($categories as $category){
            ?>
                <!-- Pour accéder aux détails de la catégorie sélectionnée -->
                <a href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?>"><?=$category->getName()?></a>
            
                <!-- Pour supprimmer une catégorie directement dans la liste -->
                <form action="index.php?ctrl=forum&action=delCategory&id=<?=$category->getId()?>" method="post">
                    
                    <!-- Mettre une icône dans l'input -->
                    <input type="image" class="suppC" alt="Supprimer" src="./public/img/supp.jpg">

                </form>
            
            <?php
        }
    ?>

</div>

<!-- banière contenant plusieurs images qui défilent automatiquement -->
<div id="baniere">
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine1.jpg" class="images" alt="Soupe au pistou revisitée">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/patisserie1.jpg" class="images" alt="Paris-Brest">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine5.jpg" class="images" alt="Foie de veu en persillade, pomme de terre rôties et champignons">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/patisserie3.jpg" class="images" alt="Nougat Glacé, crème chantilly et crème anglaise">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine4.jpg" class="images" alt="Tarte de boeuf et Salade verte">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/patisserie4.jpg" class="images" alt="Panna-Cotta aux fruits rouges">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine2.jpg" class="images" alt="Rösti oeufs aux légumes">
        </figure>
    </div>
</div>
