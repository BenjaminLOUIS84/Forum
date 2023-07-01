<?php
    namespace Model\Managers;

    use App\Manager;
    use App\DAO; 
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserManager;
    use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";

        public function __construct(){
            parent::connect();
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////
        // Créer une fonction spécifique pour afficher toutes les informations des Posts de chaque utilisateurs et d'un Topic sélectionné 
        // Cette fonction servira de complément à la fonction listPost($id) dans le forumController

        // public function selectTopic($id)
        // {
        //     $sql = "SELECT *
        //     FROM post p
        //     INNER JOIN user u
        //     ON p.user_id = u.id_user
        //     INNER JOIN topic t
        //     ON t.id_topic = p.topic_id
        //     WHERE t.id_topic = :id";
            
        //     return $this->getOneOrNullResults(
        //         DAO::select($sql, ['id' => $id], true), 
        //         $this->className
        //     );
        // }                         
        /////////////////////////////////////////////////////////////////////////////////////////////////////
    }
?>