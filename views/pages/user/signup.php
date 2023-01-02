    <!--
    //
    // Fonction: Page où les utilisateurs peuvent s'inscrire
    // Route: app_user_signup / Controller: UserController / Methode: signup
    //
    -->

<h1>Inscription</h1>

<?php include '_errors.php' ?>

<form method="POST" class="form-container">
  
  <div><label for="nickname" class="form-label">Pseudonyme</label></div>
  <div><input type="text" id="nickname" name="nickname" size="30" required minlength="4" class="form-input"></div>
    
  <div><label for="email" class="form-label">Adresse email</label></div>
  <div><input type="email" id="email" name="email" size="30" required class="form-input"></div>
  

  <div><label for="password" class="form-label">Mot de passe</label></div>
  <div><input type="password" id="password" name="password" size="30" 
  required class="form-input" onChange="onChange()" ></div>
      
  <div><label for="confirm_password" class="form-label">Répétez votre mot de passe</label></div>
  <div><input type="password" id="confirm_password" name="confirm_password" size="30" 
  required class="form-input" onChange="onChange()" ></div>
  
  
  <div><button type="submit" class="form-submit">S'inscrire</button></div>
  
</form>

<script src="./public/js/validation/signup-validation.js"></script>