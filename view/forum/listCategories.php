<?php
    $categories = $result["data"]['categories'];// Cette variable permet d'accéder et d'afficher les informations demandées dans cette page
?>

<h2>LES CATEGORIES</h2>

<p>Le Forum DEV COOK est un lieu de discussion francophone consacré aux arts culinaires.<br>
    Choisissez une catégorie et entrez dans le topic qui vous convient.<br>
    Pour les nouveaux contributeurs, merci de lire les conditions d'utilisation avant de poster votre premier message.
</p>

<div class="topicC">

    <!-- Pour accéder au formulaire pour ajouter une catégorie -->
    <a href="index.php?ctrl=forum&action=formulaireCategory">AJOUTER</a> 
     
</div>

<div class="topic">
    <?php
        // if(App\Session::isAdmin()){

            foreach($categories as $category){
                ?>
                    <div class="back">
                        <!-- Pour accéder aux TOPICS de la catégorie sélectionnée -->
                        <a href="index.php?ctrl=forum&action=listTopics&id=<?=$category->getId()?>"><?=$category->getName()?></a>

                        <div class="option">

                            <!-- Pour modifier une catégorie -->
                            <!--<form action="index.php?ctrl=forum&action=formCat&id=<?//=$category->getId()?>" method="post">
                            
                                <input type="image" class="majC" alt="Modifier" src="./public/img/pen-to-square-solid.svg">
                            </form>-->
                            
                            <!-- Pour supprimmer une catégorie directement dans la liste -->
                            <!--<form action="index.php?ctrl=forum&action=delCategory&id=<?//=$category->getId()?>" method="post">
                                
                                <!-- Mettre une icône dans l'input -->
                                <!--<input type="image" class="suppC" alt="Supprimer" src="./public/img/xmark-solid.svg">

                            </form>-->
                        </div>

                    </div>
                <?php
            }
        // }else{
           

        //}
    ?>

</div>

<!-- banière contenant plusieurs images qui défilent automatiquement -->
<div id="baniere">
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine1.jpg" class="images" alt="Soupe au pistou revisitée">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/patisserie1.jpg" class="images" alt="Paris-Brest">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine5.jpg" class="images" alt="Foie de veu en persillade, pomme de terre rôties et champignons">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/patisserie3.jpg" class="images" alt="Nougat Glacé, crème chantilly et crème anglaise">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine4.jpg" class="images" alt="Tarte de boeuf et Salade verte">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/patisserie4.jpg" class="images" alt="Panna-Cotta aux fruits rouges">
        </figure>
    </div>
    <div class="ban">
        <figure>
            <img src="./public/img/cuisine2.jpg" class="images" alt="Rösti oeufs aux légumes">
        </figure>
    </div>
</div>
