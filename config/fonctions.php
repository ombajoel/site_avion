<?php


// la function_exists pemet de verifier si la fonction existe déjà puis renvois true,
 if(!function_exists('not_empty')){
     // création de la fonction not_empty une fonction qui reçois un tableau et verifie si les éléments en l'interieure ne sont pas vide
    function not_empty($fields=[]){
        if(count($fields)!=0){
            // utilisation de la boucle foreach qui nous aide à parcourir tous les éléments du tableau
            foreach($fields as $field){
                // trim est une fonction locale qui nous permet de supprimer les espaces dans la chaine de caractères
                // empty est une fonction locale qui nous permet de verifier si la variable est vide
                if(empty($_POST[$field])|| trim($_POST[$field]=='')){
                    
                    return false;
                }  
                
            }
            
                 
                return true;
           
        
        }

    }
}

//creation d'une autre fonction
// fonction qui verifie si la valeur donnée en parametre existe dans la base donnée elle prend trois parametre le nom du champ la valeur et le table
if(!function_exists('is_already_in_use')){
    // creation d'une fonction is_already_in_use nous permet de veriefier si le pseudo ou l'email entrer a été déjà utilisé
    // is_already_use prend en paramètre le champ la valeur, la table
    function is_already_in_use($field,$value,$table){
       
        try{
            global $db;
        // envois d'une requete à la base de données, selectionne id depuis la $table, (si) 'where' $field=?'
        $q=$db->prepare("SELECT id_client FROM $table WHERE $field= ?");
        //c'est une requete preparer 'execute' c'est pour executer notre requete
        $q->execute([$value]);
        // rowCount() c'est une fonction qui permet de compter les nombres de resultat trouver
        $count= $q->rowCount();
        // il faut fermer le curseur que nous avons utilser pour notre requête de selection à base de données grâce à la fonction closeCursor()
        $q->closeCursor();
        // si nous retournons la valeur trouvée 0 si la valeur n'existe pas dans bdd 1 si la valeur existe
        return $count;
    

   } catch(PDOException $e){
   return false;
 }

    }
}
// la foction qui nous permet d'envoyer le message  elle prend deux parametres le message et le type de message(erreure,ou succes)
if(!function_exists('set_flash')){
  
    function set_flash($message,$type='info'){
        $_SESSION['notification']['message']=$message;
        $_SESSION['notification']['type']=$type;

       
}}
// la fonction redirect permet redirection le client dans la page qui lui faut
if(!function_exists('redirect')){
  
    function redirect($page){
        header('Location:'.$page);
        exit();

       
}}
// la fonction  qui nous permet de controller que les balises html introduites ne soient pas prises en compte
if(!function_exists('e')){
  
    function e($string){
     
            if($string){
                return strip_tags($string);
            }
       
}}
// la fonction qui nous permet de stocker les données en session
if(!function_exists('save_data')){

    function save_data(){
     
            foreach($_POST as $key => $value){
                if(strpos($key,'password')===false AND strpos($key,'confirmation')===false){
                    $_SESSION['input'][$key]=$value;
                }
               
            }
       
}}
// la fonction qui nous permet recuperer les information qui sont stockées en session
if(!function_exists('get_input')){
  
    function get_input($key){
     
              if(!empty($_SESSION['input'][$key])){
                  return e($_SESSION['input'][$key]);
              }
              else{
                  return null;
              }
            
}}

if(!function_exists('get_compte')){
  
    function get_compte(){
     
              if(!empty($_SESSION['user_id']) || !empty($_SESSION['pseudo'])){
                  return true;
              }
              else{
                  return false;
              }
            
}}
if(!function_exists('get_user_data_by_id')){
  
    function get_user_data_by_id($id){
      global $db;
        $q=$db->prepare('SELECT * FROM clients  where id_client=?');
        $q->execute([$id]);
       
      return $data=$q->fetch(PDO::FETCH_OBJ);
            
}}
if(!function_exists('find_code_by_id')){
  
    function find_code_by_id($id){
      global $db;
      $q=$db->prepare('SELECT code from codes where id=?');
      $q->execute([$_GET['id']]);
      $data= $q->fetch(PDO::FETCH_OBJ);
       
      return $data;
            
}}
if(!function_exists('get_session')){
  
    function get_session($key){
     
              if(!empty($_SESSION[$key])){
                  return e($_SESSION[$key]);
              }
              else{
                  return null;
              }
            
}}

 //  la fonction qui nous permet d'effacer les données qui sont en session
if(!function_exists('clear_save_data')){
  
    function clear_save_data($donne){
     
        if(isset($_SESSION[$donne])){
            $_SESSION[$donne]=[];
        }
            
}}

// la loction qui reconnait la page dans la quelle on se trouve active l'active dans le menu
if(!function_exists('set_active')){
  
    function set_active($menu,$classe='active'){
          // $_server['script'] nous permet d'avoir le chemin de la page on se trouve
          //explode()est une fonction native qui prend deux parametres un caractere est une chaine de caractère et decoupe la chaine de caratere et les place dans un tableau
          //array_pop() est une fonction qui prend en parametre un tableau et qui renvoi le dernier élément du tableau
          $path=$_SERVER['SCRIPT_NAME'] ;
          $tableau= explode('/',$path);
          $dernier_element=array_pop($tableau);
          $_menu=$menu.'.php';
          if($_menu==$dernier_element){
            return $classe;  
         }
         else{
             return " ";
         }
     

}}



?>