<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link rel="stylesheet" href="../../public/Css_Pages/sign_in_up.css">
    <?php
    require_once("../Page_Structuration/meta.php");
    ?>
</head>

<body>
    <?php
    session_start();
    if (empty($_SESSION["id"])) {
        if (isset($_GET["inscrip"]) && (($_GET["inscrip"] == 0) || ($_GET["inscrip"] == 1) || ($_GET["inscrip"] == 2))) {
            $page_inscription = 10;
        } else if (isset($_GET['reset']) && (($_GET["reset"] == 2) || ($_GET["reset"] == 3))) { //ici on test le liens pour savoir quelle formulaire afficher
            $page_inscription = 15;
        } else if (isset($_GET["fail"]) && ($_GET["fail"] == 4)) {
            $page_inscription = 15;
        } else {
            $page_inscription = 1;
        }
    ?>
        <div class="container">
            <div class="login-container">
                <input id="item-1" type="radio" name="item" class="sign-in" <?php echo $page_inscription == 1 ? 'checked' : ''; ?> style="display:none;">
                <label for="item-1" class="item">Sign In</label>
                <input id="item-2" type="radio" name="item" class="sign-up" <?php echo $page_inscription == 10 ? 'checked' : ''; ?> style="display:none;">
                <label for="item-2" class="item">Sign Up</label>
                <input id="item-3" type="radio" name="item" class="forgot-password" <?php echo $page_inscription == 15 ? 'checked' : ''; ?>>
                <label for="item-3" class="item item-reset">Reset</label>
                <div class="login-form">
                    <form class="sign-in-htm" action="<?php echo isset($_GET["state"]) && $_GET["state"] == "noconfirm" ? "../../SQL_Traitement/Validation_code.php" : "../../SQL_Traitement/traitement_connexion.php" ?>" method="post">
                        <?php
                        if (isset($_GET["state"])) {
                            if ($_GET["state"] == "noconfirm") {
                                echo '<h2 class="comment">Vous devez confirmer votre compte avant de vous connecter</h2>';
                                echo '<h3 class="comment">Vous avez reçu un email contenant un code</h3>';
                            }
                            if (isset($_GET["fail"]) && $_GET["fail"] == "1") {
                                echo '<h2 id="fail" class="comment" >Mauvais Code !</h2>';
                            }
                        } else { //Si state n'est pas définis
                            echo '<h2 class="comment">Connectez-vous à Sirius !</h2>';
                            if (isset($_GET["fail"]) && $_GET["fail"] == "0") {
                                echo '<h2 id="fail" class="comment" >Aucun compte pour cette email !</h2>';
                            }
                            if (isset($_GET["fail"]) && $_GET["fail"] == "2") {
                                echo '<h2 id="fail" class="comment" >Vos logins sont faux !</h2>';
                            }
                        }
                        ?>
                        <?php if (isset($_GET["state"]) && $_GET["state"] == "noconfirm") { ?>
                            <div class="group">
                                <input placeholder="Saissisez le code reçu dans l'email" id="user" name="code" type="text" class="input" required>
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Vérifier le code" name="Valider_code">
                            </div>
                            <div class="hr"></div>
                            <div class="footer">
                                <a href="../../SQL_Traitement/mail_code_confirmation.php">Renvoyer le code</a>
                            </div>
                        <?php } else if (isset($_GET["state"]) && $_GET["state"] == "end") {
                            echo '<h2 class="comment">Fin de l\'inscription</h2>'; ?>
                            <div class="group">
                                <input placeholder="Username" id="user" name="email" type="email" class="input" autocomplete="username" required pattern="[a-zA-Z.-]+@([a-z.A-Z]*)(junia.com)$">
                            </div>
                            <div class="group">
                                <input placeholder="Password" id="pass" name="password" type="password" class="input" data-type="password" autocomplete="current-password" required>
                            </div>
                            <div class="group">
                                <input type="checkbox" id="remember-me" checked name="remember-me">
                                <label id="me" for="remember-me">Remember me</label>
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Sign In" name="Connexion">
                            </div>
                            <div class="hr"></div>
                            <div class="footer">
                                <label for="item-3">Forgot Password ?</label>
                            </div><?php
                                } else if (empty($_GET["state"])) {
                                    if (isset($_GET["mdp"]) && $_GET["mdp"] == "reset") {
                                        echo ('<h3 class="comment">Votre mot de passe a bien été changé.</h3>');
                                    }
                                    ?>
                            <div class="group">
                                <input placeholder="Username" id="user" name="email" type="email" class="input" autocomplete="username" required pattern="[a-zA-Z.-]+@([a-z.A-Z]*)(junia.com)$">
                            </div>
                            <div class="group">
                                <input placeholder="Password" id="pass" name="password" type="password" class="input" data-type="password" autocomplete="current-password" required>
                            </div>
                            <div class="group">
                                <input type="checkbox" id="remember-me" checked name="remember-me">
                                <label id="me" for="remember-me"> Remember me</label>
                            </div>
                            <div class="group">
                                <input type="submit" class="button" value="Sign In" name="Connexion">
                            </div>
                            <div class="hr"></div>
                            <div class="footer">
                                <label for="item-3">Forgot Password ?</label>
                            </div>
                        <?php } ?>
                    </form>
                    <form class="sign-up-htm" action="../../SQL_Traitement/traitement_inscription.php" method="post">
                        <h2 class="comment">Inscrivez-vous rapidement sur Sirius !</h2>
                        <?php
                        if (isset($_GET["inscrip"]) && ($_GET["inscrip"] == 1)) { ?>
                            <h3 class="comment">Les mots de passe sont différents</h3> <?php
                                                                                    } else if (isset($_GET["inscrip"]) && ($_GET["inscrip"] == 2)) {
                                                                                        ?>
                            <h3 class="comment">L'adresse email existe déjà</h3> <?php
                                                                                    }
                                                                                    ?>
                        <div class="group">
                            <input placeholder="Email address" id="email" name="email" type="email" class="input" pattern="[a-zA-Z.-]+@(student.)(junia.com)$" autocomplete="username" autofocus="autofocus" required>
                        </div>
                        <div class="group">
                            <input placeholder="Password" id="pass1" name="password" type="password" class="input" data-type="password" autocomplete="new-password" required>
                        </div>
                        <div class="group">
                            <input placeholder="Repeat password" id="pass" name="pass" type="password" class="input" data-type="password" autocomplete="new-password" required>
                        </div>
                        <div class="group">
                            <select class="input" id="select-option" name="classe" required>
                                <option value="">Select your class</option>
                                <option value="CIR1">CIR1</option>
                                <option value="CNB1">CNB1</option>
                                <option value="CIR2">CIR2</option>
                                <option value="CNB2">CNB2</option>
                                <option value="CIR3">CIR3</option>
                                <option value="CNB3">CNB3</option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                            </select>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up">
                        </div>
                        <div class="hr"></div>
                        <div class="footer">
                            <label for="item-1">Already have an account ?</label>
                        </div>
                    </form>
                    <!-- Reset Form -->
                    <?php
                    if (empty($_GET["reset"])) { ?>
                        <form class="forgot-password-htm" action="../../SQL_Traitement/traitement_mdp.php" method="post">
                            <h2 class="comment">Mot de passe oublié ?</h2>
                            <?php
                            if (isset($_GET["fail"]) && $_GET["fail"] == 4) {
                                echo "<h2 id='fail' class='comment'>L'email est inconnue</h2>";
                            }
                            ?>
                            <div class="group">
                                <input placeholder="Email adress" id="reset-email" name="reset-email" type="email" class="input" required autocomplete="username" pattern="[a-zA-Z.-]+@([a-z.A-Z]*)(junia.com)$">
                            </div>
                            <div class="group">
                                <input type="submit" class="button" name="Reset" value="Reset">
                            </div>
                            <div class="hr"></div>
                            <div class="footer">
                                <label for="item-2" class="reset-link">Pas de compte ? <br> S'inscrire</label>
                            </div>
                        </form> <?php
                            }
                            if (isset($_GET["reset"])) {
                                if ($_GET["reset"] == 2) {
                                ?> <form action="../../SQL_Traitement/traitement_changement_mdp.php" method="post">
                                <h2 class="comment">Confirmation par code</h2>
                                <h3 class="comment">Vous avez reçu un email contenant un code</h3>
                                <?php if (isset($_GET["fail"]) && $_GET["fail"] == "1") {
                                        echo '<h2 id="fail" class="comment" >Mauvais Code !</h2>';
                                    } ?>
                                <div class="group">
                                    <input placeholder="Saissisez le code reçu par email" id="user" name="code_reset" type="text" class="input" required>
                                </div>
                                <div class="group">
                                    <input type="submit" class="button" value="Vérifier le code" name="Valider_code_reset">
                                </div>
                                <div class="hr"></div>
                                <div class="footer">
                                    <a href="../../SQL_Traitement/mail_code_confirmation.php">Renvoyer le code</a>
                                </div>
                            </form> <?php
                                } else if ($_GET["reset"] == 3) { ?>
                            <!-- on demande a l'urilisateur de saisir son nouveau mot de passe -->
                            <form action="../../SQL_Traitement/traitement_mdp_bdd.php" method="post">
                                <h3 class="comment">Changement du mot de passe</h3>
                                <?php
                                    if (isset($_GET["fail"]) && $_GET["fail"] == 3) {
                                        echo ('Il faut un mot de passe valide pour se connecter.');
                                    }
                                ?>
                                <div class="group">
                                    <input placeholder="Saissisez votre nouveaux mot de passe" id="user" name="pass" type="password" class="input" required>
                                </div>
                                <div class="group">
                                    <input type="submit" class="button" placeholder="Changer le mot de passe" name="Changer_code_reset">
                                </div>
                                <div class="hr"></div>
                                <div class="footer">
                                    <h3>C'est presque finit !</h3>
                                </div>
                            </form> <?php
                                }
                            }
                                    ?>
                </div>
            </div>
        <?php } else {
        header("Location: ../../index.php");
    }
        ?>
</body>

</html>