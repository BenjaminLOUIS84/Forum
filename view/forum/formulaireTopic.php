<?php
   
    $topics = $result["data"]['topics'];
    $category = $result["data"]['category']; //Pour permettre le retour vers la liste des topics de la catégorie correspondante
    $user = $result["data"]['user'];
    
?>

<h2>AJOUTER UN TOPIC & UN POST</h2>
<p> Démarrer un Topic c'est l'occasion de lancer un nouveau sujet sur lequel tout le monde peut débattre</p>

<div class="topicT">

    <?php
        // if(isset($topics)){
        if($topics == true){//Créer une condition pour permettre l'ajout d'un topic dans une catégorie vide

            foreach($topics as $topic){}
            // Afficher le nom de la Catégorie sélectionnée
            echo "<div class='titreT'>".$topic->getCategory()->getName()."</div>";
            
            ?>

            <h3>Remplir les champs ci dessous pour ajouter un nouveau Topic et un Post dans le Forum</h3>

            <form class="formulaireTopic" action="index.php?ctrl=forum&action=addTopic" method="post">
                            
                <label class="title" for="title">TITRE DU TOPIC</label>
                <input name="title" type="text" id="title" required>
                
                <!-- Rédiger le post pour pouvoir aussi entrer dans le topic pour ajouter d'autres posts -->

                <label class="text" for="text">MESSAGE DU POST</label>
                <input name="text" type="text" id="text" required>

                <!-- Liaisons du topic avec la catégorie et l'utilisateur -->

                <input type="hidden" name="category_id" value="<?=$topic->getCategory()->getId()?>">
                
                <input type="hidden" name="user_id" value="<?=$topic->getUser()->getId()?>">

                <input id="submit" type="submit" name="addTopic" value="AJOUTER">

            </form>
            
            <?php

        }else{// Afficher le formulaire pour ajouter un premier topic à la catégorie vide (cas où il n'y aucuns topics)

            echo "<div class='titreT'>".$category->getName()."</div>";//Pour afficher le titre de la catégorie gràce à la variable $category
            echo "Ajouter un premier topic à cette catégorie";  

            ?>  
                <!-- Générer le même formulaire qui celui ci dessus mais avec des $ variables différentes dans le cas d'une catégorie vide -->

                <form class="formulaireTopic" action="index.php?ctrl=forum&action=addTopic" method="post">
                    
                    <label class="title" for="title">TITRE DU TOPIC</label>
                    <input name="title" type="text" id="title" required>

                    <label class="text" for="text">MESSAGE DU POST</label>
                    <input name="text" type="text" id="text" required>

                    <!-- Liaison du topic avec la catégorie -->

                    <input type="hidden" name="category_id" value="<?=$category->getId()?>">
                    
                    <!-- Liaison du topic avec l'utilisateur problème pour récupérer l'Id de l'utilisateur nécessaire pour valider l'ajout d'un nouveau post dans une catégorie vide-->
                    
                    <input type="hidden" name="user_id" value="<?//=$user->getId()?>">
                    
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

<!-- Gérer le retour du formulaire vers la liste des topics de la catégorie correspondante -->

<a class="retour" href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?><?=$category->getName()?>">RETOUR</a>
