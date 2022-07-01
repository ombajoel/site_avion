<?php 
session_start();
require('config/database.php');
require('config/fonctions.php');

// sI LE FORMULAIRE A ETE SOUMIS

 if(isset($_POST['newCompte'])){
  
    if(not_empty(['nom','password','confirmation','email'])){
        $errors=[];
        extract($_POST);
        

        // verifications des conditions
         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
             $errors[]="L'adresse email n'est pas valide";
         }
         if(mb_strlen($password)<6){
            
             $errors[]='Le mot de passe est trop court (minimum 6 caractères)';
    
          }
          else if($password!=$confirmation){
             $errors[]='Les deux mot de passe ne sont pas identiques'; 
            
          }
         
          if(is_already_in_use('email_client',$email,'client')){
             $errors[]="Adresse email  déjà utilisé";
            
          }
          if(mb_strlen($nom)<3){
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
                                
                              redirect('index.php?id='.$data->id_client);
                             }

                        
          }
          else{
             
            $errors[]='Veillez remplir les champs';
        
            save_data();
      }
    }


 }




 // partie connexion
 if(isset($_POST['connexion'])){
 
    if(not_empty(['email','password'])){
      
        $errors=[];
        extract($_POST);

        // verification dans la base de données
        if(isset($_POST['email'])&& $_POST['email']=='campapharma@gmail.com' && isset($_POST['password']) &&$_POST['password']=="pharmacie" ){
            redirect('store.php');
          }
        
        if($emai=is_already_in_use('email_client',$email,'client')){
         
            $q=$db->prepare('SELECT password_client FROM client  where ( email_client=:email)');
             $q->execute([
                'email' =>$email
            ]);
        
            $data=$q->fetch(PDO::FETCH_OBJ);
           
           
             if($data->password_client==sha1($password)){
                 
                $q=$db->prepare('SELECT id_client FROM client  where ( email_client=:email)');
                $q->execute([
                   'email' =>$email
               ]);
               
               $data=$q->fetch(PDO::FETCH_OBJ);
               // essai la ligne suivante est à effacer
               $_SESSION['id_client']= $data->id_client;
                    
                     $q->closeCursor();
                           
                    
                           if(isset($_POST['password']) &&$_POST['password']=="campapharma" ){
                              redirect('admin.php?id_user='.$data->id_client);
                            $errors=[];
                           }
                             else{
                               
                              redirect('index.php?id_client='.$data->id_client);
                              $errors=[];
                             }
            }else{
                $errors[]='Le mot de passe n\'est pas correcte';
                save_data(); 
            }

        }else{
            $errors[]='L\'addresse mail n\'existe pas';
            
            clear_save_data('input');
        }
    }
 
}