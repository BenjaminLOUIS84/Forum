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
        
        <title>FORUM</title>
    </head>
    <body>
        <div id="wrapper"> 
        
            <div id="mainpage">

                <header>
                    <nav>

                        <?php
                           // if(App\Session::isAdmin()){   // Espace réservé à l'Administrateur (Peut accéder à toutes les fonctionnalités du site!)
                            ?>
                            <!-- <a href="index.php">Accueil</a> -->
                            <!-- <a href="index.php?ctrl=security&action=loginUser">Connexion</a> -->
                            <!-- <a href="index.php?ctrl=forum&action=listCategories">Liste des Catégories</a> -->
                            <!-- <a href="index.php?ctrl=security&action=listUsers">Liste des Membres</a> -->

                            <!-- Accéder au profil -->
                            <!-- <a href=""><span class="fas fa-user"></span>&nbsp;></a> -->
                            <!-- Déconnexion -->

                            <!-- <a href="index.php?ctrl=security&action=logout">Déconnexion</a> -->
                        <?php
                            //}
                        ?>
                       
                        <?php
                            
                            if(App\Session::getUser()){ // Espace utilisateur (Peut accéder aux catégories et à son profil)
                                ?>
                                <a href="index.php">Accueil</a>
                                <a href="index.php?ctrl=forum&action=listCategories">Liste des Catégories</a>
                                
                                <!-- Accéder au profil -->
                                <!-- <a href=""><span class="fas fa-user"></span>&nbsp;</a> -->

                                <!-- Déconnexion -->
                                <a href="index.php?ctrl=security&action=logout">Déconnexion</a>
                                <?php
                            }
                            else{   //Espace de travail Développeur pour gérer le site (deviendra un espace d'accueil lorsque les rôle Administrateur et la fonction rubrique seront installés)
                                ?>
                                <a href="index.php">Accueil</a>
                                <a href="index.php?ctrl=security&action=loginUser">Connexion</a>
                                <a href="index.php?ctrl=security&action=register">Inscription</a>
                                <?php
                            }
                        ?>
                        
                    </nav>

                    <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                    <h3 class="message" style="color: black"><?= App\Session::getFlash("error") ?></h3>
                    <h3 class="message" style="color: black"><?= App\Session::getFlash("success") ?></h3>

                </header>
                
                <main id="forum">

                    <!-- Logo en arrière plan -->
                        <figure>
                            <img src="./public/img/logo.png" class="photo" alt="Logo Dev Cook">
                        </figure>

                    <!-- Pour faire la temporisation de sortie -->
                    <!-- Renvoi les différents contenus respectifs de chaque rubriques -->
                    <?= $page ?>

                </main>
            </div>
            <footer>
                <div class="pied">

                    <h1>&copy; 2023 - Forum DEV COOK</h1>

                    <a href="https://www.youtube.com/@lesrecettesdebenjamin">Créer par Benjamin LOUIS</a>
                    
                    <a href="index.php?ctrl=security&action=cgu">CGU</a> - 
                    <a href="index.php?ctrl=security&action=mentions">Mentions légales</a>

                </div>
                <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
            </footer>
        </div>
        <!-- <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script> -->
        <!-- <script>

            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })

            

            /*
            $("#ajaxbtn").on("click", function(){
                $.get(
                    "index.php?action=ajax",
                    {
                        nb : $("#nbajax").text()
                    },
                    function(result){
                        $("#nbajax").html(result)
                    }
                )
            })*/
        </script> -->
    </body>
</html>