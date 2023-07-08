<?php
    namespace Model\Managers;

    use App\Manager;
    use App\DAO; 
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserManager;
    use Model\Managers\PostManager;
    use Model\Managers\ReponseManager;

    class ReponseManager extends Manager{

        protected $className = "Model\Entities\Reponse";
        protected $tableName = "reponse";

        public function __construct(){
            parent::connect();
        }
    }
?>