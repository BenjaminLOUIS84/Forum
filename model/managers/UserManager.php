<?php
    namespace Model\Managers;

    use App\Manager;
    use App\DAO; 
    use Model\Managers\CategoryManager;
    use Model\Managers\TopicManager;
    use Model\Managers\UserManager;
    use Model\Managers\PostManager;
    use Model\Managers\ReponseManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";

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
                    WHERE t.category_id = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        // Fonctions pour trouver un utilisateur selon son mail ou son pseudo
        // Ces fonctions servent pour sécuriser le formulaire d'inscription 

        public function findUserByMail($mail) {
            $sql = "SELECT 
                        u.id_user,
                        u.mail,
                        u.pseudo,
                        u.password
                    FROM ".$this->tableName." u
                    WHERE u.mail = :mail";
                    
            return $this->getOneOrNullResult(
            DAO::select($sql, ['mail' => $mail], false), 
            $this->className
            );
        }

        public function findUserByPseudo($pseudo) {
            $sql = "SELECT 
                        u.id_user,
                        u.mail,
                        u.pseudo,
                        u.password
                    FROM ".$this->tableName." u
                    WHERE u.pseudo = :pseudo";
                    
            return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false), 
            $this->className
            );
        }     
    }
?>