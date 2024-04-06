<?php 
    session_start();
    //on traite le code de confirmation
   //on verifie que le code est bon grace a la session
   if(isset($_POST['Valider_code_reset_in'])){
    /* $_SESSION['code'] */
    $code = 12345;
    if($code == $_POST['code_reset_in']){
        header("Location: ../Page_html/Page_PHP/sign_in_up.php?reset=3");
    }else{
        header("Location: ../Page_html/Page_PHP/sign_in_up.php?reset=2&fail=1");
        return;
    }
   }
