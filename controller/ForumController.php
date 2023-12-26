<?php

    namespace Controller;                               // Mettre le controlleur dans un namespace pour pouvoir le retrouver 

    use App\Session;
    use App\AbstractController;                         // Pour le faire fonctionner 
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\ReponseManager;

    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){                        // Fonction index() qui redirige en cas de problème vers la page listCategory.php par défaut (pour éviter une page d'erreur)

            return listCategories();
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // CATEGORIES FONCTIONS

        //////////////////////////////AFFICHER TOUTE LES CATEGORIES

        public function listCategories(){               // Fonction pour afficher la liste de toute les catégories
            
            $categoryManager = new CategoryManager();   // Instancier cette variable pour accéder aux méthodes de la classe

            return [                                    // Fonction native du FrameWork findAll() (se trouve dans Manager.php) on demande à la variable d'utiliser cette fonction
                
                "view" => VIEW_DIR."forum/listCategories.php",

                "data" => ["categories" => $categoryManager->findAll(["name","ASC"])]                               
            ];                                          // Permet d'afficher toutes les catégories
        }

        //////////////////////////////FORULAIRE POUR AJOUTER UNE CATEGORIE

        public function formulaireCategory(){           // Fonction pour accéder au formulaire des Catégories à séparer de la fonction d'ajout et de suppression

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                
                "view" => VIEW_DIR."forum/formulaireCategory.php",                           
            ];
        }

        //////////////////////////////AJOUTER UNE CATEGORIE VIDE

        public function addCategory(){                  // Fonction pour ajouter une catégorie vide au formulaire 

            $categoryManager = new CategoryManager();   // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres
            $session = new Session();                   // Instancier pour ajouter une notification

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $categoryManager->add(['name' => $name]);   // Pour effectuer l'action d'ajout 

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                                           
                "view" => VIEW_DIR."forum/listCategories.php",
                $session->addFlash('success',"Ajouté avec succès"),// Afficher la notification
                "data" => ["categories" => $categoryManager->findAll()]                               
            ];
        }

        //////////////////////////////SUPPRIMER UNE CATEGORIE

        public function delCategory($id){               // Fonction pour supprimer une Catégorie

            $categoryManager = new CategoryManager();
            $session = new Session();                   // Instancier pour ajouter une notification

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/listCategories.php",  // Après la suppression -> redirection sur la même page
                $session->addFlash('success',"Supprimé avec succès"),// Afficher la notification
                
                "data" => [$categoryManager->delete($id), "categories" => $categoryManager->findAll(["name", "ASC"])]           
            ];
        }

        //////////////////////////////FORMULAIRE POUR MODIFIER UNE CATEGORIE

        public function formCat($id){                   // Fonction pour accéder au formCat() de la catégorie à modifier à séparer de la fonction modifier

            $categoryManager = new CategoryManager();

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                
                "view" => VIEW_DIR."forum/formCat.php",  
                
                "data" => ["category" => $categoryManager->findOneById($id)] // Pour cibler avec précision la catégorie à modifier grâce à l'ID
            ];
        }

        //////////////////////////////MODIFIER UNE CATEGORIE

        public function majCategory($id){               // Fonction pour modifier une catégorie  

            $categoryManager = new CategoryManager();   // Instancier cette variable pour accéder aux méthodes de la classe et ajouter le filtre
            $session = new Session();                   // Instancier pour ajouter une notification
            
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                                           
                "view" => VIEW_DIR."forum/listCategories.php",
                $session->addFlash('success',"Modifié avec succès"),// Afficher la notification
                "data" => [$categoryManager->majCategory($name, $id), "categories" => $categoryManager->findAll(["name", "ASC"])]     
            ];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // TOPICS FONCTIONS

        //////////////////////////////AFFICHER LA LISTE DE TOUT LES TOPICS SELON LA CATEGORIE

        public function listTopics($id){                // Fonction pour afficher la liste de tout les Topics selon la catégorie
        
            $topicManager = new TopicManager();         // Instancier cette variable pour accéder aux méthodes de la classe 
            $categoryManager = new CategoryManager();   // Instancier cette variable pour accéder aux méthodes de la classe et permettre l'ajout de topic dans une catégorie vide
            $userManager = new UserManager();           // Instancier cette variable pour accéder aux méthodes de la classe et permettre l'ajout de topic dans une catégorie vide

            return [

                "view" => VIEW_DIR."forum/listTopics.php",

                "data" => [                             // Les fonctions natives du FrameWork findAll() et findOneById($id) (se trouvent dans Manager.php) on demande à la variable d'utiliser cette fonction

                    "topics" => (
                        isset($id)
                        ? $topicManager->findListByIdDep($id, "category", ["creationdate", "DESC"])
                        : $topicManager->findAll(["creationdate", "DESC"])// Permet d'afficher toutes les informations d'un topic
                    ),
                    "category" => $categoryManager->findOneById($id),// Pour retrouver un élément selon un id
                    
                    "user" => $userManager->findOneById($id)// Pour retrouver un élément selon un id 
                ]                                  
            ];                                          
        }

        //////////////////////////////FORMULAIRE POUR AJOUTER UN TOPIC 

        public function formulaireTopic($id){       // Fonction pour accéder au formulaire des Catégories à séparer de la fonction d'ajout

            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();       // Instancier cette variable permettre l'ajout d'un topic dans une catégorie vide et gérer le retour

            $userManager = new UserManager();
            
            return [                                        // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/formulaireTopic.php",

                "data" => [
                    
                    "topics" => (
                        isset($id)
                        ? $topicManager->findListByIdDep($id, "category", ["creationdate", "DESC"])
                        : $topicManager->findAll(["creationdate", "DESC"])// Permet d'afficher toutes les informations d'un topic
                    ),
                    "category" => $categoryManager->findOneById($id),// Pour retrouver un élément selon un id pour gérer le retour

                    "user" => $userManager->findOneById($id)// Pour retrouver un élément selon un id
                   
                ]                            
            ];
        }
        //////////////////////////////AJOUTER UN TOPIC AVEC UN POST

        public function addTopic($category_id){         // Fonction pour accéder au formulaire pour ajouter des Topics selon la catégorie

            $topicManager = new TopicManager();         // Instancier ces variables pour accéder aux méthodes de leur classes et ajouter les filtres
            $postManager = new PostManager();           // Instancier pour lier un post à un topic
            $categoryManager = new CategoryManager();
            $userManager = new UserManager();

            $session = new Session();                   // Instancier pour ajouter une notification

            // Pour que l'utilisateur connecté soit à l'origine du topic ajouté
                        
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Pour lier le Topic à un utilisateur connecté
            $user_id = Session::getUser()->getId();

            // Pour rédiger un post automatiquement quand on créer un topic on doit lier l'id topic au post
            
            $topic_id = $topicManager->add([
                'title' => $title, 
                'creationdate' => $date,
                'category_id' => $category_id, 
                'user_id' => $user_id
            ]);
            
            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/listTopics.php", // Après l'ajout on reste sur la même page
                
                $session->addFlash('success',"Ajouté avec succès"),// Afficher la notification
                
                "data" => [                             // Ce référer à la base SQL pour ajouter les informations en argument dans le tableau ci dessous
                    
                    "topics" => $topicManager->findListByIdDep($category_id, "category"),
                    
                    "category" => $categoryManager->findOneById($category_id),

                    //////////////////////////////////////////////////////////////////////
                    "user" => $userManager->findOneById($user_id),
                    
                    //////////////////////////////////////////////////////////////////////

                    $postManager->add([
                        'text' => $text, 
                        'dateCreate' => $date, 
                        'user_id' => $user_id, 
                        'topic_id' => $topic_id
                    ]) 

                ]                                       // Pour lier un post au topic (rédiger le texte du post dans le formulaire, inclure la dateCreate du post, l'utilisateur et le topic)                  
            ];                                          
        }

        //////////////////////////////SUPPRIMER UN TOPIC 

        public function delTopic($id){                  // Fonction pour supprimer un Topic

            $topicManager = new TopicManager();
            $categoryManager = new CategoryManager();

            $session = new Session();                   // Instancier pour ajouter une notification

            $category_id = $topicManager->findOneById($id);

            return [  

                // "view" => VIEW_DIR."forum/listTopics.php",
                // Retour vers la liste des topics de la categorie correspondante
                header("Location: index.php?ctrl=forum&action=listTopics&id=".$category_id->getCategory()->getId().""),

                $session->addFlash('success',"Supprimé avec succès"),// Afficher la notification
                                                        
                "data" => [
                    
                    $topicManager->delete($id),// Pour effacer le topic
                   
                    "topics" => $topicManager->findTopicsByCategoryId($id),     
                    "category" => $categoryManager->findOneById($id),

                ]                                   // Retour vers la liste des topics de la categorie correspondante
            ];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // POSTS FONCTIONS
        //////////////////////////////AFFICHER LA LISTE DE TOUT LES POSTS SELON LE TOPIC 

        public function listPosts($idTopic){            // Fonction permettant d'afficher la liste de tout les posts de chaque utilisateurs selon le topic sélectionné

            $postManager = new PostManager();           // Instancier cette variable pour accéder aux méthodes de leurs classes
            $topicManager = new TopicManager();         // Pour gérer le retour 

            return [

                "view" => VIEW_DIR."forum/listPosts.php",

                "data" => [

                    "posts" => (
                        isset($idTopic)
                        ? $postManager->findListByIdDep($idTopic, "Topic", ["dateCreate", "DESC"])
                        : $postManager->findAll(["dateCreate", "DESC"])
                    ),
                    "topic" => $topicManager->findOneById($idTopic) // Pour gérer le retour
                ]
            ];
        }

        //////////////////////////////FORMULAIRE POUR AJOUTER UN POST

        public function formulairePost($idTopic){      // Fonction pour accéder au formulaire des Posts à séparer de la fonction d'ajout

            $postManager = new PostManager();          // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
             
            
            return [   
                                                
                "view" => VIEW_DIR."forum/formulairePost.php", 
                "data" => ["posts" => $postManager->findListByIdDep($idTopic, "topic")]                            
            ];
        }

        //////////////////////////////AJOUTER UN POST 

        public function addPost(){                    // Fonction pour accéder au formulaire des Posts selon le topic

            $postManager = new PostManager(); 
            $topicManager = new TopicManager();

            $session = new Session();                   // Instancier pour ajouter une notification            

            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');

            $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Pour lier le Post à un utilisateur connecté
            $user_id = Session::getUser()->getId();
            
            $postManager->add(['text' => $text, 'dateCreate' => $date,'topic_id' => $topic_id, 'user_id' => $user_id]);

            return [     

                "view" => VIEW_DIR."forum/listPosts.php",
                $session->addFlash('success',"Ajouté avec succès"),// Afficher la notification
                "data" => [
                    "posts" => $postManager->findListByIdDep($topic_id, "topic"),
                    "topic" => $topicManager->findOneById($topic_id)
                    ]                               
            ];                                          
        }

        //////////////////////////////SUPPRIMER UN POST

        public function delPost($topic_id){           // Fonction pour supprimer un Post

            $postManager = new PostManager();
            $topicManager = new TopicManager();       // Gérer le retour
            $session = new Session();                 // Instancier pour ajouter une notification

            $post = $postManager->findOneById($topic_id);

            return [                                  // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                // "view" => VIEW_DIR."forum/listPosts.php", // ATTENTION Gérer le retour vers la même page
                header("Location: index.php?ctrl=forum&action=listPosts&id=".$post->getTopic()->getId().""),

                $session->addFlash('success',"Supprimé avec succès"),// Afficher la notification
                
                "data" => [

                    $postManager->delete($topic_id),    // Pour effacer le post 
                    
                    "posts" => $postManager->findAll(["dateCreate", "DESC"]),
                    "topic" => $topicManager->findListByIdDep($topic_id, "topic")
                
                ]
            ];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // OBJECTIFS: Créer une fonction pour permettre l'ajout et l'affichage des réponses spécifiquent à chaque posts sous forme de cartes
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //////////////////////////////AFFICHER TOUTES LES REPONSES SELON LE POST

        public function detailPost($id){               // Fonction permettant d'afficher le détail d'un post (le message du post)

            $postManager = new PostManager();          //Instancier cette variable pour accéder aux méthodes de leurs classes
            $reponseManager = new ReponseManager();    //Instancier cette variable pour accéder aux méthodes de leurs classes

            return [

                "view" => VIEW_DIR."forum/detailPost.php",

                "data" => [

                    "posts" => $postManager->findPostByIdDep($id, "Post", ["dateCreate", "DESC"]), // Pour que le message corresponde au post    
                
                    "reponses" => (
                        isset($id)
                        ? $reponseManager->findListByIdDep($id, "Post", ["dateCreate", "DESC"]) // Pour afficher les réponses de chaque posts
                        : $reponseManager->findAll(["dateCreate", "DESC"]) // Pour afficher toute les réponses
                    )
                ]     
            ];
        }

        //////////////////////////////FORMULAIRE POUR AJOUTER UNE REPONSE

        public function formulaireReponse($id){     // Fonction pour accéder au formulaire des Réponses à séparer de la fonction d'ajout

            $reponseManager = new ReponseManager();
            $postManager = new PostManager();

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                                                
                "view" => VIEW_DIR."forum/formulaireReponse.php",

                "data" => [

                    "reponses" => $reponseManager->findListByIdDep($id, "post"),
                    
                    // "reponses" => (
                    //     isset($id)
                    //     ? $reponseManager->findListByIdDep($id, "post", ["dateCreate", "DESC"])
                    //     : $reponseManager->findAll(["dateCreate", "DESC"])
                    // ),

                    "post" => $postManager->findOneById($id)
                    // "post" => $postManager->findPostByIdDep($id, "Post"),
                    
                ]     
                        
            ];
        }

        //////////////////////////////AJOUTER UNE REPONSE

        public function addReponse($post_id){           // Fonction pour ajouter une réponse au post 

            $reponseManager = new ReponseManager();     // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres
            $postManager = new PostManager();     // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres

            $session = new Session();                   // Instancier pour ajouter une notification

            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');

            $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            // Pour lier la réponse à un utilisateur connecté
            $user_id = Session::getUser()->getId();
            
            $reponse_id = $reponseManager->add([
                'text' => $text, 
                'dateCreate' => $date,
                'post_id' => $post_id, 
                'user_id' => $user_id
            
            ]);                                          

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                                           
                "view" => VIEW_DIR."forum/formulaireReponse.php",
                
                $session->addFlash('success',"Ajouté avec succès"),// Afficher la notification
                
                "data" => [

                    "reponses" => $reponseManager->findListByIdDep($post_id, "post"),
                    "post" => $postManager->findOneById($post_id),
                    // "posts" => $postManager->findPostByIdDep($post_id, "Post"),
                ]                       
            ];
        }

        //////////////////////////////SUPPRIMER UNE REPONSE
        
        public function delReponse($id){                 // Fonction pour supprimer une réponse

            $reponseManager = new ReponseManager();
            $postManager = new PostManager();
            $session = new Session();                   // Instancier pour ajouter une notification

            return [                                     // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/detailPost.php", // ATTENTION Gérer le retour vers la même page

                $session->addFlash('success',"Supprimé avec succès"),// Afficher la notification

                "data" => [

                    $reponseManager->delete($id),
                    "posts" => $postManager->findAll()

                    // "posts" => (
                    //     isset($id)
                    //     ? $postManager->findListByIdDep($id, "Post", ["dateCreate", "DESC"]) // Pour afficher les réponses de chaque posts
                    //     : $postManager->findAll(["dateCreate", "DESC"]) // Pour afficher toute les réponses
                    // )

                ]
            ];
        }




    }
