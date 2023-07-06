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

            return [
                "view" => VIEW_DIR."forum/listCategories.php",

                "data" => [                             // Fonction native du FrameWork findAll() (se trouve dans Manager.php) on demande à la variable d'utiliser cette fonction

                    "categories" => $categoryManager->findAll(["name","ASC"])
                ]                               
            ];                                          // Permet d'afficher toutes les catégories
        }

        public function addCategory(){           // Fonction pour accéder au formulaire des Topics selon la catégorie

            $categoryManager = new CategoryManager();   // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                "view" => VIEW_DIR."forum/addCategory.php",

                "data" => [                             
                    "categories" => 
                        
                        $categoryManager->findAll(),
                        $categoryManager->add(['name' => $name])
                    
                ]                               
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

        public function formulaireTopic($idCategory){   // Fonction pour accéder au formulaire des Topics selon la catégorie

            $topicManager = new TopicManager();         // Instancier cette variable pour accéder aux méthodes de la classe et ajouter les filtres

            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $textTopic = filter_input(INPUT_POST, 'textTopic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $pseudoTopic = filter_input(INPUT_POST, 'pseudoTopic', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            

            return [                                    // Le nom de la fonction doit correspondre avec le fichier cible pour accéder à celui ci
                "view" => VIEW_DIR."forum/formulaireTopic.php",

                "data" => [                             
                    
                    "topics" => $topicManager->findListByIdDep($idCategory, "category")
                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                    //"topics" => $topicManager->findAll()  
                    
                    // "topics" => (                    // A utiliser en cas de besoin
                    //     isset($idCategory)
                    //         ? $topicManager->findListByIdDep($idCategory, "category")
                    //         : $topicManager->add()
                    // )
                    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                ]                               
            ];                                          
        }

        // public function addTopic($idCategory){          // Fonction pour ajouter un Topic selon la catégorie
            
        //     $topicManager = new TopicManager();         // Instancier cette variable pour accéder aux méthodes de la classe 

        //     return [
        //         "view" => VIEW_DIR."forum/listTopics.php",

        //         "data" => [                             // Les fonctions natives du FrameWork findAll() et findOneById($id) (se trouvent dans Manager.php) on demande à la variable d'utiliser cette fonction

        //             "topics" => (
        //                 isset($idCategory)
        //                 ? $topicManager->findListByIdDep($idCategory, "category", ["creationdate", "DESC"])
        //                 : $topicManager->findAll(["creationdate", "DESC"])
        //             )
        //         ]                               
        //     ];                                          
        // }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // POSTS FONCTIONS

        public function listPosts($idTopic){                // Fonction permettant d'afficher la liste de tout les posts de chaque utilisateurs selon le topic sélectionné

            //Instancier cette variable pour accéder aux méthodes de leurs classes
            $postManager = new PostManager();

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

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        // OBJECTIFS: Créer une fonction pour permettre l'ajout et l'affichage des réponses dans un tableau

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        public function detailPost($id){                          // Fonction permettant d'afficher le détail d'un post (le message du post)

            //Instancier cette variable pour accéder aux méthodes de leurs classes
            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR."forum/detailPost.php",
                "data" => [                     
                    "posts" => $postManager->findPostByIdDep($id) // Pour que le message corresponde au post    
                ]
            ];
        }
    }
?>

<?php
    //RECHERCHES POUR ATTEINDRE L'OBJECTIF
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
