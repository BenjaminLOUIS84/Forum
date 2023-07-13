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

        //////////////////////////////AFFICHER LE FORMULAIRE DE CONNEXION ET METTRE UN UTILISATEUR EN SESSION

        public function login() {

            if($_POST["login"]) { // Si le formulaire de connexion est soumis
            
                $userManager = new UserManager();
                $session = new Session();
                
                $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL); // Filtre les champs contre les failles XSS
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                if ($mail && $password) {                           // Vérifier si les filtres sont valides

                    $user = $userManager->findUserByMail($mail);    // Equivaut à une réquête préparée $pdo=prepare(SELECT* FROM...) utilisée quand il n'y a pas de Framework

                    //var_dump($user);die;                          // Pour vérifier si on entre dans le formulaire un utilisateur qui existe dans la BDD
                
                    
                    if($user) {                                     // Si l'utilisateur existe

                        $hash = $user["password"];                  // Récuréper le mot de passe haché de l'utilisateur $hash = $user->getPassword(); est une formule équivalente
                
                        if(password_verify($password, $hash)) {     // Pour vérifier si le mot de passe inscrit dans le formulaire correspond à celui de la BDD
                            $_SESSION["user"] = $user;              // Mettre l'utilisateur en session (stocker dans un tableau toute les informations de l'utilisateur)
                            
                            return [
                                "view" => VIEW_DIR."view/home.php",
                                $session->addFlash('success', " .$user "." est connecté !")
                            ];
                        } else {

                            return [
                                "view" => VIEW_DIR."security/login.php",
                                $session->addFlash('error', "Utilisateur inconnu ou mot de passe incorrect")
                            ]; 
                        }

                    } else {

                        return [
                            "view" => VIEW_DIR."security/login.php",
                            $session->addFlash('error',"Utilisateur inconnu ou mot de passe incorrect")
                        ]; 

                    }
                    
                }
                    //$check = password_verify($password, $hash);

                // 
                //         $hash = $user->getPassword(); 
                //         if (password_verify($password, $hash)) {
                //             

                //             $session->addFlash('success'," .$user "." est connecté !");

                //         } else {

                //             $session->addFlash('error',"Mail ou mot de passe incorrect ou inexistant");
                //         }
                           
                //         // return [

                //         //     $session->setUser($user),
                //         //     "view" => VIEW_DIR."forum/listCategories.php",
                                
                //         // ];     
                //    }
                // }
            }

            return [
                "view" => VIEW_DIR."security/login.php",
                //var_dump($user)
            ];
                        
        }

        //////////////////////////////PERMETTRE LA DECONNEXION

        // public function logout() {
        //     $session = new Session();
            
        //     if ($session->getUser() || $session->isAdmin()) {
        //         unset($_SESSION['user']);
        //     }
        // }
    }

?>