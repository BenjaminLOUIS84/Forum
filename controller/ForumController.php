<?php

    namespace Controller;                               // Mettre le controlleur dans un namespace pour pouvoir le retrouver 

    use App\Session;
    use App\AbstractController;                         // Pour le faire fonctionner 
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;

    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){                        // Fonction index() qui redirige en cas de problème vers la page listCategory.php par défaut (pour éviter une page d'erreur)

            return listCategories();
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // CATEGORIES FONCTIONS

        public function listCategories(){               // Fonction pour afficher la liste de toute les catégories
            
            $categoryManager = new CategoryManager();   // Instancier cette variable pour accéder aux méthodes de la classe

            return [                                    // Fonction native du FrameWork findAll() (se trouve dans Manager.php) on demande à la variable d'utiliser cette fonction
                
                "view" => VIEW_DIR."forum/listCategories.php",

                "data" => ["categories" => $categoryManager->findAll(["name","ASC"])]                               
            ];                                          // Permet d'afficher toutes les catégories
        }

        public function formulaireCategory(){           // Fonction pour accéder au formulaire des Catégories à séparer de la fonction d'ajout et de suppression

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                
                "view" => VIEW_DIR."forum/formulaireCategory.php",                           
            ];
        }

        public function addCategory(){                  // Fonction pour ajouter une catégorie au formulaire 

            $categoryManager = new CategoryManager();   // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres
            
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $category_id = $categoryManager->add(['name' => $name]);   // Pour effectuer l'action d'ajout 

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                                           
                "view" => VIEW_DIR."forum/listCategories.php",

                "data" => ["categories" => $categoryManager->findAll()]                               
            ];
        }

        public function delCategory($id){               // Fonction pour supprimer une Catégorie

            $categoryManager = new CategoryManager();

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/listCategories.php",  // Après la suppression -> redirection sur la même page

                "data" => [$categoryManager->delete($id),"categories" => $categoryManager->findAll(["name", "ASC"])]           
            ];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // TOPICS FONCTIONS

        public function listTopics($idCategory){        // Fonction pour afficher la liste de tout les Topics selon la catégorie
            
            $topicManager = new TopicManager();         // Instancier cette variable pour accéder aux méthodes de la classe 

            return [

                "view" => VIEW_DIR."forum/listTopics.php",

                "data" => [                             // Les fonctions natives du FrameWork findAll() et findOneById($id) (se trouvent dans Manager.php) on demande à la variable d'utiliser cette fonction

                    "topics" => (
                        isset($idCategory)
                        ? $topicManager->findListByIdDep($idCategory, "category", ["creationdate", "DESC"])
                        : $topicManager->findAll(["creationdate", "DESC"])
                    )
                ]                               
            ];                                          // Permet d'afficher toutes les informations d'un topic
        }

        public function formulaireTopic($idCategory){   // Fonction pour accéder au formulaire des Catégories à séparer de la fonction d'ajout

            $topicManager = new TopicManager(); 
            
            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/formulaireTopic.php",

                "data" => ["topics" => $topicManager->findListByIdDep($idCategory, "category"),]                            
            ];
        }

        public function addTopic(){                     // Fonction pour accéder au formulaire des Topics selon la catégorie

            $topicManager = new TopicManager();         // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres
            $postManager = new PostManager();           // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');
            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Pour rédiger un post automatiquement quand on créer un topic on doit lier l'id topic au post
            
            $topic_id = $topicManager->add(['title' => $title, 'creationdate' => $date,'category_id' => $category_id, 'user_id' => $user_id]);

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/formulaireTopic.php", // Après l'ajout on reste sur la même page

                "data" => [                             // Ce référer à la base SQL pour ajouter les informations en argument dans le tableau ci dessous
                    
                    "topics" => $topicManager->findListByIdDep($category_id, "category"),

                    $postManager->add(['text' => $text, 'dateCreate' => $date, 'user_id' => $user_id, 'topic_id' => $topic_id])             
                ]                                       // Pour lier un post au topic (rédiger le texte du post dans le formulaire, inclure la dateCreate du post, l'utilisateur et le topic)                  
            ];                                          
        }

        public function delTopic($category_id){          // Fonction pour supprimer un Topic

            $topicManager = new TopicManager();

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [                                     // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/listTopics.php", // Retour vers la liste des topics de la categorie correspondante

                "data" => [  

                    "topics" => $topicManager->delete($category_id), // Pour effacer le topic

                    // "topics" => (
                    //     isset($idCategory)            // Pour renvoyer la liste des topics de la catégorie correspondante

                    //     ? $topicManager->findListByIdDep($idCategory, "topic", ["title", "DESC"])
                    //     : $topicManager->findAll(["title", "DESC"])  
                    // )

                    //"topics" => $this->listTopics()
                    //"topics" => $topicManager->findListByIdDep($category_id, "category")
                    //"topics" => $topicManager->findAll(["title", "DESC"]), // Renvoi la liste de tous les topics (La cause du problème de redirection)
                ]
            ];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // POSTS FONCTIONS

        public function listPosts($idTopic){            // Fonction permettant d'afficher la liste de tout les posts de chaque utilisateurs selon le topic sélectionné

            $postManager = new PostManager();           // Instancier cette variable pour accéder aux méthodes de leurs classes

            return [

                "view" => VIEW_DIR."forum/listPosts.php",

                "data" => [

                    "posts" => (
                        isset($idTopic)
                        ? $postManager->findListByIdDep($idTopic, "Topic", ["dateCreate", "DESC"])
                        : $postManager->findAll(["dateCreate", "DESC"])
                    )
                ]
            ];
        }

        public function formulairePost($idTopic){      // Fonction pour accéder au formulaire des Posts à séparer de la fonction d'ajout

            $postManager = new PostManager();          // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
            
            return [   
                                                
                "view" => VIEW_DIR."forum/formulairePost.php",
                
                "data" => ["posts" => $postManager->findListByIdDep($idTopic, "topic")]                            
            ];
        }

        public function addPost(){                    // Fonction pour accéder au formulaire des Posts selon le topic

            $postManager = new PostManager();              

            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');

            $topic_id = filter_input(INPUT_POST, 'topic_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
            $postManager->add(['text' => $text, 'dateCreate' => $date,'topic_id' => $topic_id, 'user_id' => $user_id]);

            return [     

                "view" => VIEW_DIR."forum/formulairePost.php",

                "data" => ["posts" => $postManager->findListByIdDep($topic_id, "topic")]                               
            ];                                          
        }

        public function delPost($id){                 // Fonction pour supprimer un Post

            $postManager = new PostManager();

            $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [                                  // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci

                "view" => VIEW_DIR."forum/listPosts.php", // ATTENTION Gérer le retour vers la même page

                "data" => [$postManager->delete($id),"posts" => $postManager->findAll(["text", "ASC"])]
            ];
        }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        // OBJECTIFS: Créer une fonction pour permettre l'ajout et l'affichage des réponses dans un tableau

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        public function detailPost($id){               // Fonction permettant d'afficher le détail d'un post (le message du post)

            $postManager = new PostManager();          //Instancier cette variable pour accéder aux méthodes de leurs classes

            return [

                "view" => VIEW_DIR."forum/detailPost.php",

                "data" => ["posts" => $postManager->findPostByIdDep($id)] // Pour que le message corresponde au post    
            ];
        }
    }
?>

<?php
    //RECHERCHES POUR ATTEINDRE L'OBJECTIF
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //TEST Utiliser la fonction native du framework indOneById() 

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
