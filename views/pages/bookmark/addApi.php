    <!--
    //
    // Fonction: Formulaire intermédiaire permettant de remplir le formulaire bookmark/add.php
    // Route: app_bookmark_addApi / Controller: BookmarkController / Methode: addApi
    //
    -->

<h1>Ajouter un favori avec l'API</h1>

<?php include '_errors.php' ?>

<form method="POST" class="form-container">
  
    <div><label for="urlApi" class="form-label">Url du favori:</label></div>
    <div><input type="url" id="urlApi" name="urlApi" required size="30" class="form-input"></div>

    <div><input type="submit" value="Appeler l'API" class="form-submit" /></div>

     <em>Powered by <a href="https://jsonlink.io/">JsonLink API</a></em> 

  
</form>

<script src="./public/js/validation/addpi-validation.js"></script>