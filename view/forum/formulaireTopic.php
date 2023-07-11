<?php
   
    $topics = $result["data"]['topics'];
    //$category = $result["data"]['category'];
   // $user = $result["data"]['user'];
?>

<h2>AJOUTER UN TOPIC</h2>

<div class="topicT">

    <?php
        if($topics == true){//Créer une condition pour permettre l'ajout d'un topic dans une catégorie vide

            foreach($topics as $topic){}
            // Afficher le nom de la Catégorie sélectionnée
            echo "<div class='titreT'>".$topic->getCategory()->getName()."</div>";
            
            ?>

            <h3>Remplir ce formulaire pour ajouter un nouveau Topic à la base SQL</h3>

            <form class="formulaireTopic" action="index.php?ctrl=forum&action=addTopic" method="post">
                            
                <label class="title" for="title">TITRE</label>
                <input name="title" type="text" id="title" required>
                
                <!-- Rédiger le post pour pouvoir aussi entrer dans le topic pour ajouter d'autres posts -->

                <label class="text" for="text">TEXTE</label>
                <input name="text" type="text" id="text" required>

                <!-- Liaisons du topic avec la catégorie et l'utilisateur -->

                <input type="hidden" name="category_id" value="<?=$topic->getCategory()->getId()?>">
                <input type="hidden" name="user_id" value="<?=$topic->getUser()->getId()?>">
                                               
                <input id="submit" type="submit" name="addTopic" value="AJOUTER">

            </form>
            
            <?php

        }else{// Afficher le formulaire pour ajouter un premier topic à la catégorie vide (cas où il n'y aucuns topics)

            //echo "<div class='titreT'>".$category->getName()."</div>";//Pour afficher le titre de la catégorie gràce à la variable $category
            echo "Ajouter un premier topic à cette catégorie";  

            ?>  
                <!-- Générer le même formulaire qui celui ci dessus mais avec des $ variables différentes dans le cas d'une catégorie vide -->

                <form class="formulaireTopic" action="index.php?ctrl=forum&action=addTopic" method="post">
                    
                    <label class="title" for="title">TITRE</label>
                    <input name="title" type="text" id="title" required>
                    <label class="text" for="text">TEXTE</label>
                    <input name="text" type="text" id="text" required>

                    <!-- Liaison du topic avec la catégorie -->
                    <!-- <input type="hidden" name="category_id" value=""> -->
                   
                    <!-- Liaison du topic avec l'utilisateur problème pour récupérer l'Id de l'utilisateur nécessaire pour valider l'ajout d'un nouveau post dans une catégorie vide-->
                    <!-- <input type="hidden" name="id_user" value=""> -->

                    <input id="submit" type="submit" name="addTopic" value="AJOUTER">
            
                </form>

            <?php
            
        }

    ?>

</div>

<!-- Image en arrière plan -->
<figure>
    <img src="./public/img/patisserie4.jpg" class="photo" alt="Panna Cotta aux Fruits rouges">
</figure>

<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=1">- TOPICS CUISINE -</a>
<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=2">- TOPICS PATISSERIE -</a>
