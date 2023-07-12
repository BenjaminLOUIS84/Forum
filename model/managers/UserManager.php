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