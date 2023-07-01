<?php
    $posts = $result["data"]['posts'];// Ces variables permettent d'accéder et d'afficher les informations demandées dans cette page
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
            foreach($posts as $post){// On fait un foreach pour afficher tous les Posts
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
        ?>
    </table>      
</div>

<a href="index.php?ctrl=forum&action=listCategories">Retour</a>
    
