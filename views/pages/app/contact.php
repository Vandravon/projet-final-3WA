    <!--
    //
    // Fonction: Affiche le formulaire de contact, pour s'adresser à l'administrateur
    // Route: app_contact / Controller: ContactController / Methode: contact
    //
    -->

<h1>Formulaire de contact</h1>

<?php include '_errors.php' ?>

<form method="POST" class="form-container">
  
    <div><label for="title" class="form-label">Sujet:</label></div>
    <div><input type="text" id="title" name="title" required size="80" maxlength="255" class="form-input"></div>
    
    <div><label for="content" class="form-label">Veuillez formuler votre demande svp:</label></div>
    <div><textarea id="content" name="content" rows="7" cols="80" 
                    required maxlength="8192" class="form-input"></textarea></div>   

    <div><input type="submit" value="Envoyer le formulaire" class="form-submit" /></div>
    
  
</form>

<script src="./public/js/validation/contact-validation.js"></script>