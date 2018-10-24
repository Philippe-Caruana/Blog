<?php 

$title = "Créez votre compte";

ob_start();

?>

<section class="frame" id="registration-container">
    
    <h2>Identifiants</h2>

    <p class="alert alert-dark">* champs obligatoires</p>

    <form method="post" action="index.php?action=addMember">
        
        <div>
            <label for="username"><i class="fas fa-user-circle"></i></label>
            <input type="text" name="username" id="username" placeholder="Nom d'utilisateur *" required>
        </div>

        <div>
            <label for="email"><i class="fas fa-at"></i></label>
            <input type="email" name="email" id="email" placeholder="Email *" required>
        </div>
        
        <div>
            <label for="password"><i class="fas fa-key"></i></label>
            <input type="password" name="password" id="password" placeholder="Mot de passe *" required>
        </div>

        <div>
            <label for="passwordConfirmation"><i class="fas fa-check"></i></label>
            <input type="password" name="passwordConfirmation" id="passwordConfirmation" placeholder="Confirmation du mot de passe *" required>
        </div>

        <input type="hidden" id="g-recaptcha" name="g-recaptcha-response" value="">
        
        <div>
            <input type="submit" value="Créer un compte">
        </div>

    </form>

</section>

<?php

    $content = ob_get_clean();
    
    require('view/frontend/template.php'); 

?>