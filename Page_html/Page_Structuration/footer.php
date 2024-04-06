<style>
  /*footer*/
  .container-footer {
    max-width: 1170px;
    margin: auto;
  }

  .footer {
    background-color: var(--orange_isen);
    padding: 70px 0;
  }

  .row {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;

  }

  .footer-col {
    width: 43%;
    padding: 0 15px;
  }

  .footer-col h4 {
    font-size: 18px;
    color: white;
    margin-bottom: 35px;
    font-weight: 500;
    position: relative;
  }

  .footer-col h4::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -10px;
    background-color: var(--violet_isen);
    height: 3px;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    width: 50px;
  }

  .footer-col ul li {
    list-style-type: none;
  }

  .footer-col ul li:not(:last-child) {
    margin-bottom: 10px;

  }

  .footer-col ul li a {
    font-size: 16px;
    font-weight: 300;
    color: white;
    display: block;
    -webkit-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
    text-decoration: none;

  }

  .footer-col ul li a:hover {
    color: var(--violet_isen);
    padding-left: 5px;
  }

  .footer-col .social-lien a {
    display: inline-block;
    height: 40px;
    width: 40px;
    background-color: rgba(255, 254, 254, 0.2);
    margin: 0 10px 10px 0;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    color: white;
    -webkit-transition: all 0.7S ease;
    -o-transition: all 0.7S ease;
    transition: all 0.7S ease;

  }

  .footer-col .social-lien p {
    font-size: 16px;
    text-transform: capitalize;
    font-weight: 300;
    color: white;
    display: block;
  }

  .footer-col .social-lien a:hover {
    color: #24262b;
    background-color: white;
  }

  /* le responsive pour le footer */
  @media(max-width:570px) {
    .footer-col {
      width: 100%;
      padding-top: 50px;

    }

    .footer {
      padding-top: 0;
    }
  }
</style>
<footer class="footer">
  <div class="container-footer">
    <div class="row">
      <div class="footer-col">
        <h4>Pages</h4>
        <ul>
          <li>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true) { //si on n'est pas dans l'index alors on change le liens de l'Accueil
            ?> <a href="../../index.php">Accueil</a> <?php
                                                    } else {
                                                      ?> <a href="index.php">Accueil</a> <?php
                                                                                        }
                                                                                          ?>
          </li>
          <li>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true) {
            ?> <a href="classement.php">Classement</a> <?php
                                                      } else {
                                                        ?> <a href="Page_html/Page_PHP/classement.php">Classement</a> <?php
                                                                                                                    }
                                                                                                                      ?>
          </li>
          <li>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true) { //si on n'est pas dans l'index alors on change le liens ds notes
            ?> <a href="moyennes.php">Moyenne</a> <?php
                                                } else {
                                                  ?> <a href="Page_html/Page_PHP/moyennes.php">Moyenne</a> <?php
                                                                                                          }
                                                                                                            ?>
          </li>
          <li>
            <?php
            if (strpos($_SERVER['REQUEST_URI'], 'Page_html/Page_PHP') == true) { //si on n'est pas dans l'index alors on change le liens ds notes
            ?><a href="mesnotes.php">Mes notes</a> <?php
                                                  } else {
                                                    ?><a href="Page_html/Page_PHP/mesnotes.php">Mes notes</a> <?php
                                                                                                            }
                                                                                                              ?>
          </li>
          <li>
            <?php //si on est pas co alors se co sinon afficher profils
            if (isset($_SESSION["id"]) == false) { //si on est pas connecté
              if (strpos($_SERVER['REQUEST_URI'], '/Page_html/Page_PHP/') == true) {
            ?><a href="sign_in_up.php">Se Connecter</a><?php // 
                                                      } else {
                                                        ?><a href="Page_html/Page_PHP/sign_in_up.php">Se Connecter</a> <?php // ../../Page_html/Page_PHP/sign_in_up.php
                                                                                                                      }
                                                                                                                    } else {
                                                                                                                      //si on est connecté est que l'on est dans l'index alors
                                                                                                                      if (strpos($_SERVER['REQUEST_URI'], '/Page_html/Page_PHP/') == true) {
                                                                                                                        ?> <a href="graph.php">Graphiques</a> <?php  //changer l'url au dessus
                                                                                                                                                                    } else {
                                                                                                                                                                      ?> <a href="Page_html/Page_PHP/graph.php">Graphiques</a> <?php
                                                                                                                                                                              }
                                                                                                                                                                            }
                                                                                                                                                                                ?>
          </li>
          <li>
            <?php //si on est pas co alors se co sinon afficher profils
            if (isset($_SESSION["id"]) == false) { //si on est pas connecté
              if (strpos($_SERVER['REQUEST_URI'], '/Page_html/Page_PHP/') == true) {?>
                <a href="sign_in_up.php">Se Connecter</a><?php // 
              } else {?>
                <a href="Page_html/Page_PHP/sign_in_up.php">Se Connecter</a> 
              <?php // ../../Page_html/Page_PHP/sign_in_up.php
                                                                                                                      }
              } else {
                //si on est connecté est que l'on est dans l'index alors
                if (strpos($_SERVER['REQUEST_URI'], '/Page_html/Page_PHP/') == true) { ?> 
                  <a href="compte.php">Profil</a> <?php  //changer l'url au dessus
                } else {?> 
                 <a href="Page_html/Page_PHP/compte.php">Profil</a> <?php
                 }
                } ?>
          </li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Nous Suivre</h4>
        <div class="social-lien">
          <a target="_blank" href="https://www.facebook.com/ISEN.Lille/?locale=fr_FR"><i class="fab fa-facebook-f"></i></a>
          <a target="_blank" href="https://www.instagram.com/isen_lille/?hl=fr"><i class="fab fa-instagram"></i></a>
          <a target="_blank" href="https://twitter.com/isenlille?lang=fr"><i class="fab fa-twitter"></i></a>
          <a target="_blank" href="https://www.youtube.com/channel/UCMUaKrCftlybQKkXL4-fEbw"><i class="fa-brands fa-youtube"></i></a>
          <a target="_blank" href="mailto:clement.tassin@student.junia.com?"><i class="fa fa-envelope"></i></a>
          <a target="_blank" href="https://www.google.com/maps/place/Junia+ISEN+Lille/@50.6342041,3.0487604,15z/data=!4m14!1m7!3m6!1s0x47c2d578da129f7d:0xd134d73fb7f4c699!2sJunia+ISEN+Lille!8m2!3d50.6342041!4d3.0487604!16zL20vMDg1azZr!3m5!1s0x47c2d578da129f7d:0xd134d73fb7f4c699!8m2!3d50.6342041!4d3.0487604!16zL20vMDg1azZr"><i class="fas fa-map-marker-alt"></i></a>
        </div>
        <h4>Pages légales</h4>
        <ul>

          <?php
          if (strpos($_SERVER['REQUEST_URI'], '/Page_html/Page_PHP/') == true) {
          ?><li><a href="mention_legale.php">Mentions légales</a></li><?php // 
                                                                    } else {
                                                                      ?><li><a href="Page_html/Page_PHP/mention_legale.php">Mentions légales</a></li><?php // ../../Page_html/Page_PHP/sign_in_up.php
                                                                                          } ?>
        </ul>
      </div>
    </div>
  </div>
</footer>