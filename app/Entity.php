<?php
    namespace App;

    abstract class Entity{// Fonction principale quand celle-ci recoit des clés étrangères dans une entitité 

        protected function hydrate($data){
            // $data contient un tableau associatif qui est une ligne de la base de donnée (il vient d'un fetch)
            
            // field est le nom de la colone en BDD et $value est la valeur associée (pour cet enregistrement/ligne)
            foreach($data as $field => $value){

                // field = marque_id
                // fieldarray = ['marque','id']
                // explode() (comme .split() dans d'autres langues) permet de transformer un string en tableau/array, en séparant les parties du
                // string en fonction d'un délimiteur

                // exemple : si $field == "title" => $filedArray == ["title"]
                // exemple : si $field == "category_id => $fieldArray == ["category", "id"]

                $fieldArray = explode("_", $field);

                // le "if des clés étrangères (foreign keys)"
                // si l'élément de l'index 1 (=> le 2ème) du tableau $fieldArray existe ET est == "id" (donc si on a le pattern truc_id)

                if(isset($fieldArray[1]) && $fieldArray[1] == "id"){

                    // exemple : CategoryManager
                    $manName = ucfirst($fieldArray[0])."Manager";

                    // exemple : Model\Managers\CategoryManager
                    $FQCName = "Model\Managers".DS.$manName;
                    
                    // nouvelle instance du manager ciblé
                    $man = new $FQCName();

                    // appel à la methode findOneById() du manager en fournissant l'id de l'entité liée
                    // ASTUCE : on réutilise la variable $value, qui contient maintenant un objet (instance d'entité [Category]) et lieu de l'id de 
                    // sa dépendance (de son entité liée [category_id])
                    $value = $man->findOneById($value);
                }

                // fabrication du nom du setter à appeler (ex: setMarque, setId, setTitle, setCategory)
                $method = "set".ucfirst($fieldArray[0]);
               
                // si ce setter existe alors on l'appelle et on lui fourni comme valeur $value (la valeur de la cellule en BDD ou ...)
                if(method_exists($this, $method)){
                    $this->$method($value);
                }

            }
        }

        public function getClass(){
            return get_class($this);
        }
    }
?>