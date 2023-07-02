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
                
                ?>
                <tbody>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
                <?php 

            }

            // Afficher le message du Post sélectionné
            echo "<div class='titre'>".$post//->getTopic()
            ->getText()."</div>";
            ?>

            <!-- Lien pour répondre au Post -->
            <a href="#">Répondre</a>
            <?php
            
        ?>
    </table>      
</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/cuisine2.jpg" class="photo" alt="Rösti oeuf aux légumes">
</figure>


<a class="retour" href="index.php?ctrl=forum&action=listCategories">Retour</a>
