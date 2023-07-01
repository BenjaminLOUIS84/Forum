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

<div class="baniere">
    <!-- <figure>
        <img src="./public/img/cuisine1.jpg" class="photo" alt="Soupe au pistou revisitée">
    </figure> -->
</div>
