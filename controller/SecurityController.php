<?php

    namespace Controller; 

    use App\Session;
    use App\AbstractController; //Pour le faire fonctionner 
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategoryManager;
    use Model\Managers\ReponseManager;

    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
            
            return [
                "view" => VIEW_DIR."register.php"// Pour accéder à la view register.php
            ];
    
        }
    }
?>