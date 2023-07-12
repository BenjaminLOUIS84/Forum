<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" /> -->
        
    <!-- <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css"> -->
    <link rel="stylesheet" href="public/css/style.css">
        
    <title>INSCRIPTION</title>

</head>
    <body>
        <div id="wrapper"> 

            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <!-- <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3> -->
                <!-- <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3> -->
                <header>
                    <nav>
                        <!-- <div id="nav-left"> -->
                            <!-- <a href="/">Accueil</a> -->
                            <?php
                            //if(App\Session::isAdmin()){
                                ?>
                                <!-- <a href="index.php?ctrl=home&action=users">Voir la liste des gens</a> -->
                            
                            <?php
                            //}
                            ?>
                        <!-- </div> -->
                        <!-- <div id="nav-right"> -->
                        <?php
                            
                            //if(App\Session::getUser()){
                                ?>
                                <!-- <a href="/security/viewProfile.html"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a> -->
                                <!-- <a href="/security/logout.html">Déconnexion</a> -->
                                <?php
                            // }
                            // else{
                                ?>
                                <a href="index.php">Accueil</a>
                                <a href="./view/security/login.php">Connexion</a>
                                <a href="/security/register.php">Inscription</a>
                                <a href="index.php?ctrl=forum&action=listCategories">Liste des Catégories</a>
                                <?php
                            //}
                        ?>
                        <!-- </div> -->
                    </nav>
                </header>
                
                <main id="forum">
                    <!-- Pour faire la temporisation de sortie -->
                    <!-- Renvoi les différents contenus respectifs de chaque rubriques -->
                    <!-- <?= $page ?> -->

                    <h2>S'inscrire</h2>

                    






                </main>
            </div>
                    
                    

            <footer>
                <p>&copy; 2023 - Forum DEV COOK - <a href="/home/forumRules.html">Conditions d'utilisation</a> - <a href="">Mentions légales</a></p>
            </footer>
        </div>
    </body>
</html>