<?php
    $posts = $result["data"]['posts'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h2>DETAIL</h2>

<div class="topicP">
   
    <table>

        <thead>
            <tr>
                <th>REPONSES</th>
            </tr>
        </thead>

        <?php
            foreach($posts as $post){// On fait un foreach pour permettre l'affichage du tableau contenant les réponses 
                $post->getText();   
            }

            // Afficher le message du Post sélectionné
            echo "<div class='titreP'>".$post->getText()."</div>";
            ?>

            <!-- Lien pour répondre au Post -->
            <a href="#">Répondre</a>
            <?php  
        ?>

    </table> 

</div>

<div class="card-container">
    <div class="card">
        <div class="card-front">
            <p>DECOUVRIR</p>
        </div>
        <div class="card-back">
            <p>Réponse de...</p>
        </div>
    </div>
</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/cuisine2.jpg" class="photo" alt="Rösti oeuf aux légumes">
</figure>

<!-- Trouver une solution pour gérer le retour vers la liste des Posts selon le titre du Topic -->
<!-- TEST 1 Renvoi vers le post suivant -->
<!-- <a class="retour" href="index.php?ctrl=forum&action=listPosts&id=<?=$post->getId()?>">Retour</a> -->