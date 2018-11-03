<?php 

$title = "Connexion à votre interface d'administration";

ob_start();

?>

<section class="frame" id="authentication">
    
    <h2>Interface d'administration</h2>

    <p class="alert alert-dark">Vous tentez d'accéder à votre interface d'administration. Par mesure de sécurité, veuillez s'il vous plaît, renseigner le code d'accès.</p>
    
    <?php

        if(isset($_GET['authentication']) && $_GET['authentication'] == "failed") {
    ?>       
            <p class="alert alert-danger fade-out">L'authentification a échoué, le mot de passe que vous avez saisi est incorrect.</p>
    <?php
        }
    ?>

    <form method="post" action="index.php?action=sign-in-administration">
        
        <div>
            <label for="password"><i class="fas fa-key"></i></label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        </div>
        
        <div>
            <input type="submit" value="Connexion">
        </div>

    </form>

</section>

<?php

    $content = ob_get_clean();
    
    require('view/frontend/template.php'); 

?>