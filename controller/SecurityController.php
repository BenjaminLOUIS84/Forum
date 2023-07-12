<?php

    namespace Controller; 

    use App\Session;
    use App\AbstractController;                         // Pour le faire fonctionner 
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\ReponseManager;

    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){

            return register();                          // Pour accéder à la view register.php
    
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // REGISTER FONCTIONS

        //////////////////////////////AFFICHER LA LISTE DES USERS

        public function listUsers(){                    // Fonction pour afficher la liste de toute les catégories
            
            $userManager = new UserManager();           // Instancier cette variable pour accéder aux méthodes de la classe

            return [                                    // Fonction native du FrameWork findAll() (se trouve dans Manager.php) on demande à la variable d'utiliser cette fonction
                
                "view" => VIEW_DIR."security/listUsers.php",

                "data" => ["users" => $userManager->findAll(["pseudo","ASC"])]                               
            ];                                          // Permet d'afficher tous les utilisateurs
        }

        //////////////////////////////AFFICHER LE FORMULAIRE D'INSCRIPTION

        public function register(){                     

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                
                "view" => VIEW_DIR."security/register.php",                           
            ];
        }

        public function addUser(){ 
            
           $userManager = new UserManager();            // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres
           
           $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
           $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

           $userManager->add(['pseudo' => $pseudo, 'mail' => $mail, 'password' => $password]);
            
           return [                               

                "view" => VIEW_DIR."security/listUsers.php",

                "data" => ["users" => $userManager->findAll()]

            ];
        }


    }
?>