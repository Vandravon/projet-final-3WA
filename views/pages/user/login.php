    <!--
    //
    // Fonction: Page où un utilisateur peut se connecter
    // Route: app_user_login / Controller: UserController / Methode: login
    //
    -->

<h1>Connexion</h1>

<?php include '_errors.php' ?>

<form method="POST" class="form-container">
    
    <div class="form-label"><label for="email">Email:</label></div>
    <div><input type="email" name="email" id="email" size="30" required class="form-input"></div>
    
    <div class="form-label"><label for="password">Mot de passe:</label></div>
    <div><input type="password" name="password" id="password" size="30" required class="form-input"></div>
    
    <div><button type="submit" class="form-submit"><span>Se connecter</span></button></div>
    
</form>

<script src="./public/js/validation/login-validation.js"></script>