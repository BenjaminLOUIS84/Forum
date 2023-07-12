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
           //$session = new Session();

           $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
           $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

           //$mailExist = $userManager->find();        // Pour vérifier s'il y a des utilisateur existant dans la BDD
           //$pseudoExist = $userManager->findOneById($id);        // Pour vérifier s'il y a des utilisateur existant dans la BDD

           //if($pseudo && $mail && $pass1 && $pass2) {
               

                //if($mailExist) {                        // Si on isncrit un user est déjà présent on redirige vers le formulaire d'inscription avec header()

                    //return [
                        //"view" => VIEW_DIR."security/register.php",
                        //$session->addFlash('Email ou Pseudo existe déjà')
                    //];
                    //header("Location: register.php"); exit;
                
                //} else {
                    
                    if($pass1 == $pass2 && strlen($pass1) >= 8) {// Condition pour vérifier si le mot de passe est confirmé et doit contenir au moins 8 caractères
                        $userManager->add([                     // add() pour ajouter un user à la BDD
                            'pseudo' => $pseudo,
                            'mail' => $mail,
                            'password' => password_hash($pass1, PASSWORD_DEFAULT)// Filtre pour hacher le mot de passe
                        ]);
                            
                        return ["view" => VIEW_DIR."security/listUsers.php", "data" => ["users" => $userManager->findAll()]]; // Renvoi vers la liste des users
                    }
                //}
            //}
        }
    }
?>