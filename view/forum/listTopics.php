<?php
    $topics = $result["data"]['topics'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h2>LES TOPICS</h2>

<div class="topicT">
    <table>
        <thead>
            <tr>
                <th>TITRES</th>
                <th>DATES&HEURES</th>
                <th>PSEUDOS</th>
                <th>OPTIONS</th>
            </tr>
        </thead>
        <?php
            foreach($topics as $topic){// On fait un foreach pour afficher tous les Topics dans un tableau
                ?>
                    <tbody>
                        <tr>
                            <td><?=$topic->getTitle()?></td>
                            <td><?=$topic->getCreationdate()?></td>
                            <td><?=$topic->getUser()->getPseudo()?></td>
                            
                            <td>
                                <div class="backT">

                                    <!-- Pour accéder aux détails du topic sélectionné -->
                                    <a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>">ENTRER</a>

                                    <div class="option">
                                        
                                        <!-- Pour supprimer le topic sélectionné directement dans la liste -->
                                        <form action="index.php?ctrl=forum&action=delTopic&id=<?=$topic->getId()?>" method="post">
                            
                                            <!-- Mettre une icône dans l'input -->
                                            <input type="image" class="suppT" alt="Supprimer" src="./public/img/supp.jpg">

                                        </form>

                                        <!-- Pour modifier un topic -->
                                        <form action="index.php?ctrl=forum&action=formulaireTopic&id=<?=$topic->getCategory()->getId()?>" method="post">
                                            <input type="image" class="majT" alt="Modifier" src="./public/img/maj.jpg">
                                        </form>

                                    </div>

                                </div> 
                            </td>
                        </tr>
                    </tbody>
                    
                <?php
            }
            // Afficher le nom de la Catégorie sélectionnée
            echo "<div class='titreT'>".$topic->getCategory()->getName()."</div>";
            ?>

                <!-- Lien pour créer un nouveau Topic selon la catégorie -->
                <a href="index.php?ctrl=forum&action=formulaireTopic&id=<?=$topic->getCategory()->getId()?>">Démarrer un nouveau Topic</a>

            <?php

        ?>

        
    </table>
</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/cuisine1.jpg" class="photo" alt="Soupe au pistou revisitée">
</figure>

<!-- Lien vers la liste des Catégories -->
<a class="retour" href="index.php?ctrl=forum&action=listCategories">Retour</a>
