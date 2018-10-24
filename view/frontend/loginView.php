<?php 

$title = "Connectez-vous à votre compte";

ob_start();

?>

<section class="frame" id="login-container">
    
    <h2>Identifiez-vous</h2>

    <p class="alert alert-dark">Connectez-vous avec votre adresse email et votre mot de passe pour accéder à votre compte.</p>

    <form method="post" action="index.php?action=">

        <div>
            <label for="email"><i class="fas fa-at"></i></label>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        
        <div>
            <label for="password"><i class="fas fa-key"></i></label>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        </div>
        
        <div>
            <input type="submit" value="Connexion">
        </div>

    </form>

    <p class="alert alert-info">Première visite ? 
        <a href="index.php?action=sign-up" class="alert-link">Créer un compte</a>
    </p>

</section>

<?php

    $content = ob_get_clean();
    
    require('view/frontend/template.php'); 

?>