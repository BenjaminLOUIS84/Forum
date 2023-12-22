<?php
    $posts = $result["data"]['posts'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
    $topic = $result["data"]['topic'];// Pour gérer le retour
?>

<h2>LES POSTS</h2>

<div class="topicP">
   
    <table>
        <thead>
            <tr>
                <th>PSEUDOS</th>
                <th>MESSAGES</th>
                <th>DATES&HEURES</th>
                <th>OPTIONS</th>
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
                            
                            <td>
                                <div class="backT">

                                    <!-- Pour accéder aux détails du post sélectionné -->
                                    <a href="index.php?ctrl=forum&action=detailPost&id=<?=$post->getId()?>">LIRE</a>
                                
                                    <div class="option">

                                        <!-- Pour supprimer le post sélectionné directement dans la liste -->
                                        <form action="index.php?ctrl=forum&action=delPost&id=<?=$post->getId()?>" method="post">
                                
                                            <!-- Mettre une icône dans l'input -->
                                            <input type="image" class="suppT" alt="Supprimer" src="./public/img/xmark-solid.svg">

                                        </form>

                                    </div>

                                </div>

                            </td>  
                        </tr>
                    </tbody>

                <?php 
            }

            // Afficher le titre du Topic sélectionné
            echo "<div class='titreT'>".$post->getTopic()->getTitle()."</div>";
            ?>

                <!-- Lien pour créer un nouveau Post -->
                <a href="index.php?ctrl=forum&action=formulairePost&id=<?=$post->getTopic()->getId()?>">Créer un nouveau Post</a>
                
            <?php
            
        ?>
    </table>      
</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie1.jpg" class="photo" alt="Paris-Brest">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=<?=$topic->getCategory()->getId()?>">RETOUR</a>