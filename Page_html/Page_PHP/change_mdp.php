<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once "../Page_Structuration/meta.php"; ?>
    <?php require_once("../Page_Structuration/meta.php"); ?>
    <link rel="stylesheet" href="../../public/Css_Pages/change.css">
</head>

<body>
    <div class="container">
        <div class="login-container">
            <input id="item-1" type="radio" name="item" class="sign-in" checked style="display:none;">
            <label for="item-1" class="item">Confirmation</label>
            <input id="item-2" type="radio" name="item" class="sign-up" style="display:none;">
            <div class="login-form">
                <form class="sign-in-htm" action="../../SQL_Traitement/traitement_changement_mdp.php" method="post">
                    <h2 class="comment">Confirmation par code</h2>
                    <div class="group">
                        <input placeholder="Code reçu par email" id="user" name="code_reset_in" type="text" class="input" autocomplete="username" required>
                    </div>

                    <div class="group">
                        <input type="submit" class="button" name="Valider_code_reset_in" value="Valider Code">
                    </div>
                    <div class="hr"></div>
                    <div class="footer">
                        <label for="item-3">L'email peut prendre quelques minutes à arriver</label>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>