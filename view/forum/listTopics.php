<?php
    $topics = $result["data"]['topics'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h2>LES TOPICS</h2>

<div class="topicT">
    <table>
        <thead>
            <tr>
                <th>CATEGORIES</th>
                <th>TITRES</th>
                <th>DATES&HEURES</th>
                <th>PSEUDOS</th>
                <th>DETAILS</th>
            </tr>
        </thead>
        <?php
            foreach($topics as $topic){// On fait un foreach pour afficher tous les Topics dans un tableau
                ?>
                    <tbody>
                        <tr>
                            <td><?=$topic->getCategory()->getName()?></td>
                            <td><?=$topic->getTitle()?></td>
                            <td><?=$topic->getCreationdate()?></td>
                            <td><?=$topic->getUser()->getPseudo()?></td>
                            
                            <!-- Pour accéder aux détails du topic sélectionné -->
                            <td><a href="index.php?ctrl=forum&action=listPosts&id=<?=$topic->getId()?>">ENTRER</a><td>  
                        </tr>
                    </tbody>
                <?php
            }
        ?>
    </table>
</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/cuisine1.jpg" class="photo" alt="Soupe au pistou revisitée">
</figure>

<!-- Lien vers la liste des Catégories -->
<a href="index.php?ctrl=forum&action=listCategories">Retour</a>