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

        //////////////////////////////AFFICHER LA LISTE DES UTILISATEURS

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

        //////////////////////////////AJOUTER UN UTILISATEUR DANS LA BDD VIA LE FORMULAIRE D'INSCRIPTION

        public function addUser(){ 
            

            //if(isset($_GET["action"])) {
                //switch($_GET["action"]) {

                    //case "register":
                        // Si le formulaire est soumis

                        if($_POST["addUser"]){

                            $userManager = new UserManager();                              // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres
                            $session = new Session();                                      // Instancier cette variable pour afficher des messages (CF app & layout.php)

                            $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                            $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                            $pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                            $pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                            $mailExist = $userManager->findUserByMail($mail);              // Pour vérifier s'il y a des utilisateurs existant dans la BDD
                            $pseudoExist = $userManager->findUserByPseudo($pseudo);        // Faire appel aux fonctions de userManager pour checker les mails et les pseudos 

                            if($pseudo && $mail && $pass1 && $pass2) { 
                                if($mailExist) {                                          // Si on inscrit un user qui est déjà présent dans la BDD (on inscrit le même mail)

                                    return [
                                        "view" => VIEW_DIR."security/register.php",       // Rediriger vers le formulaire d'inscription avec header()
                                        $session->addFlash('error',"Ce mail existe déjà") // Afficher un message d'erreur (CF layout.php)
                                    ];

                                } elseif($pseudoExist) {

                                    return [
                                        "view" => VIEW_DIR."security/register.php",
                                        $session->addFlash('error',"Ce pseudo existe déjà")
                                    ];

                                } else {
                                    
                                    if($pass1 == $pass2 && strlen($pass1) >= 8) {       // Condition pour vérifier si le mot de passe est confirmé et doit contenir au moins 8 caractères
                                        $userManager->add([                             // add() pour ajouter un user à la BDD
                                            'pseudo' => $pseudo,
                                            'mail' => $mail,
                                            'password' => password_hash($pass1, PASSWORD_DEFAULT)// Filtre pour hacher le mot de passe
                                        ]);
                                            
                                        return [
                                            "view" => VIEW_DIR."security/login.php", // Renvoi vers la liste de tous les utilisateurs
                                            $session->addFlash('success',"Ajouté avec succès"),
                                            "data" => ["users" => $userManager->findAll()] // Permettre l'affichage de toutes les infos (mais dans la liste seul les pseudos sont affichés)
                                        ]; 
                                    } else {
                                        // message "Les mots de passe ne sont pas identiques"
                                    }
                                }   
                            } else {
                                // Problème de saisie dans les champs de formulaire
                            }
                        }

                        // Par défaut afficher le formulaire d'inscription
                        return [
                            "view" => VIEW_DIR."security/register.php"
                        ];

                   // break;
                    
                    //case "login":
                      
                        // if($_POST["login"]) {

                        //     $userManager = new UserManager();                              // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres
                        //     // $session = new Session();                                      // Instancier cette variable pour afficher des messages (CF app & layout.php)

                        //     $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                        //     $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                        //     if($mail && $password) {


                        //     }
                        // }

                        // return [
                        //     "view" => VIEW_DIR."security/login.php"
                        // ];

                   // break;

                   // case "logout":
                   // break;

               // }
            //}
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // LOGIN FONCTIONS

        //////////////////////////////AFFICHER LE FORMULAIRE DE CONNEXION

        public function loginUser(){                     

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                
                "view" => VIEW_DIR."security/login.php",                           
            ];
        }

        //////////////////////////////AFFICHER LE FORMULAIRE DE CONNEXION

        public function login() {

            if($_POST["login"]) {
            
                $userManager = new UserManager();
                $session = new Session();
                
                $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                $user = $userManager->findUserByMail($mail);

                if ($mail && $password) {

                    if ($user) {
                        $hash = $user->getPassword(); 
                        if (password_verify($password, $hash)) {
                            
                            $session = new Session();
                            return [
                                $session->setUser($user),
                                "view" => VIEW_DIR."forum/listCategories.php",
                                var_dump($_SESSION["user"])
                            ];
                            ///////////////////////////////////////////////////////////////////////////
                        } else {
                           $session->addFlash('error',"Mot de passe incorrect ou inexistant");
                        }
                        // On récupère le mot de passe
                    } else {
                        //$session = new Session();

                        return [
                            "view" => VIEW_DIR."security/login.php",
                            $session->addFlash('error',"Mail ou mot de passe incorrect")
                        ];
                    }
                }
            }

            return [
                "view" => VIEW_DIR."security/login.php",
                
               
                var_dump($user)
            ];
                        
        }



        // public function logout() {
        //     $session = new Session();
            
        //     if ($session->getUser() || $session->isAdmin()) {
        //         unset($_SESSION['user']);
        //     }
        // }
    }

?>