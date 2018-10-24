<?php 

$title = "Créez votre compte";

ob_start();

?>

<section class="frame" id="registration-container">
    
    <h2>Identifiants</h2>

    <p class="alert alert-dark">* champs obligatoires</p>

    <?php

        if(isset($_GET['error']) && $_GET['error'] == "different-passwords") {
    ?>       
            <p class="alert alert-danger fade-out">La confirmation du mot de passe ne correspond pas au mot de passse que vous avez saisi.</p>
    <?php
        }
    ?>

     <?php

        if(isset($_GET['error']) && $_GET['error'] == "username-already-used") {
    ?>       
            <p class="alert alert-danger fade-out">Le nom d'utilisateur que vous avez choisi n'est pas disponible.</p>
    <?php
        }
    ?>
    
    <?php

        if(isset($_GET['error']) && $_GET['error'] == "email-already-used") {
    ?>       
            <p class="alert alert-danger fade-out">L'adresse e-mail que vous avez renseigné est déjà utilisée.</p>
    <?php
        }
    ?>

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