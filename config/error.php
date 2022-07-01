<?php
        
        if(isset($errors)&& count($errors)!=0){
          
        echo '<div class="error" style="">
        <i class="fa fa-exclamation-triangle"></i>
        <p class="error-message">'; 
                foreach($errors as $error){
                   
    
                    
                  echo'   '. $error ;
                 
                 
                }
                echo '    </p>
                <i class="fa fa-close"></i>
                </div> ';
                $errors=[];
               
            } 
            ?>
            