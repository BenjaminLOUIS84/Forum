<?php
    $categories = $result["data"]['categories'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h2>LES CATEGORIES</h2>

<div class="topicC">
    
    <?php
        foreach($categories as $category){// On fait un foreach pour afficher toute les catégories
            ?>
                <!-- Pour accéder aux détails de la catégorie sélectionnée -->
                <a href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?>"><?=$category->getName()?></a>  
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
            <img src="./public/img/cuisine2.jpg" class="images" alt="Navarin d'Agneau">
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
            <img src="./public/img/cuisine5.jpg" class="images" alt="Foie de veu en persillade, pomme de terre rôties et champignons">
        </figure>
    </div>
</div>