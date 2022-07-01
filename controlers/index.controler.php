<?php 

session_start();
require('config/database.php');
require('config/fonctions.php');

// sI LE FORMULAIRE A ETE SOUMIS

 if(isset($_POST['submit'])){
   die("je suis envoyé");
    if(not_empty(['name','password','passwordConfirmation','email'])){
        $errors=[];
        extract($_POST);
        

        // verifications des conditions
         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            die("erreur email");
             $errors[]="L'adresse email n'est pas valide";
         }
         if(mb_strlen($password)<6){
            die("password");
             $errors[]='Le mot de passe est trop court (minimum 6 caractères)';
    
          }
          else if($password!=$passwordConfirmation){
            die("mot de passe de confirmation");
             $errors[]='Les deux mot de passe ne sont pas identiques'; 
            
          }
         
          if(is_already_in_use('email_client',$email,'client')){
            die("erreur email utilisé");
             $errors[]="Adresse email  déjà utilisé";
            
          }
          if(mb_strlen($name)<3){
             $errors[]="Le nom ne doit être inferieur à 2 caracteres";
            
          }
          /*
          if(mb_strlen($prenom)<3){
             $errors[]="Le prenomne doit être inferieur à 2 caracteres";
            
          }
          if(mb_strlen($postnom)<3){
             $errors[]="Le prenomne doit être inferieur à 2 caracteres";
            
          }
          if(mb_strlen($tel)<=9){
             $errors[]="Le numero ne doit être inferieur à 9 caracteres";
            
          }

          if(count($errors)>7){
             
                $errors[]='Veillez remplir les champs';
            
                save_data();
          }
          */
          if(count($errors)==0){
// stockage des données
                die("je suis bien remplit");
            $q= $db->prepare('INSERT INTO client(nom_client, email_client,password_client)
                  VALUES(:nom, :email, :password)');
                  $q->execute([
                     'nom'=>$nom,
                     
                     'email'=>$email,
                     'password'=>sha1($password)
                    
                  ]);
                   
                  $q=$db->prepare('SELECT id_client FROM client  where (email_client=:email)');
                  $q->execute([
                     'email' =>$email
                 ]);
                  $data=$q->fetch(PDO::FETCH_OBJ);
                  // essai la ligne suivante est à effacer
                  $_SESSION['id_client']= $data->id_client;
                       
                        $q->closeCursor();
                       
                          clear_save_data('input');
                      
                           if(isset($_POST['password']) &&$_POST['password']=="campapharma" ){
                              redirect('count.php?id_user='.$data->id_client);
                           }
                             else{
                                
                              redirect('count.php?id='.$data->id_client);
                             }

                        
          }
          else{
             
            $errors[]='Veillez remplir les champs';
        
            save_data();
      }
    }


 }
 
?>