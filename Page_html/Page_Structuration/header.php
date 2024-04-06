<style> 
    /*CSS de la navbar*/

    .navbar{
        background-color: var(--violet_isen);
        padding: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        border-bottom-right-radius: 20px;
        border-bottom-left-radius: 20px;
    }
    #titre-nav{
    color:white; 
    text-align: center;
    margin: 0;
    }
    .logo img{
        width: 70px;
        height: 70px;
    }

    .icon{
        fill: white;
        cursor: pointer;
    }

    .navbar input, .nav-menu, .dropdown{
        display: none;  
    }


    [id^=btn]:checked + ul{
        display: block;
        z-index: 1;
        list-style-type: none;
    }
    [id^=btn]:checked .image{
        z-index: 2; /*pour cacher lorsque le menu est ouvert*/ 
    }
    .nav-menu{
        background-color: var(--violet_isen);
        position: absolute;
        top: 50px;
        left: 0;
        right: 0;
    }

    .nav-item a, .drop-item a, .show{
        color: white;
        text-decoration: none;
        line-height: 70px;
        font-size: 1.2rem;
    }



    @media screen and (min-width: 935px){
        .icon{
            display: none;
        }
        .nav-menu{
            display: initial;
            position: static;
        }
        .nav-item{  
            display: inline-block;
            margin-left: 20px;
            position: relative;
            padding-right: 20px;
        }
        .dropdown{
            position: absolute;
            background-color: black;
            top: 50px;
            right: 0;
            padding-right: 40px;
            width: max-content;
        }
        .drop-item{
            padding: 20px 0 20px 0;
        }
        .nav-item a {
            line-height: 10px;
        }
        .surlignement a::after{
            content: "";
            display: block;
            width: 100%;
            height: 3px;
            margin: 0 ;
            transform: scale(0);
            background: var(--orange_isen);
            transition: transform 0.2s ease-in-out;
        }
        .surlignement a:hover::after{
            transform: scale(1);
        }
        #contact a{
            border: solid 2px var( --orange_isen);
            background-color: var(--orange_isen);
            color: white;
            border-radius: 30px;
            padding: 10px 20px 10px 20px;
        }
        #contact a:hover{
            border: solid 2px var(--orange_isen);
            background-color: white;
            color: var(--violet_isen);
            border-radius: 30px;
            padding: 10px 20px 10px 20px;
        }
    }

    <?php
        $uri = $_SERVER['REQUEST_URI'];
        $chemin_image = '';
        
        if (strpos($uri, 'Page_html/Page_PHP') !== false) {
            require_once("../../SQL_Traitement/DB_connect.php");
            $chemin_image = '../../public/Images/Images.jpg/test.jpg';
        } else {
            $chemin_image = 'public/Images/Images.jpg/test.jpg';
            require_once("SQL_Traitement/DB_connect.php");
        }
    ?>
    .text-container h2{
    font-size: 22px;
    color: rgba(255,255,255,.2);
    background-image: url("<?php echo $chemin_image ?>");
    /* background-position: center; */
    background-size: 270px;
    background-repeat: repeat-x;
    -webkit-background-clip: text;
    animation: animate 15s linear infinite;
    }

    @keyframes animate {
    0% {
        background-position: left 0px top 0px;
    }
    40% {
        background-position: left 800px top 0px;
    }
    }

    .text-container {
    text-align: center;
    }
</style>
<nav class="navbar">
        <!-- on met le logo sirius -->
        <div class="logo">
            <?php 
                if(strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true){ //si on n'est pas dans l'index alors on change le liens de l'Accueil
                    echo '<a href="../../index.php"><img src="../../public/Images/Icons/Sirius.png" alt="logo sirius"></a>';
                    } else {
                        echo '<a href="index.php"><img src="public/Images/Icons/Sirius.png" alt="logo sirius"></a>';
                    }
            ?>
        </div>
        <div class="text-container">
            <?php 
            //on appel la bdd
                //on recupere le texte stocké dans la bdd
                $text = $conn->query('SELECT mess FROM admin WHERE id = 1')->fetchColumn();
                if(isset($_COOKIE["user_id"])){
                    echo"<h2>$text</h2>"; 
                }
                
            ?>
        </div>
        <label for="btn" class="icon">
            <svg viewBox="0 0 100 80" width="40" height="40">
                <rect width="100" height="15"></rect>
                <rect y="35" width="100" height="15"></rect>
                <rect y="70" width="100" height="15"></rect>
            </svg>
        </label>
        
 

        <input type="checkbox" id="btn">
        <ul class="nav-menu">
            <li class="nav-item surlignement">
            <?php 
                if(strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true){ //si on n'est pas dans l'index alors on change le liens de l'Accueil
                    echo'<a href="../../index.php">Accueil</a>';
                } else {
                    echo'<a href="index.php">Accueil</a>';
                }
            ?>
        </li>
        <li class="nav-item surlignement">
            <?php 
                if(strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true){
                    echo'<a href="classement.php">Classement</a>';
                } else {
                    echo'<a href="Page_html/Page_PHP/classement.php">Classement</a>';
                }
            ?>
        </li>
        <li class="nav-item surlignement">
            <?php
                if(strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true){ //si on n'est pas dans l'index alors on change le liens ds notes
                    echo'<a href="moyennes.php">Moyenne</a>';
                } else {
                    echo'<a href="Page_html/Page_PHP/moyennes.php">Moyenne</a>';
                }
            ?>
        </li>
        <li class="nav-item surlignement">
            <?php
                if(strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true){ //si on n'est pas dans l'index alors on change le liens ds notes
                    echo'<a href="mesnotes.php">Mes notes</a>';
                }else {
                    echo'<a href="Page_html/Page_PHP/mesnotes.php">Mes notes</a>';
                } 
            ?>   
        </li>
        <li id="contact" class="nav-item">
            <?php //si on est pas co alors se co sinon afficher profils
                if (!isset($_COOKIE['user_id'])){ //si on est pas connecté  //si on est pas connecté
                    unset($_SESSION['id']);
                    unset($_SESSION['email']);
                    session_destroy();
                    if(strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP/') == true){
                            echo'<a href="sign_in_up.php">Se Connecter</a>';// 
                    } else {
                        echo'<a href="Page_html/Page_PHP/sign_in_up.php">Se Connecter</a>';// ../../Page_html/Page_PHP/sign_in_up.php
                    }
                } else {
                            //si on est connecté est que l'on est dans l'index alors
                    if(strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true){
                        echo'<a href="compte.php">Profil</a>'; //changer l'url au dessus
                    } else {
                        echo'<a href="Page_html/Page_PHP/compte.php">Profil</a>';
                    }
                }
            ?>
        </li>
    </ul>
</nav>