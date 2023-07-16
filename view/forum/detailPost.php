<?php
    $posts = $result["data"]['posts'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
    $reponses = $result["data"]['reponses'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
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
            <a href="index.php?ctrl=forum&action=formulaireReponse&id=<?=$post->getId()?>">Répondre</a>
            <?php  
        ?>

    </table> 

</div>

<?php
    //$reponses = $result["data"]['reponses'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<div class="reponses">

    <?php // Afficher les réponses sous forme de cartes à retourner

        foreach($reponses as $reponse){

            ?>
                <div class="card-container">
                    <div class="card">
                        <div class="card-front">
                            <p><?=$reponse->getUser()->getPseudo()?></p>
                            <h3><?=$reponse->getDateCreate()?></h3>
                        </div>

                        <div class="card-back">

                            <h3>Réponse de <?=$reponse->getUser()->getPseudo()?></h3>
                            <p><?=$reponse->getText()?></p>

                            <div class="optionsR">

                                <!-- Pour supprimer la réponse sélectionnée directement dans la liste -->
                                <form action="index.php?ctrl=forum&action=delReponse&id=<?=$reponse->getId()?>" method="post">

                                    <!-- Mettre une icône dans l'input -->
                                    <input type="image" class="suppR" alt="Supprimer" src="./public/img/supp.jpg">

                                </form>
                            
                                <!-- Pour modifier une réponse -->
                                <form action="iindex.php?ctrl=forum&action=formulaireReponse&id=<?=$reponse->getId()?>" method="post">
                                    <input type="image" class="majR" alt="Modifier" src="./public/img/maj.jpg">
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            <?php
        }
    ?>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/cuisine2.jpg" class="photo" alt="Rösti oeuf aux légumes">
</figure>

<!-- Trouver une solution pour gérer le retour vers la liste des Posts selon le titre du Topic -->
<!-- TEST 1 Renvoi vers le post suivant -->
<!-- <a class="retour" href="index.php?ctrl=forum&action=listPosts&id=<?=$post->getId()?>">Retour</a> -->

<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=1">- TOPICS CUISINE -</a>
<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=2">- TOPICS PATISSERIE -</a>
