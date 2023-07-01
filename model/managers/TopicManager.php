<?php
    namespace Model\Managers;

    use App\Manager;
    use App\DAO; 
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserManager;
    use Model\Managers\PostManager;
    
    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }
        // On peut créer d'autres méthodes dans cet objet (CF expl PostManager)

         /////////////////////////////////////////////////////////////////////////////////////////////////////
        // Créer une fonction spécifique pour afficher toutes les informations des Topics d'une Catégorie 
        // Cette fonction servira de complément à la fonction listTopics($id) dans le forumController

        // public function selectByCategory($id)
        // {
        //     $sql = "SELECT *
        //     FROM category c
        //     INNER JOIN topic t
        //     ON c.id_category = t.category_id
        //     WHERE c.id_category = :id";
            
        //     return $this->getMultipleResults(
        //         DAO::select($sql, ['id' => $id], true), 
        //         $this->className
        //     );
        // }                         
        /////////////////////////////////////////////////////////////////////////////////////////////////////
        
    }
   
?>