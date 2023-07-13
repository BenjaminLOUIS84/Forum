<?php
    namespace Model\Managers;

    use App\Manager;
    use App\DAO; 
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserManager;
    use Model\Managers\PostManager;
    use Model\Managers\ReponseManager;
    
    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";

        public function __construct(){
            parent::connect();
        }  
        
        public function findTopicsByCategoryId($id){

            $sql = "SELECT 
                        t.id_topic,
                        t.title,
                        t.category_id,
                        t.creationdate
                    FROM ".$this->tableName." t
                    INNER JOIN category c ON c.id_category = t.category_id
                    WHERE c.id_category = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }
    } 
?>