?>

<?php

    //RECHERCHES POUR ATTEINDRE L'OBJECTIF ET COMPRENDRE LE FRAMEWORK
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //TEST Utiliser la fonction native du framework findOneById() 

    // public function listPosts($id){
    //     //Instancier cette variable pour accéder aux méthodes de la classe
    //     $postManager = new PostManager();

    //     return [
    //         "view" => VIEW_DIR."forum/listPosts.php",
    //         "data" => [
    //             "posts" => $postManager->findOneById($id)
    //         ]
    //     ];
    // }

    //  PB Les informations des posts ne s'affichent pas et la sélection est limitée à 1 post par topic/////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TEST Utiliser la fonction native du framework findAll() 
    // public function listPosts(){

    //     //Instancier cette variable pour accéder aux méthodes de la classe
    //     $postManager = new PostManager();

    //     return [
    //         "view" => VIEW_DIR."forum/listPosts.php",
    //         "data" => [
    //             "posts" => $postManager->findAll()
    //         ]
    //     ];
    // }

    // PB Cette fonction permet d'afficher la liste de tout les posts mais dans tout les topics, la sélection n'est pas prise en compte/////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TEST Créer une fonction spécifique selectTopic() dans le PostManager.php
    // public function listPosts($id){

    //     //Instancier cette variable pour accéder aux méthodes de la classe
    //     $postManager = new PostManager();

    //     return [
    //         "view" => VIEW_DIR."forum/listPosts.php",
    //         "data" => [                     
    //             "posts" => $postManager->selectTopic($id)
    //         ]
    //     ];
    // }
    
    // PB Cette fonction entre en conflit avec le framework/////////////////////////////////////////////////////////////////////////////////////////////////////////////

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TEST Combiner les fonctions natives du framework et les managers. Cela nécessite d'ajouter aussi 2 variables $postManager et $topicManager dans listPosts.php
    // public function listPosts($id){

    //     //Instancier cette variable pour accéder aux méthodes de la classe
    //     $postManager = new PostManager();
    //     $topicManager = new TopicManager();

    //     return [
    //         "view" => VIEW_DIR."forum/listPosts.php",
    //         "data" => [                     
    //             "topics" => $topicManager->findOneById($id),
    //             "posts" => $postManager->findAll()
    //         ]
    //     ];
    // }
    
    // PB Cette méthode a le même effet que la fonction native findAll()/////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
