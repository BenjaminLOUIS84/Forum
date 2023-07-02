<?php
    $posts = $result["data"]['posts'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
    $categories = $result["data"]['categories'];
?>

<h2>LES POSTS</h2>

<div class="topicP">
   
    <table>
        <thead>
            <tr>
                <th>PSEUDOS</th>
                <th>MESSAGES</th>
                <th>DATES&HEURES</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <?php
            foreach($posts as $post){// On fait un foreach pour permettre l'affichage des infos de tous les Posts
                
                ?>
                <tbody>
                    <tr>
                        <td><?=$post->getUser()->getPseudo()?></td>
                        <td><?=$post->getText()?></td>
                        <td><?=$post->getDateCreate()?></td>
                        
                        <!-- Pour accéder aux détails du topic sélectionné -->
                        <td><a href="index.php?ctrl=forum&action=detailPost&id=<?=$post->getId()?>">LIRE</a><td>  
                    </tr>
                </tbody>
                <?php 
            }

            // Afficher le titre du Topic sélectionné
            echo "<div class='titre'>".$post->getTopic()->getTitle()."</div>";
            ?>

            <!-- Lien pour créer un nouveau Post -->
            <a href="#">Créer un nouveau Post</a>
            <?php
                foreach($categories as $category){
                    $category->getId();
                }
        ?>
    </table>      
</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie1.jpg" class="photo" alt="Paris-Brest">
</figure>

<!-- Trouver une solution pour gérer le retour vers la liste des Topics selon la catégorie -->

<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?>">Retour</a>
<!-- <a class="retour" href="index.php?ctrl=forum&action=listTopics&id=1">Retour</a> -->
    
